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