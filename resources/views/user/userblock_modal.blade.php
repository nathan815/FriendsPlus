<div class="media">
  <div class="media-object pull-left">
    <img src="{{ $userblock_user->getAvatarUrl(50) }}">
    <br>
  </div>
  <div class="media-body">
    <a href="{{ route('user.profile', $userblock_user->username) }}" class="text-strong">{{ $userblock_user->name }}</a>
    <div class="pull-right">
      @include('user.friend_btn')
    </div>
  </div>
</div>