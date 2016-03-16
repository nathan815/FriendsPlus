<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Input;
use Image;

use FriendsPlus\Http\Requests;
use FriendsPlus\Http\Controllers\Controller;
use FriendsPlus\Models\User;
use FriendsPlus\Models\Status;

class ProfileController extends Controller
{
    
    public $tabs = [
      'posts' => 'Posts', 
      'pictures' => 'Pictures', 
      'friends' => 'Friends', 
      'groups' => 'Groups', 
      'info' => 'Info'
    ];
    private $user;
    private $view_data = [];

    public function getProfile($username, $tab = 'posts') {
      $is_owner = Auth::check() && ($username == Auth::user()->username);
      if($is_owner) {
        $this->user = Auth::user();
      }
      else {
        $this->user = User::where('username', $username)->first();
      }
      if(!$this->user || !array_key_exists($tab, $this->tabs)) {
        abort(404);
      }
      $this->view_data = [
        'user' => $this->user,
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
      $this->view_data['statuses'] = Status::where('user_id', $this->user->id)->orWhere('to_user_id', $this->user->id)->orderBy('created_at', 'desc')->get();
      return view('profile.tabs.posts')->with($this->view_data);
    }

    private function _tabPictures() {
      $this->view_data['pictures'] = [];
      return view('profile.tabs.pictures')->with($this->view_data);
    }

    private function _tabFriends() {
      return view('profile.tabs.friends')->with($this->view_data);
    }

    private function _tabGroups() {
      $this->view_data['groups'] = [];
      return view('profile.tabs.groups')->with($this->view_data);
    }

    private function _tabInfo() {
      return view('profile.tabs.info')->with($this->view_data);
    }

    public function getChangeAvatarModal() {
      return view('settings.modal.avatar');
    }

    public function postUploadAvatar(Requests\UploadAvatarRequest $request) {
      $user = Auth::user();
      $file = $request->file('avatar');

      $image = Image::make($file);
      $fileName = $user->id . '_' . time() . '.png';
      $path = storage_path() . '/app/public' . $user->avatar_directory . $fileName;
      $image->resize(200, 200);

      if($image->save($path)) {
        $user->avatar = $fileName;
        $user->save();
      }

      return redirect()->route('user.profile', $user->username);
    }

    public function postDeleteAvatar() {
      $user = Auth::user();
      $user->avatar = null;
      $user->save();
      return response()->json([
        'success' => true,
        'url' => $user->getAvatarUrl()
      ]);
    }

}
