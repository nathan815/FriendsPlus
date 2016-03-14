/**
 * General JS for Friends+
 */

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

function LikeStatus() {
  var btn = $(this);
  var status = btn.closest('.status');
  var statusId = status.data('id');

  var likesThis = $('.likes', status);

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

function ViewLikes(e) {
  e.preventDefault();
  var id = $(this).closest('.status').data('access-id');
  AjaxModal({
    title: 'People who like this',
    url: '/status/'+id+'/likes'
  });
}

$(document).ready(function() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
    },
    error: function() {
      alert('Sorry, the request could not be completed. Please try again.');
    }
  });

  // Change text and color of button on hover
  // Use data-hover-text and data-hover-toggle-class attributes
  $('.container').on('mouseenter', '.btn[data-hover-text]', function() {
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

  $('.container').on('click', '.status .comment', FocusCommentBox);
  $('.container').on('click', '.status .like', LikeStatus);
  $('.container').on('click', '.status .likes a', ViewLikes);

  $('.timeago').timeago();

});