jQuery(function ($) {
    $.superSimpleScroll({
        menuItemClass: 'ativo'
    });

    $('#assinatura').on('click', function () {
        $('html, body').animate({scrollTop: $('#home').offset().top}, 1000);
    });

});