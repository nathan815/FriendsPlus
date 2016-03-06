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

    public function isOwner() {
      return Auth::check() && $this->user->id === Auth::user()->id;
    }

    public function scopeStatusesByFriendsAndMe($query) {
      return $query->where(function($query) {
        return $query->where('user_id', Auth::user()->id)
                     ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
      })
      ->orderBy('created_at', 'desc')
      ->get();
    }
}
