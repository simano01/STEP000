<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = ['title', 'overview', 'category_id', 'achievement_time_id'];

    public function user() {
      return $this->belongsTo('App\User');
    }
    public function child_steps() {
      return $this->hasMany('App\ChildStep');
    }
    public function category() {
      return $this->belongsTo('App\Category');
    }
    public function charenges() {
      return $this->hasMany('App\Charenge');
    }
    public function achievement_time() {
      return $this->belongsTo('App\Achievement_time');
    }
}
