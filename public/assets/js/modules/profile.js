function ChangeAvatar(e) {
  e.preventDefault();
  AjaxModal({
    title:'Change Picture',
    url: '/settings/modal/avatar'
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

$(document).ready(function() {
  $('.change-avatar').click(ChangeAvatar);
  $('body').on('click', '.delete-avatar', DeleteAvatar);
});