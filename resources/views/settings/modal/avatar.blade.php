<div class="row">
  <div class="col-sm-6">
    <h5>Upload New Picture</h5>
    <form method="post" action="">
      <input type="file" class="form-control" name="avatar" type="jpeg,png,gif" />
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