<div id="new-status" class="new-status white-box">
  <form action="{{ route('status.new') }}" method="post">
    {{ csrf_field() }}
    @if(Route::is('user.profile'))
      <input type="hidden" name="to" value="{{ $user->id }}" />
    @endif
    <textarea class="form-control" placeholder="{{ Route::is('user.profile') && !$is_owner ? 'Post to '.$user->username.'\'s profile...' : 'What\'s up, '.Auth::user()->username .'?' }}" name="body"></textarea>
    <div class="actions">
      <div class="pull-left">
        <button type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-picture"></span> Add Pictures
        </button>
        <button type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-folder-open"></span> Create Album
        </button>
      </div>
      <button class="btn btn-primary pull-right">Post Status</button>
    </div>
    <div class="clearfix"></div>
  </form>
</div>