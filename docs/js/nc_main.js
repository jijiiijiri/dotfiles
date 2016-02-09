$(function() {
  var nav = $('.contactbox');
  var navHeight = nav.height()+10;
  var showFlag = false;
  nav.css('top', -navHeight+'px');

  $(window).load(function () {
    var winTop = $(this).scrollTop();
    if (winTop >= 120) {
      if (showFlag == false) {
        showFlag = true;
        nav.css('display','block');
        nav
          .addClass('contactboxfixed')
          .stop().animate({'top' : '0px'}, 200);
      }
    }
  });
  $(window).scroll(function () {
    var winTop = $(this).scrollTop();
    if (winTop >= 120) {
      if (showFlag == false) {
        showFlag = true;
        nav.css('display','block');
        nav.addClass('contactboxfixed');
        nav.stop().animate({'top' : '0px'}, 200);
      }
    } else if (winTop <= 120) {
      if (showFlag) {
        showFlag = false;
        nav.stop().animate({'top' : -navHeight+'px'}, 200, function(){
          nav.css('display','none');
          nav.removeClass('contactboxfixed');
        });
      }
    }
  });
});

$(function(){
	jQuery.preloadImages = function(){
		for(var i = 0; i<arguments.length; i++){
			jQuery("<img>").attr("src", arguments[i]);
		}
	};
	$.preloadImages("/images/nc/nc_main_top_ninriki.png","/images/nc/nc_main_adope.png","/images/nc/nc_main_sbt.png","/images/nc/nc_main_vml.png","/images/nc/nc_main_attribution.png","/images/nc/nc_main_tagmanagement.png","/images/nc/nc_main_digitalice.png","/images/nc/nc_main_tech.png","/images/nc/nc_main_rss.png");
});

$(function(){
     $(".arrow_left").hover(function(){
        $(".arrow_left").addClass("arrow_anim");
          }, function(){
             $(".arrow_left").removeClass('arrow_anim');
   });
     $(".arrow_right").hover(function(){
        $(".arrow_right").addClass("arrow_anim");
          }, function(){
             $(".arrow_right").removeClass('arrow_anim');
   });
});


$(function(){
     $(".sbt1").hover(function(){
        $(".sbt1").addClass("tableHilight");
          }, function(){
             $(".sbt1").removeClass('tableHilight');
   });
     $(".sbt2").hover(function(){
        $(".sbt2").addClass("tableHilight");
          }, function(){
             $(".sbt2").removeClass('tableHilight');
   });
     $(".sbt3").hover(function(){
        $(".sbt3").addClass("tableHilight");
          }, function(){
             $(".sbt3").removeClass('tableHilight');
   });
     $(".sbt4").hover(function(){
        $(".sbt4").addClass("tableHilight");
          }, function(){
             $(".sbt4").removeClass('tableHilight');
   });
     $(".sbt5").hover(function(){
        $(".sbt5").addClass("tableHilight");
          }, function(){
             $(".sbt5").removeClass('tableHilight');
   });
});

//topお知らせ
	$(function(){
		$("#info").css({bottom:'-200px'});
		setTimeout(function(){
			$("#info").stop().animate({bottom:'0'},400);
		},1000);
	});
	// $(window).scroll(function () {
	//         if ($(this).scrollTop() > 200) {
	//           setTimeout(function(){
	// 					$("#info").stop().animate({bottom:'-400'},400);
	// 					},1000);
	//         } else {
	//         }
	//     });