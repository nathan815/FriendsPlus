<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
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

    public function getChangeAvatarModal() {
      return view('settings.modal.avatar');
    }
    public function postUploadAvatar() {

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
