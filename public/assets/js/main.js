/**
 * General JS for Friends+
 */

function NewComment(e) {
  var _t = $(this);
  var status_id = _t.data('status-id');
  var comments = $('.comments-list', '#status-'+status_id);
  var textarea = $('textarea', _t);
  var body = textarea.val();
  textarea.prop('disabled',true);
  e.preventDefault();
  $.ajax({
    url: _t.attr('action'),
    method: 'POST',
    data: { body: body },
    success: function(response) {
      textarea.prop('disabled',false);
      if(!response.success) {
        alert(response.error);
        return;
      }
      comments.append(response.comment_html);
      textarea.val('');
    }
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


});