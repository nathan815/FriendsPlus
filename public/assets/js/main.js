/**
 * General JS for Friends+
 */

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
    $(this).data('orig-text', $(this).html())
           .html($(this).data('hover-text'))
           .toggleClass($(this).data('hover-toggle-class'));
  }).on('mouseout', '.btn[data-hover-text]', function() {
    $(this).html($(this).data('orig-text'))
           .toggleClass($(this).data('hover-toggle-class'));
  });


});