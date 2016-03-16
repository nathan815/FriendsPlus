<div class="status white-box" data-id="{{ $status->id }}" data-access-id="{{ $status->access_id }}" id="status-{{ $status->access_id }}">
  <div class="status-content">
    <div class="media">
        <a class="pull-left" href="{{ route('user.profile', $status->user->username) }}">
            <img class="media-object img-rounded profile-picture" alt="{{ $status->user->username }}" src="{{ $status->user->getAvatarUrl(50) }}">
        </a>
        <div class="media-body">
            <div class="media-heading">
              <a href="{{ route('user.profile', $status->user->username) }}" class="username" title="{{ "@" . $status->user->username }}">{{ $status->user->name }}</a>
              @if($status->to_user_id)
                <span class="glyphicon glyphicon-menu-right to-user-icon"></span>
                <a href="{{ route('user.profile', $status->to->username) }}" title="{{ "@" . $status->user->username }}">{{ $status->to->name }}</a>
              @endif
              <p class="status-time">
                <a href="{{ route('status.view', $status->access_id) }}" class="timeago" title="{{ $status->created_at->toIso8601String() }}">{{ $status->created_at->toDayDateTimeString() }}</a>
              </p>
            </div>
        </div>
    </div>

    <p class="status-body">{!! nl2br(e($status->body)) !!}</p>

    <div class="dropdown status-options">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-menu-down"></span></a>
      <ul class="dropdown-menu dropdown-menu-right">

        @if($status->isOwner())
          <li><a href="#" class="edit-status">Edit</a></li>
          <li><a href="#" class="delete-status">Delete</a></li>
        @else
          @if(Auth::check())
            <li><a href="#" class="hide-status">Hide</a></li>
          @endif
          <li><a href="#" class="report-status">Report</a></li>
        @endif

      </ul>
    </div>

    <div class="actions">
        <div class="pull-left">
          <button class="like-status btn btn-sm btn-{{ Auth::check() && Auth::user()->hasLikedStatus($status) ? 'success' : 'default' }}">
            <span class="glyphicon glyphicon-thumbs-up"></span>
          </button>
          <button class="dislike-status btn btn-sm btn-default disabled">
            <span class="glyphicon glyphicon-thumbs-down"></span>
          </button>
        </div>
        <div class="likes-dislikes pull-left">
          <span class="status-likes">
            @if($status->getLikeInfo())
              {{ $status->getLikeInfo()->you }}
              <a href="#">{{ $status->getLikeInfo()->other_users_liked }}</a>
              {{ $status->getLikeInfo()->likes_this }}
            @endif
          </span>
          <!--<span class="dislikes"><a href="#">2 people</a> dislike this.</span>-->
        </div>
        <div class="pull-right">
          <button class="btn btn-sm btn-default comment-btn"><span class="glyphicon glyphicon-comment"></span> Comment</button>
          <button class="btn btn-sm btn-default share-btn"><span class="glyphicon glyphicon-share"></span> Share</button>
        </div>
        <div class="clearfix"></div>
    </div>

  </div><!-- end .status-content -->

  <div class="comments">

    <div class="comments-list">
      @foreach($status->comments as $comment)
        @include('status.comment')
      @endforeach
    </div>

    @if(Auth::check() && Auth::user()->isFriendsWith($status->user) || $status->isOwner())
    <div class="media new-comment-container">
      <img class="pull-left media-object img-rounded" src="{{ Auth::user()->getAvatarUrl(35) }}" />
      <div class="media-body">
        <form class="new-comment" role="form" action="{{ route('comment.new', [ 'status_id' => $status->access_id ]) }}" method="post">
          {{ csrf_field() }}
          <textarea name="body" class="form-control" rows="2" placeholder="Type a comment..."></textarea>
        </form>
      </div>
    </div>
    @endif

  </div>

</div>