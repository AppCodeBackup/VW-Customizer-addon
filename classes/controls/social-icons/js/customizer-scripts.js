jQuery(document).ready(function($) {
    //"use strict";

    //FontAwesome Icon Control JS
    $('body').on('click', '.total-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.total-icon-list').prev('.total-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.total-icon-list').next('input').val(icon_class).trigger('change');
    });

    $('body').on('click', '.total-selected-icon', function(){
        $(this).next().slideToggle();
    });
    $(".vwsocialInput").on("keyup", function() {
        //alert("hii");
        var value = $(this).val().toLowerCase();
        $(".total-icon-list li").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
