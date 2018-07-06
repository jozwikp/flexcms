# Flexcms

Flexcms is simple and flexible yet powerful Laravel functionality.! It lets you build a page structure with lists and pages.

Every page can exist within the list or separately. You can build a blog with categories or a lonely contact page.

# Full feature list

- Use of standard authentication and user account but separated logic of admin and author - no changes to your User model
- Use of routes fallback gives you the unlimited paths flexibility
- Blade templates for lists and pages
- Pages as part of lists or standalone Pages
- Full SEO support with meta title end description
- Laravel cache for Pages and Lists - 0 database queries for page or list display
- Simple but powerful Admin and Author panel
- Easy to understand, publish and customization

### Flexible paths

The most important thing is that you can have a page or a list with whatever url you like for example:
- /my-page
- /blog/super-category/super-post-with-extra-content
- /contact
- /about/company
- /your/super/path/to/content

### Separated

Flexcms doesn't change any of the existing Laravel app. You don't even have to add anything to User model.

### Styleable

Every List or Page can have its own blade template.

### Cached

Flexcms is ultra fast. Every Page and List is fully cached. No database request.


### Installation

Laravel 5.6 with standard Authentication

```sh
composer require jozwikp/flexcms
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

### Next steps

Share the lists with the views in your AppServiceProvider.php boot() method

```sh
$lists = Cache::rememberForever('lists', function() {
          return Liist::with('siblings')->whereNull('parent_id')->get();
        });
view()->share('lists', $lists);
```

Include partials in your template (parent lists)
```sh
@include('flexcms::_lists')
```
or (parents with siblings)
```sh
@include('flexcms::_lists-siblings')
```
        
### Customize the default views

Publish the views 

```sh
php artisan vendor:publish
```

list-default.blade.php
page-default.blade.php


If you need other type of views you can copy default views and change default into other name. Use your new name while editing lists or pages.

