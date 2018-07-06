<?php

namespace Jozwikp\Flexcms\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Jozwikp\Flexcms\models\Page;
use Jozwikp\Flexcms\models\Liist;
use Jozwikp\Flexcms\models\Author;

class PhotoController extends Controller
{


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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storepagephoto(Request $request)
    {

      $request->validate([
          'photo' => 'required|mimes:jpeg,jpg,png|max:700',
          'page_id' => 'required'
      ]);

      $path = $request->photo->store('flexcms/page/'.$request->page_id, 'public');

      $photos = Storage::files('public/flexcms/page/'.$request->page_id);

      return view('flexcms::admin.photo._photolist',['photos'=>$photos]);


    }

    public function storelistphoto(Request $request)
    {

      $request->validate([
          'photo' => 'required|mimes:jpeg,jpg,png|max:700',
          'list_id' => 'required'
      ]);

      $path = $request->photo->store('flexcms/list/'.$request->list_id, 'public');
      $list = Liist::findOrFail($request->list_id);
      $list->img = Storage::url($path);
      $list->save();

      return back()->with('status','Zapisałem cover');

    }

    public function storeauthorphoto(Request $request)
    {

      $request->validate([
          'photo' => 'required|mimes:jpeg,jpg,png|max:700',
      ]);

      $path = $request->photo->store('flexcms/author/'.$request->user()->id, 'public');
      $author = Author::findOrFail($request->user()->id);
      $author->img = Storage::url($path);
      $author->save();

      return back()->with('status','Zapisałem cover');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
