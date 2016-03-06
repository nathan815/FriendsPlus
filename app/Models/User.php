<?php

namespace FriendsPlus\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * Gender options "enum"
     * @var array
     */
    public $GenderOptions = [
        1 => 'Male',
        2 => 'Female',
        3 => 'Other'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'username', 
        'bio', 
        'location', 
        'email', 
        'password',
        'gender',
        'website'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * Search users by gender
     * @param  QueryBuilder $q
     * @param  int $gender self::GenderOptions[] id to search
     * @return QueryBuilder
     */
    public function scopeSearchGender($q, $gender) {
        return $q->where('gender', '=', $gender);
    }

    /**
     * Search users by location
     * @param  QueryBuilder $q
     * @param  string $location Location to search
     * @return QueryBuilder
     */
    public function scopeSearchLocation($q, $location) {
        return $q->where('location', 'like', "%{$location}%");
    }

    /**
     * Search users by name/username
     * @param  QueryBuilder $q
     * @param  string $query Search query
     * @return QueryBuilder
     */
    public function scopeSearchNameOrUsername($q, $query) {
        return $q->where('name', 'like', "%{$query}%")
                 ->orWhere('username', 'like', "%{$query}%");
    }

    public function getGender() {
        if(isset($this->GenderOptions[$this->gender])) 
            return $this->GenderOptions[$this->gender];
        else 
            return null;
    }

    /**
     * Get user's avatar url (gravatar)
     * @param  integer $size Size of gravatar
     * @return string        URL
     */
    public function getAvatarUrl($size = 80) {
        $baseUrl = 'http://gravatar.com/avatar/';
        $hash = md5($this->email);
        $url = $baseUrl . $hash . '?s=' . $size;
        return $url;
    }

    public function friendsOfMine() {
        return $this->belongsToMany(
            '\FriendsPlus\Models\User', 
            'friends', 
            'user_id', 
            'friend_id'
        );
    }

    public function friendOf() {
        return $this->belongsToMany(
            '\FriendsPlus\Models\User', 
            'friends', 
            'friend_id', 
            'user_id'
        );
    }

    public function friends() {
        return $this->friendsOfMine()
            ->wherePivot('accepted', true)
            ->get()
            ->merge($this->friendOf()
            ->wherePivot('accepted', true)
            ->get());
    }

    public function friendRequests() {
        return $this->friendOf()
            ->wherePivot('accepted', false)
            ->get();
    }

    public function friendRequestsSent() {
        return $this->friendsOfMine()
            ->wherePivot('accepted', false)
            ->get();
    }

    public function hasFriendRequestFrom(User $user) {
        return (bool) $this->friendRequests()
            ->where('id', $user->id)
            ->count();
    }

    public function hasFriendRequestReceived(User $user) {
        return (bool) $this->friendRequestsSent()
            ->where('id', $user->id)
            ->count();
    }

    public function isFriendsWith(User $user) {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function addFriend(User $user) {
        return $this->friendsOfMine()->attach($user->id);
    }

    public function deleteFriend(User $user) {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function cancelFriendRequest(User $user) {
        return $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user) {
        return $this->friendRequests()
                    ->where('id', $user->id)
                    ->first()
                    ->pivot->update([
                        'accepted' => true 
                    ]);
    }

    public function denyFriendRequest(User $user) {
        $this->deleteFriend($user);
    }

}
