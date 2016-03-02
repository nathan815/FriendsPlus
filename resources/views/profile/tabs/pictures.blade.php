@extends('profile.tabs.template')

@section('profile_content')
pictures
@stop

@section('profile_sidebar')
<div class="white-box">
  <b>About Me</b>
  <p>{{ $user->bio }}</p>
</div>
@stop