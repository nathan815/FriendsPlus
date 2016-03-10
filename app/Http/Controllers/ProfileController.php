<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use FriendsPlus\Http\Requests;
use FriendsPlus\Http\Controllers\Controller;
use FriendsPlus\Models\User;

class ProfileController extends Controller
{
    
    public $tabs = [
      'posts' => 'Posts', 
      'pictures' => 'Pictures', 
      'friends' => 'Friends', 
      'groups' => 'Groups', 
      'info' => 'Info'
    ];
    private $view_data = [];

    public function getProfile($username, $tab = 'posts') {
      $is_owner = Auth::check() && ($username == Auth::user()->username);
      if($is_owner) {
        $user = Auth::user();
      }
      else {
        $user = User::where('username', $username)->first();
      }
      if(!$user || !array_key_exists($tab, $this->tabs)) {
        abort(404);
      }
      $statuses = $user->statuses;
      $this->view_data = [
        'user' => $user,
        'current_tab' => $tab,
        'tabs' => $this->tabs,
        'is_owner' => $is_owner,
        'statuses' => $statuses
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
      $this->view_data['posts'] = [];
      return view('profile.tabs.posts')->with($this->view_data);
    }

    private function _tabPictures() {
      $this->view_data['pictures'] = [];
      return view('profile.tabs.pictures')->with($this->view_data);
    }

    private function _tabFriends() {
      $this->view_data['posts'] = [];
      return view('profile.tabs.friends')->with($this->view_data);
    }

    private function _tabGroups() {
      $this->view_data['groups'] = [];
      return view('profile.tabs.groups')->with($this->view_data);
    }

    private function _tabInfo() {
      return view('profile.tabs.info')->with($this->view_data);
    }

}
