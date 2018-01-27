<div class="comment media{{ Auth::check() && Auth::user()->hasLikedComment($comment) ? ' has-liked' : '' }}" data-id="{{ $comment->id }}">
    <a class="pull-left" href="#">
        <img class="media-object img-rounded" alt="{{ $comment->user->name }}" src="{{ $comment->user->getAvatarUrl(35) }}">
    </a>
    <div class="media-body">

        <p class="media-heading">
          <a href="{{ route('user.profile', $comment->user->username) }}" title="{{ $comment->user->username }}">{{ $comment->user->name }}</a> 
          <span class="timeago" title="{{ $comment->created_at->toIso8601String() }}">{{ $comment->created_at->toDayDateTimeString() }}</span>
        </p>
        
        <p class="comment-body">{!! nl2br(e($comment->body)) !!}</p>

        <div class="comment-options">
          @if($comment->isOwner() || $status->isOwner())
          <a href="#" class="delete-comment"><span class="glyphicon glyphicon-trash"></span></a>
          @endif
        </div>
        
        <div class="actions">
          <a href="#" class="like-comment">
            <span class="link-text-like">Like</span>
            <span class="link-text-unlike">Unlike</span>
          </a>
          <span class="comment-likes{{ $comment->likes->count() < 1 ? ' hidden' : '' }}">
            &bull;
            <a href="#" title="View who liked this comment">
              <span class="glyphicon glyphicon-thumbs-up"></span> 
              <span class="likes-count">{{ $comment->likes->count() }}</span>
            </a>
          </span>
        </div>

    </div>
</div>