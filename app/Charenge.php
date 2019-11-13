<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charenge extends Model
{
  protected $table = 'charenge';
  protected $fillable = ['user_id', 'step_id'];

  public function steps() {
    return $this->hasMany('App\Step');
  }
  public function user() {
    return $this->belongsTo('App\User');
  }
}
