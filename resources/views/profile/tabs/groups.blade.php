@extends('profile.main')

@section('tab_content')
groups
@stop

@section('tab_sidebar')
<div class="white-box">
  <b>About Me</b>
  <p>{{ $user->bio }}</p>
</div>
@stop