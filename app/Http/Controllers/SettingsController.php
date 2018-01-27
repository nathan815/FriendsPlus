<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;

use FriendsPlus\Http\Requests;
use FriendsPlus\Http\Requests\SettingsEditProfileRequest;
use FriendsPlus\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct() {

    }

    public function getAccount() {
      return view('settings.account')->with([
        'tab' => 'account'
      ]);
    }

    public function getProfile() {
      return view('settings.profile')->with([
        'tab' => 'profile',
        'user' => Auth::user()
      ]);
    }
    public function postProfile(SettingsEditProfileRequest $request) {

      Auth::user()->update([
        'name' => $request->input('name'),
        'username' => $request->input('username'),
        'location' => $request->input('location'),
        'bio' => $request->input('bio'),
        'gender' => $request->input('gender'),
        'website' => $request->input('website')
      ]);

      return redirect()->route('settings.profile')->withAlert([
        'type' => 'success',
        'message' => 'Your profile has been updated. Looks good!'
      ]);

    }

    public function getPassword() {
      return view('settings.password')->with([
        'tab' => 'password'
      ]);
    }

}
