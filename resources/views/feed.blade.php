@extends('layouts.two_col_right_sidebar')
@section('title','Feed')

@section('content')

@include('posts.new_post_box')

<div class="white-box">
  <span class="muted">You haven't added any friends yet.</span>
</div>

@stop

@section('sidebar')

  @include('sidebar_modules.online_friends')
  @include('sidebar_modules.online_friends')

@stop