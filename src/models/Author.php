<?php

namespace Jozwikp\Flexcms\models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['bio', 'name', 'img', 'user_id'];

    public function user()
    {
      return $this->hasOne('App\User','id', 'user_id');
    }
    public function pages()
    {
      return $this->hasMany('Jozwikp\Flexcms\models\Page', 'author_id', 'user_id');
    }
}
