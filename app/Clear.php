<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clear extends Model
{
  protected $table = 'step_detail_clear';
  protected $fillable = ['step_detail_id', 'user_id'];

  public function user() {
    return $this->belongsTo('App\User');
  }
}
