<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildStep extends Model
{
    protected $table = 'step_detail';
    protected $fillable = ['title', 'description', 'step_id', 'num'];

    public function user() {
      return $this->belongsTo('App\User');
    }
    public function step() {
      return $this->belongsTo('App\Step');
    }
    public function clear() {
      return $this->hasMany('App\Clear');
    }
}
