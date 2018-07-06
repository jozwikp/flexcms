<?php

namespace Jozwikp\Flexcms\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Jozwikp\Flexcms\models\Liist;
use Jozwikp\Flexcms\models\Page;

class PathController extends Controller
{


    public function resolve($path)
    {
      /*
      $requested = $this->extractFromPath($path);

      if(!$view = $this->returnList($requested))
      {
        $view = $this->returnPage($requested);
      }

      return $view;
      */

      $value = Cache::rememberForever($path, function() use ($path) {
        $requested = $this->extractFromPath($path);

        if(!$view = $this->returnList($requested))
        {
          $view = $this->returnPage($requested);
        }
          return $view->render();
      });

      return $value;

    }

    public function returnList($requested)
    {

      $list = Liist::with('siblings', 'parent', 'parent.siblings')
      ->where('path', $requested['path'])
      ->first();

      if(!$list)
      {
        return false;
      }

      $allPagesCount = $list->pages()->where('is_published',1)->get(['pages.id'])->count();
    
      $pages = $list->pages()
                    ->with('author','list')
                    ->where('is_published',1)
                    ->orderByDesc('created_at')
                    ->skip($requested['pagination']*config('flexcms.paginate'))
                    ->take(config('flexcms.paginate'))
                    ->get();


      return view('flexcms::list-'.$list->template, [
        'list'=>$list,
        'pages'=>$pages,
        'requested'=>$requested,
        'allPagesCount'=>$allPagesCount,
        'requested'=>$requested
      ]);
    }

    public function returnPage($requested)
    {
      // 'list.parent'
      $page = Page::with('author', 'list')->where([['path', $requested['path']],['is_published',1]])->firstOrFail();

      return view('flexcms::page-'.$page->template, [
        'page'=>$page,
        'requested'=>$requested
      ]);

    }

    public function extractFromPath($path)
    {
      $requested = [
        'path' => $path,
        'fullpath' => $path,
        'pagination' => 0
      ];

      if(preg_match('/^(.*)\/(\d+)$/', $path, $pagination))
      {
        $requested = [
          'path' => $pagination[1],
          'fullpath' => $pagination[0],
          'pagination' => $pagination[2]
        ];
      }

      return $requested;
    }
}
