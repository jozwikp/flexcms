<?php

namespace Jozwikp\Flexcms\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Jozwikp\Flexcms\models\Liist;
use Jozwikp\Flexcms\models\Page;
use Jozwikp\Flexcms\models\Admin;
use Jozwikp\Flexcms\models\Author;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->checkUser();
        return view('flexcms::admin.index',[
          'lists' => Liist::with('parent', 'siblings')->whereNull('parent_id')->get(),
          'pages' => Page::with('list', 'author')->paginate(10)
        ]);
    }

/*
    public function checkUser()
    {
      if (!Auth::check()) {
        return back()->with('status', 'Musisz być zalogowany');
      }
      $id = Auth::id();

      if(Author::where('user_id', $id)->count() ||
          Admin::where('user_id', $id)->count())
      {
        return true;
      }
      return back()->with('status', 'Nie masz uprawnień do tego zasobu');
    }
*/
}
