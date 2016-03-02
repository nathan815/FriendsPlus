<?php

namespace SocialNetwork\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use SocialNetwork\Http\Requests;
use SocialNetwork\Http\Controllers\Controller;
use SocialNetwork\Models\User;

class ProfileController extends Controller
{
    
    public $tabs = [
      'posts' => 'Posts', 
      'pictures' => 'Pictures', 
      'friends' => 'Friends', 
      'groups' => 'Groups', 
      'info' => 'Info'
    ];
    private $template_data = [];

    public function getProfile($username, $tab = 'posts') {
      $user = User::where('username', $username)->first();
      if(!$user || !array_key_exists($tab, $this->tabs)) {
        abort(404);
      }
      $is_owner = Auth::check() && ($user->id == Auth::user()->id);
      $this->template_data = [
        'user' => $user,
        'current_tab' => $tab,
        'tabs' => $this->tabs,
        'is_owner' => $is_owner
      ];
      switch($tab) {
        case 'posts':
          return $this->_tabPosts();
        break;
        case 'pictures':
          return $this->_tabPictures();
        break;
        case 'friends':
          return $this->_tabFriends();
        break;
        case 'groups':
          return $this->_tabGroups();
        break;
        case 'info':
          return $this->_tabInfo();
        break;
      }
    }

    private function _tabPosts() {
      $this->template_data['posts'] = [];
      return view('profile.main')->with($this->template_data);
    }

    private function _tabPictures() {
      $this->template_data['pictures'] = [];
      return view('profile.main')->with($this->template_data);
    }

    private function _tabFriends() {
      $this->template_data['posts'] = [];
      return view('profile.main')->with($this->template_data);
    }

    private function _tabGroups() {
      $this->template_data['groups'] = [];
      return view('profile.main')->with($this->template_data);
    }

    private function _tabInfo() {
      return view('profile.main')->with($this->template_data);
    }

}
