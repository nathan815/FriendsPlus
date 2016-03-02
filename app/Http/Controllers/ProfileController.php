<?php

namespace SocialNetwork\Http\Controllers;

use Illuminate\Http\Request;

use SocialNetwork\Http\Requests;
use SocialNetwork\Http\Controllers\Controller;
use SocialNetwork\Models\User;

class ProfileController extends Controller
{
    
    public function getProfile($username) {
      $user = User::where('username', $username)->first();
      if(!$user) {
        abort(404);
      }
      return view('user.profile')->with([
        'user' => $user
      ]);
    }

}
