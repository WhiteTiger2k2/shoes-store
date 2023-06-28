

(function ($){

    "use strict";

    /*[ Back to top ]
    ===========================================================*/
     $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
    

    /*[ +/- quantity product  ]
    ===========================================================*/
    $('.btn-minus').on('click', function(){
        var quantity = Number($(this).next().val());
        if(quantity > 1) $(this).next().val(quantity - 1);
    });
    
    $('.btn-plus').on('click', function(){
        var quantity = Number($(this).prev().val());
        $(this).prev().val(quantity + 1);
    });
})(jQuery);
