$(function(){
	
	$(window).bind("load", onLoad);
	//alert("a");
	function onLoad(){
		$(".animation .bg").css("opacity", "1");
		startAnimation();
	}
	
	function startAnimation() {
		var delayTime = 500;
		$(".animation .img0text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		delayTime += 4500;
		$(".animation .img0").delay(delayTime).animate({"opacity": 0},2000,"linear");
		
		delayTime += 2000;
		$(".animation .img1text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		delayTime += 4500;
		$(".animation .img1").delay(delayTime).animate({"opacity": 0},2000,"linear");
		
		delayTime += 2000;
		$(".animation .img2text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		delayTime += 4500;
		$(".animation .img2").delay(delayTime).animate({"opacity": 0},2000,"linear");

		delayTime += 2000;
		$(".animation .img3text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		delayTime += 4500;
		$(".animation .img3").delay(delayTime).animate({"opacity": 0},2000,"linear");

		delayTime += 2000;
		$(".animation .img4text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		delayTime += 4500;
		$(".animation .img4").delay(delayTime).animate({"opacity": 0},2000,"linear");

		delayTime += 2000;
		$(".animation .img5text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		delayTime += 4500;
		$(".animation .img5").delay(delayTime).animate({"opacity": 0},2000,"linear");

		delayTime += 2000;
		$(".animation .img6text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		delayTime += 4500;
		$(".animation .img6").delay(delayTime).animate({"opacity": 0},2000,"linear");

		delayTime += 2000;
		$(".animation .img7text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		delayTime += 4500;
		$(".animation .img7").delay(delayTime).animate({"opacity": 0},2000,"linear");

		delayTime += 2000;
		$(".animation .img8text").delay(delayTime).animate({"opacity": 1},2000).delay(2000).animate({"opacity": 0},2000);
		
		delayTime += 0;
		$(".animation .img0").delay(delayTime).animate({"opacity": 1},2000,"linear",function(){
			startAnimation()
			$(".animation .bg").css("opacity", "1");
		});
	}
});