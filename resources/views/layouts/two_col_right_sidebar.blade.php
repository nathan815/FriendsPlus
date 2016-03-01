<!-- left content area, right sidebar -->

@extends('layouts.master')

@section('main_content')

<div class="row">

  <div class="content pull-left col-md-8">
    @yield('content')
  </div>

  <div class="sidebar pull-left col-md-4">
    @yield('sidebar')
  </div>

</div>

@stop