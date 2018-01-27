/**
 * General JS for Friends+
 */

var CurrentRoute = $('meta[name=route]').attr('content');

function AjaxModal(options) {
  var defaults = {
    title: 'Title',
    message: '<div class="progress"> \
      <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 100%"> \
        <span class="sr-only">Loading</span> \
      </div> \
    </div>'
  }
  var options = Object.assign(defaults, options);
  var box = bootbox.dialog(options);
  $.ajax({
    method: 'get',
    url: options.url,
    complete: function() {
      box.modal('hide');
    },
    success: function(response) {
      options['message'] = response;
      bootbox.dialog(options);
    },
    error: function() {
      options['message'] = 'Could not load modal.';
      bootbox.dialog(options);
    }
  })
}

function FocusCommentBox() {
  var status = $(this).closest('.status');
  $('textarea', status).focus();
}
function NewComment(e) {
  e.preventDefault();
  var form = $(this);
  var status = form.closest('.status');
  var statusId = status.data('id');
  var comments = $('.comments-list', status);
  var textarea = $('textarea', form);
  var body = $.trim(textarea.val());
  if(body.length < 1) return;
  textarea.prop('disabled',true);
  $.ajax({
    url: form.attr('action'),
    method: 'POST',
    data: { body: body },
    complete: function() {
      textarea.prop('disabled',false);
    },
    success: function(response) {
      textarea.prop('disabled',false);
      if(!response.success) {
        alert(response.error);
        return;
      }
      comments.append(response.comment_html);
      $('.timeago').timeago();
      textarea.val('');
    }
  });
}
function LikeComment(e) {
  e.preventDefault();
  var link = $(this);
  var comment = link.closest('.comment');
  var commentId = comment.data('id');

  var likes = $('.comment-likes', comment);
  var likesCount = $('.likes-count', likes);

  $.ajax({
    url: '/comment/like',
    method: 'POST',
    data: { id: commentId },
    complete: function() {
    },
    success: function(response) {
      if(!response.success) {
        alert(response.error);
        return;
      }

      if(response.likes) {
        likes.removeClass('hidden');
        likesCount.text(response.likes);
      }
      else {
        likes.addClass('hidden');
      }

      if(response.userHasLiked) {
        link.text('Unlike');
        comment.addClass('has-liked');
      }
      else {
        link.text('Like');
        comment.removeClass('has-liked');
      }

    }
  });

}

function LikeStatus() {
  var btn = $(this);
  var status = btn.closest('.status');
  var statusId = status.data('id');

  var likesThis = $('.status-likes', status);

  btn.prop('disabled',true);
  $.ajax({
    url: '/status/like',
    method: 'POST',
    data: { id: statusId },
    complete: function() {
      btn.prop('disabled',false);
    },
    success: function(response) {
      if(!response.success) {
        alert(response.error);
        return;
      }

      if(response.likesThis) {
        likesThis.html(
          response.likesThis.you + 
          '<a href="#">' + response.likesThis.other_users_liked + '</a>' +
          response.likesThis.likes_this
        );
      } 
      else {
        likesThis.text('');
      }

      if(response.userHasLiked) {
        btn.addClass('btn-success').removeClass('btn-default');
      }
      else {
        btn.addClass('btn-default').removeClass('btn-success');
      }

    }
  });

}

function ViewStatusLikes(e) {
  e.preventDefault();
  var id = $(this).closest('.status').data('access-id');
  AjaxModal({
    title: 'People who like this status',
    url: '/status/'+id+'/likes'
  });
}function ViewCommentLikes(e) {
  e.preventDefault();
  var id = $(this).closest('.comment').data('id');
  AjaxModal({
    title: 'People who like this comment',
    url: '/comment/'+id+'/likes'
  });
}

function DeleteStatus(id, callback) {
  $.ajax({
    url: '/status/delete',
    method: 'post',
    data: {
      id: id
    },
    success: function(response) {
      if(response.error) {
        alert(response.error);
        return;
      }
      $('#status-'+id).slideUp();
      callback();
    }
  })
}
function DeleteStatusConfirm(e) {
  e.preventDefault();
  var id = $(this).closest('.status').data('access-id');
  var box = bootbox.dialog({
    title: 'Delete Status',
    message: 'Are you sure that you want to delete this status?',
    buttons: {
      cancel: {
        label: 'Cancel',
        className: 'btn-default'
      },
      danger: {
        label: 'Delete Status',
        className: 'btn-danger',
        callback: function() {
          DeleteStatus(id, function() {
            box.modal('hide');
          });
          return false;
        }
      }
    }
  });
}

function DeleteComment(id, callback) {
  $.ajax({
    url: '/comment/delete',
    method: 'post',
    data: {
      id: id
    },
    success: function(response) {
      if(response.error) {
        alert(response.error);
        return;
      }
      $('.comment[data-id='+id+']').slideUp();
      callback();
    }
  })
}
function DeleteCommentConfirm(e) {
  e.preventDefault();
  var id = $(this).closest('.comment').data('id');
  var box = bootbox.dialog({
    title: 'Delete Comment',
    message: 'Are you sure that you want to delete this comment?',
    buttons: {
      cancel: {
        label: 'Cancel',
        className: 'btn-default'
      },
      danger: {
        label: 'Delete Comment',
        className: 'btn-danger',
        callback: function() {
          DeleteComment(id, function() {
            box.modal('hide');
          });
          return false;
        }
      }
    }
  });
}

function Notifications() {
  bootbox.dialog({
    title: 'Notifications',
    message: '<p class="text-center" style="font-size:16px;"><span class="glyphicon glyphicon-bell" style="font-size:30px;"></span> <br>No new notifications.</p>'
  });
  return false;
}

function Messages() {
  bootbox.dialog({
    title: 'Messages',
    message: '<p class="text-center" style="font-size:16px;"><span class="glyphicon glyphicon-envelope" style="font-size:30px;"></span> <br>Messaging is coming soon!</p>'
  });
  return false;
}

$(document).ready(function() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
    },
    error: function(jqxhr, settings, thrownError) {
      var message = 'Sorry, your request could not be completed. Please reload the page and try again.';
      message += '<br><br><pre>Status Code: ' + jqxhr.status + '\nMessage: '+ thrownError + '</pre>';
      bootbox.dialog({
        title: 'A problem has occurred',
        message: message,
        buttons: {
          close: {
            label: 'Close',
            className: 'btn-default'
          },
          reload: {
            label: '<span class="glyphicon glyphicon-refresh"></span> Reload',
            className: 'btn-primary',
            callback: function() {
              document.location.reload();
              return false;
            }
          }
        }
      });
    }
  });

  // Change text and color of button on hover
  // Use data-hover-text and data-hover-toggle-class attributes
  $('body').on('mouseenter', '.btn[data-hover-text]', function() {
    if(!$(this).data('orig-text')) {
      $(this).data('orig-text', $(this).html());
    }
    $(this).html($(this).data('hover-text'))
           .toggleClass($(this).data('hover-toggle-class'));
  }).on('mouseout', '.btn[data-hover-text]', function() {
    $(this).html($(this).data('orig-text'))
           .toggleClass($(this).data('hover-toggle-class'));
  });

  $('.new-comment textarea').keypress(function(e) {
    if(e.which === 13) {
      e.preventDefault();
      $(this).parent('form').submit();
    }
  });
  $('.new-comment').submit(NewComment);

  $('#notifications').click(Notifications);
  $('#messages').click(Messages);

  $('.container').on('click', '.status .comment-btn', FocusCommentBox);
  
  $('.container').on('click', '.status .like-status', LikeStatus);
  $('.container').on('click', '.status .status-likes a', ViewStatusLikes);

  $('.container').on('click', '.comment .like-comment', LikeComment);
  $('.container').on('click', '.comment .comment-likes a', ViewCommentLikes);
  
  $('.container').on('click', '.status .delete-status', DeleteStatusConfirm);
  $('.container').on('click', '.status .comment .delete-comment', DeleteCommentConfirm);

  $('.timeago').timeago();

});