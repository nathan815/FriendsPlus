@extends('profile.main')

@section('tab_content')

  @if($user->friends()->count())
    @foreach($user->friends() as $userblock_user)
      @include('user.userblock')
    @endforeach
  @else
    <div class="white-box">
      <p>{{ $user->username }} does not have any friends at the moment.</p>
    </div>
  @endif

@stop

@section('tab_sidebar')
<div class="white-box">
  <b>About Me</b>
  <p>{{ $user->bio }}</p>
</div>
@stop