// JavaScript Document
	$(function(){
		//トップスクロール
		var windowRoll = $(window),
			topBtn = $('#ToTheTop'),
			showFlug = false,
			changeBottom = $('body').height() - windowRoll.height() - 0;
			 
		topBtn.css('right', '10');
		//スクロールが100に達したらボタン表示
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				topBtn.fadeIn();
			} else {
				topBtn.fadeOut();
			}
		});
		//スクロール位置によるボタンのbottom変化
	   windowRoll.scroll(function() {
		   if ($(this).scrollTop() <= changeBottom) {
			   topBtn.addClass("bottomsmall").removeClass("bottomlage");
		   }
		   else {
			   topBtn.removeClass("bottomsmall").addClass("bottomlage");
		   }
			   });
	 
		//スクロールしてトップ
		topBtn.click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 300);
			return false;
		});
		 
	});