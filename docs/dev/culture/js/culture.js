$(function(){

	$(window).on('load resize', function() {
		//mindページ ページ内リンク高さ調整
	    var squareWidth = $('div.nav-square > a').width();
	    $('nav.nav-mind, .nav-square > a').css('height', squareWidth + 'px');
	});


    $('.nav-square > a').on('touchstart mouseenter', function(){
    	$(this).removeClass('off').addClass('active');
    		    }).on('touchend mouseleave', function(){
        $(this).removeClass('active').addClass('off');
    });

	var headerHight = 80; //オフセット値
    $('a[href^=#]').click(function(){
        var href= $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top-headerHight; //ヘッダの高さ分位置をずらす
        $("html, body").animate({scrollTop:position}, 550, "swing");
        return false;
    });

});