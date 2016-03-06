@extends('layouts.default')

@section('title', 'Friend Requests')
@section('content')
  
  <div class="white-box">
    <h3 class="pull-left">Friend Requests</h3>
    <ul class="nav nav-tabs pull-right">
      <li class="{{ $type == 'to_me' ? 'active' : '' }}">
        <a href="{{ route('user.friend.requests') }}">Requests To Me</a>
      </li>
      <li class="{{ $type == 'from_me' ? 'active' : '' }}">
        <a href="{{ route('user.friend.requests', ['from_me']) }}">Requests From Me</a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  
  @if($friend_requests->count())
    @foreach($friend_requests as $userblock_user)
      @include('user.userblock')
    @endforeach
  @else
    <div class="white-box">
      @if($type == 'to_me')
      You do not have any friend requests.
      @else
      There are no pending friend requests sent from you.
      @endif
    </div>
  @endif

@stop