<?php

namespace SocialNetwork\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Validator;

use SocialNetwork\Http\Requests\SignUpRequest;
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
  public function postSignup(SignUpRequest $request, User $user) {

    // Create user
    $user->create([
      'name' => $request->full_name,
      'email' => $request->email,
      'username' => $request->username,
      'password' => bcrypt($request->password)
    ]);

    // Redirect
    $alert = [
      'type' => 'success', 
      'message' => 'Welcome to Friends+! You can now login to your new account.'
    ];
    return redirect()->route('home')->withAlert($alert);

  }

  public function getLogin() {
    return view('auth.login');
  }
  public function postLogin() {
    
    if(!$this->request->login || !$this->request->password) {
      return redirect()->back()->withAlert([
        'type'=>'error',
        'message'=>'Enter your username/email and password.'
      ]);
    }

    $login_field = filter_var($this->request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    $info = [ 
      $login_field => $this->request->input('login'), 
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
