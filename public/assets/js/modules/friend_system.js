/**
 * JS for friends system
 * Adding, deleting friends
 * Cancel friend requests
 * Reject friend requests
 */

function AddFriend() {
  var username = $(this).data('username');
  var _this = $(this);
  $.ajax({
    type: 'POST',
    url: '/friend/add',
    data: {
      username: username
    },
    success: function(response) {
      if(!response.success) {
        alert(response.error);
        return;
      }
      _this.removeClass('btn-primary')
           .addClass('btn-danger')
           .text('Cancel Request')
           .attr('data-friend-btn', 'cancel');
    }
  });
}
function DeleteFriendConfirm() {
  var username = $(this).data('username');
  var btn = $(this);
  bootbox.dialog({
    title: 'Unfriend',
    message: 'Are you sure you want to unfriend <b>@'+username+'</b>?',
    size: 'small',
    buttons: {
      cancel: {
        label: 'Cancel',
        className: 'btn-default'
      },
      main: {
        label: 'Unfriend',
        className: 'btn-danger',
        callback: function() {
          DeleteFriend(username, btn);
        }
      }
    }
  });
}
function DeleteFriend(username, btn) {
  $.ajax({
    type: 'POST',
    url: '/friend/delete',
    data: {
      username: username
    },
    success: function(response) {
      if(!response.success) {
        alert(response.error);
        return;
      }
      btn.removeAttr('data-hover-text')
           .removeAttr('data-hover-toggle-class')
           .removeClass('btn-danger btn-success')
           .addClass('btn-primary')
           .text('Add Friend')
           .attr('data-friend-btn', 'add');
      $('#message-user').remove();
      if(CurrentRoute === 'user.profile') {
        document.location.reload();
      }
    }
  });
}
function CancelFriendRequestConfirm() {
  var username = $(this).data('username');
  var btn = $(this);
  bootbox.dialog({
    title: 'Cancel friend request',
    message: 'Are you sure you want to cancel your friend request to <b>@'+username+'</b>?',
    buttons: {
      cancel: {
        label: 'Close',
        className: 'btn-default'
      },
      main: {
        label: 'Yes, cancel it',
        className: 'btn-danger',
        callback: function() {
          CancelFriendRequest(username, btn);
        }
      }
    }
  });
}
function CancelFriendRequest(username, btn) {
  $.ajax({
    type: 'POST',
    url: '/friend/request/cancel',
    data: {
      username: username
    },
    success: function(response) {
      if(!response.success) {
        alert(response.error);
        return;
      }
      btn.removeClass('btn-danger')
           .addClass('btn-primary')
           .text('Add Friend')
           .attr('data-friend-btn', 'add');
    }
  });
}
function AcceptFriendRequest() {
  var username = $(this).data('username');
  var _this = $(this);
  $.ajax({
    type: 'POST',
    url: '/friend/request/accept',
    data: {
      username: username
    },
    success: function(response) {
      if(!response.success) {
        alert(response.error);
        return;
      }
      _this.removeClass('btn-primary')
           .addClass('btn-success')
           .html('<span class="glyphicon glyphicon-ok"></span> Friend')
           .attr('data-friend-btn', 'delete');
      $('.btn[data-friend-btn="deny"][data-username="'+username+'"]').remove();
    }
  });
}
function DenyFriendRequest() {
  var username = $(this).data('username');
  var _this = $(this);
  $.ajax({
    type: 'POST',
    url: '/friend/request/deny',
    data: {
      username: username
    },
    success: function(response) {
      if(!response.success) {
        alert(response.error);
        return;
      }
      _this.removeClass('btn-danger')
           .addClass('btn-primary')
           .text('Add Friend')
           .attr('data-friend-btn', 'add');
      $('.btn[data-friend-btn="accept"][data-username="'+username+'"]').remove();
    }
  });
}

$(document).ready(function() {
  $('body').on('click', '.btn[data-friend-btn="add"]', AddFriend)
           .on('click', '.btn[data-friend-btn="delete"]', DeleteFriendConfirm)
           .on('click', '.btn[data-friend-btn="cancel"]', CancelFriendRequestConfirm)
           .on('click', '.btn[data-friend-btn="accept"]', AcceptFriendRequest)
           .on('click', '.btn[data-friend-btn="deny"]', DenyFriendRequest);
});