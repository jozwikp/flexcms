<?php

namespace Jozwikp\Flexcms\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Jozwikp\Flexcms\models\Liist;
use Jozwikp\Flexcms\models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Jozwikp\Flexcms\models\Author;


class PageController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware(['auth','isauthor']);
        $this->middleware('iscreator')->only('edit','update');
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
        return view('flexcms::admin.page.create', [
          'page'=> new Page,
          'authors' => Author::get(),
          'lists' => Liist::whereNotNull('parent_id')->get(),
        ]);
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
        'title' => 'required',
        'author_id' => 'required',
      ]);

      $pageData = $request->all();
      $path = $this->makePath($request);
      if(!$path)
      {
        return back()->withInput()->with('status','Jest już lista lub strona o takim adresie.');
      }
      $pageData['path'] = $path;


      $newPage = Page::create($pageData);
      Cache::flush();

      return redirect(route('page.edit', ['page' => $newPage->id]))->with('status','Dodałem stronę');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
      return view('flexcms::page-'.$page->template, [
        'page'=>$page,
        'requested'=>$requested = []
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $photos = Storage::files('public/flexcms/page/'.$page->id);

        return view('flexcms::admin.page.edit', [
          'page'=> $page,
          'authors' => Author::get(),
          'lists' => Liist::whereNotNull('parent_id')->get(),
          'photos' => $photos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
      $request->validate([
        'path' => [
          'required',
          'max:255',
          Rule::unique('pages')->ignore($page->id),
          Rule::unique('lists')
        ],
        'title' => 'required',
      ]);


      $page->update($request->all());
      Cache::pull($request->path);

      return redirect(route('page.edit', ['page' => $page->id]))->with('status','Zmieniłem stronę');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function makePath($request)
    {
      $path = str_slug($request->title);

      if(!empty($request->list_id))
      {
        $startPath = Liist::find($request->list_id);
        $path =  $startPath->path.'/'.$path;
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
