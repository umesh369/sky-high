$(document).ready(function(){
	$('.me').append("<span class='close'>X</span>");
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });

	});

	function rePlay() {
    	$(".animateDwn a").animate({'top':'5px'},300).animate({'top':'0px'},300,rePlay); 
	}
	rePlay();

	$(".regular").slick({
		dots: false,
		infinite: false,
		slidesToShow: 6,
		slidesToScroll: 1,
		responsive: [
		{
	      breakpoint: 1366,
	      settings: {
	        slidesToShow: 4,
	        slidesToScroll: 1,
	        infinite: false,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 800,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1,
	        infinite: false,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 640,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1,
	        infinite: false,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1,
	        infinite: false,
	        dots: false
	      }
	    }
	  ]
	});
	$(".photos").slick({
		dots: false,
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
	 	//variableWidth: true,
	 	responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1,
	        infinite: false,
	        //variableWidth: true,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 800,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1,
	        infinite: false,
	        //variableWidth: false,
	        //centerMode: true,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 640,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1,
	        infinite: false,
	        //variableWidth: false,
	        //centerMode: true,
	        dots: false
	      }
	    }
	  ]
	});

	$(window).resize(function (){
		var fullWidth = $(window).width();
		var fullHeight = $(window).height();

		$('.main').width(fullWidth);
		$('.main').height(fullHeight);

		var actualWidth = fullWidth * 50 / 100;
		var actualHeight = fullHeight * 50 / 100;

		$('.me').width(actualWidth);
		var abc = $('.me').outerWidth();
		var divWidth = fullWidth - abc
		$('.me').css('left', (divWidth) / 2);

		$('.me').height(actualHeight);
		var pqr = $('.me').height();
		var divHeight = fullHeight - pqr
		$('.me').css('top', (divHeight) / 2); 

		$(".close, .main").click(function(){
			$('.main').fadeOut();
			$("body").css("overflow","auto");
		});
		$(".me").click(function(e){
		    e.stopPropagation();
		});

		$(".openMe").click(function(){
		    $('.main').fadeIn();
		    $("body").css("overflow","hidden");
		   	var target = $(this).attr("data-target");
		   	$(".popDiv").each(function(){
			    var $this = $(this);
			    var matchAttr = $this.attr("data-target");
			    if(target == matchAttr){
			        var ot =  $this.html();
			        $(".content").empty();
			        $(ot).prependTo(".content");
			    }else{
			        $this.hide();
			    }
			});	 
			var $scrollable = $('.scrollable'),
			    $scrollbar  = $('.scrollbar'),
			    H   = $scrollable.outerHeight(true),
			    sH  = $scrollable[0].scrollHeight,
			    sbH = H*H/sH;

			$('.scrollbar').height( sbH ).draggable({
			    axis : 'y',
				 containment : 'parent', 
				  drag: function(e, ui) {
						$scrollable.scrollTop( sH/H*ui.position.top  );
			    }
			}); 
			 
			$scrollable.on("scroll", function(){
				$scrollbar.css({top: $scrollable.scrollTop()/H*sbH });
			});

			var xyz = $(".scrollbar").height();
			var lmn = $(".me").height();

			if(xyz == lmn){
			        $(".scrollbar").hide();
		    }else{
		        $(".scrollbar").show();
		    }
		});
	});
	$(window).resize();
});

$(window).resize(function(){
	var banHgt = $(".banner img").height();
	var formHgt = $(".form").outerHeight();
	var banrH = banHgt - formHgt
	var actBanHgt = banrH/2
	$(".form").css("top", actBanHgt);
	$(".form").css({"top": actBanHgt, right: actBanHgt});	
});

$(window).load(function(){
	var banHgt = $(".banner img").height();
	var formHgt = $(".form").outerHeight();
	var banrH = banHgt - formHgt
	var actBanHgt = banrH/2
	$(".form").css("top", actBanHgt);
	$(".form").css({"top": actBanHgt, right: actBanHgt});
	$(".form").css("opacity","1");

	$(".mobMap").click(function(){  
		$(".mobMapImg").slideToggle();
	});
});