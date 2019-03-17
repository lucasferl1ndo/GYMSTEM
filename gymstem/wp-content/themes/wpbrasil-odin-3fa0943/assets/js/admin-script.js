jQuery(function ($) {
    $('[name = "post_title"]').keyup(function(){
        $('#nome').val($(this).val());
        console.log($(this).val());
    });
});