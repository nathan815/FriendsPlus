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
        'gender'
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
     * Get user's name
     * @return string Name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get user's username
     * @return string Username
     */
    public function getUsername() {
        return $this->username;
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

}
