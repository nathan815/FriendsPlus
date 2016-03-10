@extends('profile.main')

@section('tab_content')

  @include('status.new_status_box')

  @if(!$statuses->count())
    <div class="white-box">
      {{ $user->name }} has not posted any statuses yet.
    </div>
  @else
    @foreach($statuses as $status) 
      @include('status.status')
    @endforeach
  @endif

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