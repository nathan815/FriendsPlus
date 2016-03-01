<?php

namespace SocialNetwork\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

use SocialNetwork\Http\Requests;
use SocialNetwork\Http\Controllers\Controller;
use SocialNetwork\Models\User;

class AuthController extends Controller
{

  private $auth;
  private $request;

  public function __construct(Request $request, AuthManager $auth) {
    $this->auth = $auth;
    $this->request = $request;
  }

  public function getSignup() {
    return view('auth.signup');
  }
  public function postSignup(User $user) {
    
    // Validate the form
    $rules = [
      'full_name' => 'required|regex:/^[\pL\s]+$/u',
      'email' => 'required|unique:users|email|max:255',
      'username' => 'required|unique:users|alpha_dash|max:15',
      'password' => 'required|min:6',
      'confirm_password' => 'required|same:password',
      'terms' => 'accepted'
    ];
    $error_messages = [
      'terms.accepted' => 'You must agree with the terms.'
    ];
    $this->validate($this->request, $rules, $error_messages);

    // Create user
    $user->create([
      'name' => $this->request->full_name,
      'email' => $this->request->email,
      'username' => $this->request->username,
      'password' => bcrypt($this->request->password)
    ]);

    // Redirect
    return redirect()->route('home')->withAlert(['type' => 'success', 'message' => 'Welcome to Friends+! You can now login to your new account.']);

  }

  public function getLogin() {
    return view('auth.login');
  }
  public function postLogin() {
    
    if(!$this->request->login || !$this->request->password) {
      return redirect()->back()->withAlert(['type'=>'error','message'=>'Enter your username/email and password.']);
    }

    $username_or_email_field = filter_var($this->request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    $info = [ 
      $username_or_email_field => $this->request->input('login'), 
      'password' => $this->request->input('password') 
    ];

    if( !$this->auth->attempt($info) ) {
      $message = 'Incorrect username, email, or password. Please try again.';
      $message .= '<br><small>Forgot your password? <a href="#" class="alert-link">Click here to reset it.</a></small>';
      return redirect()->back()->withInput()->withAlert(['type'=>'danger','message'=>$message]);
    }

    return redirect()->back();

  }
  public function getLogout() {
    $this->auth->logout();
    return redirect()->to('/');
  }
}
