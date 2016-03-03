@extends('settings.template')

@section('tab_content')

<form action="{{ route('settings.profile') }}" method="post">
  {{ csrf_field() }}
  
  <div class="row">

    <div class="col-md-6">
      <div class="white-box">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label>Full Name</label>
          <input type="text" class="form-control" placeholder="First &amp; Last Name" name="name" value="{{ old('name') ?: $user->name }}" />
          @if($errors->has('name')) 
            <span class="help-block">{{ $errors->first('name') }}</span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
          <label>Username</label>
          <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') ?: $user->username }}" />
          @if($errors->has('username')) 
            <span class="help-block">{{ $errors->first('username') }}</span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
          <label>Location</label>
          <input type="text" class="form-control" placeholder="Location" name="location" value="{{ old('location') ?: $user->location }}" />
          @if($errors->has('location')) 
            <span class="help-block">{{ $errors->first('location') }}</span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
          <label>Website</label>
          <input type="text" class="form-control" placeholder="Website URL" name="website" value="{{ old('website') ?: $user->website }}" />
          @if($errors->has('website')) 
            <span class="help-block">{{ $errors->first('website') }}</span>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="white-box">
        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
          <label>About Me</label>
          <textarea class="form-control" placeholder="Write something about yourself..." name="bio" rows="7" style="resize:none;">{{ old('bio') ?: $user->bio }}</textarea>
          @if($errors->has('bio')) 
            <span class="help-block">{{ $errors->first('bio') }}</span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
          <label>Gender</label>
          @include('user.gender_dropdown')
          @if($errors->has('gender')) 
            <span class="help-block">{{ $errors->first('gender') }}</span>
          @endif
        </div>
      </div>
    </div>

  </div><!-- end .row -->


  <div class="white-box text-center">
    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Save Changes</button>&nbsp;
    <a href="{{ route('user.profile', $user->username) }}" class="btn btn-default">View Profile <span class="glyphicon glyphicon-menu-right"></span></a>
  </div>

</form>

@stop