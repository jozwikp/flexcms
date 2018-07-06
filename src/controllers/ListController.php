<?php

namespace Jozwikp\Flexcms\controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Jozwikp\Flexcms\models\Liist;
use Jozwikp\Flexcms\models\Page;

class ListController extends Controller
{
  /*
    public function __construct()
    {
        $this->middleware(['auth','isadmin']);
    }
    */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flexcms::admin.list.create', ['list'=> new Liist, 'lists'=>Liist::whereNull('parent_id')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        //'slug' => 'required|unique:categories|max:255',
        'name' => 'required',
      ]);

      $listData = $request->all();
      $path = $this->makePath($request);
      if(!$path)
      {
        return back()->withInput()->with('status','Jest już lista lub strona o takim adresie.');
      }

      $listData['path'] = $path;

      $newList = Liist::create($listData);
      Cache::flush();

      return redirect(route('list.edit', ['list' => $newList->id]))->with('status','Dodałem liste');

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Liist $list)
    {
        return view('flexcms::admin.list.edit', ['list'=>$list, 'lists'=>Liist::whereNull('parent_id')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liist $list)
    {
      $request->validate([
        'path' => [
          'required',
          'max:255',
          Rule::unique('lists')->ignore($list->id),
          Rule::unique('pages')
        ],
        'name' => 'required',
      ]);

      $list->update($request->all());
      //Cache::pull($request->path);

      Cache::flush();

      return redirect(route('list.edit', ['list' => $list->id]))->with('status','Zmieniłem liste');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = Liist::findOrFail($id);
        $list->delete();
        return back()->with('status', 'Skasowałem');
    }

    public function makePath($request)
    {
      $path = str_slug($request->name);

      if(!empty($request->parent_id))
      {
        $parent = Liist::find($request->parent_id);
        $path =  $parent->path.'/'.$path;
      }

      $checkLists = Liist::where('path', $path)->get(['id'])->count();
      $checkPages = Page::where('path', $path)->get(['id'])->count();

      if(!$checkLists && !$checkPages && !starts_with('flexcms/',$path))
      {
        return $path;
      }
      return false;
    }
}
