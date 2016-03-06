<div class="media userblock white-box">    
  
  @if(Auth::check()) 

    <div class="pull-right">
    @if(Auth::user()->id === $userblock_user->id)
      <a href="{{ route('settings.profile') }}" class="btn btn-default btn-sm">Edit Profile</a>
    @elseif(Auth::user()->hasFriendRequestFrom($userblock_user))
      <button class="btn btn-primary btn-sm" data-friend-btn="accept" data-username="{{ $userblock_user->username }}">
        <span class="glyphicon glyphicon-ok"></span> Confirm Friend
      </button>
      <button class="btn btn-danger btn-sm" data-friend-btn="deny" data-username="{{ $userblock_user->username }}">
        <span class="glyphicon glyphicon-remove"></span> Deny
      </button>
    @elseif($userblock_user->hasFriendRequestFrom(Auth::user()))
      <button class="btn btn-danger btn-sm" data-friend-btn="cancel" data-username="{{ $userblock_user->username }}">Cancel Request</button>
    @elseif(Auth::user()->isFriendsWith($userblock_user))
      <button class="btn btn-success btn-sm" data-friend-btn="delete" data-username="{{ $userblock_user->username }}" data-hover-text="Unfriend" data-hover-toggle-class="btn-danger btn-success">
        <span class="glyphicon glyphicon-ok"></span> Friend
      </button>
    @else
      <button class="btn btn-primary btn-sm" data-friend-btn="add" data-username="{{ $userblock_user->username }}">Add Friend</button>
    @endif
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