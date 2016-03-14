<div class="media">
  <div class="media-object pull-left">
    <img src="{{ $userblock_user->getAvatarUrl(50) }}">
    <br>
  </div>
  <div class="media-body">
    <h5 class="pull-left"><a href="{{ route('user.profile', $userblock_user->username) }}" class="text-bold">{{ $userblock_user->name }}</a></h5>
    <div class="pull-right">
      @include('user.friend_btn')
    </div>
  </div>
</div>