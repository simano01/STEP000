<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $table = 'user_detail';
  protected $fillable = ['name', 'image', 'introduction',];

  public function uesr() {
    return $this->belongsTo('App\User');
  }
}
