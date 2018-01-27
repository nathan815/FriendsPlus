function ChangeAvatar() {
  var content = $('#avatar-modal-container').html();
  bootbox.dialog({
    title:'Change Picture',
    message: content,
    onEscape: function() {
      window.location.hash = '';
    }
  });
}
function DeleteAvatar() {
  $.ajax({
    url: '/settings/avatar/delete',
    method: 'post',
    success: function(response) {
      $('.delete-avatar').hide();
      $('.current-avatar').attr('src', response.url);
    }
  });
}

function ChangeCover() {
  var content = $('#cover-modal-container').html();
  bootbox.dialog({
    title: 'Change Cover',
    message: content
  });
}

$(document).ready(function() {
  $('.change-avatar').click(ChangeAvatar);
  $('.change-cover').click(ChangeCover);
  $('body').on('click', '.delete-avatar', DeleteAvatar);
  if(window.location.hash === '#change-avatar') {
    ChangeAvatar();
  }
});