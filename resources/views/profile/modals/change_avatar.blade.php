<div class="change-avatar-modal row">
  <div class="col-sm-6">
    <h5>Upload New Picture</h5>
    <form method="post" action="{{ route('avatar.upload') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
        <input required type="file" class="form-control" name="avatar" accept="jpg,jpeg,png,gif" />

        @if($errors->has('avatar')) 
          <span class="help-block">{{ $errors->first('avatar') }}</span>
        @endif

      </div>
      <br />
      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
  </div>
  <div class="col-sm-6">
    <h5>
      Current Picture 
      @if(Auth::user()->avatar)
        <button class="btn btn-danger btn-sm pull-right delete-avatar">Delete</button>
      @endif
    </h5>
    <img src="{{ Auth::user()->getAvatarUrl(100) }}" class="current-avatar img-rounded" />
  </div>
</div>