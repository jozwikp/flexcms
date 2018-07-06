<?php

namespace Jozwikp\Flexcms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Jozwikp\Flexcms\models\Liist;

class FlexcmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'flexcms');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/flexcms'),
        ]);

        $this->publishes([
            __DIR__.'/flexcms.php' => config_path('flexcms.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                commands\Flexcms::class,
            ]);
        }

        /*
        $lists = Cache::rememberForever('lists', function() {
          return Liist::with('siblings')->whereNull('parent_id')->get();
        });

        view()->share('lists', $lists);
        */
        //$this->aliasMiddleware('isadmin' , __DIR__.'/middleware/'.IsAdmin::class);
        //$this->aliasMiddleware('isauthor' , __DIR__.'/middleware/'.IsAuthor::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->mergeConfigFrom(
          __DIR__.'/flexcms.php', 'flexcms'
      );


    }
}
