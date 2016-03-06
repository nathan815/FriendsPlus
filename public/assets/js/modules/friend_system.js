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
function DeleteFriend() {
  var username = $(this).data('username');
  var _this = $(this);
  if(!confirm("Are you sure you want to unfriend @"+username+"?")) {
    return false;
  }
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
      _this.removeAttr('data-hover-text')
           .removeAttr('data-hover-toggle-class')
           .removeClass('btn-danger btn-success')
           .addClass('btn-primary')
           .text('Add Friend')
           .attr('data-friend-btn', 'add');
      $('#message-user').remove();
      document.location.reload();
    }
  });
}
function CancelFriendRequest() {
  var username = $(this).data('username');
  var _this = $(this);
  if(!confirm("Cancel your friend request to @"+username+"?")) {
    return false;
  }
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
      _this.removeClass('btn-danger')
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
  $('.container').on('click', '.btn[data-friend-btn="add"]', AddFriend)
                 .on('click', '.btn[data-friend-btn="delete"]', DeleteFriend)
                 .on('click', '.btn[data-friend-btn="cancel"]', CancelFriendRequest)
                 .on('click', '.btn[data-friend-btn="accept"]', AcceptFriendRequest)
                 .on('click', '.btn[data-friend-btn="deny"]', DenyFriendRequest);
});