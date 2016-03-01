<div class="media userblock white-box">    
  
  <button class="btn btn-primary btn-sm pull-right">Add Friend</button>
  
  <a class="pull-left" href="{{ route('user.profile', ['nathan']) }}">
    <img class="media-object img-rounded" alt="" src="http://placehold.it/120x120">
  </a>
  
  <div class="media-body">

    <h4 class="media-heading">
      <a href="{{ route('user.profile', [$user->username]) }}">
        <span>{{ $user->name }}</span>
        <small>{{ "@".$user->username }}</small>
      </a>
    </h4>

    <p>
      <b>Location:</b>
      @if($user->location)
      {{ $user->location }}
      @else
      Planet Earth
      @endif
    </p>

    <p>
      <b>Bio:</b>
      @if($user->bio)
      {{ $user->bio }}
      @else
      <em>No bio written yet.</em>
      @endif
    </p>

  </div><!-- end .media-body -->

</div>