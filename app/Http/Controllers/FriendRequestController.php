<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use FriendsPlus\Http\Requests;
use FriendsPlus\Http\Controllers\Controller;
use FriendsPlus\Models\User;

class FriendRequestController extends Controller
{
    
    public function __construct(Request $request) {
      $this->request = $request;
    }

    public function postAdd() {
      $username = $this->request->input('username');
      $user = User::where('username', $username)->first();
      if(!$user) {
        abort(404);
      }
      if(Auth::user()->hasFriendRequestFrom($user) || $user->hasFriendRequestFrom(Auth::user())) {
        return response()->json([
          'success' => false,
          'error' => 'There is already a friend request between you and this person.'
        ]);
      }
      if(Auth::user()->isFriendsWith($user)) {
        return response()->json([
          'success' => false,
          'error' => 'You are already friends with this person.'
        ]);
      }
      Auth::user()->addFriend($user);
      return response()->json([
        'success' => true
      ]);
    }

    public function postCancel() {
      $username = $this->request->input('username');
      $user = User::where('username', $username)->first();
      if(!$user) {
        abort(404);
      }
      if(!Auth::user()->hasFriendRequestReceived($user)) {
        return response()->json([
          'success' => false,
          'error' => 'No friend request to cancel'
        ]);
      }
      Auth::user()->cancelFriendRequest($user);
      return response()->json([
        'success' => true
      ]);
    }

    public function postDelete() {
      $username = $this->request->input('username');
      $user = User::where('username', $username)->first();
      if(!$user) {
        abort(404);
      }
      if(!Auth::user()->isFriendsWith($user)) {
        return response()->json([
          'success' => false,
          'error' => 'You are not friends with this person.'
        ]);
      }
      Auth::user()->deleteFriend($user);
      return response()->json([
        'success' => true
      ]);
    }

    public function postAccept() {
      $username = $this->request->input('username');
      $user = User::where('username', $username)->first();
      if(!$user) {
        abort(404);
      }
      if(!Auth::user()->hasFriendRequestFrom($user)) {
        return response()->json([
          'success' => false,
          'error' => 'You have not recieved a friend request from this person.'
        ]);
      }
      Auth::user()->acceptFriendRequest($user);
      return response()->json([
        'success' => true
      ]);
    }

    public function postDeny() {
      $username = $this->request->input('username');
      $user = User::where('username', $username)->first();
      if(!$user) {
        abort(404);
      }
      if(!Auth::user()->hasFriendRequestFrom($user)) {
        return response()->json([
          'success' => false,
          'error' => 'You have not recieved a friend request from this person.'
        ]);
      }
      Auth::user()->denyFriendRequest($user);
      return response()->json([
        'success' => true
      ]);
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
