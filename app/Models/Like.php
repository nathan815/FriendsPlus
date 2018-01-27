<?php

namespace FriendsPlus\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $table = 'likeable';

  protected $fillable = [
    'user_id',
    'likeable_id',
    'likeable_type'
  ];

  public function likeable() {
    return $this->morphTo();
  }

  public function user() {
    return $this->belongsTo('FriendsPlus\Models\User', 'user_id');
  }

}
