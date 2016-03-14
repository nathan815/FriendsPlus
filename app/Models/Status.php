<?php

namespace FriendsPlus\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Status extends Model
{
    protected $table = 'statuses';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'body'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function user() {
      return $this->belongsTo('FriendsPlus\Models\User', 'user_id');
    }

    public function comments() {
      return $this->hasMany('FriendsPlus\Models\Comment', 'status_id', 'id');
    }

    public function likes() {
      return $this->morphMany('FriendsPlus\Models\Like', 'likeable');
    }

    public function isOwner() {
      return Auth::check() && Auth::user()->id === $this->user->id;
    }

    public function scopeStatusesByFriendsAndMe($query) {
      return $query->where(function($query) {
        return $query->where('user_id', Auth::user()->id)
                     ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
      })
      ->orderBy('created_at', 'desc')
      ->get();
    }

    public function getLikeInfo() {
      if($this->linkInfo) {
        return $this->likeInfo;
      }
      $likes = $this->likes->count();
      if(!$likes) {
        return null;
      }
      $you = '';
      $other_users_liked = '';
      $likes_this = ' like';

      if(Auth::check() && Auth::user()->hasLikedStatus($this)) {
        $you = 'You ';
        $likes_this = ' like';
        if($likes > 1) {
          $you .= 'and ';
          $other_users_liked = --$likes;
          if($likes > 1) {
            $other_users_liked .= ' others';
          }
          else {
            $other_users_liked .= ' other person';
            $likes_this .= 's';
          }
        }
      }
      else {
        $other_users_liked = $likes;
        if($likes > 1) {
          $other_users_liked .= ' people';
        }
        else {
          $other_users_liked .= ' person';
          $likes_this .= 's';
        }
      }

      $likes_this .= ' this.';
      $this->likeInfo = (object)[
        'you' => $you, 
        'other_users_liked' =>  $other_users_liked,
        'likes_this' => $likes_this
      ];
      return $this->likeInfo;
    }
}
