<div class="media userblock white-box">    
  
  @if(Auth::check()) 

    <div class="pull-right">
      @include('user.friend_btn')
    </div>

  @endif
  
  <a class="pull-left" href="{{ route('user.profile', $userblock_user->username ) }}">
    <img class="media-object img-rounded" alt="{{ $userblock_user->username }}" src="{{ $userblock_user->getAvatarUrl(90) }}">
  </a>
  
  <div class="media-body">

    <h4 class="media-heading">
      <a href="{{ route('user.profile', [$userblock_user->username ]) }}">
        <span>{{ $userblock_user->name }}</span>
        <small>{{ "@".$userblock_user->username }}</small>
      </a>
    </h4>

    <p>
      <b>Location:</b>
      @if($userblock_user->location)
      {{ $userblock_user->location }}
      @else
      <em>No location set.</em>
      @endif

      @if($userblock_user->gender)
      | <b>Gender:</b> {{ $userblock_user->GenderOptions[$userblock_user->gender] }}
      @endif
    </p>

    <p>
      <b>Bio:</b>
      @if($userblock_user->bio)
      {{ str_limit($userblock_user->bio, 100) }}
      @else
      <em>No bio written yet.</em>
      @endif
    </p>

  </div><!-- end .media-body -->

</div>