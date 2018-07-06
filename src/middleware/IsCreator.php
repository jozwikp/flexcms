<?php

namespace Jozwikp\Flexcms\middleware;

use Closure;
use Jozwikp\Flexcms\models\Page;
use Jozwikp\Flexcms\models\Admin;

class IsCreator
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
      if(Page::where([['id',$request->page->id],['author_id',$request->user()->id]])->count() ||
          Admin::where('user_id', $request->user()->id)->count())
      {
        return $next($request);
      }

      return redirect('/flexcms')->with('status', 'Nie masz uprawnień do tego zasobu');
      //abort(403, 'Nie masz uprawnień do tego zasobu');
    }
}
