<div class="comment media">
    <a class="pull-left" href="#">
        <img class="media-object img-rounded" alt="{{ $comment->user->name }}" src="{{ $comment->user->getAvatarUrl(35) }}">
    </a>
    <div class="media-body">
        <p class="media-heading">
          <a href="#" title="{{ $comment->user->username }}">{{ $comment->user->name }}</a> 
          {{ $comment->created_at->diffForHumans() }}
        </p>
        <p class="comment-body">{{ $comment->body }}</p>
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