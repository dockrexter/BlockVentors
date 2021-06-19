(function ($) {
	"use strict";
	//Global variable
	var $rtl = false;
	if(cryptcio_params.cryptcio_rtl=='yes'){
		$rtl = true;
	}
	// Check images loaded
	$.fn.JAS_ImagesLoaded = function( callback ) {
		var JAS_Images = function ( src, callback ) {
			var img = new Image;
			img.onload = callback;
			img.src = src;
		}
		var images = this.find( 'img' ).toArray().map( function( el ) {
			return el.src;
		});
		var loaded = 0;
		$( images ).each(function( i, src ) {
			JAS_Images( src, function() {
				loaded++;
				if ( loaded == images.length ) {
					callback();
				}
			})
		})
	}
	function cryptcioSetChildWidth(){
		$('.cate-menu > ul > li > ul').each(function(){
			var count_num = $(".cate-menu > ul > li > ul > li").size();	
			$(this).addClass('menu-col'+count_num/2);
		});
		// alert('ok');
	}
	function cryptcio_AutocompleteSearch(){
		$('.search-form').each(function(){
			var url = cryptcio_params.ajax_url + "?action=cryptcio_search";
			var $this = $(this);					
			var $post_type = ($(this).find( "input[name='post_type']" ).val()!='')?$(this).find( "input[name='post_type']" ).val():'';
			var s1 = [];
			// var s2 = [];
			$(this).find(' select' ).each(function(){
				$(this).on('change', function() {
					s1.unshift({
						tax: $(this).attr('name'), 
						term: $(this).find(":selected").val()
					});				  				  	
					var categories =[];
					var dup= [];
					if(s1.length !== 0){
						$.each(s1, function(index, value) {
							if(typeof value !== "undefined"){
								if ($.inArray(value.tax, categories) == -1) {
									categories.push(value.tax);
								}else{
									dup.push(value.tax);
									s1.pop();
								}
							}
						});
					}
				});

			});

			$(this).find( "input[name='s']" ).autocomplete({
					// source: url,
					source: function( request, response ) {
						var request_data = {
							term: request.term,
							post_type: $post_type,
							tax: s1,
							min_price: function(){
								return $('.first_limit').text();					        
							},
							max_price: function(){
								return $('.last_limit').text();					        
							},							
						};				        
						$.getJSON(cryptcio_params.ajax_url+'?&action=cryptcio_search', request_data, response);				        
					},
					appendTo: $this.parent(),
					autoFocus: true,
					delay: 500,
					minLength: 3,
					search: function( event, ui ) {
						$this.find('.searchsubmit .fa-search').removeClass('fa-search').addClass('fa-spin fa-refresh');
					},
					response: function( event, ui ) {
						$this.find('.searchsubmit .fa-spin').removeClass('fa-spin fa-refresh').addClass('fa-search');
						$this.parent().toggleClass('s-no-result-found');
						$this.parent().find('.search-no-results').remove();
						$this.parent().append('<div class="search-no-results"><p>'+cryptcio_params.cryptcio_search_no_result+'</p></div>');				
					},
					focus: function() {
						return false;
					},
				})
			.autocomplete( "instance" )._renderItem = function( ul, item ) {
				$this.parent().find('.search-no-results').remove();
				$this.parent().toggleClass('s-result-found').removeClass('s-no-result-found');
				var result =  "<div class='search-content'>" ;
				if(item.imgsrc!=''){
					result += "<div class='search-img'><img src='"+item.imgsrc+"' alt='' /></div>";
				}
				result += "<div class='search-info'>";
				result += "<a href='"+item.link +"'>" + item.label + "</a>";	
				if(item.add_cart!=''){
					result += "<div class='price'>" + item.add_cart + "</div>";	
				}	
				result += "</div>"+ "</div>";
				return $( "<li>" )
				.append( result )
				.appendTo( ul );
			};
			$(this).find( "input[name='s']" ).on('autocompleteselect', function (e, ui) {
				$this.parent().find('.ui-autocomplete').addClass('show');
				if($this.find('input[name="post_type"]').val()!='product'){
					$this.parent().find('.ui-autocomplete').removeClass('show');
				};
			});
		});		
	}	
	function cryptcioGetBlogImgWidth(){
		$('.img-hover').each(function(){
			$(this).width($(this).find('img').width());
		});
	}
	// Option Slick Slider
	function cryptcioOptionSlickSlider() {
		var $status = $('.pagingInfo');
		var $slickElement = $('.slick-counter-slide');
		$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
			//currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
			var i = (currentSlide ? currentSlide : 0) + 1;
			$status.text(i + '/' + slick.slideCount);
		});
		
		//custom function showing current slick slide
		var $numbernext = $('.number-next');
		var $numberprev = $('.number-prev');
		var $slickElement = $('.slick-dot');

		$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
			//currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
			var i = (currentSlide ? currentSlide : 0) + 2;
			$numbernext.text(i + ' / ' + slick.slideCount);
		});
		$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, prevSlide) {
			//currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
			var i = (currentSlide ? currentSlide : 0) + 1;
			$numberprev.text(i + ' / ' + slick.slideCount);
		});
	}

	// Fix Height Gallery
	function cryptcioGalleryContentHeight() {
		$('.figcaption').each(function(){
			var heightPort = $(this).find('.gallery-img').height();
			$(this).find('.gallery_content').css('height', heightPort + 'px' );
		});
	}
	//Coming Soon Date
	function cryptcioComingSoonDate() {
		$('#getting-started').countdown(cryptcio_params.under_end_date).on('update.countdown', function(event) {
			var $this = $(this);
			if (event.elapsed) {
				$this.html(event.strftime(''
					+ '<div class="coming-timer"><span>%D</span><span>'+cryptcio_params.cryptcio_text_day+'</span></div> '
					+ '<div class="coming-timer"><span>%H</span><span>'+cryptcio_params.cryptcio_text_hour+'</span></div>'
					+ '<div class="coming-timer"><span>%M</span><span>'+cryptcio_params.cryptcio_text_min+'</span></div>'
					+ '<div class="coming-timer"><span>%S</span><span>'+cryptcio_params.cryptcio_text_sec+'</span></div>'
					+ ''));
			} else {
				$this.html(event.strftime(''
					+ '<div class="coming-timer"><span>%D</span><span>'+cryptcio_params.cryptcio_text_day+'</span></div> '
					+ '<div class="coming-timer"><span>%H</span><span>'+cryptcio_params.cryptcio_text_hour+'</span></div>'
					+ '<div class="coming-timer"><span>%M</span><span>'+cryptcio_params.cryptcio_text_min+'</span></div>'
					+ '<div class="coming-timer"><span>%S</span><span>'+cryptcio_params.cryptcio_text_sec+'</span></div>'
					+ ''));
			}
		});
	}
	// Check Browser
	function cryptcioCheckBrowser() {
		//Check if Safari
		if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
			$('html').addClass('safari');
		}
		//Check if MAC
		if(navigator.userAgent.indexOf('Mac')>1){
			$('html').addClass('safari');
		}
		// Add class IE
		var ms_ie = false;
		var ua = window.navigator.userAgent;
		var old_ie = ua.indexOf('MSIE ');
		var new_ie = ua.indexOf('Trident/');
		if ((old_ie > -1) || (new_ie > -1)) {
			ms_ie = true;
		}
		if ( ms_ie ) {
			jQuery('body').addClass('ie-11');
		}
		if(document.getElementById("defaultOpen")){
		 // Get the element with id="defaultOpen" and click on it
		 document.getElementById("defaultOpen").click();   
		}
		function is_Rirefox(){
			return /^((?!firefox).)*firefox/i.test(navigator.userAgent);
		}
		if(navigator.userAgent.indexOf('Firefox') > -1) {
			jQuery('body').addClass('firefox');
		}
	}
	// Woocommer
	function woocommerce_add_cart_ajax_message() {
		if ($('.add_to_cart_button').length !== 0 && $('#cart_added_msg_popup').length === 0) {
			var message_div = $('<div>')
			.attr('id', 'cart_added_msg'),
			popup_div = $('<div>')
			.attr('id', 'cart_added_msg_popup')
			.html(message_div)
			.hide();

			$('body').prepend(popup_div);
		}
	}	
	function cryptcioWoocommer() {
		// Redirect On off
		$('#woosearch-search').on('submit', function (e) {
			if( $(this).data('redirect') == 1 ){
				e.preventDefault();    
			}
		});
		if(cryptcio_params.cryptcio_woo_enable == 'yes'){
			//woocommerce
			$('body').bind('added_to_cart', function (response) {
				$('body').trigger('wc_fragments_loaded');
			});    
			//end ajax search

			woocommerce_add_cart_ajax_message();
			//Woocommerce update cart sidebar
			$('body').bind('added_to_cart', function (response) {
				$('body').trigger('wc_fragments_loaded');
				$('ul.products li .added_to_cart').remove();
				var msg = $('#cart_added_msg_popup');
				$('.search-form').each(function(){
					$(this).parent().find('.ui-autocomplete').removeClass('show');			    					
				});
				$('.mini-cart').addClass('active_minicart');
				$('#cart_added_msg').html(cryptcio_params.ajax_cart_added_msg);
				msg.css('margin-left', '-' + $(msg).width() / 2 + 'px').fadeIn();
				window.setTimeout(function () {
					msg.fadeOut();
					$('.mini-cart').removeClass('active_minicart');
				}, 2000);
			});
			
			// tabs
			$("form.cart").on("change", "input.qty", function() {
				if (this.value === "0")
					this.value = "1";

				$(this.form).find("button[data-quantity]").data("quantity", this.value);
			});        
			//product list view mode
			if(cryptcio_params.type_product == 'list-default' || cryptcio_params.type_product == 'grid-default' || cryptcio_params.shop_list != true || cryptcio_params.type_product == ''){
				$('#grid_mode').unbind('click').on('click', function() {
					var $toggle = $('.viewmode-toggle');
					var $parent = $toggle.parent();
					var $products = $parent.find('ul.products');
					$('.product_types').addClass('product-grid').removeClass('product-list');
					$('.product_archives').addClass('product-grid-wrap').removeClass('product-list-wrap');
					$products.find('li').removeClass('col-md-12 col-sm-12');
					$('this').addClass('active');
					$('#list_mode').removeClass('active');
					setTimeout(function() {
						$('.product_types').isotope( 'layout');
					}, 200);
					if (($.cookie && $.cookie('viewmodecookie') == 'list') || !$.cookie) {
						if ($toggle.length) {
							$products.fadeOut(300, function () {
								$products.addClass('grid').removeClass('list').fadeIn(300);
							});
						}
					}
					if ($.cookie)
						$.cookie('viewmodecookie', 'grid', {
							path: '/'
						});
					return false;
				});

				$('#list_mode').unbind('click').on('click', function() {
					var $toggle = $('.viewmode-toggle');
					var $parent = $toggle.parent();
					var $products = $parent.find('ul.products');
					$('.product_types').addClass('product-list').removeClass('product-grid');
					$('.product_archives').addClass('product-list-wrap').removeClass('product-grid-wrap');
					$products.find('li').addClass('col-md-12 col-sm-12');
					$(this).addClass('active');
					$('#grid_mode').removeClass('active');
					setTimeout(function() {
						$('.product_types').isotope( 'layout');
					}, 200);
					if (($.cookie && $.cookie('viewmodecookie') == 'grid') || !$.cookie) {
						if ($toggle.length) {
							$products.fadeOut(300, function () {
								$products.addClass('list').removeClass('grid').fadeIn(300);
							});
						}
					}
					if ($.cookie)
						$.cookie('viewmodecookie', 'list', {
							path: '/'
						});
					return false;
				});

				if ($.cookie && $.cookie('viewmodecookie')) {
					var $toggle = $('.viewmode-toggle');
					if ($toggle.length) {
						var $parent = $toggle.parent();
						if ($parent.find('ul.products').hasClass('grid')) {
							$.cookie('viewmodecookie', 'grid', {
								path: '/'
							});
						} else if ($parent.find('ul.products').hasClass('list')) {
							$.cookie('viewmodecookie', 'list', {
								path: '/'
							});
						} else {
							$parent.find('ul.products').addClass($.cookie('viewmodecookie'));
						}
					}
				}
				if ($.cookie && $.cookie('viewmodecookie') == 'grid') {
					var $toggle = $('.viewmode-toggle');
					var $parent = $toggle.parent();
					var $products = $parent.find('ul.products');
					$('.viewmode-toggle #grid_mode').addClass('active');
					$('.product_types').addClass('product-grid').removeClass('product-list');
					$('.product_archives').addClass('product-grid-wrap').removeClass('product-list-wrap');
					$('.viewmode-toggle #list_mode').removeClass('active');
				}
				if ($.cookie && $.cookie('viewmodecookie') == 'list') {
					var $toggle = $('.viewmode-toggle');
					var $parent = $toggle.parent();
					var $products = $parent.find('ul.products');
					$('.viewmode-toggle #grid_mode').addClass('active');
					$('.product_types').addClass('product-grid').removeClass('product-list');
					$('.product_archives').addClass('product-grid-wrap').removeClass('product-list-wrap');
					$('.viewmode-toggle #list_mode').removeClass('active');
				}
				if(cryptcio_params.type_product == 'grid-default' || cryptcio_params.shop_list != true){
					if ($.cookie && $.cookie('viewmodecookie') == null) {
						var $toggle = $('.viewmode-toggle');
						if ($toggle.length) {
							var $parent = $toggle.parent();
							$parent.find('ul.products').addClass('grid');
							$('.product_types').addClass('product-grid');
							$('.product_archives').addClass('product-grid-wrap');
						}
						$('.viewmode-toggle #grid_mode').addClass('active');
						if ($.cookie)
							$.cookie('viewmodecookie', 'grid', {
								path: '/'
							});
					}
				}  
				if(cryptcio_params.type_product == 'list-default' || cryptcio_params.shop_list != true){
					if ($.cookie && $.cookie('viewmodecookie') == null) {
						var $toggle = $('.viewmode-toggle');
						if ($toggle.length) {
							var $parent = $toggle.parent();
							$parent.find('ul.products').addClass('list');
							$('.product_types').addClass('product-list');
							$('.product_archives').addClass('product-list-wrap');
						}
						$('.viewmode-toggle #list_mode').addClass('active');
						if ($.cookie)
							$.cookie('viewmodecookie', 'list', {
								path: '/'
							});
					}
				}      
			}        
			$( document ).ready( function($){
				if(typeof yith_wcwl_l10n != 'undefined') {
					var update_wishlist_count = function() {
						var data = {
							action: 'update_wishlist_count'
						};
						$.ajax({
							type: 'POST',
							url: yith_wcwl_l10n.ajax_url,
							data: data,
							dataType: 'json',
							beforeSend: function () {

							},
							success   : function (data) {
								$('a.update-wishlist span').html('('+data+')');
							}
						});
					};

					$('body').on( 'added_to_wishlist removed_from_wishlist', update_wishlist_count );
				}
			} );
			//quantily
			$('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<div class="qty-number"><span class="increase-qty plus" onclick="">+</span></div>').prepend('<div class="qty-number"><span class="increase-qty minus" onclick="">-</span></div>');

			// Target quantity inputs on product pages
			$('input.qty:not(.product-quantity input.qty)').each(function () {
				var min = parseFloat($(this).attr('min'));

				if (min && min > 0 && parseFloat($(this).val()) < min) {
					$(this).val(min);
				}
			});

			$(document).off('click', '.plus, .minus').on('click', '.plus, .minus', function () {

				// Get values
				var $qty = $(this).closest('.quantity').find('.qty'),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max')),
				min = parseFloat($qty.attr('min')),
				step = $qty.attr('step');

				// Format values
				if (!currentVal || currentVal === '' || currentVal === 'NaN')
					currentVal = 0;
				if (max === '' || max === 'NaN')
					max = '';
				if (min === '' || min === 'NaN')
					min = 1;
				if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
					step = 1;

				// Change the value
				if ($(this).is('.plus')) {

					if (max && (max === currentVal || currentVal > max)) {
						$qty.val(max);
					} else {
						$qty.val(currentVal + parseFloat(step));
					}

				} else {

					if (min && (min === currentVal || currentVal < min)) {
						$qty.val(min);
					} else if (currentVal > 0) {
						$qty.val(currentVal - parseFloat(step));
					}

				}

				// Trigger change event
				$qty.trigger('change');
			});
			if($('input.qty:not(.product-quantity input.qty)').val() < 10){
				$('input.qty:not(.product-quantity input.qty)').val('0'+$('input.qty:not(.product-quantity input.qty)').val());  
			}
			$('input.qty:not(.product-quantity input.qty)').on('change', function() {
				if($(this).val() < 10 && $(this).val() > 0) {
					$(this).val('0'+$(this).val());
				}
			}); 
			
			// Viewby
			$( '.woocommerce-viewing' ).off( 'change' ).on( 'change', 'select.count', function() {
				$( this ).closest( 'form' ).submit();
			});
		}
		$(document).on( 'added_to_wishlist removed_from_wishlist', function(){
			var counter = $('.ajax-wishlist');
			$.ajax({
				url: yith_wcwl_l10n.ajax_url,
				data: {
					action: 'yith_wcwl_update_wishlist_count'
				},
				dataType: 'json',
				success: function( data ){
					counter.html( data.count );
				},
				beforeSend: function(){
					counter.block();
				},
				complete: function(){
					counter.unblock();
				}
			})
		} );
		$('.yith-woocompare-widget .clear-all').on('click', function(){
			if($('.compare_product .add_to_compare').hasClass('added')){
				$('.compare_product .add_to_compare').addClass('removed');
			}else{
				$('.compare_product .add_to_compare').removeClass('removed');
			}
		});
	}

	function loadMore(){
		var $j = jQuery.noConflict();
		var $container = $j('.load-item');
		var i = 1;
		var paged = $('.load_more_button span').data('paged');
		var page = paged ? paged + 1 : 2;
		$j('.load_more_button a').off('click tap').on('click tap', function(e)  {
			e.preventDefault();
			var el = $(this);
			$j('.load_more_button a').append('<i class="fa fa-refresh fa-spin"></i>');
			el.addClass('hide-loadmore');
			var link = $j(this).attr('href');
			var $content = '.load-item';
			var $anchor = '.load_more_button a';
			var $next_href = $j($anchor).attr('href');
			$j.get(link+'', function(data){
				$j('.load-more').find('.fa-spin').remove();
				el.removeClass('hide-loadmore');
				var $new_content = $j($content, data).wrapInner('').html();
				$next_href = $j($anchor, data).attr('href');
				$container.append( $j( $new_content) ).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
				gallerySlider(page);

				setTimeout(function() {
					$j('.load-item').isotope( 'layout');
				}, 400);

				if($j('.load_more_button span').attr('data-totalpage') > i) {
					$j('.load_more_button a').attr('href', $next_href); // Change the next URL
				} else {
					$j('.load_more_button').remove();
				}

			});
			i++;
		});
	}
	
	// Product Load More
	var Product = {
		_initialized :false,
		init: function(){
			if(this._initialized)
				return false;
			this._initialized = true;
			this.isotopeChangeLayout();
		},
		isotopeChangeLayout : function(){

			var button = $('[data-isotope-container]');

			button.each(function(){

				var $this = $(this),

				container = $($this.data('isotope-container')),

				layout = $this.data('isotope-layout');

				$this.on('click',function(){

					$(this).addClass('black_button_active').siblings().removeClass('black_button_active').addClass('black_hover');

					if(layout == "list"){

						container.children("[class*='isotope_item']").addClass('list_view_type');

					}

					else{

						container.children("[class*='isotope_item']").removeClass('list_view_type');

					}

					container.isotope('layout');

					container.find('.tooltip_container').tooltip('.tooltip').tooltip('.tooltip');

				});

			});

		},

	};
	
	function gallerySlider(page) {
		if(cryptcio_params.cryptcio_slick_enable == 'yes'){
			$('.single-post .blog-gallery').slick({         
				dots: true,
				rtl:$rtl,
				arrows: false,
				infinite: false,
				autoplay: false,
			});
			$('.item-page'+page).each( function() {
				if($(this).find('.blog-img').hasClass('blog-gallery')) {
					var id = $(this).find('.blog-img').attr('id');
					$('#'+id).slick({         
						dots: true,
						rtl:$rtl,
						arrows: false,
						infinite: false,
						autoplay: false,
					});
				}
			});
		}
	}
	// Blog Slick Slider
	function cryptcioBlogSlickSlider() {
		
		$('.blog-gallery-zones').slick({         
			dots: false,
			arrows: true,
			rtl:$rtl,
			nextArrow: '<button class="btn-next"><i class="fa fa-angle-right"></i></button>',
			prevArrow: '<button class="btn-prev"><i class="fa fa-angle-left"></i></button>',
			infinite: true,
			autoplay: false,
		});

		$('.blog-grid-5').slick({
			dots: true,
			rtl:$rtl,
			arrows: false,
			infinite: false,
			autoplay: false,
			autoplaySpeed: 2000,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 2,
				}
			},
			{
				breakpoint: 481,
				settings: {
					slidesToShow: 1,
				}
			}

			]
		});
	}
	// Slick Slider
	function cryptcioSlickSlider() {
		if(cryptcio_params.cryptcio_woo_enable == 'yes'){
			$('.thumbs_list img').on('click', function(e){
				$('.woocommerce-product-gallery__image').trigger('zoom.destroy'); // remove zoom
				$('.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image').zoom(); // add zoom
			});
			$('.woocommerce-product-gallery__wrapper').on('afterChange', function(event, slick, currentSlide, nextSlide){
				$('.slick-slide').removeClass('flex-active-slide');
				$("[data-slick-index='"+currentSlide+"']").addClass('flex-active-slide');      
			});
			if($('.content-primary').hasClass('single_product_3')){
				$('.woocommerce-product-gallery__wrapper').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					fade: true,
					rtl:$rtl,
					dots: true,
				});
			}else if($('.content-primary').hasClass('single_product_1') || $('.content-primary').hasClass('single_product_2') || $('.content-primary').hasClass('single_product_5')){ 
				$('.woocommerce-product-gallery__wrapper').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					fade: true,
					rtl:$rtl,
					asNavFor: '.thumbs_list',
				});                         
			}

			$('.attribute-swatch > div').on('click', function(){
				$('.woocommerce-product-gallery__wrapper').slick('slickGoTo', 0)
			});
			if($('.single_product_1').hasClass('main-sidebar') || $('.content-primary').hasClass('single_product_2') || $('.content-primary').hasClass('single_product_5') || $('.main-sidebar').hasClass('single_product_2')){
				var toshow = 4;
				var toscroll = 1;
			}else{
				var toshow = 4;
				var toscroll = 1;
			}
			if($('.content-primary').hasClass('single_product_2') || $('.main-sidebar').hasClass('single_product_2')){
				var vertical = true;
				var nextArrow = '<button class="btn-next"><i class="fa fa-angle-up" aria-hidden="true"></i></button>';
				var prevArrow = '<button class="btn-prev"><i class="fa fa-angle-down" aria-hidden="true"></i></button>';
			}else{
				var vertical = false;
				var nextArrow = '<button class="btn-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>';
				var prevArrow = '<button class="btn-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>';
			}
			$('.thumbs_list').slick({
				nextArrow: nextArrow,
				prevArrow: prevArrow,
				slidesToShow: toshow,
				slidesToScroll: toscroll,
				asNavFor: '.woocommerce-product-gallery__wrapper',
				centerMode: false,
				focusOnSelect: true,
				// rtl:$rtl,
				dots: false,
				arrows: true,
				vertical: vertical,
				speed: 300,
				responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 641,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 481,
					settings: {
						slidesToShow: 3,
						vertical: false,
						slidesToScroll: 1,
					}
				}
				]
			}); 
			$('.cate-archive').slick({
				nextArrow: '<button class="btn-next"><i class="fa fa-angle-right"></i></button>',
				prevArrow: '<button class="btn-prev"><i class="fa fa-angle-left"></i></button>',
				slidesToShow: cryptcio_params.cryptcio_number_cate,
				slidesToScroll: 1,
				rtl:$rtl,
				dots: false,
				arrows: true,
				infinite: true,
				speed: 300,
				responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1
					}
				}
				]
			});
		}
		$('.instagram-slider').slick({
			centerMode: true,
			rtl:$rtl,
			dots: false,
			arrows: false,
			centerPadding: '220px',
			slidesToShow: 3,
			responsive: [
			{
				breakpoint: 1200,
				settings: {
					centerPadding: '250px',
					centerMode: true,
					slidesToShow: 1
				}
			},
			{
				breakpoint: 768,
				settings: {
					centerPadding: '100px',
					centerMode: true,
					slidesToShow: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
					centerPadding: '0px',
					centerMode: true,
					slidesToShow: 1
				}
			}
			]
		});
		$('.instagram-slider-3').slick({
			centerMode: true,
			rtl:$rtl,
			dots: false,
			arrows: false,
			centerPadding: '238px',
			slidesToShow: 3,
			responsive: [
			{
				breakpoint: 1920,
				settings: {
					centerPadding: '170px',
					centerMode: true,
					slidesToShow: 3
				}
			},
			{
				breakpoint: 1200,
				settings: {
					centerPadding: '200px',
					centerMode: true,
					slidesToShow: 1
				}
			},
			{
				breakpoint: 768,
				settings: {
					centerPadding: '100px',
					centerMode: true,
					slidesToShow: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
					centerPadding: '0px',
					centerMode: true,
					slidesToShow: 1
				}
			}
			]
		});
		if(cryptcio_params.cryptcio_coming_subcribe_text){
			if(cryptcio_params.cryptcio_coming_subcribe_text.trim() && cryptcio_params.cryptcio_coming_subcribe_text.length > 0){
				$('.page-coming-soon .mc4wp-form input[type="submit"]').attr("value", cryptcio_params.cryptcio_coming_subcribe_text);
			}
		}  
	}
	//Filter Isotop Window Load
	function cryptcioFilterIsotopLoad() {
		var $grid = $('.isotope');
		var container = $('.isotope').isotope({
			itemSelector: '.item',
			layoutMode: 'fitRows',
			getSortData: {
				name: '.item'
			}
		});
		
		$('.btn-filter').each( function( i, buttonGroup ) {
			var filterLoadValue = $(this).find('.active').attr('data-filter');
			container.isotope({ filter: filterLoadValue });
		});
		
		if($('.grid-isotope').hasClass('blog-masonry')){
			var layoutMode = 'masonry';
		}else if($('.grid-isotope').hasClass('blog-packery')){
			var layoutMode = 'packery';
		}else{
			var layoutMode = 'fitRows';
		}
		$('.grid-isotope').isotope({
			itemSelector: '.grid-item',
			layoutMode: layoutMode,
			getSortData: {
				name: '.grid-item',
			}
		});

		if($('.isotope').hasClass('layout_masonry')){
			var layoutMode = 'masonry';
		}else if($('.isotope').hasClass('layout_packery')){
			var layoutMode = 'packery';
		}else{
			var layoutMode = 'fitRows';
		}
		$('.gallery-entries-wrap.isotope').isotope({
			itemSelector: '.item',
			layoutMode: layoutMode,
			getSortData: {
				name: '.item'
			}
		});
		var container = $('.isotope.layout_masonry').isotope({
			itemSelector: '.item',
			layoutMode: 'masonry',
			getSortData: {
				name: '.item'
			}
		});
		
		var container = $('.product-category.layout-packery').isotope({
			itemSelector: '.item',
			layoutMode: 'packery',
			getSortData: {
				name: '.item'
			}
		});
		
		var container = $('.product_packery .isotope').isotope({
			itemSelector: '.item',
			layoutMode: 'packery',
			getSortData: {
				name: '.item'
			}
		});
		
		$('.instagram_parkery').isotope({
			layoutMode: 'packery',
			itemSelector: '.instagram-img',
			percentPosition: true,
			getSortData: {
				name: '.instagram-img'
			},
			transitionDuration:"0.7s",
			masonry : {
				columnWidth:".instagram-img"
			}
		});
		
		$('.btn-filter').on( 'click', '.button', function() {
			var filterValue = $(this).attr('data-filter');
			container.isotope({ filter: filterValue });
		});
		$('.btn-filter').each( function( i, buttonGroup ) {
			var buttonGroup = $(buttonGroup);
			buttonGroup.on( 'click', '.button', function() {
				buttonGroup.find('.active').removeClass('active');
				$(this).addClass('active');
			});
		});
		
		var container_project = $('.project-entries-wrap').isotope({
            itemSelector: '.grid-item',
            layoutMode: 'packery',
            getSortData: {
                name: '.grid-item'
            }
        });
		$('.btn-filter-project').each( function( i, buttonProjectGroup ) {
            var filterProjectLoadValue = $(this).find('.active').attr('data-filter');
            container_project.isotope({ filter: filterProjectLoadValue });
        });
		$('.btn-filter-project').on( 'click', '.button-project', function() {
            var filterProjectValue = $(this).attr('data-filter');
            container_project.isotope({ filter: filterProjectValue });
        });
		$('.btn-filter-project').each( function( i, buttonProjectGroup ) {
            var buttonProjectGroup = $(buttonProjectGroup);
            buttonProjectGroup.on( 'click', '.button-project', function() {
                buttonProjectGroup.find('.active').removeClass('active');
                $(this).addClass('active');
            });
        });
	}
	// Srcoll Top
	function cryptcioScrollTop() {
		if ($('.scroll-to-top').length) {
			$(window).scroll(function () {
				if ($(this).scrollTop() > $('#page:not(.fixed-header) .site-header').height() +40) {
					if($('header').hasClass('header-bottom')){
						$('.scroll-to-top').css({bottom: "90px"});
					}else{
						$('.scroll-to-top').css({bottom: "25px"});
					}

				} else {
					$('.scroll-to-top').css({bottom: "-100px"});
				}
			});

			$('.scroll-to-top').on('click', function() {
				$('html, body').animate({scrollTop: '0px'}, 800);
				return false;
			});
		}
		if ($('.up-top').length) {
			$('.up-top').on('click', function() {
				$('html, body').animate({scrollTop: '0px'}, 800);
				return false;
			});
		}
	}
	//Up To Top
	function cryptcioUpToTop() {
		$('.to-top').on('click', function() {
			$('html, body').animate({scrollTop: '0px'}, 800);
			return false;
		});
	}
	// Sticky Menu
	function cryptcioStickyMenu() {
		var  mn = $(".site-header");
		var	mns = "is-sticky";
		var	hdr = $('header').height();
		$(window).scroll(function() {
			if( $(this).scrollTop() > hdr ){
				if(cryptcio_params.header_sticky_mobile != 1){
					if($(window).width() > 991){
						if(cryptcio_params.header_sticky == 1){
							mn.addClass(mns);
						}
					}
				}else if(cryptcio_params.header_sticky != 1 && $('.site').hasClass('fixed-header')){
					mn.addClass('no-sticky');
				}else{
					if(cryptcio_params.header_sticky == 1){
						mn.addClass(mns);
					}
				}
			} else {
				mn.removeClass(mns);
				mn.removeClass('no-sticky');
			}
		});
	}
	// Funcition Css
	function cryptcioCss(){
		// Page Teacher
		$('.teacher_sort .member-info').each(function(i, obj){
			var style2 = $(this).data('cryptcio_info_bg')!=''?$(this).data('cryptcio_info_bg'):'#34b3fb';
			var final_style = {};

			if(style2!=''){
				final_style['background'] = style2;
			}
			if(final_style !=''){
				$(this).css(final_style);
			}
		});   

		var color = $('.ultsl-stop').css("color");
		$('.ultsl-stop').css('background',color);
		
		var h = $(window).height();
		var h404 = h + 83;
		$('.text-left.coming-soon-container').css('height', h + 'px');
		$('.page-404').css('height', h404 + 'px');
		
		$('body').on('added_to_cart', function () {
			$("a.added_to_cart").remove();
		});
		
		$('#commentform .form-submit .submit').addClass("btn btn-black");
	}
	// Funcition Click
	function cryptcioClick(){
		// filter items on button click Gallery
		var $gridGallery = $('.isotope');
		$('.button-group').on( 'click', 'button', function() {
			var filterValueGallery = $(this).attr('data-filter');
			$gridGallery.isotope({ filter: filterValueGallery });
			$('.button-group button').removeClass('is-checked');
			$(this).addClass('is-checked');
		}); 
		
		// filter items on button click Blog
		var $grid = $('.grid-isotope');
		$('.button-group').on( 'click', 'button', function() {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({ filter: filterValue });
			$('.button-group button').removeClass('is-checked');
			$(this).addClass('is-checked');
		}); 	
		
		$('.cate-menu .title-cate').on('click', function() {
			$(this).toggleClass('active');
			$('.header-menu .cate-menu .product-categories').slideToggle();
		});
		
		$("a.cart_label").on('click', function(event){
			event.preventDefault();
		}); 
		
		$(".thumbs_list a.view-img").on('click', function(event){
			event.preventDefault();
		});
		
		$('.btn_togglefilter').on('click', function(e){
			toggleFilter(this);
		});    
		$('.btn-open').on('click', function(e){
			toggleFilter(this);
		});
		$('.btn-search').on('click', function(e){
			toggleFilter(this);
		});
		$('.cart_label').on('click', function(e){
			toggleFilter(this);
		});
		$('.current-open').on('click', function(e){
			toggleFilter(this);
		});
		$(".select-cate").on('click',function(){
			$(".category-list").toggleClass("active");
		}); 
	}
	// Submenu hover left
	function cryptcioFixSubMenu(){
		$('.mega-menu > li:not(.megamenu)').mouseover(function(){
			var wapoMainWindowWidth = $(window).width();
			// checks if third level menu exist
			var subMenuExist = $(this).children('.sub-menu').length;
			if( subMenuExist > 0){
				var subMenuWidth = $(this).children('.sub-menu').width();
				var subMenuOffset = $(this).children('.sub-menu').parent().offset().left + subMenuWidth;
				// if sub menu is off screen, give new position
				if((subMenuOffset + subMenuWidth) > wapoMainWindowWidth){
					var newSubMenuPosition = subMenuWidth;
					$(this).addClass('left_side_menu');
				}else{
					var newSubMenuPosition = subMenuWidth;
					$(this).removeClass('left_side_menu');
				}
			}
		});
	}
	// Search, cart click body remove
	function cryptcioRemoveActive(){
		if($(window).width() < 992){
			$(".mini-cart .cart_label").on('click',function(e) {
				e.stopPropagation();
			});
			$(".search-block-top > .btn-search").on('click',function(e) {
				e.stopPropagation();
			});
			$('body').on('click', function(e){
				if (!$(e.target).is('.content-filter, .content-filter *')) {
					$(".content-filter").removeClass('active');
				}
			});
		}
	}
	// Fillter Isotop
	function cryptcioFillterIsotop(){
		var filterValue = $('.active_cat').attr('data-filter');
		var container = $('.isotope').isotope({
			itemSelector: '.item',
			filter: filterValue,
			layoutMode: 'fitRows',
			getSortData: {
				name: '.item'
			}
		});
		$('.btn-filter').on( 'click', '.button', function() {
			var filterValue = $(this).attr('data-filter');
			container.isotope({ filter: filterValue });
		});
		$('.btn-filter').each( function( i, buttonGroup ) {
			var buttonGroup = $(buttonGroup);
			buttonGroup.on( 'click', '.button', function() {
				buttonGroup.find('.active').removeClass('active');
				$(this).addClass('active');
			});
		});
	}
	function cryptcio_changeToggleAction(){
		$('.box-accordion7').each(function(){
			var $this = $(this);
			$this.find('.vc_toggle').first().addClass('vc_toggle_active');
			$(this).find('.vc_toggle').on('click', function(){
				$this.find('.vc_toggle').removeClass('vc_toggle_active');
				$this.find('.vc_toggle_content').hide();
				if($(this).hasClass('vc_toggle_active')){
					$(this).removeClass('vc_toggle_active');
					$(this).find('.vc_toggle_content').hide("slow");						
				}else{
					$(this).addClass('vc_toggle_active');
					$(this).find('.vc_toggle_content').show();
				}
			});
		});
	}
	// Fix Height Content
	function cryptcioHeightContent(){
		// Fix Height Blog
		var wdw = $(window).width();
		if(wdw > 767){
			var heightBlog = $('.blog-img').height();
			var heightBlog2 = $('.blog-list-2 .blog-img').height();
			var heightBlogSticky = $('.blog-img-sticky').height(); 
			$('.blog-list-2 .blog-post-info ').css('height', heightBlog2 + 'px'); 
			$('.sticky-post-2').css('height', heightBlogSticky + 'px'); 	
		}
		if(wdw > 501){
			$('.blog-packery-2 .grid-item').each(function(){
				$(this).find('.blog-post-info').css('height', $(this).find('.blog-img img').height() + 'px'); 
			});
		}	
		// Fix Height Instagram
		var heightIns = $('.instagram-type1').height();
		$('.instagram-type1 .title-insta').css('height', heightIns + 120 + 'px' );
		$('.vc_row.triangle_bg').each(function(i, obj){
			var style = $(this).data('cryptcio-triangle-background');
			var style2 = $(this).data('cryptcio-triangle-width')!=''?$(this).data('cryptcio-triangle-width'):'100%';
			var style3 = $(this).data('cryptcio-triangle-pos')!=''?$(this).data('cryptcio-triangle-pos'):'';
			var final_style = {};
			$.each(style3, function(index, val) {   
				final_style[index] = val;   			
			});	
			if(style !='' && style2!=''){
				final_style['background'] = 'linear-gradient('+style+')';
				final_style['width'] = 	style2;
			}
			if(final_style !=''){
				$(this).find('.triangle_bg_abs').css(final_style);
			}
		});		
		$('.instagram-type6 .instagram-img').height($('.instagram-type6 .instagram-img').width());
		$('.instagram-type7 .instagram-img').each(function(){
			$(this).height($(this).width());
		});
		var heightHeader = $('.site-header').height();
		var heightFooter = $('footer').height();
		if($(window).width() < 992){
			if($('.site-header').hasClass('header-bottom')){
				$('footer').css('margin-bottom', heightHeader + 'px');
			}
		}
		if($(window).width() > 767){
			if($('#page').hasClass('footer-fixed')){
				$('#page').css('margin-bottom', heightFooter + 'px');
			}
		}
		
		// Fix Height menu vertical
		var height = $(window).height();
		var width = $(window).width();
		var heightNav = $('.header-sidebar').height();
		var heightNavMenu = $('.mega-menu').height();	
		if( heightNav > height ){
			$('.header-ver').addClass('header-scroll');
		}
		if(width < 992){
			if( heightNavMenu > height ){
				$('.header-center').addClass('header-scroll');
			}
		}
		
		var heightProject = $('.project-entries-wrap .image_size .project-content').height();
		if(wdw > 480){
			$('.project-entries-wrap .title-content').css('height', heightProject + 'px'); 
		}
	}
	// Menu
	function cryptcioMenu(){
		$(".mega-menu .caret-submenu").on('click', function(e){
			$(this).toggleClass('active');
			$(this).siblings('.sub-menu').toggle(300);
		});
		if($('.menu-item').hasClass('menu_open_box')){
			$('body').addClass('fancybox-on');
		}
		$('ul.mega-menu > li.megamenu .menu-bottom').hide();
		$('ul.mega-menu > li.megamenu .menu-bottom').each(function(){
			var className = $(this).parent().parent().attr('id');
			if($(this).hasClass(className)){
				$(this).show();
			}
		});
		
		//Menu double
		if($(window).width() > 991){
			var item = $('.mega-menu').children('li').length,
			half = Math.round(item / 2),
			mid = $('.mega-menu > li:nth-child(' + half + ')'),
			logo = $('.kad-header-logo'),
			menu = $('.kad-header-menu');
			mid.after(logo);
			menu.css('width', '100%');
		}  	
		//Add class category
		$('.widget_categories ul').each(function(){
			if($(this).hasClass('children')) {
				$(this).parent().addClass('cat-item-parent');
			} 
		});	
		// Menu Category Sidebar  
		$("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > a");
		var $p = $(".widget_product_categories ul.product-categories > li p");
		$(".widget_product_categories ul.product-categories > li:not(.current-cat):not(.current-cat-parent) p").append('<span><i class="fa fa-angle-right"></i></span>');
		$(".widget_product_categories ul.product-categories > li.current-cat p").append('<span><i class="fa fa-angle-down"></i></span>');
		$(".widget_product_categories ul.product-categories > li.current-cat-parent p").append('<span><i class="fa fa-angle-down"></i></span>');
		$(".widget_product_categories ul.product-categories > li:not(.current-cat):not(.current-cat-parent) > ul").hide();

		$(".widget_product_categories ul.product-categories > li").each(function () {
			if ($(this).find("ul > li").length == 0) {
				$(this).find('p').remove();
			}

		});

		$p.on('click', function() {
			var $accordion = $(this).nextAll('ul');

			if ($accordion.is(':hidden') === true) {

				$(".widget_product_categories ul.product-categories > li > ul").slideUp();
				$accordion.slideDown();

				$p.find('span').remove();
				$p.append('<span><i class="fa fa-angle-right"></i></span>');
				$(this).find('span').remove();
				$(this).append('<span><i class="fa fa-angle-down"></i></span>');
			}
			else {
				$accordion.slideUp();
				$(this).find('span').remove();
				$(this).append('<span><i class="fa fa-angle-right"></i></span>');
			}
		});
		
		// Menu Lever 2
		$("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > ul > li > a");
		var $pp = $(".widget_product_categories ul.product-categories > li > ul > li p");
		$(".widget_product_categories ul.product-categories > li >ul >li > ul").hide();
		$(".widget_product_categories ul.product-categories > li > ul > li p").append('<span><i class="fa fa-angle-right"></i></span>');

		$(".widget_product_categories ul.product-categories > li > ul > li").each(function () {
			if ($(this).find("ul > li").length == 0) {
				$(this).find('p').remove();
			}
		});

		$pp.on('click', function() {
			var $accordions = $(this).nextAll('ul');

			if ($accordions.is(':hidden') === true) {

				$(".widget_product_categories ul.product-categories > li > ul > li > ul").slideUp();
				$accordions.slideDown();

				$pp.find('span').remove();
				$pp.append('<span><i class="fa fa-angle-right"></i></span>');
				$(this).find('span').remove();
				$(this).append('<span><i class="fa fa-angle-down"></i></span>');
			}
			else {
				$accordions.slideUp();
				$(this).find('span').remove();
				$(this).append('<span><i class="fa fa-angle-right"></i></span>');
			}
		});
		
		// Menu Lever 3
		$("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > ul > li > ul > li > a");
		var $ppp = $(".widget_product_categories ul.product-categories > li > ul > li > ul > li p");
		$(".widget_product_categories ul.product-categories > li > ul > li > ul > li > ul").hide();
		$(".widget_product_categories ul.product-categories > li > ul > li > ul > li p").append('<span><i class="fa fa-angle-right"></i></span>');
		
		$(".widget_product_categories ul.product-categories > li > ul > li > ul > li").each(function () {
			if ($(this).find("ul > li").length == 0) {
				$(this).find('p').remove();
			}
		});
		
		$ppp.on('click', function() {
			var $accordions = $(this).nextAll('ul');

			if ($accordions.is(':hidden') === true) {

				$(".widget_product_categories ul.product-categories > li > ul > li > ul > li > ul").slideUp();
				$accordions.slideDown();

				$ppp.find('span').remove();
				$ppp.append('<span><i class="fa fa-angle-right"></i></span>');
				$(this).find('span').remove();
				$(this).append('<span><i class="fa fa-angle-down"></i></span>');
			}
			else {
				$accordions.slideUp();
				$(this).find('span').remove();
				$(this).append('<span><i class="fa fa-angle-right"></i></span>');
			}
		});
		// Categories Blog Sidebar
		$("<p></p>").insertAfter(".widget_categories > ul > li.cat-item-parent > a");
		var $p = $(".widget_categories > ul > li.cat-item-parent > p");
		$(".widget_categories > ul > li.cat-item-parent > p").append('<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>');
		$(".widget_categories > ul > li.cat-item-parent > p").on('click', function(){
			$(".widget_categories > ul > li.cat-item-parent > p").removeClass('btn-close');
			$(".widget_categories > ul > li.cat-item-parent > ul").toggleClass('opening');
			$(this).addClass('btn-close');
		});
		
		// Vertical Menu Search
		$(".search_button").on('click', function(){
			$('.search-holder .searchform_wrap').addClass("opened");
			$('html').addClass("search_opened");
			$('.overlay').removeClass('overlay-menu');
		});
		$('.close_search_form').on('click', function(f){
			f.preventDefault();
			$('.search-holder .searchform_wrap').removeClass("opened");
			$('html').removeClass("search_opened");
		});
		$('.overlay').on('click', function(f){
			f.preventDefault();
			$('.search-holder .searchform_wrap').removeClass("opened");
			$('html').removeClass("search_opened");
			$('.overlay').removeClass('overlay-menu');
		});
		
		// Vertical Menu Search
		$(".open-menu").on('click', function(){
			$('html').addClass("nav-open");
			$('.overlay').removeClass('overlay-menu');
		});
		$(".header-left .open-menu").on('click', function(){
			$('html').addClass("nav-open nav-open-left");
		});	
		$('.close-menu').on('click', function(f){
			f.preventDefault();
			$('html').removeClass("nav-open");
			$('html').removeClass("nav-open-left");
		});
		$('.overlay').on('click', function(f){
			f.preventDefault();
			$('html').removeClass("nav-open");
			$('html').removeClass("nav-open-left");
		});

		// Vertical Menu
		var $bdy = $('html');
		if($('.site-header').hasClass('header-v3')) {
			$('html').addClass('page-overlay');
		}
		$('.open-menu-mobile').on('click',function(e){
			$('.overlay').addClass('overlay-menu');
			if($bdy.hasClass('openmenu')) {
				jsAnimateMenu2('close');
			} else {
				jsAnimateMenu2('open');
				if($('.site-header').hasClass('header-v3')) {
					$('html').addClass('header-vertical');
				}
			}
		});
		$('.close-menu-mobile').on('click',function(e){
			if($bdy.hasClass('openmenu')) {
				jsAnimateMenu2('close');
				if($('.site-header').hasClass('header-v3')) {
					$('html').removeClass('header-vertical');
				}
			} else {
				jsAnimateMenu2('open');
			}
		});
		
		$('a[href$="#"]').on('click', function(e){
			e.preventDefault();
		});
		
		$('.overlay').on('click', function(){
			if($('html').hasClass('openmenu')){
				$('html').removeClass('openmenu');
				if($('.site-header').hasClass('header-v3')) {
					$('html').removeClass('header-vertical');
				}
			}
		});
	}
	//Tooltip
	function cryptcioTooltip(){
		$('[data-toggle="tooltip"]').tooltip();
	}
	// Preloader
	function cryptcioPreloader(){
		$('.preloader').fadeOut(500,function(){$(this).remove();});
	}
	// FancyBox
	function cryptcioFancyBox(){
		$('.menu_open_box > a').fancybox({});
		$('img').on('hover', function(e){
			$(this).data("title", $(this).attr("title")).removeAttr("title");
		});
		$('.iframe_fancybox').fancybox({
			maxWidth    : 800,
			maxHeight   : 600,
			fitToView   : false,
			width       : '70%',
			height      : '70%',
			autoSize    : false,
			closeClick  : false,
			openEffect  : 'elastic',
			closeEffect : 'none'
		});
		// Choose what buttons to display by default
		$.fancybox.defaults.buttons = [
		'slideShow',
		'fullScreen',
		'thumbs',
		'close'
		];
		$('[data-fancybox]').fancybox({
			preload : "auto",
			thumbs : {
				autoStart : true
			}
		});
		
		
		if(cryptcio_params.cryptcio_woo_enable == 'yes'){	
			$(".fancybox-zoomcontainer").fancybox({
				helpers : {
					title : {
						type : 'inside'
					},
					buttons : {},
					thumbs : {
						width : 50,
						height : 50
					}
				},
				afterShow: function() {
					$('.zoomContainer').remove();
					$('img.fancybox-image').elevateZoom({ 
						zoomType: "inner",
						cursor: "crosshair",
						zoomWindowFadeIn: 500,
						zoomWindowFadeOut: 750
					});
				},
				afterClose: function() {
					$('.zoomContainer').remove();
					$('img.zoom').elevateZoom({ 
						zoomType: "inner",
						cursor: "crosshair",
						zoomWindowFadeIn: 500,
						zoomWindowFadeOut: 750
					});		        
				}
			});		
		}
	} 
	//Validate Form
	function cryptcioValidateForm(){
		if(cryptcio_params.cryptcio_valid_form == 'yes'){
			$('#commentform').validate();
		}
	}	
	//Animation
	function cryptcioAnimation(){
		if(cryptcio_params.cryptcio_animation == 'yes'){
			$('.animated').appear(function() {
				var item = $(this);
				var animation = item.data('animation');
				if ( !item.hasClass('visible') ) {
					var animationDelay = item.data('animation-delay');
					if ( animationDelay ) {
						setTimeout(function(){
							item.addClass( animation + " visible" );
						}, animationDelay);
					} else {
						item.addClass( animation + " visible" );
					}
				}
			});
		}
	}	
	//One Page
	function cryptcioOnePage(){
		$('.main-navigation ul.mega-menu > li > a[href*="#"]:not([href="#"]), .site-header .mega-menu .sub-menu li a[href*="#"]:not([href="#"]), .widget_nav_menu .menu li a[href*="#"]:not([href="#"])').on('click', function(){
			$('.main-navigation ul.mega-menu > li > a[href*="#"]:not([href="#"]), .site-header .mega-menu .sub-menu li a[href*="#"]:not([href="#"]), .widget_nav_menu .menu li a[href*="#"]:not([href="#"])').removeClass('active');
			$(this).addClass('active');
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
				|| location.hostname == this.hostname){
				var target = $(this.hash),           
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']'); 
			if (target.length){
				$('html,body').animate({
					scrollTop: target.offset().top - 90 
				}, 500);
				return false;
			}
		}
	});  
	} 	
	// Fix Height Content
	function cryptcioHeightContentResize() {
		var h = $(window).height();
		$('.page-404').css('height', h + 'px');
		var heightHeader = $('.site-header').height();
		var heightFooter = $('footer').height();
		var wdw = $(window).width();
		if(wdw > 767){
			var heightBlog = $('.blog-img').height();
			var heightBlog2 = $('.blog-list-2 .blog-img').height();
			var heightBlogSticky = $('.blog-img-sticky').height();	
			$('.blog-list-2 .blog-post-info ').css('height', heightBlog2 + 'px');
			$('.sticky-post-2').css('height', heightBlogSticky + 'px'); 	
		}
		if(wdw > 501){
			$('.blog-packery-2 .grid-item').each(function(){
				$(this).find('.blog-post-info').css('height', $(this).find('.blog-img img').height() + 'px'); 
			});
		}
		if($(window).width() < 992){
			if($('.site-header').hasClass('header-bottom')){
				$('footer').css('margin-bottom', heightHeader + 'px');
			}
		}
		if($(window).width() > 767){
			if($('#page').hasClass('footer-fixed')){
				$('#page').css('margin-bottom', heightFooter + 'px');
			}
		}
		var heightProject = $('.project-entries-wrap .image_size .project-content').height();
		if(wdw > 480){
			$('.project-entries-wrap .title-content').css('height', heightProject + 'px'); 
		}
		//Menu double
		if($(window).width() > 991){
			var item = $('.mega-menu').children('li').length,
			half = Math.round(item / 2),
			mid = $('.mega-menu>li:nth-child(' + half + ')'),
			logo = $('.kad-header-logo'),
			menu = $('.kad-header-menu');
			mid.after(logo);
			menu.css('width', '100%');
		}  
		// Instagram fix height
		var heightIns = $('.instagram-type1').height();
		$('.instagram-type1 .title-insta').css('height', heightIns + 120 + 'px' );
		$('.instagram-type6 .instagram-img').height($('.instagram-type6 .instagram-img').width());
		$('.instagram-type7 .instagram-img').each(function(){
			$(this).height($(this).width());
		});
		
		// Fix height header vertical
		var height = $(window).height();
		var width = $(window).width();
		var heightNav = $('.header-sidebar').height();
		var heightNavMenu = $('.mega-menu').height();
		
		if( heightNav > height ){
			$('.header-ver').addClass('header-scroll');
		}
		if(width < 992){
			if( heightNavMenu > height ){
				$('.header-center').addClass('header-scroll');
			}
		}
		var h = $(window).height();
		$('.text-left.coming-soon-container').css('height', h + 'px');   
		// Fix Height Category Menu Home 1
		var heightSliderHomeResize = $('.slider-home .rev_slider_wrapper').height();
		if($(window).width() > 991){
			$('.wpb_text_column .product-categories').css('height', heightSliderHomeResize + 'px'); 	
		}
	}

	// Sticky Sidebar For Single Product Layout 4
	function cryptcioStickySidebar() {
		if ( $('.single_product_4 .info').length > 0 ) {
			$('.single_product_4 .info').stick_in_parent({offset_top: 100});
		}
	}
	function cryptcio_extract_data_style(){
		var $item = $('.mega-menu .menu-item');
		$item.each(function(){
			// if ($(this).attr('ch-target')) {
				var target = $(this).data("ch-target"); 
				var style_arg = $(this).data("ch-stylesheet");	
		    	var styles = {};
				$.each(style_arg, function(index, val) {   
					styles[index] = val;   			
				});		
			    $(target).css(styles);
			// }
		});	    	
		
	}	
	/**
	 * DOMready event.
	 */
	 $( document ).ready( function() {
		// Fix Height Category Menu Home 1
		var heightSliderHome = $('.slider-home .rev_slider_wrapper').height();
		if($(window).width() > 991){
			$('.wpb_text_column .product-categories').css('height', heightSliderHome + 'px'); 	
		}
		cryptcio_changeToggleAction();
		cryptcioOptionSlickSlider();
		cryptcioGalleryContentHeight();
		cryptcioCheckBrowser();
		cryptcioWoocommer();
		if(cryptcio_params.cryptcio_slick_enable == 'yes'){
			cryptcioBlogSlickSlider();
			cryptcioSlickSlider();
			gallerySlider(1);
		}		
		cryptcioUpToTop();
		cryptcioStickyMenu();
		cryptcioCss();
		cryptcioClick();
		cryptcioFillterIsotop();
		cryptcioRemoveActive();
		cryptcioHeightContent();
		cryptcioMenu();
		cryptcioFixSubMenu();
		cryptcioTooltip();
		cryptcioPreloader();
		if(cryptcio_params.cryptcio_fancybox_enable == 'yes'){
			cryptcioFancyBox();
		}
		cryptcioValidateForm();
		cryptcioAnimation();
		cryptcioOnePage();		
		cryptcioStickySidebar();
		
		cryptcioGetBlogImgWidth();
		cryptcioSetChildWidth();
		cryptcio_extract_data_style();
		cryptcio_AutocompleteSearch();
		if(cryptcio_params.cryptcio_woo_enable == 'yes'){
			Product.init();
		}
	});
	 $(window).resize(function () {
	 	cryptcioHeightContentResize();
	 	cryptcioGalleryContentHeight();
	 	cryptcioGetBlogImgWidth();
	 	loadMore();
	 	if($(window).width() < 992){
	 		cryptcioRemoveActive();
	 	}
	 });
	 $(window).load(function() {
	 	cryptcioScrollTop();
	 	cryptcioFilterIsotopLoad();
	 	loadMore();
	 });

	})(jQuery);
	function jsAnimateMenu1(tog) {
		if(tog == 'open') {
			jQuery('html').addClass('openmenu openmenu-hoz');
		}
		if(tog == 'close') {
			jQuery('html').removeClass('openmenu openmenu-hoz');
		}
	}
	function jsAnimateMenu2(tog) {
		if(tog == 'open') {
			jQuery('html').addClass('openmenu');
		}
		if(tog == 'close') {
			jQuery('html').removeClass('openmenu');
		}
	}		
// Active Cart, Search
function toggleFilter(obj){
	if(jQuery(window).width() < 1199){
		if(jQuery(obj).parent().find('> .content-filter').hasClass('active')){
			jQuery(obj).parent().find('> .content-filter').removeClass('active');  
			jQuery(obj).removeClass('btn-active');                         
		}else{
			jQuery('.btn-open,.cart_label,.btn-search, .languges-flags > a').removeClass('btn-active');
			jQuery('.content-filter').removeClass('active');
			jQuery(obj).parent().find(' > .content-filter').addClass('active');   
			jQuery(obj).addClass('btn-active');           
		}
	}
}
function menu_tab(evt, tabTitle) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(tabTitle).style.display = "block";
	evt.currentTarget.className += " active";
}
