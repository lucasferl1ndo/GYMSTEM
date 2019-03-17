jQuery(function($){
   $.noConflict();
   var $anteriores = $('input.button').prev();
   $.each($anteriores, function(index, value){
      if($(value).is('input') || $(value).is('select')){
          $(value).addClass('input-with-button');
      }
   });

   $('.color_field').wpColorPicker({
       hide: true
   });
});
