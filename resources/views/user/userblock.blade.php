<div class="media userblock white-box">    
  
  <button class="btn btn-primary btn-sm pull-right">Add Friend</button>
  
  <a class="pull-left" href="{{ route('user.profile', $userblock_info->username ) }}">
    <img class="media-object img-rounded" alt="{{ $userblock_info->username }}" src="{{ $userblock_info->getAvatarUrl(90) }}">
  </a>
  
  <div class="media-body">

    <h4 class="media-heading">
      <a href="{{ route('user.profile', [$userblock_info->username ]) }}">
        <span>{{ $userblock_info->getName() }}</span>
        <small>{{ "@".$userblock_info->getUsername() }}</small>
      </a>
    </h4>

    <p>
      <b>Location:</b>
      @if($userblock_info->location)
      {{ $userblock_info->location }}
      @else
      <em>No location set.</em>
      @endif

      @if($userblock_info->gender)
      | <b>Gender:</b> {{ $userblock_info->GenderOptions[$userblock_info->gender] }}
      @endif
    </p>

    <p>
      <b>Bio:</b>
      @if($userblock_info->bio)
      {{ str_limit($userblock_info->bio, 100) }}
      @else
      <em>No bio written yet.</em>
      @endif
    </p>

  </div><!-- end .media-body -->

</div>