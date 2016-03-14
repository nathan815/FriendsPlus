@extends('layouts.two_col_right_sidebar')

@section('title', $status->user->username . "'s status")

@section('content')

@include('status.status')

@stop

@section('sidebar')

sidebar

@stop