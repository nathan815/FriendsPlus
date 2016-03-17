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
    public $GenderOptionsInverse = [
        'Male' => 1,
        'Female' => 2,
        'Other' => 3
    ];
    public $PronounOwnership = [
        1 => 'his',
        2 => 'her',
        3 => 'their'
    ];

    public $avatar_directory = '/uploads/avatars/';

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

    /**
     * Get the user's gender
     * @return int|null
     */
    public function getGender() {
        if(isset($this->GenderOptions[$this->gender])) 
            return $this->GenderOptions[$this->gender];
        else 
            return null;
    }

    /**
     * Get user's ownership pronoun (his, her, their)
     * @return string Pronoun
     */
    public function getPronounOwnership() {
        $gender = $this->gender;
        if(!$gender) $gender = $this->GenderOptionsInverse['Other'];
        return $this->PronounOwnership[$gender];
    }

    /**
     * Get user's avatar url (gravatar)
     * @param  integer $size Size of gravatar
     * @return string        URL
     */
    public function getAvatarUrl($size = 80) {
        $default = '/assets/img/icon-user-default.png';
        /*$baseUrl = 'http://gravatar.com/avatar/';
        $hash = md5($this->email);
        $url = $baseUrl . $hash . '?s=' . $size . '&d=' . $default;
        return $url;*/
        return $this->avatar ? $this->avatar_directory . $this->avatar : $default;
    }

    public function statuses() {
        return $this->hasMany('FriendsPlus\Models\Status', 'user_id');
    }

    public function statuses_from_others() {
        return $this->hasMany('FriendsPlus\Models\Status', 'to_user_id');
    }

    public function comments() {
        return $this->hasMany('FriendsPlus\Models\Comment', 'user_id');
    }

    public function likes() {
        return $this->hasMany('FriendsPlus\Models\Like', 'user_id');
    }

    public function friendsOfMine() {
        return $this->belongsToMany(
            'FriendsPlus\Models\User', 
            'friends', 
            'user_id', 
            'friend_id'
        );
    }

    public function friendOf() {
        return $this->belongsToMany(
            'FriendsPlus\Models\User', 
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

    public function hasLikedStatus(Status $status) {
        return (bool) $status->likes()
            ->where('likeable_id', $status->id)
            ->where('likeable_type', 'status')
            ->where('user_id', $this->id)
            ->count();
    }

    public function hasLikedComment(Comment $comment) {
        return (bool) $comment->likes()
            ->where('likeable_id', $comment->id)
            ->where('likeable_type', 'comment')
            ->where('user_id', $this->id)
            ->count();
    }
}
