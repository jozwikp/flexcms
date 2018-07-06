# Flexcms

Flexcms is simple and flexible yet powerful Laravel functionality.! It lets you build a page structure with lists and pages.

Every page can exist within the list or separately. You can build a blog with categories or a lonely contact page.


### Flexible paths


The most important thing is that you can have a page or a list with whatever url you like for example:
- /my-page
- /blog/super-category/super-post-with-extra-content
- /contact
- /about/company
- /your/super/path/to/content

### Separated

Secondly, Flexcms doesn't change any of the existing Laravel app. You don't even have to add anything to User model.

### Styleable

The last thing is the templates. Every List or Page can have its own blade template.

### Cached

The last, last thing is the fact that Flexcms is ultra fast. Every Page and List is fully cached. No database request.


### Installation

Laravel 5.6 with standard Authentication

```sh
composer require --dev jozwikp/flexcms
```

Add basic authentication

```sh
php artisan make:auth
```

Add the ServiceProvider to the providers array in config/app.php

```sh
Jozwikp\Flexcms\FlexcmsServiceProvider::class,
```

Add this line to the end of your routes/web.php

```sh
Route::any('{path}', '\Jozwikp\Flexcms\controllers\PathController@resolve')->where('path', '(.*)');
```

Run migrations

```sh
php artisan migrate
```

Add admin user with:

```sh
$ php artisan flexcms:makeadmin
```

Flexcms use images to lists and pages so you should create a symbolic link from "public/storage" to "storage/app/public" with:

```sh
$ php artisan storage:link
```

Login to your app and go to /flexcms
