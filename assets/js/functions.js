var maxlength = 45;
var timerShow = 3; // in seconds

$(document).ready(function() {	
	initScroll();
	findNewPic();
	reduceTextLength();
	initGallery();
//	initToolTip();
	initShow();
//	initSlideNews();
});

function initScroll() {
	$("a[href*='#']").click(function() {
		var href = $(this).attr("href");
		var obj = $(href);
		var pos = obj.offset().top;
			$("html, body").animate({scrollTop:pos}, 500);
			$(obj).animate( {opacity:".1"}, 500 );
			$(obj).animate( {opacity:"1"}, 500 );
			return false;
	});
}

function findNewPic() {
	$(".newpic").each(function(){
		$(this).append( '<div class="newicon"></div>' );
	});
}

function reduceTextLength() {
	$(".img-label").each(function() {
		var text = $(this).text();
		if (text.length > maxlength)
			$(this).text(text.substr(0, maxlength) + "...");
	});
}

function initGallery() {
	$("a[rel^='prettyPhoto']").prettyPhoto({theme: 'facebook',slideshow:5000, autoplay_slideshow:true});
/*
	$(".gallery-view:first a[rel^='prettyPhoto']").prettyPhoto({
		animationSpeed: 'slow',
		theme: 'facebook', // 'dark_rounded' 'dark_square' 'facebook' 'light_rounded' 'light_square' 
		slideshow: 3000, 
		autoplay_slideshow: true
	});*/
}

function initToolTip() {
	var chat = $(".livechat a");
	chat.simpletooltip();
};

function initShow() {
	$('.img-con img:gt(0)').hide();
	setInterval(function(){ 
		$('.img-con a :first-child').fadeOut()
		.next('img').fadeIn().end().appendTo('.img-con a')
	}, timerShow*1000);
}

