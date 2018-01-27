<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use FriendsPlus\Http\Requests;
use FriendsPlus\Http\Controllers\Controller;
use FriendsPlus\Models\Status;

class HomeController extends Controller
{
  
  public function index() {
    if(Auth::check()) {
      return $this->_feed();
    }
    else {
      return $this->_home();
    }
  }

  /**
   * Home page for logged out users
   * @return view
   */
  private function _home() {
    return view('home');
  }

  /**
   * Feed page for logged in users
   * @return view
   */
  private function _feed() {
    $statuses = Status::statusesByFriendsAndMe();
    return view('feed')->with([
      'statuses' => $statuses
    ]);
  }

}
