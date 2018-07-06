<?php

namespace Jozwikp\Flexcms\models;

use Illuminate\Database\Eloquent\Model;

class Liist extends Model
{
  protected $fillable = [
      'name', 'description', 'meta_description', 'img', 'order', 'path', 'template', 'parent_id', 'meta_title'
  ];

  public $timestamps = false;
  protected $table = 'lists';

  public function pages()
  {
    if($this->parent_id)
    {
      return $this->hasMany('Jozwikp\Flexcms\models\Page', 'list_id', 'id');
    }

    return $this->hasManyThrough(
            'Jozwikp\Flexcms\models\Page',
            'Jozwikp\Flexcms\models\Liist',
            'parent_id', // Foreign key on users table...
            'list_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );

  }

  public function siblings()
  {
    return $this->hasMany('Jozwikp\Flexcms\models\Liist', 'parent_id', 'id');
  }

  public function parent()
  {
    return $this->hasOne('Jozwikp\Flexcms\models\Liist', 'id', 'parent_id');
  }

  //public function

}
