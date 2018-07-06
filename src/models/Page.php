<?php

namespace Jozwikp\Flexcms\models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $fillable = [
      'title', 'description', 'meta_description', 'tags', 'type', 'content', 'img', 'order', 'is_published',
      'author_id', 'list_id', 'path', 'template', 'meta_title'
  ];

  //protected $with = ['author', 'list', 'list.parent'];

  protected $dates = [
          'created_at',
          'updated_at',
      ];

  public function author()
  {
    return $this->hasOne('Jozwikp\Flexcms\models\Author', 'user_id', 'author_id');
  }

  public function list()
  {
    return $this->hasOne('Jozwikp\Flexcms\models\Liist', 'id', 'list_id');
  }


  public function getReadTimeAttribute()
  {
    $word = str_word_count(strip_tags($this->content));
    $m = floor($word / 200)+1;

    return $m;
  }


}
