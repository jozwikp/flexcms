<?php

namespace Jozwikp\Flexcms\middleware;

use Closure;
use Jozwikp\Flexcms\models\Author;
use Jozwikp\Flexcms\models\Admin;

class IsAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


      if(Author::where('user_id', $request->user()->id)->count() ||
          Admin::where('user_id', $request->user()->id)->count())
      {
        return $next($request);
      }
      return redirect('/home')->with('status', 'Nie masz uprawnień do tego zasobu');
    }
}
