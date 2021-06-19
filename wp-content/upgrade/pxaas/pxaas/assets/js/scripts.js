(function($){
	"use strict";
	$(document).ready(function(){

        var menu_height = $('#main-navbar').outerHeight(true)
        // onepage nav
        jQuery(".landing-scroll-nav  ul").singlePageNav({
            filter: ":not(.external) > a",
            updateHash: false,
            offset: menu_height,
            threshold: 120,
            speed: 1200,
            currentClass: "act-link",
            beforeStart : function(){},
            onComplete: function() {}
        });
        jQuery(".custom-scroll-link,.menu-scroll-link").on("click", function() {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") || location.hostname == this.hostname) {
                var b = jQuery(this.hash);
                b = b.length ? b : jQuery("[name=" + this.hash.slice(1) + "]");
                if (b.length) {
                    jQuery("html,body").animate({
                        scrollTop: b.offset().top - menu_height
                    }, {
                        queue: false,
                        duration: 1600,
                        easing: "easeInOutExpo"
                    });
                    return false;
                }
            }
        });

        var mobileWidth = 991
        $(document).on('click', '#top-menu .menu-item.menu-item-has-children > a', function(e){
            var w_w = $(window).innerWidth()
            if( w_w <= mobileWidth){
                e.preventDefault()
                var parent = $(this).parent('.menu-item')
                parent.toggleClass('show')
            }
        });

		$(".single-slider").each(function(){
	        var owlsl = $(this) ;
	        var owlsl_df = {margin: 0, responsive: false, smartSpeed:1300,autoplay:false,items:1,loop:true, nav: true, dots: true,center:false,autoWidth:false,thumbs:false};
	        var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};
	        owlsl_ops = $.extend({}, owlsl_df, owlsl_ops);
	        if(owlsl_ops.responsive){
                var respArr = owlsl_ops.responsive.split(',');
                owlsl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    owlsl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };
                }
            }else{
                owlsl_ops.responsive = false;
            }
	        owlsl.owlCarousel({
	            autoWidth: owlsl_ops.autoWidth,
	            // margin: 20,
	            margin: owlsl_ops.margin,

	            items: owlsl_ops.items,
	            smartSpeed: owlsl_ops.smartSpeed,
	            loop: owlsl_ops.loop,
	            autoplay: owlsl_ops.autoplay,
	            center: owlsl_ops.center,
	            nav: owlsl_ops.nav,
	            dots: owlsl_ops.dots,
	            thumbs: owlsl_ops.thumbs,
	            responsive: owlsl_ops.responsive,
	            navText:['<i class="fa fa-long-arrow-left" aria-hidden="true"></i>','<i class="fa fa-long-arrow-right" aria-hidden="true"></i>'],
	        });

	    });
		$(".testi-slider").each(function(){
	        var owlsl = $(this) ;
	        var owlsl_df = {margin: 0, responsive: false, smartSpeed:1300,autoplay:false,items:1,loop:true, nav: true, dots: true,center:false,autoWidth:false,thumbs:false};
	        var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};
	        owlsl_ops = $.extend({}, owlsl_df, owlsl_ops);
	        if(owlsl_ops.responsive){
                var respArr = owlsl_ops.responsive.split(',');
                owlsl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    owlsl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };
                }
            }else{
                owlsl_ops.responsive = false;
            }
	        owlsl.owlCarousel({
	            autoWidth: owlsl_ops.autoWidth,
	            // margin: 20,
	            margin: owlsl_ops.margin,

	            items: owlsl_ops.items,
	            smartSpeed: owlsl_ops.smartSpeed,
	            loop: owlsl_ops.loop,
	            autoplay: owlsl_ops.autoplay,
	            center: owlsl_ops.center,
	            nav: owlsl_ops.nav,
	            dots: owlsl_ops.dots,
	            thumbs: owlsl_ops.thumbs,
	            responsive: owlsl_ops.responsive,
	            navText:['<i class="fa fa-long-arrow-left" aria-hidden="true"></i>','<i class="fa fa-long-arrow-right" aria-hidden="true"></i>'],
	            // smartSpeed: 650,
	            animateIn: 'fadeIn',
	        });

	    });
		$(".carousel-slider").each(function(){
	        var owlsl = $(this) ;
	        var owlsl_df = {margin: 0, responsive: false, smartSpeed:1300,autoplay:false,items:1,loop:true, nav: true, dots: true,center:false,autoWidth:false,thumbs:false};
	        var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};
	        owlsl_ops = $.extend({}, owlsl_df, owlsl_ops);
	        if(owlsl_ops.responsive){
                var respArr = owlsl_ops.responsive.split(',');
                owlsl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    owlsl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };
                }
            }else{
                owlsl_ops.responsive = false;
            }
	        owlsl.owlCarousel({
	            autoWidth: owlsl_ops.autoWidth,
	            // margin: 20,
	            margin: owlsl_ops.margin,

	            items: owlsl_ops.items,
	            smartSpeed: owlsl_ops.smartSpeed,
	            loop: owlsl_ops.loop,
	            autoplay: owlsl_ops.autoplay,
	            center: owlsl_ops.center,
	            nav: owlsl_ops.nav,
	            // dots: owlsl_ops.dots,
	            thumbs: owlsl_ops.thumbs,
	            responsive: owlsl_ops.responsive,
	            navText:['<i class="fa fa-long-arrow-left" aria-hidden="true"></i>','<i class="fa fa-long-arrow-right" aria-hidden="true"></i>'],
	            dotsContainer: '.vision-dots'
	        });

	    });


	
		//=======
		$('.bg').each(function(){
			var $bg = $(this);

			if(typeof $bg.data('bg') != 'undefined'){
				$bg.css('background-image', 'url(' + $bg.data('bg') + ')');
			}
		})
		// reservation booking
		 $(".res-tab").on("click", function () {
            var table_type = $(this).closest("div.tb-box1-wrapper").data('tbtype');
            if(typeof table_type != 'undefined') $('#tableres_type').val(table_type)
           	var dbclick = $(this).closest("div.tb-box1-wrapper").addClass('active');
			$('html, body').animate({
		    	scrollTop: $("div.reser-input-box-Wrapper").offset().top -46
		  	}, 1000)
           
        });

		// Preloader 
		$(".load-wrapp").fadeOut(300, function () {
        });

		// Message login-error
        $(".login-error").fadeOut(7000, function () {
        });

	    // ===== Scroll to Top ==== 
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 100) {
                $('#return-to-top').fadeIn(200);
            } else {
                $('#return-to-top').fadeOut(200);
            }
        });
        $('#return-to-top').on('click', function() {
            $('body,html').animate({
                scrollTop: 0
            }, 500);
        });

        //Video Play
        $('.play-trigger').magnificPopup({
            type: 'iframe',
            // disableOn: function() {
            //     if( $(window).width() < 600 ) {
            //         return false;
            //     }
            //     return true;
            // }
        });
        $.extend(true, $.magnificPopup.defaults, {
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                    }
                }
            }
        });


        $('.project-popup-image').magnificPopup({
            type: 'image'
            // other options
        });

        var win = $(window);
        win.on("scroll", function () {
            var wScrollTop  = $(window).scrollTop();    
            if (wScrollTop > 100) {
                $(".navbar").addClass("navbar-colored");
            } else {
                $(".navbar").removeClass("navbar-colored");
            }
        });
    
	});

	//
	


	// Tab listing plan
	$('ul.tabs-plan li').on('click', function(){
		var myID = $(this).attr('id');
		$(this).addClass('active').siblings().removeClass('active');
		$('#' + myID + '-content').fadeIn(800).siblings().hide();
	});

    $(".testimonials-carousel-wrap-ss").each(function(){
        //Function to animate slider captions 
        function doAnimations(elems) {
            //Cache the animationend event in a variable
            var animEndEv = 'webkitAnimationEnd animationend';

            elems.each(function() {
                var $this = $(this),
                    $animationType = $this.data('animation');
                $this.addClass($animationType).one(animEndEv, function() {
                    $this.removeClass($animationType);
                });
            });
        }

        //Variables on page load 
        var $myCarousel = $('#carousel-example-generic'),
            $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

        //Initialize carousel 
        $myCarousel.carousel();

        //Animate captions in first slide on page load 
        doAnimations($firstAnimatingElems);

        //Pause carousel  
        $myCarousel.carousel('pause');


        //Other slides to be animated on carousel slide event 
        $myCarousel.on('click slide.bs.carousel', function(e) {
            var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
            doAnimations($animatingElems);
        });

    });

})(jQuery);



/*----------------------------
wow js active
------------------------------ */
new WOW().init();

