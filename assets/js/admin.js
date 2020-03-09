var $ = jQuery;

var dropdownFields = ".acf-field[data-type='component_field'][data-name='background'] > .acf-label label, .acf-field[data-type='component_field'][data-name='animate_options'] > .acf-label label";


$(".acf-fields.-top").on("click", dropdownFields, function(){
  var $parent = $(this).closest('.acf-field');
  $parent.toggleClass('expanded');

  $parent.find('.acf-input').first().slideToggle();
});

$(".acf-fields.-top").on("change", ".acf-field[data-name='responsive_options'] input[type='checkbox']", function(){
  var $parent = $(this).closest('.acf-field');

  var uncheckBoxes = $('');

  if ( $(this).is("[value='single']") ){
    uncheckBoxes = $parent.find("input[type='checkbox']:not([value='single'])");
  }else{
    uncheckBoxes = $parent.find("input[type='checkbox'][value='single']");
  }

  uncheckBoxes.removeAttr('checked');
});
