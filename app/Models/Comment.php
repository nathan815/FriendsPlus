<?php

namespace FriendsPlus\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    
    protected $table = 'comments';

    protected $fillable = [
      'body'
    ];

    public function user() {
      return $this->belongsTo('FriendsPlus\Models\User', 'user_id');
    }

    public function status() {
      return $this->belongsTo('FriendsPlus\Models\Status', 'status_id');
    }

    public function isOwner() {
      return Auth::check() && Auth::user()->id === $this->user_id;
    }

    public function likes() {
      return $this->morphMany('FriendsPlus\Models\Like', 'likeable');
    }

}
