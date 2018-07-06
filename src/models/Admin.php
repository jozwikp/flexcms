<?php

namespace Jozwikp\Flexcms\models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  protected $primaryKey = 'user_id';
  public $incrementing = false;
  public $timestamps = false;

  protected $fillable = ['user_id'];

  public function user()
  {
    return $this->hasOne('App\User','id', 'user_id');
  }
}
