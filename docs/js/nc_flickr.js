$(function(){
    $.ajax({
        type : 'GET',
        url : 'https://www.flickr.com/services/rest/',
        data : {
            format : 'json',
            method : 'flickr.photos.search',
            api_key : '0d95c625265da9011da61ec4f48d39ba',
            user_id : '116611635@N06',
            sort : 'date-posted-desc',
            per_page : '20',
        },
        dataType : 'jsonp',
        jsonp : 'jsoncallback',
        success : _getFlickrPhotos
    });
});

function _getFlickrPhotos(data){

    var dataStat = data.stat;
    var dataTotal = data.photos.total;
    if(dataStat == 'ok'){
        $.each(data.photos.photo, function(i, item){
            var itemFarm = item.farm;
            var itemServer = item.server;
            var itemID = item.id;
            var itemSecret = item.secret;
            var itemTitle = item.title;
            var itemLink = 'http://www.flickr.com/photos/cbn_akey/' + itemID + '/'
            var itemPath = 'http://farm' + itemFarm + '.static.flickr.com/' + itemServer + '/' + itemID + '_' + itemSecret + '_b.jpg'
            var flickrSrc = '<img src="' + itemPath + '" alt="' + itemTitle + '" width="100%;">';
            var htmlSrc = '<li class="lbimg"><a href="' + itemPath + '" target="_blank"  title="' + itemTitle + '">' + flickrSrc + '</a><span style="color:#424242;font-size:0.6em;text-align:center;">' + itemTitle + '</span></li>'

            $('#main ul').append(htmlSrc);
				var options = {
					autoResize: true,
					container: $('#main'),
					offset: 0,
					itemWidth: 308
				};
				
				var handler = $('#tiles li');
				handler.wookmark(options);
				$(".cover").css('display','none');
        });
        

		if($("body").hasClass("lteie8")||$("body").hasClass("ie9")) {
			setTimeout(function(){
				var options = {
					autoResize: true,
					container: $('#main'),
					offset: 0,
					itemWidth: 308
				};
			
			var handler = $('#tiles li');
			handler.wookmark(options);
			
			$(".cover").css('display','none');
			$(".footer").css('display','block');
	    	$(".lbimg a").colorbox({scalePhotos:true,maxHeight:'95%'});
			$(window).resize(function(){
				$.colorbox.resize({scalePhotos:true,maxHeight:'95%'});
			});	
	    	},3000);

		}else{

			$(window).load(function () {
				var options = {
					autoResize: true,
					container: $('#main'),
					offset: 0,
					itemWidth: 308
				};
				
				var handler = $('#tiles li');
				handler.wookmark(options);
				
				$(".cover").css('display','none');

				var h = document.documentElement.clientHeight;
        		var	w = document.documentElement.clientWidth;
        		if(w > h){
			    	$(".lbimg a").colorbox({scalePhotos:true,maxHeight:'95%'});
					$(window).resize(function(){
						$.colorbox.resize({scalePhotos:true,maxHeight:'95%'});
					});	
        		} else{
			    	$(".lbimg a").colorbox({scalePhotos:true,maxWidth:'95%'});
					$(window).resize(function(){
						$.colorbox.resize({scalePhotos:true,maxWidth:'95%'});
					});	
        		}
			});

	    }
        
    }else{
    }

}


