@extends('layouts.default')

@section('title', 'Home')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="/assets/css/home.css" />
@stop

@section('content_outside_container')
<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
      <h1>Connect with your friends</h1>
      <p>Stay up to date with your friends, meet new people, and have fun. Friends+ enables you to connect with people no matter where they are in the world, without user tracking or advertisements. This is the social network you've been waiting for.</p>
      </div>
      <div class="col-md-5">
        <h2>Sign Up</h2>
        <h5>It's quick, easy, and 100% free.</h5>
        <form action="{{ route('auth.signup') }}" method="POST">
          <input type="text" required class="form-control" placeholder="Full Name" name="full_name" />
          <input type="text" class="form-control" placeholder="Username" name="username" />
          <input type="text" required class="form-control" placeholder="Email" name="email" />
          <input type="password" required class="form-control" placeholder="Password" name="password" />
          <input type="password" required class="form-control" placeholder="Confirm Password" name="confirm_password" />
          <div class="checkbox pull-left" style="margin-top:25px">
            <label>
              <input type="checkbox" required name="terms" /> 
              I agree with the <a href="/terms" target="_blank">terms</a>
            </label>
          </div>
          <br />
          <p><button class="btn btn-primary pull-right" type="submit">Create Account</button></p>
          <input type="hidden" name="_token" value="{{ Session::token() }}" />
        </form>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')

<div class="row">
  
</div>

@stop
