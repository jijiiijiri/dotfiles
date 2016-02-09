$(function(){

	var $windowPage = $(window);

	if ( $windowPage.width() < 801 ) {

		//実機チェックの際にon tapのみにする
		$('#nav-site-btn').on('click', function(){
			$('ul.nav-first-layer').stop().slideToggle(300, 'swing');

			//header_nav_multi.ejs使用時、下記スクリプト使う
			//$('ul.nav-second-layer').hide();
			//$('span.nav-icn-active').removeClass('active');
		});

		//header_nav_multi.ejs使用時、下記スクリプト使う

		// $('a.nav-item-first-layer').on('click', function(){
		// 	//クリックされたnav-item-first-layerの兄弟要素　ul.nav-second-layer
		// 	$(this).siblings().stop().slideToggle(300, 'swing');
		// 	$('span.nav-icn-active', this).toggleClass('active');
		// });

	} else {

		//PCメニュー ドロップダウン

		//header_nav_multi.ejs使用時、下記スクリプト使う

	    // $('ul.nav-first-layer li').on('touchstart mouseenter', function(){
	    // 	$('ul:not(:animated)', this).show().animate({
	    // 		opacity: '1',
	    // 		top:'4rem'}, 200);
	    // }).on('touchend mouseleave', function(){
	    //     $("ul.nav-second-layer",this).fadeOut(200).animate({
	    //     	opacity: '0',
	    //     	top: '4.4rem'}, 200);
	    // });
	}


	$('a.btn-hover01, a.btn-hover02, a.btn-hover03').on({
	    'mouseenter':function(){
	    	$(this).addClass('sns-btn-active');
	        $(this).siblings().addClass('sns-btn-active');
	    },
	    'mouseleave':function(){
	    	$(this).removeClass('sns-btn-active');
		    $(this).siblings().removeClass('sns-btn-active');
	    }
	});

	$('.btn-sns01 > a').on('click', function(){
		window.open().location.href='https://www.facebook.com/fringe81';
		return false;
	});

	$('.btn-sns02 > a').on('click', function(){
		window.open(this.href, 'fbShareWindow', 'height=450, width=550, top=0, left=0, toolbar=0, location=0, menubar=0, directories=0, scrollbars=0').location.href='http://www.facebook.com/share.php?u=http://www.fringe81.com/culture/&amp;t=Fringe81';
		return false;
	});

	$('.btn-sns03 > a').on('click', function(){
		window.open().location.href='http://b.hatena.ne.jp/add?url=http://www.fringe81.com/';
		return false;
	});

	$('.btn-sns04 > a').on('click', function(){
		window.open(encodeURI(decodeURI(this.href)), 'tweetwindow', 'width=650, height=470, personalbar=0, toolbar=0, scrollbars=1, sizable=1').location.href='http://twitter.com/share?text=「新しい発見をもとに、地球の未来を創る集団」Fringe81株式会社&url=http%3A%2F%2Fwww.fringe81.com%2F&hashtags=Fringe81';
		return false;
	});


    var _ua = (function() {
        return {
            Gecko: 'MozAppearance' in document.documentElement.style,
            Blink: window.chrome,
            Webkit: typeof window.chrome == "undefined" && 'WebkitAppearance' in document.documentElement.style,
            Mobile: (typeof window.orientation != "undefined") || (navigator.userAgent.indexOf("Windows Phone") != -1)
        };
    })();

    if (_ua.Blink && !_ua.Mobile || _ua.Webkit && !_ua.Mobile || _ua.Gecko && !_ua.Mobile) {

		//デスクトップ版Chrome/Operaの処理
		//デスクトップ版Safariの処理
		//デスクトップ版Firefoxの処理
		$(".block-like-count").removeClass('count-active').addClass('count-active');
		$.ajax({
			url: 'https://graph.facebook.com/fql?q=SELECT%20url,%20total_count%20FROM%20link_stat%20WHERE%20url=%27https://www.facebook.com/fringe81%27&format=json',
			dataType: 'json',
			data: {name: 'chara'},
			success: function(data){
				var dataArray = data.data;
				$.each(dataArray, function(i){
					$("#like-count").append( dataArray[i].total_count );
				});
			}
		});


		$('<img>').attr('src','/culture/img/about/sprite_anime.png');
		setTimeout(function(){
			$('.sprite-anime').addClass('start');
			$(function(){
			    $(".sprite-anime").on('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function(){
			        $('#container-sprite-anime').fadeOut(500);
			        $('.head-main-visual').fadeIn(900);
			    });
			});
		}, 800);


    } else {
    	$('.head-main-visual').fadeIn(300);
    	$('#container-sprite-anime').hide();
    }


	$(window).on('load resize', function() {

		//高さを取ってきて他の要素の高さに代入
	    var getHeight = $('.get-height').height();
	    $('.input-height').css('height', getHeight + 'px');

		//横幅を取ってきて高さに代入
	    var getWidth = $('.get-width').width();
	    $('.input-width').css('height', getWidth + 'px');

	    //main visual高さを代入
	    var mainVisualHeight = $('.bg-main-visual').height();
	    $('.main-visual-mod, .main-visual').css('height', mainVisualHeight + 'px');

	});

});