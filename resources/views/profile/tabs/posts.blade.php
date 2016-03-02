@extends('profile.main')

@section('tab_content')

  @include('posts.new_post_box')

@stop

@section('tab_sidebar')
  
  @include('profile.sidebar_modules.mutual_friends')
  @include('profile.sidebar_modules.pictures')
  @include('profile.sidebar_modules.friends')

  <div class="white-box">
    <b>About Me</b>
    <p>{{ $user->bio }}</p>
  </div>

@stop