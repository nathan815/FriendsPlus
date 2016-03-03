@extends('layouts.default')
@section('title', 'Settings')
@section('content')
<div class="row">

  <div class="content pull-left col-md-12">
    <div class="white-box">
      <h3>Settings</h3>
      <ul class="nav nav-tabs">
        <li class="{{ $tab == 'account' ? 'active' : '' }}">
          <a href="{{ route('settings.account') }}">
            <span class="glyphicon glyphicon-info-sign"></span> Account
          </a>
        </li>
        <li class="{{ $tab == 'profile' ? 'active' : '' }}">
          <a href="{{ route('settings.profile') }}">
            <span class="glyphicon glyphicon-pencil"></span> Edit Profile
          </a>
        </li>
        <li class="{{ $tab == 'password' ? 'active' : '' }}">
          <a href="{{ route('settings.password') }}">
            <span class="glyphicon glyphicon-lock"></span> Change Password
          </a>
        </li>
        <li class="{{ $tab == 'emails' ? 'active' : '' }}">
          <a href="{{ route('settings.emails') }}">
            <span class="glyphicon glyphicon-bell"></span> Email Notifications
          </a>
        </li>
    </div>
    @yield('tab_content')
  </div>

</div>

@stop