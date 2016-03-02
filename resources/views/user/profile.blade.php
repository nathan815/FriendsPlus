@extends('layouts.default')

@section('title', $user->name)

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="/assets/css/profile.css" />
@stop

@section('content')

<header class="header">
  
  <div class="cover-photo">
    <div class="cover-photo-container">
      <img class="cover" src="http://wowslider.com/sliders/demo-10/data/images/autumn_leaves.jpg" />
      <button class="btn btn-default btn-sm change">Change Cover</button>
      <div class="overlay"></div>
    </div>

    <div class="infobar">
      <h3 class="pull-left">{{ $user->name }} <small> {{ "@" . $user->username }}</small></h3>
    
      @if(Auth::check())
      <div class="actions pull-right">
        
        @if($user->id == Auth::user()->id)
        <button class="btn btn-default">Edit Profile</button>
        @else
        <button class="btn btn-primary">Add Friend</button>
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

  <img src="{{ $user->getAvatarUrl(150) }}" class="avatar" />

  <div class="profile-nav">
    <ul class="nav nav-pills nav-sm">
      <li class="active"><a href="#">Posts</a></li>
      <li><a href="#">Pictures</a></li>
      <li><a href="#">Friends</a></li>
      <li><a href="#">Groups</a></li>
      <li><a href="#">Info</a></li>
    </ul>
  </div>

</header>


<div class="row">
  <div class="profile-sidebar col-md-4">
    
    <div class="white-box">
      <b>Bio</b>
      <p>{{ $user->bio }}</p>
    </div>
  </div>
  <div class="col-md-8">
    @include('posts.new_post_box')
  </div>
</div>

@stop