<div class="white-box media user-info">
  <a class="pull-left" href="{{ route('user.profile', Auth::user()->username) }}">
      <img class="media-object" alt="{{ Auth::user()->username }}" src="{{ Auth::user()->getAvatarUrl(80) }}" />
  </a>
  <div class="media-body">
      <h5 class="media-heading"><a href="{{ route('user.profile', Auth::user()->username) }}">{{ Auth::user()->name }} <br /><small>{{ "@" . Auth::user()->username }}</small></a></h5>
  </div>
</div>