@extends('layouts.two_col_right_sidebar')
@section('title','Feed')

@section('content')

@include('status.new_status_box')

<!--<div class="white-box">
  <span class="muted">You haven't added any friends yet.</span>
</div>-->

@if(!$statuses->count())
  <div class="white-box">
    There aren't any statuses in your feed. Start by posting a status and adding some friends!
  </div>
@else
  @foreach($statuses as $status) 
    @include('status.status')
  @endforeach
@endif

@stop

@section('sidebar')

  @include('sidebar_modules.user_info')
  @include('sidebar_modules.friend_requests')
  @include('sidebar_modules.suggested_people')

@stop