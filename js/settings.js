jQuery(function () {
  var $  = jQuery,
  $text  = $('.mediavoice textarea'),
  $check = $('.mediavoice input:checkbox');

  $check.on('click', function () {
    toggleTextArea();
  })

  function toggleTextArea() {
    var checked = $check.is(':checked');
    $text.toggleClass('disabled', !checked).prop('readonly', !checked);
  }

  toggleTextArea();
})
