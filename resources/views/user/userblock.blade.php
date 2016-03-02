<div class="media userblock white-box">    
  
  <button class="btn btn-primary btn-sm pull-right">Add Friend</button>
  
  <a class="pull-left" href="{{ route('user.profile', ['nathan']) }}">
    <img class="media-object img-rounded" alt="{{ $user->getUsername() }}" src="{{ $user->getAvatarUrl(120) }}">
  </a>
  
  <div class="media-body">

    <h4 class="media-heading">
      <a href="{{ route('user.profile', [$user->getUsername()]) }}">
        <span>{{ $user->getName() }}</span>
        <small>{{ "@".$user->getUsername() }}</small>
      </a>
    </h4>

    <p>
      <b>Location:</b>
      @if($user->location)
      {{ $user->location }}
      @else
      <em>No location set.</em>
      @endif

      @if($user->gender)
      | <b>Gender:</b> {{ $user->GenderOptions[$user->gender] }}
      @endif
    </p>

    <p>
      <b>Bio:</b>
      @if($user->bio)
      {{ str_limit($user->bio, 200) }}
      @else
      <em>No bio written yet.</em>
      @endif
    </p>

  </div><!-- end .media-body -->

</div>