@extends('layouts.two_col_right_sidebar')

@section('title', 'Search Results')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="/assets/css/search.css">
@stop

@section('content')

<div class="white-box">
  <h3>Search results for <b>{{ $query }}</b></h3>
</div>

@if($count)
  @foreach($users as $userblock_info)
    @include('user.userblock')
  @endforeach
@else
<div class="white-box text-centered">
  <span class="glyphicon glyphicon-search search-icon"></span>
  <h5>Sorry, no people were found. Try a different query <span class="glyphicon glyphicon-arrow-right"></span></h5>
</div>
@endif

@stop

@section('sidebar')
  <div class="white-box filters">
    <h4>Search Filters</h4>
    <form action="{{ route('search.results') }}" method="get">
      
      <h6>Information</h6>
      <div class="form-group">
        <label for="q">Full Name/Username:</label>
        <input type="text" required class="form-control text-bold" name="q" value="{{ $query }}" placeholder="Full Name/Username" id="q" autofocus autocomplete="off" />
      </div>

      <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" class="form-control" name="location" value="{{ $location }}" id="location" placeholder="Location" autocomplete="off" />
      </div>

      <div class="form-group">
        <label for="gender">Gender:</label>
        
        <select name="gender" class="form-control" id="gender">
          
          <option value="0">Choose Gender</option>
          
          @foreach($user->GenderOptions as $key => $value)
          <option value="{{ $key }}" {{ $gender == $key ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach

        </select>

      </div>
        
      <h6>Order</h6>
      <div class="form-group">
        <input type="radio" name="order" value="relevance" id="order_relevance" {{ $order == 'relevance' ? 'checked' : '' }} />
        <label for="order_relevance">Relevance</label>
      </div>
      <div class="form-group">
        <input type="radio" name="order" value="join_date" id="order_join_date" {{ $order == 'join_date' ? 'checked' : '' }} />
        <label for="order_join_date">Joined (Newest First)</label>
      </div>
      <div class="form-group">
        <input type="radio" name="order" value="alpha" id="order_alpha" {{ $order == 'alpha' ? 'checked' : '' }} />
        <label for="order_alpha">Alphabetical (A-Z)</label>
      </div>
      <div class="form-group">
        <input type="radio" name="order" value="alpha_reverse" id="order_alpha_reverse" {{ $order == 'alpha_reverse' ? 'checked' : '' }} />
        <label for="order_alpha_reverse">Reverse Alphabetical (Z-A)</label>
      </div>

      <hr />
      <div class="text-right">
        <a href="{{ route('search.results', ['q'=>$query]) }}" class="btn btn-default btn-sm">Clear Filters</a>
        &nbsp;
        <button type="submit" class="btn btn-warning btn-sm">
        Search</button>
      </div>

    </form>
  </div>
@stop