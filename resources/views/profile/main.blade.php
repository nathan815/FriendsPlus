@extends('layouts.default')

@section('title', $user->name)

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="/assets/css/profile.css" />
@stop

@section('scripts')
<script type="text/javascript" src="/assets/js/modules/profile.js"></script>
@stop

@section('content')

<header class="header">
  
  <div class="cover-photo">
    <div class="cover-photo-container">
      <img class="cover" src="http://wowslider.com/sliders/demo-10/data/images/autumn_leaves.jpg" />
      
      @if($is_owner)
      <div class="dropdown change-cover">
        <button data-toggle="dropdown" class="btn btn-default btn-sm change dropdown-toggle"><span class="glyphicon glyphicon-picture"></span> Change Cover</button>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#" class="upload-cover">Upload New Cover</a></li>
          <li><a href="#" class="remove-cover">Remove Current Cover</a></li>
        </ul>
      </div>
      @endif

      <div class="overlay"></div>
    </div>

    <div class="infobar">
      <h3>{{ $user->name }} <small> {{ "@" . $user->username }}</small></h3>
    
      @if(Auth::check())
      <div class="actions">
        
        @if($is_owner)
          <a href="{{ route('settings.profile') }}" class="btn btn-default">
            <span class="glyphicon glyphicon-pencil"></span>
            Edit Profile
          </a>
        @else

          @if(Auth::user()->isFriendsWith($user))
            <button class="btn btn-primary" id="message-user">Message</button>
            <button class="btn btn-success" data-friend-btn="delete" data-username="{{ $user->username }}" data-hover-text="Unfriend" data-hover-toggle-class="btn-danger btn-success">
              <span class="glyphicon glyphicon-ok"></span> Friend
            </button>

          @elseif(Auth::user()->hasFriendRequestFrom($user))
            <button class="btn btn-primary" data-friend-btn="accept" data-username="{{ $user->username }}"><span class="glyphicon glyphicon-ok"></span> Confirm Friend</button>
            <button class="btn btn-danger" data-friend-btn="deny" data-username="{{ $user->username }}"><span class="glyphicon glyphicon-remove"></span> Deny</button>

          @elseif($user->hasFriendRequestFrom(Auth::user()))
            <button class="btn btn-danger" data-friend-btn="cancel" data-username="{{ $user->username }}">Cancel Request</button>

          @else
            <button class="btn btn-primary" data-friend-btn="add" data-username="{{ $user->username }}">Add Friend</button>

          @endif

          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-cog"></span> 
              <span class="glyphicon glyphicon-menu-down"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a href="#">Block {{ "@" . $user->username }}</a></li>
              <li><a href="#">Report {{ "@" . $user->username }}</a></li>
            </ul>
          </div>
        @endif

      </div>
      @endif

      <div class="clearfix"></div>
    </div>

  </div>

  <div class="avatar-container">
    <img src="{{ $user->getAvatarUrl(150) }}" class="avatar" />
    @if($is_owner)
      <a href="#" class="change-avatar" title="Change Picture"><span class="glyphicon glyphicon-camera"></span></a>
    @endif
  </div>

  <div class="profile-nav">
    <ul class="nav nav-pills nav-sm">

      @foreach($tabs as $tab => $display_name)
      <li class="{{ $tab == $current_tab ? 'active' : '' }}">
        <a href="{{ route('user.profile', [ $user->username, $tab == 'posts' ? '' : $tab ]) }}">{{ $display_name }}</a>
      </li>
      @endforeach

    </ul>
  </div>

</header>


<div class="row">
  
  <div class="profile-sidebar col-md-4">
    @yield('tab_sidebar')
  </div>

  <div class="col-md-8">
    @yield('tab_content')
  </div>

</div>

@stop