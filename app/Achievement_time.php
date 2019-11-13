<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement_time extends Model
{
    protected $table = 'achievement_time';

    public function steps() {
      return $this->hasMany('App\Step');
    }
}
