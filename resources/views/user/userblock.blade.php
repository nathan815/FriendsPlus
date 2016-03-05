<div class="media userblock white-box">    
  
  @if(Auth::check()) 

    <div class="pull-right">
    @if(Auth::user()->hasFriendRequestFrom($userblock_info))
      
      @if(Route::is('user.friend.requests'))
      <form action="{{ route('user.friend.accept') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="username" value="{{ $userblock_info->username }}" />
        <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-ok"></span> Accept</button>&nbsp;
      </form>
      <form action="{{ route('user.friend.deny') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="username" value="{{ $userblock_info->username }}" />
        <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</button>
      </form>
      @else
      <div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Pending <span class="glyphicon glyphicon-menu-down"></span></button>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#" class="accept-friend-request" data-username="{{ $userblock_info->username }}">Accept Friend Request</a></li>
          <li><a href="#" class="deny-friend-request" data-username="{{ $userblock_info->username }}">Delete Friend Request</a></li>
        </ul>
      </div>
      @endif

    @elseif(Auth::user()->hasFriendRequestSentByMe($userblock_info))
      <form action="{{ route('user.friend.cancel') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="username" value="{{ $userblock_info->username }}" />
        <button class="btn btn-info btn-sm"><span class="glyphicon glyphicon-remove"></span> Cancel Request</button>
      </form>
    @elseif(Auth::user()->friendsWith($userblock_info))
      <form action="{{ route('user.friend.delete') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="username" value="{{ $userblock_info->username }}" />
        <button class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> Friends</button>
      </form>
    @elseif(Auth::user()->id != $userblock_info->id)
      <form action="{{ route('user.friend.add') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="username" value="{{ $userblock_info->username }}" />
        <button class="btn btn-primary btn-sm">Add Friend</button>
      </form>
    @else
      <a href="{{ route('settings.profile') }}" class="btn btn-default btn-sm">Edit Profile</a>
    @endif
    </div>

  @endif
  
  <a class="pull-left" href="{{ route('user.profile', $userblock_info->username ) }}">
    <img class="media-object img-rounded" alt="{{ $userblock_info->username }}" src="{{ $userblock_info->getAvatarUrl(90) }}">
  </a>
  
  <div class="media-body">

    <h4 class="media-heading">
      <a href="{{ route('user.profile', [$userblock_info->username ]) }}">
        <span>{{ $userblock_info->name }}</span>
        <small>{{ "@".$userblock_info->username }}</small>
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