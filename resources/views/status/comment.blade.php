<div class="comment media">
    <a class="pull-left" href="#">
        <img class="media-object img-rounded" alt="{{ $comment->user->name }}" src="{{ $comment->user->getAvatarUrl(35) }}">
    </a>
    <div class="media-body">
        <p class="media-heading">
          <a href="{{ route('user.profile', $comment->user->username) }}" title="{{ $comment->user->username }}">{{ $comment->user->name }}</a> 
          <span class="timeago" title="{{ $comment->created_at->toIso8601String() }}">{{ $comment->created_at->toDayDateTimeString() }}</span>
        </p>
        <p class="comment-body">{!! nl2br(e($comment->body)) !!}</p>
        <div class="actions">
          <a href="#">Like</a>
          <span class="likes hidden">
            &bull;
            <span class="glyphicon glyphicon-thumbs-up"></span> 
            <span class="likes-count">0</span>
          </span>
        </div>
    </div>
</div>