<?php

namespace Jozwikp\Flexcms\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Jozwikp\Flexcms\models\Author;
use Jozwikp\Flexcms\models\Admin;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('flexcms::admin.user.index', [
          'users'=>User::get(),
          'authors'=>Author::with('user')->withCount('pages')->get(),
          'admins'=>Admin::with('user')->get(),
        ]);
    }

    public function role($id, $role, $action)
    {
      if($role=='admin')
      {
        if($action=='add')
        {
          $admin = Admin::create(['user_id'=> $id]);
        }
        if($action=='del')
        {
          $admin = Admin::where('user_id',$id)->delete();
        }
      }

      if($role=='author')
      {
        if($action=='add')
        {
          $user = User::findOrFail($id);
          $admin = Author::create(['user_id'=> $id, 'name'=>$user->name]);
        }
        if($action=='del')
        {
          $admin = Author::where('user_id',$id)->delete();
        }
      }

      return back()->with('status','Wykonałem polecenie');

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
    public function store(Request $request)
    {
        //
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
