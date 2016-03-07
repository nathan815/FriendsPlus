<div class="status white-box">
  <div class="status-content">
    <div class="media">
        <a class="pull-left" href="{{ route('user.profile', $status->user->username) }}">
            <img class="media-object img-rounded" alt="$status->user->username)" src="{{ $status->user->getAvatarUrl(50) }}">
        </a>
        <div class="media-body">
            <div class="media-heading">
              <a href="{{ route('user.profile', $status->user->username) }}" class="username" title="{{ "@" . $status->user->username }}"><span>{{ $status->user->name }}</span></a>
              <p class="status-time">
                <a href="{{ route('status.view', $status->access_id) }}">{{ $status->created_at->toDayDateTimeString() }}</a>
              </p>
            </div>
        </div>
    </div>

    <p class="status-body">{{ $status->body }}</p>

    <div class="dropdown">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-menu-down"></span></a>
      <ul class="dropdown-menu dropdown-menu-right">

        @if($status->isOwner())
        <li><a href="#">Edit</a></li>
        <li><a href="#">Delete</a></li>
        @else
        <li><a href="#">Hide</a></li>
        <li><a href="#">Report</a></li>
        @endif

      </ul>
    </div>

    <div class="actions">
        <div class="pull-left">
          <button class="btn btn-sm btn-success"><span class="glyphicon glyphicon-thumbs-up"></span></button>
          <button class="btn btn-sm btn-default"><span class="glyphicon glyphicon-thumbs-down"></span></button>
        </div>
        <div class="likes-dislikes pull-left">
          <span class="likes">You and <a href="#">10 others</a> like this.</span>
          <br />
          <span class="dislikes"><a href="#">2 people</a> dislike this.</span>
        </div>
        <div class="pull-right">
          <button class="btn btn-sm btn-default"><span class="glyphicon glyphicon-comment"></span> Comment</button>
          <button class="btn btn-sm btn-default"><span class="glyphicon glyphicon-share"></span> Share</button>
        </div>
        <div class="clearfix"></div>
    </div>

  </div><!-- end .status-content -->

  <div class="comments">
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" alt="" src="http://placehold.it/35x35">
        </a>
        <div class="media-body">
            <h5 class="media-heading"><a href="#">Billy</a></h5>
            <p>Yes, it is lovely!</p>
            <ul class="list-inline">
                <li>8 minutes ago.</li>
                <li><a href="#">Like</a></li>
                <li>4 likes</li>
            </ul>
        </div>
    </div>
    <form role="form" action="#" method="post">
        <div class="form-group">
            <textarea name="reply-1" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
        </div>
        <input type="submit" value="Reply" class="btn btn-default btn-sm">
    </form>
  </div>

</div>