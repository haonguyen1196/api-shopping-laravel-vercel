
$('.checkbox_parent').click(function(){
    $(this).parents('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'));
  });

  $('.checked_all').click(function(){
    $(this).parents().find('.checkbox_parent').prop('checked', $(this).prop('checked'));
    $(this).parents().find('.checkbox_children').prop('checked', $(this).prop('checked'));
  });