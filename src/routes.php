<?php


Route::group(['middleware' => ['web']], function () {
  Route::prefix('flexcms')->group(function () {
    Route::get('/', 'Jozwikp\Flexcms\controllers\AdminController@index')->middleware(Jozwikp\Flexcms\middleware\IsAuthor::class);
    Route::resource('list', 'Jozwikp\Flexcms\controllers\ListController')->middleware(Jozwikp\Flexcms\middleware\IsAdmin::class);
    Route::resource('page', 'Jozwikp\Flexcms\controllers\PageController')->middleware(Jozwikp\Flexcms\middleware\IsAuthor::class);
    Route::post('pagephoto', 'Jozwikp\Flexcms\controllers\PhotoController@storepagephoto')->name('pagephoto')->middleware(Jozwikp\Flexcms\middleware\IsAuthor::class);
    Route::post('listphoto', 'Jozwikp\Flexcms\controllers\PhotoController@storelistphoto')->name('listphoto')->middleware(Jozwikp\Flexcms\middleware\IsAuthor::class);
    Route::post('authorphoto', 'Jozwikp\Flexcms\controllers\PhotoController@storeauthorphoto')->name('authorphoto')->middleware(Jozwikp\Flexcms\middleware\IsAuthor::class);
    Route::resource('user', 'Jozwikp\Flexcms\controllers\UserController')->middleware(Jozwikp\Flexcms\middleware\IsAdmin::class);
    Route::get('author', 'Jozwikp\Flexcms\controllers\AuthorController@edit')->name('author')->middleware(Jozwikp\Flexcms\middleware\IsAuthor::class);
    Route::put('author', 'Jozwikp\Flexcms\controllers\AuthorController@update')->name('author-update')->middleware(Jozwikp\Flexcms\middleware\IsAuthor::class);
    Route::get('user/{id}/{role}/{action}', 'Jozwikp\Flexcms\controllers\UserController@role')->middleware(Jozwikp\Flexcms\middleware\IsAdmin::class);
  });
});



//Route::any('{path}', 'Jozwikp\Flexcms\controllers\PathController@resolve')->where('path', '(.*)');
