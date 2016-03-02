<?php

namespace FriendsPlus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use FriendsPlus\Http\Requests;
use FriendsPlus\Http\Controllers\Controller;

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
    return view('feed');
  }

}
