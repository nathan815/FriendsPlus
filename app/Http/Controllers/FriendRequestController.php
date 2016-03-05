<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use FriendsPlus\Http\Requests;
use FriendsPlus\Http\Controllers\Controller;

class FriendRequestController extends Controller
{
    
    public function __construct(Request $request) {
      $this->request = $request;
    }

    public function postAdd() {
      $username = $this->request->input('username');
      dd('add '.$usernmae);
    }

    public function postDelete() {
      $username = $this->request->input('username');
      dd('delete '.$username);
    }

    public function postAccept() {
      $username = $this->request->input('username');
      dd('accept '.$username);
    }

    public function postDeny() {
      $username = $this->request->input('username');
      dd('deny '.$username);
    }

    public function postCancel() {
      $username = $this->request->input('username');
      dd('cancel '.$username);
    }

    public function getRequests($type = 'to_me') {
      if($type == 'to_me') {
        $friend_requests = Auth::user()->friendRequests();
      }
      else if($type == 'from_me') {
        $friend_requests = Auth::user()->friendRequestsSent();
      }
      else {
        abort(404);
      }
      return view('user.friend.requests')->with([ 
        'friend_requests' => $friend_requests,
        'type' => $type
      ]);
    }
}
