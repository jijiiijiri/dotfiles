(function($) {
$(function() {
    var tabs = $("#loc_nav > .locnav");
    var offset = $(tabs).offset();
    $(window).scroll(function() {
        if ($(window).scrollTop() > offset.top) {
            $(tabs).stop().animate({
                marginTop: $(window).scrollTop() - offset.top + 10
            });
            } else {
                    $(tabs).stop().animate({
                        marginTop: 0
                    });
        }
    });
});
})(jQuery);