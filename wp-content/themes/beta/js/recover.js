// FOCUS RECOVER - SETTINGS //





var textBoxs = $('.short, .long');
textBoxs.each(function() {
  var theValue = $(this).attr('value');
  $(this).focus(function (){
    if($(this).attr('value') == theValue){
      $(this).attr('value','').addClass('writingIt');
    }
  }).blur(function () {
    if($(this).attr('value') == ''){
      $(this).attr('value',theValue).removeClass('writingIt');
    }
  });
});