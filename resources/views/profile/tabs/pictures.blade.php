@extends('profile.main')

@section('tab_content')
pictures
@stop

@section('tab_sidebar')
<div class="white-box">
  <b>About Me</b>
  <p>{{ $user->bio }}</p>
</div>
@stop