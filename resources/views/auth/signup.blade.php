@extends('layouts.default')

@section('title', 'Sign Up')
@section('content')

<div class="col-md-6 col-centered white-box">
  <h3 style="margin-top:0">Sign Up</h3>
  <p>Create your free Friends+ account now!</p>
  <form action="{{ route('auth.signup') }}" method="post">
    <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
      <input type="text" class="form-control" placeholder="Full Name" name="full_name" value="{{ Request::old('full_name') ?: '' }}" />
      @if($errors->has('full_name')) 
        <span class="help-block">{{ $errors->first('full_name') }}</span>
      @endif
      <span class="help-block">Enter your first and last name.</span>
    </div>
    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
      <input type="text" class="form-control" placeholder="Username" name="username" value="{{ Request::old('username') ?: '' }}" />
      @if($errors->has('username')) 
        <span class="help-block">{{ $errors->first('username') }}</span>
      @endif
      <span class="help-block">May contain letters, numbers, dashes, and underscores.</span>
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <input type="text" class="form-control" placeholder="Email" name="email" value="{{ Request::old('email') ?: '' }}" />
      @if($errors->has('email')) 
        <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
      <input type="password" class="form-control" placeholder="Password" name="password" />
      @if($errors->has('password')) 
        <span class="help-block">{{ $errors->first('password') }}</span>
      @endif
    </div>
    <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
      <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" />
      @if($errors->has('confirm_password')) 
        <span class="help-block">{{ $errors->first('confirm_password') }}</span>
      @endif
    </div>
    <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
      <div class="checkbox pull-left" style="margin-top:25px">
        <label>
          <input type="checkbox" name="terms" value="1" {{ Request::old('terms') ? 'checked' : '' }} /> 
          I agree with the <a href="/terms" target="_blank">terms</a>
        </label>
        @if($errors->has('terms')) 
          <span class="help-block">{{ $errors->first('terms') }}</span>
        @endif
      </div>
    </div>
    <br />
    <p><button class="btn btn-primary pull-right" type="submit">Create Account</button></p>
    <div class="clearfix"></div>
    <input type="hidden" name="_token" value="{{ Session::token() }}" />
  </form>
</div>
@stop