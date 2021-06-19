<?php 
function cryptcio_scripts_styles() {
    wp_enqueue_style( 'cryptcio-fonts', cryptcio_fonts_url(), array(), null );
    global $cryptcio_settings;
    $cryptcio_primary_color = (isset($cryptcio_settings['primary-color']['from']) && $cryptcio_settings['primary-color']['from']!='')?$cryptcio_settings['primary-color']['from']:'';
    $cryptcio_primary_color_2 = (isset($cryptcio_settings['primary-color']['to']) && $cryptcio_settings['primary-color']['to']!='')?$cryptcio_settings['primary-color']['to']:'';
    $cryptcio_main_color = cryptcio_get_meta_value('main_color')!=''?cryptcio_get_meta_value('main_color'):$cryptcio_primary_color;
    $cryptcio_main_color_2 = cryptcio_get_meta_value('main_color_2')!=''?cryptcio_get_meta_value('main_color_2'):$cryptcio_primary_color_2;
    $cryptcio_highlight_color = (isset($cryptcio_settings['highlight-color']) && $cryptcio_settings['highlight-color'] != '')? $cryptcio_settings['highlight-color']:'';
    $cryptcio_page_highlight_color = (cryptcio_get_meta_value('page_highlight_color') != '') ? cryptcio_get_meta_value('page_highlight_color') : $cryptcio_highlight_color;
    $cryptcio_font_default = (isset($cryptcio_settings['general-font']['font-family']) && $cryptcio_settings['general-font']['font-family'] != '')? $cryptcio_settings['general-font']['font-family']:'';
    $cryptcio_cus_font = cryptcio_get_meta_value('cus_font');
    $cryptcio_custom_css ='';
      if (isset($cryptcio_main_color) && $cryptcio_main_color != '') :
        ?>
      <?php 
            $cryptcio_custom_css .= "
            .box-text-app .list-desc-app li:before,.box-text-app .social li a,
            .footer-v5 .payment ul li a:hover, .footer-v5 .copyright-content a:hover,
            .footer-v5 .mc4wp-form-fields .form-mail p.submit:hover:before,
            .footer-v5 .footer-menu .mega-menu li a:hover,.footer-v5 .footer-social li a:hover,
            .widget_archive li.current-cat:before, .widget_categories li.current-cat:before, .widget_product_categories li.current-cat:before, .widget_pages li.current-cat:before, .widget_meta li.current-cat:before,
            .contact-box .contact-info ul span,
            .product-list .desc p .view-details,
            .product_list_widget .product-content .product-title:hover,
            .product_list_widget .product-content .list_add_to_cart a,
            .viewmode-toggle a:hover, .viewmode-toggle a:focus, .viewmode-toggle a.active, 
            .viewmode-toggle a.black_button_active,
            .contact-form label,
            .widget_archive li.current-cat.cat-parent > span, .widget_categories li.current-cat.cat-parent > span, 
            .widget_product_categories li.current-cat.cat-parent > span, .widget_pages li.current-cat.cat-parent > span, 
            .widget_meta li.current-cat.cat-parent > span,
            .widget_archive li.current-cat > span, .widget_categories li.current-cat > span, 
            .widget_product_categories li.current-cat > span, .widget_pages li.current-cat > span, 
            .widget_meta li.current-cat > span,
            .blog-item .read-more a,.blog-info .info a:hover,
            .widget_archive li ul.children li:hover a, .widget_categories li ul.children li:hover a, 
            .widget_product_categories li ul.children li:hover a, 
            .widget_pages li ul.children li:hover > a, .widget_meta li ul.children li:hover a,
            .widget_archive li:hover > a, .widget_categories li:hover > a, 
            .post-single .pagination-link .nav-previous:hover a i, .post-single .pagination-link .nav-next:hover a i,
            .widget_product_categories li:hover > a, .widget_pages li:hover > a, .widget_meta li:hover > a,
            .widget_post_blog ul li.blog-item:hover .blog-post-info .post-name a,
            .widget_archive li:hover > span, .widget_categories li:hover > span, .widget_product_categories li:hover > span, .widget_pages li:hover > span, .widget_meta li:hover > span,
            .widget_archive li.current-cat > a, .widget_categories li.current-cat > a, 
            .widget_product_categories li.current-cat > a, .widget_pages li.current-cat > a, 
            .widget_meta li.current-cat > a,.widget_product_categories li a:hover,
            .widget_archive li:before, .widget_categories li:before, .widget_product_categories li:before, 
            .widget_pages li:before, .widget_meta li:before,
            .breadcrumb li a:hover,.widget_search form .btn-search:hover, 
            .widget_product_search form .btn-search:hover,
            .ult_pricing_table_wrap.ult_design_1 .ult_pricing_table .ult_price_body .ult_price .ult_price_figure,
            .icon_box.icon_style4, .icon_box.icon_style3,.icon_box_content:hover .icon_box_title h3,
            .icon_box_content.type_1 .icon_box_desc a,
            .fixed-header .header-v1:not(.is-sticky) .btn-search:hover i,
            .header-profile ul a i,.header-profile ul a:hover,.mini-cart .text-header .icon-header,
            a:focus, a:hover,.footer-v2 .widget_nav_menu ul li a:hover,
            .footer-v2 .mc4wp-form-fields .form-mail input[type=submit]:hover,
            .footer-v2 .copyright-content p a:hover,
            .footer-v4 .copyright-content p a:hover,
            .footer .payment ul li a:hover,.footer-social li a:hover,
            .load-more .load_more_button a:hover,
            .header-container .mega-menu > li.menu-item.current-menu-item > a, 
            .header-container .mega-menu > li.menu-item.current-menu-parent > a,
            .header-container .mega-menu > li.menu-item.current-menu-ancestor > a,
            .blog-info-top .blog-info .info a:hover,
            .widget_shopping_cart_content .buttons .btn:first-child,
            .arrowpress-heading p,.blog-packery .blog-item:hover .post-name a,
            .icon_box.icon_style2,.footer-v1 .footer-title,.footer-v1 .widget_nav_menu li a:hover,
            .list-info-footer li a:hover,.footer-v1 .footer-social li a:hover,.footer-v1 .copyright-content p a:hover,
            .footer-v1 .payment ul li a:hover,.list-info-footer li i,.footer-v2 .footer-title,
            .widget_post_blog .blog-post-info .blog-time a,
            .comment-body .comment-bottom .links-info a:hover,
            .product-content h3 a:hover,.member-type1 .member-name h4,
            .quantity .qty-number:hover span,.info .summary .add-to > div.yith-wcwl-add-to-wishlist a, 
            .info .summary .add-to > div.add-to-compare a, 
            #yith-quick-view-content .summary .add-to > div.yith-wcwl-add-to-wishlist a, 
            #yith-quick-view-content .summary .add-to > div.add-to-compare a,
            .info .summary .add-to > div.yith-wcwl-add-to-wishlist a:hover, 
            .info .summary .add-to > div.add-to-compare a:hover, 
            #yith-quick-view-content .summary .add-to > div.yith-wcwl-add-to-wishlist a:hover, 
            #yith-quick-view-content .summary .add-to > div.add-to-compare a:hover,
            .widget_product_categories li.current-cat > p span,
            .title-cart-sub,.box-shipping .shipping-calculator-button,
            .woocommerce-Address-title a, .my_account_orders a, 
            .woocommerce-MyAccount-content a, .woocommerce-MyAccount-navigation li a,
            .shop_table .cart_item a.remove:hover,.showlogin, .showcoupon,.payment_method_paypal label a,
            .woocommerce .wishlist_table .product-name a.yith-wcqv-button,
            .info .summary .woocommerce-review-link:hover, #yith-quick-view-content .summary .woocommerce-review-link:hover,
            .woocommerce-page .wishlist_table .product-remove a:hover,
            .blog-item .post_link:hover,.quote_section .author_info,.contact-box .contact-info ul a:hover,
            .addthis_sharing_toolbox .f-social li a:hover,
            .blog-grid-3 .post-name a:hover,.timeline-vertical .item_title a:hover,
            .member-type4 .item-member-content:hover .member-name h4 a,
            .single-service .blog_post_desc .checked li:before,
            .rev_slider_wrapper .tp-caption span,
            .blog-list-1 .blog-item .read-more a,
            .blog-grid-6 .blog-meta .info a:hover,
            .return-to-shop a.button:hover,
            .return-to-shop a.button:focus,
            .return-to-shop a.button:active,
            .blog-list-1 .post-name a:hover,
            .social-list li a:hover,
            .ui-autocomplete .list_add_to_cart a,
            .blog-grid-1 .blog-item .read-more a,
            .project-post-info .link-plus a,
            .project-post-info .post-name a:hover,
            .project-post-info .info-category a:hover,
            .header-v6 .social-icon li a:hover,
            .blog-packery-3 .grid-item .blog-item .blog-post-info .info-category a:hover,
            .blog-packery-3 .grid-item .blog-item .blog-post-info .info a:hover,
            .blog-packery-3 .blog-item .blog-post-info .info-comment:hover a, .blog-packery-3 .blog-item .blog-post-info .info-comment:hover i,
            .blog-grid-6 .blog-meta .info.info-comment:hover a, .blog-grid-6 .blog-meta .info.info-comment:hover i,
            .wpb-js-composer .vc_general.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a .vc_tta-icon,
            .icon_box.icon_style1,.event-info i,
            .event-date-line, .event-time p, .event-date,
            .title-video p,.link-app a,
            .list-items.style3 li::before,
            .progress-sale .token-max, .progress-sale .token-min,
            .timeline-2 .timeline-wrapper .current-view .timeline-content-item .timeline-content-item-reveal a,
            .vc_toggle.vc_toggle_text_only .vc_toggle_content a,
            .blog-grid-2 .post-name a:hover,
            .blog-grid-2 .blog-info .info a:hover,
            .close-menu, .close-menu-mobile,
            .social_icon li a,
            .contact-form2 label,
            .widget_archive li a::before, 
            .widget_categories li a::before, 
            .widget_meta li a::before, 
            .widget_pages li a::before, 
            .widget_product_categories li a::before,
            .side-breadcrumb.type-2 .breadcrumb li a:hover,
            .cate-archive .product-category a:hover .count, 
            .cate-archive .product-category a:hover .woocommerce-loop-category__title,
            .icon_box_content.type_3 .icon_box .number,
            .icon_box_content.type_1.text-right .icon_box.icon_style3,
            .footer-v6 .footer-social li a:hover,.custom_timeline.cus-color .timeline-wrapper .timeline-content-item .ev-date-out,
            .footer-v6 .widget_nav_menu li a:hover{
                 color: {$cryptcio_main_color};
            }
            .ie-7,.ie-8,.ie-9,.ie-10,.ie-11{
                  .arrowpress-heading.heading-3 h2 {
                      -webkit-text-fill-color:{$cryptcio_main_color};
                      color:{$cryptcio_main_color}; 
                  }
            }
            @media (min-width: 768px){
                  .blog-grid-1 .post-name a:hover {
                      color: {$cryptcio_main_color};
                  }
            }
            .footer-v1 .footer-title,
            .header-v3 .header-container .mega-menu > .menu-item > a:hover, 
            .header-v3 .mega-menu > li.menu-item.current-menu-parent > a, 
            .header-v3 .search-block-top > .btn-search:hover,
            .search-block-top > .btn-search:hover,
            .custom .icon_box_content.type_1.text-center:hover .icon_box.icon_style2,
            .header-profile ul li:hover a,
            .mini-cart .cart_label:hover,
            .main-color,
            .open-menu-mobile:hover,.searchform_wrap form button:hover,
            .header-contact a:hover, 
            .mega-menu li.current_page_parent > a,
            .mega-menu .sub-menu li.current-menu-item > a,
            .widget_shopping_cart_content ul li a:hover,
            .header-container .mega-menu li a:hover, .header-container .mega-menu li a:focus,
            .header-container .mega-menu li .sub-menu li.current-menu-item > a,
            .header-container .mega-menu > li.menu-item.current-menu-ancestor > a,
            .blog-packery-3 .grid-item .blog-post-title .post-name a:hover,
            .site-header .header-container .mega-menu li a:hover,
            .site-header .search-block-top > .btn-search:hover,
            .site-header .header-container .mega-menu li a:focus,
            .header-v3.is-sticky .header-container .mega-menu > li.menu-item > a:hover,
            .header-v3.is-sticky .mega-menu > li.menu-item.current-menu-parent > a, 
            .header-v3.is-sticky .search-block-top > .btn-search:hover,
            .banner-type1:hover .banner-mid .link-text a, 
            .banner-type1:hover .banner-title h2,
            .no-hover .icon_box_content.type_1.text-center:hover .icon_box_title h3,
            .no-hover .icon_box_content.type_1.text-center:hover .icon_box.icon_style4{
                color: {$cryptcio_main_color} !important;
            }
            .blog-container .load-more .load_more_button a:hover,
            .timeline-wrapper .timeline-content-item > span:before,
            .list-item-info .icon,.timeline-vertical .ev-date-out,
            .btn.btn-black:hover, .btn.btn-black:focus, .btn.btn-black:active,
            .addthis_sharing_toolbox .f-social li a:hover,
            .page-numbers li .page-numbers:hover, .page-numbers li .page-numbers.current,
            .tagcloud a:hover,
            .ult_pricing_table_wrap.ult_design_1 .ult_pricing_table:hover h3,
            .woocommerce-page .wishlist_table .product-add-to-cart .button,
            .block-text-h7 a.btn.btn-primary,
            .load-more .load_more_button a,
            .ult_pricing_table_wrap.active.ult_design_1 .ult_pricing_heading h3,
            .footer-v2 .mc4wp-form-fields .form-mail p.submit,
            .page .page-links > *:not(.page-links-title),
            .return-to-shop a.button,.woocommerce-shipping-fields #ship-to-different-address input.input-checkbox:checked:after,
            .search-block-top .top-search .woosearch-input-box,
            .mc4wp-form-fields .form-mail input[type=email]:focus,
            .slider-wrap-container .slick-default .slick-dots li.slick-active button,
            .ult-carousel-wrapper .slick-dots .slick-active .ultsl-radio-unchecked, .ult-carousel-wrapper .slick-dots li:hover .ultsl-radio-unchecked,
            .custom_timeline.cus-color.timeline-2 .timeline-wrapper .timeline-content-item .timeline-content-item-reveal:before,
            .box-video .youtube_play_btn::before,
            .footer-v6 .footer-social li a:hover, .footer-v6 .widget_nav_menu li a:hover,
            .custom_timeline.cus-color.timeline-2 .timeline-wrapper .timeline-content-item .timeline-content-item-reveal,
            .close-menu, .close-menu-mobile,.social_icon li a{
                border-color:{$cryptcio_main_color};
            }
            .custom_timeline.cus-color.timeline-2 .timeline-wrapper .timeline-content-item .timeline-content-item-reveal a:before{
                    border-color:{$cryptcio_main_color} transparent transparent  ;
            }
            @media (min-width: 992px){
                .header-container .mega-menu > li.menu-item > .sub-menu{
                    border-color:{$cryptcio_main_color};
                }
            }
            .timeline-wrapper .timeline-content-item .timeline-content-item-reveal::after{
                  border-top-color: {$cryptcio_main_color};
            }
            .event_item-container.slick-slide:nth-child(2n+1) .timeline-content-item .timeline-content-item-reveal::after{
                  border-bottom-color: {$cryptcio_main_color};
            }
            .contact-form .wpcf7-form-control-wrap input:hover, 
            .contact-form textarea:hover,
            .calcButton, .calcButton:hover, .btn-primary.calcButton:active, .btn-primary.calcButton:focus,
            .variations_form .attribute-swatch .swatchinput .wcva_single_textblock:hover, 
            .variations_form .attribute-swatch .swatchinput .wcva_single_textblock.selectedswatch{
                border-color:{$cryptcio_main_color} !important;
            }
            .blog-container .load-more .load_more_button a:hover,
            .calcButton, .calcButton:hover, .btn-primary.calcButton:active, .btn-primary.calcButton:focus,
            .woocommerce-page .wishlist_table .product-add-to-cart .button,
            .btn.btn-black:hover, .btn.btn-black:focus, .btn.btn-black:active,
            .info .add-to-cart .button, #yith-quick-view-content .add-to-cart .button,
            .tooltip .tooltip-inner,
            .yith-woocompare-widget a.clear-all, .yith-woocompare-widget a.compare,
            .widget_berocket_aapf .berocket_filter_slider.ui-widget-content .ui-slider-handle, 
            .widget_berocket_aapf .berocket_filter_price_slider.ui-widget-content .ui-slider-handle,
            .page-numbers li .page-numbers:hover, .page-numbers li .page-numbers.current,
            .widget_post_blog .blog-img:before, 
            .youtube_play_btn,.image_style_1 .vc_figure:before,
            .blog-packery .blog-img:before,
            .btn.btn-primary,.icon_box_content.type_1.text-center:hover,
            .mini-cart .text-items,
            .main-bg_color, .main-bg_color.ult-content-box-container,
            .main-bg_color > .vc_column-inner, .main-bg_color > .upb_row_bg, .main-bg_color.vc_row,
            .scroll-to-top,
            .tagcloud a:hover,.footer-v1 .footer-newsletter,
            .ult_pricing_table_wrap.active.ult_design_1 .ult_pricing_heading h3,
            .ult_pricing_table_wrap.ult_design_1 .ult_pricing_table:hover h3,
            .footer-v2 .mc4wp-form-fields .form-mail p.submit,
            .product-action.product-action-grid,
            .item_testimonial5 .caption_testimonial,
            .post-single .blog_post_desc ul li:before,
            .post-single .blog_post_desc blockquote p:before,
            .list_add_to_cart a,.load-more .load_more_button a,
            .coming-soon-container .mc4wp-form .submit input,.title-cart:before,
            .product-list .product-action-list,.bg-primary,
            .single-product .thumbs_list .slick-arrow:hover,
            .quote_section .link-icon,
            .fixed-header .header-v3:not(.is-sticky) .header-middle,
            .page .page-links > *:not(.page-links-title),
            .timeline-wrapper .timeline-content-item .timeline-content-item-reveal,
            .event_item-container .timeline-content-item:before,
            .timeline-wrapper .timeline-content-item > span:before,
            .return-to-shop a.button,input.input-radio:checked:after,
            .blog-grid-6 .blog-content:hover .blog-post-title .info::before, .blog-grid-6 .blog-content:hover .post-name::before,
            .list-item-info .icon,.member-type4 .member-img:before,.timeline-vertical .ev-date-out::after,
            .icon_box.icon_style1:hover,
            .project-post-info .post-name::before,
            .wpb-js-composer .vc_general.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
            .wpb-js-composer .vc_general.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:hover,
            .footer-v6 .footer-newsletter,
            .image_overlay .vc_single_image-wrapper:before,
            .btn-filter-project li a.active, .btn-filter-project li a:hover,
            .project-2 .project-image a::after,
            .event-content:hover,
            .timeline-2 .timeline-wrapper .timeline-content-item .timeline-content-item-reveal a .ev-date::before,
            .progress-line .progress-bar,
            .timeline-2 .timeline-wrapper .current-view.slick-slide:nth-child(2n+1) .timeline-content-item .timeline-content-item-reveal > a > h6::before,
            .timeline-2 .event_item-container .timeline-content-item::before,
            .list-token ul li:before,
            .post-single .blog_post_desc p + ul li::before{
                background-color: {$cryptcio_main_color};
            }
            .tb-coin-custom .vcw.vcw-table th,
            .ult_pricing_table_wrap.ult_design_1 .ult_pricing_table .ult_price_link .ult_price_action_button,
            .calcButton, .calcButton:hover, .btn-primary.calcButton:active, .btn-primary.calcButton:focus,
            #slide-home7 .tp-bullets.ares .tp-bullet.selected,
            .arrowpress-heading .line_separator,
            .custom-heading-2 .line_separator,
            .box-classes .ult_pricing_table_wrap.ult_design_1 .ult_pricing_table:hover{
                background-color: {$cryptcio_main_color} !important;
            }
            .wpb-js-composer .cs-tab7.vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-panels .vc_tta-panel-body .wpb_single_image{
                    -webkit-box-shadow: 4px 5px 0 0  {$cryptcio_main_color};
                   -moz-box-shadow:4px 5px 0 0 {$cryptcio_main_color};
                    box-shadow: 4px 5px 0 0 {$cryptcio_main_color};
            }
            .object,.loader:before,
            .object-2,.object-6,#object-7,
            .busy-loader .w-ball-wrapper .w-ball,
            .pacman > div:nth-child(3),
            .pacman > div:nth-child(4),
            .pacman > div:nth-child(5),
            .pacman > div:nth-child(6),
            .object-9,
            .preloader8 span,
            body .baby .back,
            body .baby .back .tail,
            body .baby .back .feet,
            body .baby .back .hand,
            body .baby .back .hand:after,
            body .baby .back .ass,
            body .baby .back .ass:after,
            body .baby .head,
            body .baby .head .horn{
                background-color: {$cryptcio_main_color};
            }
            .tooltip.top .tooltip-arrow,
            .mini-cart .cart-block,
            .object-3,
            .psoload .curve:before,
            .psoload .curve:after{
                border-top-color: {$cryptcio_main_color};
            }
            .shop_table thead tr th,
            .mini-cart .count-item,
            .psoload .straight:before,
            .psoload .straight:after,
            .psoload .inner:before,
            .psoload .inner:after{
                border-bottom-color: {$cryptcio_main_color};
            }
            .object-3{
                border-left-color: {$cryptcio_main_color};
            }
            .pacman > div:nth-child(2),
            .psoload .center{
                border-color: {$cryptcio_main_color};
            }
            .member-type5 .member-img:after,
            .ult-carousel-wrapper.slide-member .slick-dots .slick-active .ultsl-radio-unchecked, 
            .ult-carousel-wrapper.slide-member .slick-dots:hover .ultsl-radio-unchecked,
            .single-product .img_single_thumb .views-block .slick-slide.slick-current img{
                  border-color: {$cryptcio_main_color} !important;
            }
            .mini-cart .cart-block::-webkit-scrollbar-thumb { 
                background-color: {$cryptcio_main_color};
            }
            @media (min-width: 992px){
                .header-v1 .mini-cart .cart_label .title-cart,
                .cate-menu>ul>li>ul.children>li>a{
                    color: {$cryptcio_main_color};
                }
                .ultimate-map-wrapper.custom-map:before{
                    background: {$cryptcio_main_color} !important;
                }
            }       
            @media (min-width: 768px){
                .icon_box_content:hover .icon_box.icon_style1,
                .arrowpress-products.style-2.product_grid .product-action .action_item_box .action_item:hover,
                .header-profile ul a:before{
                    background:{$cryptcio_main_color};
                }
                .arrowpress-products.style-2.product_grid .product-action .list_add_to_cart a:before{
                    border-color:{$cryptcio_main_color} transparent transparent
                }
                .service-entries-wrap .blog-item:hover .post-name a{
                    color:{$cryptcio_main_color};
                }

            }
            ";
        ?>        
      <?php endif;
      if (isset($cryptcio_page_highlight_color) && $cryptcio_page_highlight_color != ''){
        $cryptcio_custom_css .= "
            .box-faq:hover,
            .member-type5 .member-img:before{
                   background: -moz-linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* ff3.6+ */
                  background: -webkit-gradient(linear, left top, right top, color-stop(0%, $cryptcio_page_highlight_color), color-stop(100%, #240a71)); /* safari4+,chrome */
                  background: -webkit-linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* safari5.1+,chrome10+ */
                  background: -o-linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* opera 11.10+ */
                  background: -ms-linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* ie10+ */
                  background: linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* w3c */
            }
            .arrowpress-heading.heading-3 h2{
                -webkit-text-fill-color: transparent;
                    -webkit-background-clip: text !important;
                    background: -moz-linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* ff3.6+ */
                  background: -webkit-gradient(linear, left top, right top, color-stop(0%, $cryptcio_page_highlight_color), color-stop(100%, #240a71)); /* safari4+,chrome */
                  background: -webkit-linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* safari5.1+,chrome10+ */
                  background: -o-linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* opera 11.10+ */
                  background: -ms-linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* ie10+ */
                  background: linear-gradient(90deg, $cryptcio_page_highlight_color 0%, #240a71 100%); /* w3c */
            }
            .btn.btn-highlight:hover, .btn.btn-highlight:focus, 
            .btn.btn-highlight:active{
                color: {$cryptcio_page_highlight_color};
            }   
            .scroll-to-top:hover,
            .project-container .title-project .title-content,
            .member-type1 .member-img:before{
                  background: {$cryptcio_page_highlight_color};
            }
            @media (min-width: 768px){
                  .blog-grid-1 .blog-item .read-more a:hover {
                      color: {$cryptcio_page_highlight_color};
                  }
            }
            @media (max-width: 767px){
                .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a{
                        background-color: {$cryptcio_page_highlight_color} !important;
                }
                .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a{
                        border-color: {$cryptcio_page_highlight_color} !important;
                }
                .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a{
                        color: {$cryptcio_page_highlight_color} !important;
                }
            }
        ";        
      }
      if (isset($cryptcio_main_color) && $cryptcio_main_color != '' && isset($cryptcio_main_color_2) && $cryptcio_main_color_2 != ''){
        $cryptcio_custom_css .= "
            .btn.btn-gradient,
            .bg-gradient,
            .hide-icon .icon_box_content h3,
            .add_contact .contact-form p.submit .btn.btn-primary,
            .add_contact .footer .footer-v2 .mc4wp-form-fields .form-mail .submit input,
            .progress-line .progress-bar,
            .timeline-2 .slick-slider.slider .slick-arrow:hover,
            .blog-container .load-more .load_more_button a:hover, .calcButton, .calcButton:hover, .btn-primary.calcButton:active, .btn-primary.calcButton:focus, .woocommerce-page .wishlist_table .product-add-to-cart .button, .btn.btn-black:hover, .btn.btn-black:focus, .btn.btn-black:active, .info .add-to-cart .button, #yith-quick-view-content .add-to-cart .button, .tooltip .tooltip-inner, .yith-woocompare-widget a.clear-all, .yith-woocompare-widget a.compare, .widget_berocket_aapf .berocket_filter_slider.ui-widget-content .ui-slider-handle, .widget_berocket_aapf .berocket_filter_price_slider.ui-widget-content .ui-slider-handle, .page-numbers li .page-numbers:hover, .page-numbers li .page-numbers.current, .widget_post_blog .blog-img::before, .youtube_play_btn, .image_style_1 .vc_figure::before, .blog-packery .blog-img::before, .btn.btn-primary, .icon_box_content.type_1.text-center:hover, .mini-cart .text-items, .main-bg_color, .main-bg_color.ult-content-box-container, .main-bg_color > .vc_column-inner, .main-bg_color > .upb_row_bg, .main-bg_color.vc_row, .scroll-to-top, .tagcloud a:hover, .footer-v1 .footer-newsletter, .ult_pricing_table_wrap.active.ult_design_1 .ult_pricing_heading h3, .ult_pricing_table_wrap.ult_design_1 .ult_pricing_table:hover h3, .footer-v2 .mc4wp-form-fields .form-mail p.submit, .product-action.product-action-grid, .item_testimonial5 .caption_testimonial, .post-single .blog_post_desc ul li::before, .post-single .blog_post_desc blockquote p::before, .list_add_to_cart a, .load-more .load_more_button a, .coming-soon-container .mc4wp-form .submit input, .title-cart::before, .product-list .product-action-list, .bg-primary, .single-product .thumbs_list .slick-arrow:hover, .quote_section .link-icon, .fixed-header .header-v3:not(.is-sticky) .header-middle, .page .page-links > :not(.page-links-title), .timeline-wrapper .timeline-content-item .timeline-content-item-reveal, .timeline-wrapper .timeline-content-item > span::before, .return-to-shop a.button, input.input-radio:checked::after, .blog-grid-6 .blog-content:hover .blog-post-title .info::before, .blog-grid-6 .blog-content:hover .post-name::before, .list-item-info .icon, .member-type4 .member-img::before, .timeline-vertical .ev-date-out::after, .icon_box.icon_style1:hover, .project-post-info .post-name::before, .wpb-js-composer .vc_general.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading, .wpb-js-composer .vc_general.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:hover, .footer-v6 .footer-newsletter, .image_overlay .vc_single_image-wrapper::before, .btn-filter-project li a.active, .btn-filter-project li a:hover, .project-2 .project-image a::after, .event-content:hover, .timeline-2 .timeline-wrapper .timeline-content-item .timeline-content-item-reveal a .ev-date::before, .progress-line .progress-bar, .timeline-2 .timeline-wrapper .current-view.slick-slide:nth-child(2n+1) .timeline-content-item .timeline-content-item-reveal > a > h6::before{
                  background: -moz-linear-gradient(0deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* ff3.6+ */
                  background: -webkit-gradient(linear, left top, right top, color-stop(0%, $cryptcio_main_color), color-stop(100%, $cryptcio_main_color_2)); /* safari4+,chrome */
                  background: -webkit-linear-gradient(0deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* safari5.1+,chrome10+ */
                  background: -o-linear-gradient(0deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* opera 11.10+ */
                  background: -ms-linear-gradient(0deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* ie10+ */
                  background: linear-gradient(90deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* w3c */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$cryptcio_main_color', endColorstr='$cryptcio_main_color_2',GradientType=1 ); /* ie6-9 */    
            }
            .tb-coin-custom .vcw.vcw-table th, .ult_pricing_table_wrap.ult_design_1 .ult_pricing_table .ult_price_link .ult_price_action_button, .calcButton, .calcButton:hover, .btn-primary.calcButton:active, .btn-primary.calcButton:focus, #slide-home7 .tp-bullets.ares .tp-bullet.selected, .arrowpress-heading .line_separator, .custom-heading-2 .line_separator, .box-classes .ult_pricing_table_wrap.ult_design_1 .ult_pricing_table:hover{
                  background: -moz-linear-gradient(0deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%) !important; /* ff3.6+ */
                  background: -webkit-gradient(linear, left top, right top, color-stop(0%, $cryptcio_main_color), color-stop(100%, $cryptcio_main_color_2)) !important; /* safari4+,chrome */
                  background: -webkit-linear-gradient(0deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%) !important; /* safari5.1+,chrome10+ */
                  background: -o-linear-gradient(0deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%) !important; /* opera 11.10+ */
                  background: -ms-linear-gradient(0deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%) !important; /* ie10+ */
                  background: linear-gradient(90deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%) !important; /* w3c */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$cryptcio_main_color', endColorstr='$cryptcio_main_color_2',GradientType=1 ) !important; /* ie6-9 */   
            }
            .footer-v7 .mc4wp-form-fields .form-mail p.submit:hover,
            .btn.btn-gradient:hover,
            .btn.btn-primary:hover,
            .add_contact .contact-form p.submit .btn.btn-primary:hover,
            .blog-container .load-more .load_more_button a,
            .add_contact .footer .footer-v2 .mc4wp-form-fields .form-mail .submit input:hover{
                  background: -moz-linear-gradient(180deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* ff3.6+ */
                  background: -webkit-gradient(linear, left top, right top, color-stop(0%, $cryptcio_main_color), color-stop(100%, $cryptcio_main_color_2)); /* safari4+,chrome */
                  background: -webkit-linear-gradient(180deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* safari5.1+,chrome10+ */
                  background: -o-linear-gradient(180deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* opera 11.10+ */
                  background: -ms-linear-gradient(180deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* ie10+ */
                  background: linear-gradient(270deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* w3c */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$cryptcio_main_color', endColorstr='$cryptcio_main_color_2',GradientType=1 ); /* ie6-9 */ 
            }

            .service_type5 .service-number,
            .text-default-color .play_btn i,
            .box-text-contact ul li span,
            .footer-v7 .mc4wp-form-fields .form-mail p.submit,
            .timeline-2 .timeline-wrapper .timeline-content-item .timeline-content-item-reveal,
            .timeline-2 .timeline-wrapper .timeline-content-item > span::after{
                  background: -moz-linear-gradient(90deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* ff3.6+ */
                  background: -webkit-gradient(linear, left top, right top, color-stop(0%, $cryptcio_main_color), color-stop(100%, $cryptcio_main_color_2)); /* safari4+,chrome */
                  background: -webkit-linear-gradient(90deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* safari5.1+,chrome10+ */
                  background: -o-linear-gradient(90deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* opera 11.10+ */
                  background: -ms-linear-gradient(90deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* ie10+ */
                  background: linear-gradient(90deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* w3c */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$cryptcio_main_color', endColorstr='$cryptcio_main_color_2',GradientType=1 ); /* ie6-9 */    
            }
            .timeline-2 .timeline-wrapper .event_item-container:nth-child(2n+1) .timeline-content-item > span::after{
                  background: -moz-linear-gradient(270deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* ff3.6+ */
                  background: -webkit-gradient(linear, left top, right top, color-stop(0%, $cryptcio_main_color), color-stop(100%, $cryptcio_main_color_2)); /* safari4+,chrome */
                  background: -webkit-linear-gradient(270deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* safari5.1+,chrome10+ */
                  background: -o-linear-gradient(270deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* opera 11.10+ */
                  background: -ms-linear-gradient(270deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* ie10+ */
                  background: linear-gradient(180deg, $cryptcio_main_color 0%, $cryptcio_main_color_2 100%); /* w3c */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$cryptcio_main_color', endColorstr='$cryptcio_main_color_2',GradientType=1 ); /* ie6-9 */    
            }
            
            ";  
      }
      if (isset($cryptcio_font_default) && $cryptcio_font_default != '') :
        ?>
        <?php 
            $cryptcio_custom_css .= "
                .active-sidebar .widget .widget-title,
                .arrowpress-products.style-2.product_grid .product-content h3,
                .arrowpress-products.style-2.product_grid .product-content .price .amount, .arrowpress-products.style-2.product_grid .product-content .price .amount span,
                .product_list.style-2 .product-content h3 a,
                .product_list.style-2 .product-content .price .amount,
                .arrowpress-products.no-spacing .title-border,
                .footer-v2 .footer-title,
                .footer-v4 .footer-social .title-social,
                .footer-v5 .footer-title,
                .footer-v5 .mc4wp-form-fields .desc,
                .header-v6 .cart_label .cart_qty,
                .search-block-top .top-search .woosearch-input-box input,
                .blog-grid-1 .post-name a,
                .blog-grid-2 .post-name a,
                .blog-grid-3 .post-name a,
                .blog-list-1 .post-name a,
                .blog-list-2 .post-name a,
                .arrowpress-heading.heading-1 h2,
                .aio-icon-box.top-icon .aio-icon-title,
                .ult_pricing_table_wrap.ult_design_2 .ult_pricing_table .ult_pricing_heading h3,
                .ult_pricing_table_wrap.ult_design_2 .ult_pricing_table .ult_pricing_heading h5,
                .ult_pricing_table_wrap.ult_design_3 .ult_pricing_table .ult_price_features,
                .ult_pricing_table_wrap.ult_design_3 .ult_pricing_table .ult_pricing_heading h3,
                .note-content h4, .title-box-mb,
                .portfolio_title h3,
                .gallery_related h3,
                .tooltip .tooltip-inner,
                .active-sidebar .widget h3,
                .widget_post_blog .blog-post-info .post-name a,
                .box-text-sidebar h4,
                .product_slide2 .product-content .price .amount,
                .product_slide2 .product-content h3,
                .product_slide2 .product-content .cryptcio_product_main_info .cryptcio_class_age,
                .product_slide2 .product-content .cryptcio_product_main_info .cryptcio_class_size,
                .product_list.style-4 .product-content h3 a,
                .product_list.style-4 .product-content .product-desc .price span.woocommerce-Price-currencySymbol,
                .info .price span.tax, .info .price span.tax span, #yith-quick-view-content .price span.tax, #yith-quick-view-content .price span.tax span,
                .teacher_header p,
                .service_type1 .service-title h4,
                .custom-progress.vc_progress_bar h6,
                .icon_box_content.type_2 .icon_box_title h3,
                .arrowpress-products.style-2.product_grid .product-content h3,
                .icon_box_content.type_2 .icon_box_title h3,
                .member-type3 .member-info .link-text a,
                .member-type3 .member-info .member-name h4,
                .service_type3 .text-left .service-info h4, 
                .service_type3 .text-right .service-info h4,
                .member-type3 .member-info .member-name h4,
                .service_type2 .service-title h4,
                .service_type1 .service-title h4,
                .item_testimonial2 .tes_info h6,
                .item_testimonial .tes_info h6,
                .product_grid.style-4 .product-content .product-desc .price .amount,
                .product_grid.style-4 .product-content .product-desc a,
                #main .product-list-style3 .product-content h3,
                .product_list.style-2 .product-content .price .amount,
                .product_list.style-2 .product-content h3 a,
                .icon_box_content.type_2 .icon_box_title h3,
                .header-v6 .search-block-top .top-search .woosearch-input-box input,
                .side-breadcrumb .breadcrumb, .side-breadcrumb .breadcrumb li a,
                .product_list.style-1.no-spacing .product-content .product-desc h3,
                .newletter-1 .mc4wp-form-fields .desc{
                    font-family: {$cryptcio_font_default};
                } 
            ";
        ?>        
    <?php endif;
    if (isset($cryptcio_cus_font) && $cryptcio_cus_font != 'default' && $cryptcio_cus_font != '') :
        ?>
        <?php 
            $cryptcio_custom_css .= "
            header,
            .megamenu.notsub_level-2 ul.sub-menu > li > a{
                font-family: '{$cryptcio_cus_font}';
            }";
        ?>        
    <?php endif;  
   
      if(isset($cryptcio_settings['breadcrumbs-overlay-color']) && $cryptcio_settings['breadcrumbs-overlay-color'] !=''){
        $cryptcio_custom_css .= "
            .side-breadcrumb.has-overlay::before{
                background-color: {$cryptcio_settings['breadcrumbs-overlay-color']};
            }
        ";        
    } 
    if(isset($cryptcio_settings['breadcrumbs_align']) && $cryptcio_settings['breadcrumbs_align'] !=''){
        $cryptcio_custom_css .= "
            .side-breadcrumb{
                text-align: {$cryptcio_settings['breadcrumbs_align']};
            }
        ";        
    }        
    if(isset($cryptcio_settings['breadcrumbs_padding']) && $cryptcio_settings['breadcrumbs_padding'] !=''){
        if(isset($cryptcio_settings['breadcrumbs_padding']['padding-left']) && $cryptcio_settings['breadcrumbs_padding']['padding-left']!=''){
            $cryptcio_custom_css .= "
                .side-breadcrumb{
                    padding-left: {$cryptcio_settings['breadcrumbs_padding']['padding-left']};
                }
            ";                    
        }
        if(isset($cryptcio_settings['breadcrumbs_padding']['padding-top']) && $cryptcio_settings['breadcrumbs_padding']['padding-top']!=''){
            $cryptcio_custom_css .= "
                .side-breadcrumb{
                    padding-top: {$cryptcio_settings['breadcrumbs_padding']['padding-top']};
                }
            ";             
        }
        if(isset($cryptcio_settings['breadcrumbs_padding']['padding-right']) && $cryptcio_settings['breadcrumbs_padding']['padding-right']!=''){
            $cryptcio_custom_css .= "
                .side-breadcrumb{
                    padding-right: {$cryptcio_settings['breadcrumbs_padding']['padding-right']};
                }
            ";            
        }
        if(isset($cryptcio_settings['breadcrumbs_padding']['padding-bottom']) && $cryptcio_settings['breadcrumbs_padding']['padding-bottom']!=''){
            $cryptcio_custom_css .= "
                .side-breadcrumb{
                    padding-bottom: {$cryptcio_settings['breadcrumbs_padding']['padding-bottom']};
                }
            ";        
        }
        
    } 
     if(isset($cryptcio_settings['title-breadcrumbs-font']['text-transform']) && $cryptcio_settings['title-breadcrumbs-font']['text-transform'] !=''){
        $cryptcio_custom_css .= "
            .side-breadcrumb .page-title h1{
                font-family: {$cryptcio_settings['title-breadcrumbs-font']['font-family']};
                color: {$cryptcio_settings['title-breadcrumbs-font']['color']};
                font-size: {$cryptcio_settings['title-breadcrumbs-font']['font-size']};
                font-weight: {$cryptcio_settings['title-breadcrumbs-font']['font-weight']};
                text-transform: {$cryptcio_settings['title-breadcrumbs-font']['text-transform']};
            }
        ";        
    }   
    if(isset($cryptcio_settings['link-breadcrumbs-font']) && $cryptcio_settings['link-breadcrumbs-font'] !=''){
        if(isset($cryptcio_settings['link-breadcrumbs-font']['font-family'])&& $cryptcio_settings['link-breadcrumbs-font']['font-family']!=''){
              $cryptcio_custom_css .= "
                  .breadcrumb,
                  .breadcrumb li a,
                  .breadcrumb > li + li::before{
                      font-family: {$cryptcio_settings['link-breadcrumbs-font']['font-family']};
                  }
              ";            
        }
        if(isset($cryptcio_settings['link-breadcrumbs-font']['color']) && $cryptcio_settings['link-breadcrumbs-font']['color']!=''){
              $cryptcio_custom_css .= "
                  .breadcrumb,
                  .breadcrumb li a,
                  .breadcrumb > li + li::before{
                      color: {$cryptcio_settings['link-breadcrumbs-font']['color']};
                  }
              ";             
        }
        if(isset($cryptcio_settings['link-breadcrumbs-font']['font-size']) && $cryptcio_settings['link-breadcrumbs-font']['font-size']!=''){
              $cryptcio_custom_css .= "
                  .breadcrumb,
                  .breadcrumb li a,
                  .breadcrumb > li + li::before{
                      font-size: {$cryptcio_settings['link-breadcrumbs-font']['font-size']};
                  }
              ";             
        }
        if(isset($cryptcio_settings['link-breadcrumbs-font']['font-weight']) && $cryptcio_settings['link-breadcrumbs-font']['font-weight']!=''){
              $cryptcio_custom_css .= "
                  .breadcrumb,
                  .breadcrumb li a,
                  .breadcrumb > li + li::before{
                      font-weight: {$cryptcio_settings['link-breadcrumbs-font']['font-weight']};
                  }
              ";
        }        
    } 
    /* Header 1 options */  
    if(isset($cryptcio_settings['height_top']) && $cryptcio_settings['height_top'] !=''){
        if(isset($cryptcio_settings['height_top']['height']) && $cryptcio_settings['height_top']['height']!=''){
            $cryptcio_custom_css .= "
                .header-v1 .header-top-link{
                    height: {$cryptcio_settings['height_top']['height']};
                }
            ";    
        }       
    } 
    if(isset($cryptcio_settings['height_middle']) && $cryptcio_settings['height_middle'] !=''){
        if(isset($cryptcio_settings['height_middle']['height']) && $cryptcio_settings['height_middle']['height']!=''){
            $cryptcio_custom_css .= "
                .header-v1 .header-middle .display-flex{
                    height: {$cryptcio_settings['height_middle']['height']};
                }
            ";    
        }       
    }
    if(isset($cryptcio_settings['height_bottom']) && $cryptcio_settings['height_bottom'] !=''){
        if(isset($cryptcio_settings['height_bottom']['height']) && $cryptcio_settings['height_bottom']['height']!=''){
            $cryptcio_custom_css .= "
                .header-v1 .header-menu .cart_label, 
                .header-v1 .header-menu .title-cate,
                .header-v1 .header-container .mega-menu > li.menu-item > a{
                    height: {$cryptcio_settings['height_bottom']['height']};
                }
            ";    
        }       
    }      
    if(isset($cryptcio_settings['header1-bg']) && $cryptcio_settings['header1-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v1,
            .fixed-header .header-v1.is-sticky{
                background-color: {$cryptcio_settings['header1-bg']};
            }
        ";         
    }   
    if(cryptcio_get_meta_value('header-top-bg')!=''){
        $header_top_bg = cryptcio_get_meta_value('header-top-bg');
        $cryptcio_custom_css .= "
            header .header-top-link{
                background-color: {$header_top_bg};
            }
        ";         
    }
    if(isset($cryptcio_settings['header-menu-bg']) && $cryptcio_settings['header-menu-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v1 .header-menu{
                background-color: {$cryptcio_settings['header-menu-bg']};
            }
        ";         
    } 
    if(isset($cryptcio_settings['header-submenu-bg']) && $cryptcio_settings['header-submenu-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v1 .header-container .mega-menu li .sub-menu,
            .header-v1 .content-filter,
            .header-v1 .header-ver{
                background-color: {$cryptcio_settings['header-submenu-bg']};
            }
            @media (max-width: 991px){
                .fixed-header .header-v1.header-bottom,
                .mega-menu li .sub-menu,
                .header-center{
                    background-color: {$cryptcio_settings['header-submenu-bg']};
                }
            }
        ";         
    }  
    if(isset($cryptcio_settings['header1-bg-hover']) && $cryptcio_settings['header1-bg-hover'] !=''){
        $cryptcio_custom_css .= "
            .header-container .mega-menu li .sub-menu li a:hover{
                background-color: {$cryptcio_settings['header1-bg-hover']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header1-color']) && $cryptcio_settings['header1-color'] !=''){
        $cryptcio_custom_css .= "
            .mini-cart .cart_label,
            .languges-flags a, 
            .mini-cart > a,
            .mega-menu > li > a,
            .mega-menu li .sub-menu li a,
            .mini-cart .count-item > p,
            .slogan, 
            .searchform_wrap input,
            .searchform_wrap form button,
            .widget_shopping_cart_content ul li.empty,
            .social-sidebar .twitter-tweet .tweet-text,
            .mini-cart .product_list_widget .product-content .product-title,
            .mega-menu .product_list_widget .product-content .product-title,
            .header-profile ul a, header.header-1 .mini-cart .cart_label{
                color: {$cryptcio_settings['header1-color']};
            }
            @media (max-width: 991px){
                .header-v1 .header-menu .header-container .mega-menu > li.menu-item > a{
                    color: {$cryptcio_settings['header1-color']};
                }
            }
        ";        
    } 
    if(isset($cryptcio_settings['header1menu-option']) && $cryptcio_settings['header1menu-option'] !=''){
        $cryptcio_custom_css .= "
            .header-v1 .header-container .mega-menu > li.menu-item > a{
                font-family: {$cryptcio_settings['header1menu-option']['font-family']};
                color: {$cryptcio_settings['header1menu-option']['color']};
                font-size: {$cryptcio_settings['header1menu-option']['font-size']};
                font-weight: {$cryptcio_settings['header1menu-option']['font-weight']};
                text-transform: {$cryptcio_settings['header1menu-option']['text-transform']};
            }
            .header-v1 .open-menu-mobile,
            .header-v1 .search-block-top > .btn-search,
            .nav-sections .nav-tabs > li > a,
            .social-mobile h5, .contact-mobile h5,
            .header-contact a,
            .header-v1 .header-container .mega-menu li .sub-menu li a{
                color: {$cryptcio_settings['header1menu-option']['color']};
            }
        ";        
    }   

    if(isset($cryptcio_settings['header1-border-color']) && $cryptcio_settings['header1-border-color'] !=''){
        $cryptcio_custom_css .= "
            .header-container .mega-menu li .sub-menu li a,
            .searchform_wrap .vc_child,
            .social-mobile,
            .main-navigation .mega-menu li .sub-menu li:last-child > a,
            .widget_shopping_cart_content ul li,
            .header-profile ul li,
            .contact-mobile {
              border-color: {$cryptcio_settings['header1-border-color']};
            }
            @media (max-width: 991px){
                .main-navigation .mega-menu > li.menu-item > a,
                .nav-sections ul.nav-tabs,
                .nav-sections .nav-tabs > li,
                .nav-tabs > li > a,
                .main-navigation .caret-submenu,
                .main-navigation .menu-block1,
                .main-navigation .menu-block2,
				#account .mega-menu li:first-child a,
                #account .mega-menu li a{
                    border-color: {$cryptcio_settings['header1-border-color']};
                }
            }
        ";
    } 
	if(isset($cryptcio_settings['header1-mb-border-color']) && $cryptcio_settings['header1-mb-border-color'] !=''){
        $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .header-container .main-navigation .mega-menu > li.menu-item > a,
				.header-container .main-navigation .mega-menu > li.menu-item:first-child > a,
                .nav-sections ul.nav-tabs,
                .nav-sections .nav-tabs > li,
                .nav-tabs > li > a,
                .main-navigation .caret-submenu,
                .main-navigation .menu-block1,
                .main-navigation .menu-block2,
                #account .mega-menu li a{
                    border-color: {$cryptcio_settings['header1-mb-border-color']};
                }
            }
        ";
    } 
    if(isset($cryptcio_settings['header-bg-image']) && $cryptcio_settings['header-bg-image'] !=''){
        $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .fixed-header .header-bottom{
                    background-image: url('{$cryptcio_settings['header-bg-image']['background-image']}');
                    background-repeat: {$cryptcio_settings['header-bg-image']['background-repeat']};
                    background-size: {$cryptcio_settings['header-bg-image']['background-size']};
                    background-attachment: {$cryptcio_settings['header-bg-image']['background-attachment']};
                    background-position: {$cryptcio_settings['header-bg-image']['background-position']};               
                }
            }
        ";          
    }
    if(isset($cryptcio_settings['header1-bg-image']) && $cryptcio_settings['header1-bg-image'] !=''){
        $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .fixed-header .header-bottom{
                    background-image: url('{$cryptcio_settings['header1-bg-image']['background-image']}');
                    background-repeat: {$cryptcio_settings['header1-bg-image']['background-repeat']};
                    background-size: {$cryptcio_settings['header1-bg-image']['background-size']};
                    background-attachment: {$cryptcio_settings['header1-bg-image']['background-attachment']};
                    background-position: {$cryptcio_settings['header1-bg-image']['background-position']};               
                }
            }
        ";          
    }
    if(isset($cryptcio_settings['header-overlay-color']) && $cryptcio_settings['header-overlay-color'] !=''){
        $cryptcio_custom_css .= "
            .header-wrapper::before{
                background-color: {$cryptcio_settings['header-overlay-color']};
            }
        ";        
    } 
    if(isset($cryptcio_settings['header-opacity']) && $cryptcio_settings['header-opacity'] !=''){
        $cryptcio_custom_css .= "
            .header-wrapper::before{
                opacity: {$cryptcio_settings['header-opacity']};
            }
        ";        
    }
    if(isset($cryptcio_settings['header1-fixed-bgcolor']) && $cryptcio_settings['header1-fixed-bgcolor'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v1:not(.is-sticky){
                background-color: {$cryptcio_settings['header1-fixed-bgcolor']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header1-fixed-color']) && $cryptcio_settings['header1-fixed-color'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v1:not(.is-sticky) .search-block-top > .btn-search i,
            .fixed-header .header-v1:not(.is-sticky) .header-profile ul a,
            .fixed-header .header-v1:not(.is-sticky) .mini-cart .cart_label,
            .fixed-header .header-v1:not(.is-sticky) .header-notice p,
            .fixed-header .header-v1:not(.is-sticky) .open-menu-mobile,
            .fixed-header .header-v1:not(.is-sticky) .languges-flags a{
                color: {$cryptcio_settings['header1-fixed-color']};
            }
            .fixed-header .header-v1:not(.is-sticky) .languges-flags a{
                border-color: {$cryptcio_settings['header1-fixed-color']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header1-fixed-menu-color']) && $cryptcio_settings['header1-fixed-menu-color'] !=''){
        $cryptcio_custom_css .= "
            @media (min-width: 992px){
                .fixed-header .header-v1:not(.is-sticky) .header-container .mega-menu > li.menu-item > a{
                    color: {$cryptcio_settings['header1-fixed-menu-color']};
                } 
            }
        ";         
    }  

    /* Header 2 options */
    if(isset($cryptcio_settings['height2_middle']) && $cryptcio_settings['height2_middle'] !=''){
        if(isset($cryptcio_settings['height2_middle']['height']) && $cryptcio_settings['height2_middle']['height']!=''){
            $cryptcio_custom_css .= "
                .header-v2 .header-middle .display-flex,
                .header-v2 .header-container .mega-menu > li.menu-item > a{
                    height: {$cryptcio_settings['height2_middle']['height']};
                }
            ";    
        }       
    }
    if(isset($cryptcio_settings['header2-bg']) && $cryptcio_settings['header2-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v2,
            .header-v2 .mega-menu li .sub-menu,
            .header-v2 .content-filter,
            .header-v2 .header-ver,
            .header-v2 .searchform_wrap{
                background-color: {$cryptcio_settings['header2-bg']};
            }
            @media (max-width: 991px){
                .header-v2 .header-center{
                    background-color: {$cryptcio_settings['header2-bg']};
                }
            }
        ";         
    }
    if(isset($cryptcio_settings['header2-bg-hover']) && $cryptcio_settings['header2-bg-hover'] !=''){
        $cryptcio_custom_css .= "
            .header-v2 .header-container .mega-menu li .sub-menu li a:hover{
                 background-color: {$cryptcio_settings['header2-bg-hover']};
            }
        ";         
    }
    if(isset($cryptcio_settings['header2-top-color']) && $cryptcio_settings['header2-top-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v2 .header-top-link .header-contact li a,
            .header-v2 .header-top-link .header-profile ul a,
            .header-v2 .header-top-link .header-contact li p{
                color: {$cryptcio_settings['header2-top-color']};
            }
        ";        
    } 
    if(isset($cryptcio_settings['header2-color']) && $cryptcio_settings['header2-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v2 .mega-menu > li.menu-item > a{
                font-family: {$cryptcio_settings['header2-color']['font-family']};
                font-size: {$cryptcio_settings['header2-color']['font-size']};
                font-weight: {$cryptcio_settings['header2-color']['font-weight']};
                text-transform: {$cryptcio_settings['header2-color']['text-transform']};
            }
            .header-v2 .nav-sections .nav-tabs > li > a,
            .header-v2 .social-mobile h5,
            .header-v2 .contact-mobile h5,
            .header-v2 .header-contact a,
            .header-v2 .mega-menu > li > a,
            .header-v2 .mega-menu li .sub-menu li a,
            .header-v2 .widget_shopping_cart_content ul li.empty,
            .header-v2 .mini-cart .count-item > p,
            .header-v2 .search-block-top > .btn-search{
                color: {$cryptcio_settings['header2-color']['color']};
            }
            .header-v2 .open-menu-mobile{
                color: {$cryptcio_settings['header2-color']['color']};
            }
        ";        
    }

    if(isset($cryptcio_settings['header2-border-color']) && $cryptcio_settings['header2-border-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v2 .header-container .mega-menu li .sub-menu li a, 
            .header-v2 .searchform_wrap .vc_child, 
            .header-v2 .social-mobile, 
            .header-v2 .main-navigation .mega-menu li .sub-menu li:last-child > a, 
            .header-v2 .widget_shopping_cart_content ul li, 
            .header-v2 .header-profile ul li,  
            .header-v2 .widget_shopping_cart_content ul li.empty,
            .header-v2 .contact-mobile{
                border-color: {$cryptcio_settings['header2-border-color']};
            }
        ";
    } 
	if(isset($cryptcio_settings['header2-mb-border-color']) && $cryptcio_settings['header2-mb-border-color'] !=''){
        $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .header-v2 .main-navigation .mega-menu > li.menu-item > a,
				.header-v2 .main-navigation .mega-menu > li.menu-item:first-child > a,
                .header-v2 .nav-sections ul.nav-tabs,
                .header-v2 .nav-sections .nav-tabs > li,
                .header-v2 .nav-tabs > li > a,
                .header-v2 .main-navigation .caret-submenu,
                .header-v2 .main-navigation .menu-block1,
                .header-v2 .main-navigation .menu-block2,
				.header-v2 #account .mega-menu li:first-child a,
                .header-v2 #account .mega-menu li a{
                    border-color: {$cryptcio_settings['header2-mb-border-color']};
                }
            }
        ";
    } 
    if(isset($cryptcio_settings['header2-fixed-bgcolor']) && $cryptcio_settings['header2-fixed-bgcolor'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v2:not(.is-sticky){
                background-color: {$cryptcio_settings['header2-fixed-bgcolor']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header2-fixed-color']) && $cryptcio_settings['header2-fixed-color'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v2:not(.is-sticky) .btn-search i,
            .fixed-header .header-v2:not(.is-sticky) .header-profile ul a,
            .fixed-header .header-v2:not(.is-sticky) .mini-cart .cart_label,
            .fixed-header .header-v2:not(.is-sticky) .header-notice p,
            .fixed-header .header-v2:not(.is-sticky) .open-menu-mobile,
            .fixed-header .header-v2:not(.is-sticky) .languges-flags a{
                color: {$cryptcio_settings['header2-fixed-color']};
            }
            .fixed-header .header-v2:not(.is-sticky) .languges-flags a{
                border-color: {$cryptcio_settings['header2-fixed-color']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header2-fixed-menu-color']) && $cryptcio_settings['header2-fixed-menu-color'] !=''){
        $cryptcio_custom_css .= "
            @media (min-width: 992px){
                .fixed-header .header-v2:not(.is-sticky) .header-container .mega-menu > li.menu-item > a{
                    color: {$cryptcio_settings['header2-fixed-menu-color']};
                } 
            }
        ";         
    } 
    /* Header 3 Options */
    if(isset($cryptcio_settings['height3_middle']) && $cryptcio_settings['height3_middle'] !=''){
        if(isset($cryptcio_settings['height3_middle']['height']) && $cryptcio_settings['height3_middle']['height']!=''){
            $cryptcio_custom_css .= "
                .header-v3 .header-middle .display-flex{
                    height: {$cryptcio_settings['height3_middle']['height']};
                }
            ";    
        }       
    }
    if(isset($cryptcio_settings['header3-top-color']) && $cryptcio_settings['header3-top-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v3 .header-top-link .header-contact li a,
            .header-v3 .header-top-link .header-profile ul a,
            .header-v3 .header-top-link .header-contact li p{
                color: {$cryptcio_settings['header3-top-color']};
            }
        ";        
    } 
    if(isset($cryptcio_settings['header3-bg']) && $cryptcio_settings['header3-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v3,
            .header-v3 .mega-menu li .sub-menu,
            .header-v3 .content-filter,
            .header-v3 .header-ver,
            .header-v3 .searchform_wrap{
                background-color: {$cryptcio_settings['header3-bg']};
            }
            @media (max-width: 991px){
                .header-v3 .header-center{
                    background-color: {$cryptcio_settings['header3-bg']};
                }
            }
        ";         
    }
    if(isset($cryptcio_settings['header3-bg-hover']) && $cryptcio_settings['header3-bg-hover'] !=''){
        $cryptcio_custom_css .= "
            .header-v3 .header-container .mega-menu li .sub-menu li a:hover{
                background-color: {$cryptcio_settings['header3-bg-hover']};
            }
        ";         
    }
   
    if(isset($cryptcio_settings['header3-color']) && $cryptcio_settings['header3-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v3 .mega-menu > li.menu-item > a{
                font-family: {$cryptcio_settings['header3-color']['font-family']};
                font-size: {$cryptcio_settings['header3-color']['font-size']};
                font-weight: {$cryptcio_settings['header3-color']['font-weight']};
                text-transform: {$cryptcio_settings['header3-color']['text-transform']};
            }
            .header-v3 .nav-sections .nav-tabs > li > a,
            .header-v3 .social-mobile h5,
            .header-v3 .contact-mobile h5,
            .header-v3 .header-contact a,
            .header-v3 .mega-menu > li > a,
            .header-v3 .mega-menu li .sub-menu li a,
            .header-v3 .widget_shopping_cart_content ul li.empty,
            .header-v3 .mini-cart .count-item > p,
            .header-v3 .header-center h5,
            .header-v3 .search-block-top > .btn-search,
            .header-v3 .open-menu-mobile{
                color: {$cryptcio_settings['header3-color']['color']};
            }
        ";        
    } 
    if(isset($cryptcio_settings['header3-active-color']) && $cryptcio_settings['header3-active-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v3 .header-container .mega-menu > li.menu-item > a:hover,
            .header-v3 .mega-menu > li.menu-item.current-menu-parent > a,
            .header-v3 .search-block-top > .btn-search:hover{
                color: {$cryptcio_settings['header3-active-color']} !important;
            }
        ";
    } 
    
    if(isset($cryptcio_settings['header3-sticky-active-color']) && $cryptcio_settings['header3-sticky-active-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v3.is-sticky .header-container .mega-menu > li.menu-item > a:hover,
            .header-v3.is-sticky .mega-menu > li.menu-item.current-menu-parent > a,
            .header-v3.is-sticky .search-block-top > .btn-search:hover{
                color: {$cryptcio_settings['header3-sticky-active-color']} !important;
            }
        ";
    }     
    if(isset($cryptcio_settings['header3-border-color']) && $cryptcio_settings['header3-border-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v3 .header-container .mega-menu li .sub-menu li a, 
            .header-v3 .searchform_wrap .vc_child, 
            .header-v3 .social-mobile, 
            .header-v3 .main-navigation .mega-menu li .sub-menu li:last-child > a, 
            .header-v3 .widget_shopping_cart_content ul li, 
            .header-v3 .header-profile ul li,  
            .header-v3 .contact-mobile{
                border-color: {$cryptcio_settings['header3-border-color']};
            }
        ";
    } 
	if(isset($cryptcio_settings['header3-mb-border-color']) && $cryptcio_settings['header3-mb-border-color'] !=''){
        $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .header-v3 .main-navigation .mega-menu > li.menu-item > a,
				.header-v3 .main-navigation .mega-menu > li.menu-item:first-child > a,
                .header-v3 .nav-sections ul.nav-tabs,
                .header-v3 .nav-sections .nav-tabs > li,
                .header-v3 .nav-tabs > li > a,
				.header-v3 #account .mega-menu li:first-child a,
                .header-v3 .main-navigation .caret-submenu,
                .header-v3 .main-navigation .menu-block1,
                .header-v3 .main-navigation .menu-block2,
                .header-v3 #account .mega-menu li a{
                    border-color: {$cryptcio_settings['header3-mb-border-color']};
                }
            }
        ";
    } 
    if(isset($cryptcio_settings['header3-fixed-bgcolor']) && $cryptcio_settings['header3-fixed-bgcolor'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v3:not(.is-sticky){
                background-color: {$cryptcio_settings['header3-fixed-bgcolor']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header3-fixed-color']) && $cryptcio_settings['header3-fixed-color'] !=''){
        $cryptcio_custom_css .= "
            
            .fixed-header .header-v3:not(.is-sticky) .header-profile ul a,
            .fixed-header .header-v3:not(.is-sticky) .mini-cart .cart_label,
            .fixed-header .header-v3:not(.is-sticky) .header-notice p,
            .fixed-header .header-v3:not(.is-sticky) .open-menu-mobile,
            .fixed-header .header-v3:not(.is-sticky) .languges-flags a{
                color: {$cryptcio_settings['header3-fixed-color']};
            }
            .fixed-header .header-v3:not(.is-sticky) .languges-flags a{
                border-color: {$cryptcio_settings['header3-fixed-color']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header3-fixed-menu-color']) && $cryptcio_settings['header3-fixed-menu-color'] !=''){
        $cryptcio_custom_css .= "
            @media (min-width: 992px){
                .fixed-header .header-v3:not(.is-sticky) .header-container .mega-menu > li.menu-item > a,
                .fixed-header .header-v3:not(.is-sticky) .search-block-top > .btn-search i,{
                    color: {$cryptcio_settings['header3-fixed-menu-color']};
                } 
            }
        ";         
    } 
    /* Header 4 Options */
    if(isset($cryptcio_settings['header4-bg']) && $cryptcio_settings['header4-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v4,
            .header-v4 .mega-menu li .sub-menu,
            .header-v4 .content-filter,
            .header-v4 .header-ver,
            .header-v4 .searchform_wrap{
                background-color: {$cryptcio_settings['header4-bg']};
            }
            @media (max-width: 991px){
                .header-v4 .header-center{
                    background-color: {$cryptcio_settings['header4-bg']};
                }
            }
        ";         
    }
    if(isset($cryptcio_settings['header4-top-bg']) && $cryptcio_settings['header4-top-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v4 .header-topinfo{
                background-color: {$cryptcio_settings['header4-top-bg']};
            }
        ";         
    }
    if(isset($cryptcio_settings['header4-bg-hover']) && $cryptcio_settings['header4-bg-hover'] !=''){
        $cryptcio_custom_css .= "
            .header-v4 .header-container .mega-menu li .sub-menu li a:hover{
                background-color: {$cryptcio_settings['header4-bg-hover']};
            }
        ";         
    }
   
    if(isset($cryptcio_settings['header4-color']) && $cryptcio_settings['header4-color'] !=''){
      $header4_family = (isset($cryptcio_settings['header4-color']['font-family'])&& $cryptcio_settings['header4-color']['font-family']!='')? $cryptcio_settings['header4-color']['font-family']:'Poppins';
      $header4_fweight = (isset($cryptcio_settings['header4-color']['font-weight'])&& $cryptcio_settings['header4-color']['font-weight']!='')? $cryptcio_settings['header4-color']['font-weight']:'700';
      $header4_transform = (isset($cryptcio_settings['header4-color']['font-transform'])&& $cryptcio_settings['header4-color']['font-transform']!='')? $cryptcio_settings['header4-color']['font-transform']:'uppercase';
      $header4_fsize = (isset($cryptcio_settings['header4-color']['font-size'])&& $cryptcio_settings['header4-color']['font-size']!='')? $cryptcio_settings['header4-color']['font-size']:'14px';
      $header4_color = (isset($cryptcio_settings['header4-color']['color'])&& $cryptcio_settings['header4-color']['color']!='')? $cryptcio_settings['header4-color']['color']:'#fff';

        $cryptcio_custom_css .= "
            .header-v4 .mega-menu > li.menu-item > a{
                font-family: {$header4_family};
                font-size: {$header4_fsize};
                font-weight: {$header4_fweight};
                text-transform: {$header4_transform};
            }
            @media (min-width: 992px){
                  .header-v4 .header-topinfo .header-contact li p, 
                  .header-v4 .header-topinfo .header-contact li a,
                  .header-v4 .header-topinfo .header-contact li,
                  .header-v4 .header-contact a,
                  .header-v4 .mega-menu > li > a,
                  .header-v4 .open-menu-mobile{
                    color: {$header4_color};
                  }
                  .header-v4 .social_icon li a{
                        background-color: {$header4_color};
                  }
                  .header-v4 .social_icon a,
                  .header-v4 .header-profile a,
                  .fixed-header .header-v4 .header-container{
                        border-color: {$header4_color};
                  }
            }
        ";        
    } 
    if(isset($cryptcio_settings['header4-border-color']) && $cryptcio_settings['header4-border-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v4 .header-container .mega-menu li .sub-menu li a, 
            .header-v4 .searchform_wrap .vc_child, 
            .header-v4 .social-mobile, 
            .header-v4 .main-navigation .mega-menu li .sub-menu li:last-child > a, 
            .header-v4 .widget_shopping_cart_content ul li, 
            .header-v4 .header-profile ul li,  
            .header-v4 .contact-mobile{
                border-color: {$cryptcio_settings['header4-border-color']};
            }
        ";
    } 
	if(isset($cryptcio_settings['header4-mb-border-color']) && $cryptcio_settings['header4-mb-border-color'] !=''){
        $cryptcio_custom_css .= "
            @media (max-width: 991px){
				.header-v4 .header-tops,
                .header-v4 .main-navigation .mega-menu > li.menu-item > a,
                .header-v4 .nav-sections ul.nav-tabs,
                .header-v4 .nav-sections .nav-tabs > li,
                .header-v4 .nav-tabs > li > a,
                .header-v4 .main-navigation .caret-submenu,
                .header-v4 .main-navigation .menu-block1,
                .header-v4 .main-navigation .menu-block2,
                .header-v4 #account .mega-menu li a,
				.header-v4 #account .mega-menu li:first-child a,
				.header-v4 .main-navigation .mega-menu > li.menu-item:first-child > a{
                    border-color: {$cryptcio_settings['header4-mb-border-color']};
                }
            }
        ";
    } 
    if(isset($cryptcio_settings['header4-fixed-bgcolor']) && $cryptcio_settings['header4-fixed-bgcolor'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v4:not(.is-sticky){
                background-color: {$cryptcio_settings['header4-fixed-bgcolor']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header4-fixed-color']) && $cryptcio_settings['header4-fixed-color'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v4:not(.is-sticky) .btn-search i,
            .fixed-header .header-v4:not(.is-sticky) .header-profile ul a,
            .fixed-header .header-v4:not(.is-sticky) .mini-cart .cart_label,
            .fixed-header .header-v4:not(.is-sticky) .header-notice p,
            .fixed-header .header-v4:not(.is-sticky) .open-menu-mobile,
            .fixed-header .header-v4:not(.is-sticky) .languges-flags a{
                color: {$cryptcio_settings['header4-fixed-color']};
            }
            .fixed-header .header-v4:not(.is-sticky) .languges-flags a{
                border-color: {$cryptcio_settings['header4-fixed-color']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header4-fixed-menu-color']) && $cryptcio_settings['header4-fixed-menu-color'] !=''){
        $cryptcio_custom_css .= "
            @media (min-width: 992px){
                .fixed-header .header-v4:not(.is-sticky) .header-container .mega-menu > li.menu-item > a{
                    color: {$cryptcio_settings['header4-fixed-menu-color']};
                } 
            }
        ";         
    } 
	/* Header 5 options */
    if(isset($cryptcio_settings['height5_middle']) && $cryptcio_settings['height5_middle'] !=''){
        if(isset($cryptcio_settings['height5_middle']['height']) && $cryptcio_settings['height5_middle']['height']!=''){
            $cryptcio_custom_css .= "
                .header-v5 .header-middle .display-flex,
                .header-v5 .header-container .mega-menu > li.menu-item > a{
                    height: {$cryptcio_settings['height5_middle']['height']};
                }
            ";    
        }       
    }
    if(isset($cryptcio_settings['header5-bg']) && $cryptcio_settings['header5-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v5,
            .header-v5 .mega-menu li .sub-menu,
            .header-v5 .content-filter,
            .header-v5 .header-ver,
            .header-v5 .searchform_wrap{
                background-color: {$cryptcio_settings['header5-bg']};
            }
            @media (max-width: 991px){
                .header-v5 .header-center{
                    background-color: {$cryptcio_settings['header5-bg']};
                }
            }
        ";         
    }
    if(isset($cryptcio_settings['header5-bg-hover']) && $cryptcio_settings['header5-bg-hover'] !=''){
        $cryptcio_custom_css .= "
            .header-v5 .header-container .mega-menu li .sub-menu li a:hover{
                 background-color: {$cryptcio_settings['header5-bg-hover']};
            }
        ";         
    }
    if(isset($cryptcio_settings['header5-top-color']) && $cryptcio_settings['header5-top-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v5 .header-top-link .header-contact li a,
            .header-v5 .header-top-link .header-profile ul a,
            .header-v5 .header-top-link .header-contact li p{
                color: {$cryptcio_settings['header5-top-color']};
            }
        ";        
    } 
    if(isset($cryptcio_settings['header5-color']) && $cryptcio_settings['header5-color'] !=''){
        if(isset($cryptcio_settings['header5-color']['text-transform']) && $cryptcio_settings['header5-color']['text-transform'] !=''){
            $cryptcio_custom_css .= "
                .header-v5 .mega-menu > li.menu-item > a{
                    text-transform: {$cryptcio_settings['header5-color']['text-transform']};
                }";
        }
        if(isset($cryptcio_settings['header5-color']['font-family']) && $cryptcio_settings['header5-color']['font-family'] !=''){
            $cryptcio_custom_css .= "
                .header-v5 .mega-menu > li.menu-item > a{
                    font-family: {$cryptcio_settings['header5-color']['font-family']};
                }";                
        }
        if(isset($cryptcio_settings['header5-color']['font-size']) && $cryptcio_settings['header5-color']['font-size'] !=''){
        $cryptcio_custom_css .= "
            .header-v5 .mega-menu > li.menu-item > a{
                font-size: {$cryptcio_settings['header5-color']['font-size']};
            }";
        }   
        if(isset($cryptcio_settings['header5-color']['font-weight']) && $cryptcio_settings['header5-color']['font-weight'] !=''){
        $cryptcio_custom_css .= "
            .header-v5 .mega-menu > li.menu-item > a{
                font-weight: {$cryptcio_settings['header5-color']['font-weight']};
            }";
        }                     
        if(isset($cryptcio_settings['header5-color']['color']) && $cryptcio_settings['header5-color']['color'] !=''){
            $cryptcio_custom_css .= ".header-v5 .nav-sections .nav-tabs > li > a,
                .header-v5 .social-mobile h5,
                .header-v5 .contact-mobile h5,
                .header-v5 .header-contact a,
                .header-v5 .mega-menu > li > a,
                .header-v5 .mega-menu li .sub-menu li a,
                .header-v5 .widget_shopping_cart_content ul li.empty,
                .header-v5 .mini-cart .count-item > p,
                .header-v5 .search-block-top > .btn-search{
                    color: {$cryptcio_settings['header5-color']['color']};
                }
                .header-v5 .open-menu-mobile{
                    color: {$cryptcio_settings['header5-color']['color']};
                }
            ";        
        }
    }

    if(isset($cryptcio_settings['header5-border-color']) && $cryptcio_settings['header5-border-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v5 .header-container .mega-menu li .sub-menu li a, 
            .header-v5 .searchform_wrap .vc_child, 
            .header-v5 .social-mobile, 
            .header-v5 .main-navigation .mega-menu li .sub-menu li:last-child > a, 
            .header-v5 .widget_shopping_cart_content ul li, 
            .header-v5 .header-profile ul li,  
            .header-v5 .widget_shopping_cart_content ul li.empty,
            .header-v5 .contact-mobile{
                border-color: {$cryptcio_settings['header5-border-color']};
            }
        ";
    } 
    if(isset($cryptcio_settings['header5-mb-border-color']) && $cryptcio_settings['header5-mb-border-color'] !=''){
        $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .header-v5 .main-navigation .mega-menu > li.menu-item > a,
                .header-v5 .main-navigation .mega-menu > li.menu-item:first-child > a,
                .header-v5 .nav-sections ul.nav-tabs,
                .header-v5 .nav-sections .nav-tabs > li,
                .header-v5 .nav-tabs > li > a,
                .header-v5 .main-navigation .caret-submenu,
                .header-v5 .main-navigation .menu-block1,
                .header-v5 .main-navigation .menu-block2,
                .header-v5 #account .mega-menu li:first-child a,
                .header-v5 #account .mega-menu li a{
                    border-color: {$cryptcio_settings['header5-mb-border-color']};
                }
            }
        ";
    } 
    if(isset($cryptcio_settings['header5-fixed-bgcolor']) && $cryptcio_settings['header5-fixed-bgcolor'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v5:not(.is-sticky){
                background-color: {$cryptcio_settings['header5-fixed-bgcolor']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header5-fixed-color']) && $cryptcio_settings['header5-fixed-color'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v5:not(.is-sticky) .btn-search i,
            .fixed-header .header-v5:not(.is-sticky) .header-profile ul a,
            .fixed-header .header-v5:not(.is-sticky) .mini-cart .cart_label,
            .fixed-header .header-v5:not(.is-sticky) .header-notice p,
            .fixed-header .header-v5:not(.is-sticky) .open-menu-mobile,
            .fixed-header .header-v5:not(.is-sticky) .languges-flags a{
                color: {$cryptcio_settings['header5-fixed-color']};
            }
            .fixed-header .header-v5:not(.is-sticky) .languges-flags a{
                border-color: {$cryptcio_settings['header5-fixed-color']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header5-fixed-menu-color']) && $cryptcio_settings['header5-fixed-menu-color'] !=''){
        $cryptcio_custom_css .= "
            @media (min-width: 992px){
                .fixed-header .header-v5:not(.is-sticky) .header-container .mega-menu > li.menu-item > a{
                    color: {$cryptcio_settings['header5-fixed-menu-color']};
                } 
            }
        ";         
    }    
    /* Header 5 options */
    if(isset($cryptcio_settings['header6_middle']) && $cryptcio_settings['header6_middle'] !=''){
        if(isset($cryptcio_settings['header6_middle']['height']) && $cryptcio_settings['header6_middle']['height']!=''){
            $cryptcio_custom_css .= "
                .header-v6 .header-middle .display-flex,
                .header-v6 .header-middle .header-container .mega-menu > li.menu-item > a{
                    height: {$cryptcio_settings['header6_middle']['height']};
                }
            ";    
        }       
    }
    if(isset($cryptcio_settings['header6_menu']) && $cryptcio_settings['header6_menu'] !=''){
        if(isset($cryptcio_settings['header6_menu']['height']) && $cryptcio_settings['header6_menu']['height']!=''){
            $cryptcio_custom_css .= "
                .header-v6 .header-menu .header-container .mega-menu > li.menu-item > a,
                .header-v6 .header-menu .display-flex{
                    height: {$cryptcio_settings['header6_menu']['height']};
                }
            ";    
        }       
    }
    if(isset($cryptcio_settings['header6-bg']) && $cryptcio_settings['header6-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v6,
            .header-v6 .mega-menu li .sub-menu,
            .header-v6 .content-filter,
            .header-v6 .header-ver,
            .header-v6 .searchform_wrap{
                background-color: {$cryptcio_settings['header6-bg']};
            }
            @media (max-width: 991px){
                .header-v6 .header-center{
                    background-color: {$cryptcio_settings['header6-bg']};
                }
            }
        ";         
    }
    if(isset($cryptcio_settings['header6-middle-bg']) && $cryptcio_settings['header6-middle-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v6 .header-middle{
                background-color: {$cryptcio_settings['header6-middle-bg']};
            }
        ";         
    }
    if(isset($cryptcio_settings['header6-menu-bg']) && $cryptcio_settings['header6-menu-bg'] !=''){
        $cryptcio_custom_css .= "
            .header-v6 .header-menu{
                background-color: {$cryptcio_settings['header6-menu-bg']};
            }
        ";         
    }
    if(isset($cryptcio_settings['header6-bg-hover']) && $cryptcio_settings['header6-bg-hover'] !=''){
        $cryptcio_custom_css .= "
            .header-v6 .header-container .mega-menu li .sub-menu li a:hover{
                 background-color: {$cryptcio_settings['header6-bg-hover']};
            }
        ";         
    }
    if(isset($cryptcio_settings['header6-top-color']) && $cryptcio_settings['header6-top-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v6 .header-top-link .header-contact li a,
            .header-v6 .header-top-link .header-profile ul a,
            .header-v6 .header-top-link .header-contact li p,
            .header-v6 .social-icon li a,
            .header-v6 .header-middle .header-container .mega-menu > li.menu-item > a{
                color: {$cryptcio_settings['header6-top-color']};
            }
        ";        
    } 
    if(isset($cryptcio_settings['header6-color']) && $cryptcio_settings['header6-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v6 .mega-menu > li.menu-item > a{
                font-family: {$cryptcio_settings['header6-color']['font-family']};
                font-size: {$cryptcio_settings['header6-color']['font-size']};
                font-weight: {$cryptcio_settings['header6-color']['font-weight']};
                text-transform: {$cryptcio_settings['header6-color']['text-transform']};
            }
            .header-v6 .nav-sections .nav-tabs > li > a,
            .header-v6 .social-mobile h5,
            .header-v6 .contact-mobile h5,
            .header-v6 .header-contact a,
            .header-v6 .mega-menu > li > a,
            .header-v6 .mega-menu li .sub-menu li a,
            .header-v6 .widget_shopping_cart_content ul li.empty,
            .header-v6 .mini-cart .count-item > p,
            .header-v6 .search-block-top > .btn-search{
                color: {$cryptcio_settings['header6-color']['color']};
            }
            .header-v6 .open-menu-mobile{
                color: {$cryptcio_settings['header6-color']['color']};
            }
        ";        
    }

    if(isset($cryptcio_settings['header6-border-color']) && $cryptcio_settings['header6-border-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v6 .header-container .mega-menu li .sub-menu li a, 
            .header-v6 .searchform_wrap .vc_child, 
            .header-v6 .social-mobile, 
            .header-v6 .main-navigation .mega-menu li .sub-menu li:last-child > a, 
            .header-v6 .widget_shopping_cart_content ul li, 
            .header-v6 .header-profile ul li,  
            .header-v6 .widget_shopping_cart_content ul li.empty,
            .header-v6 .contact-mobile{
                border-color: {$cryptcio_settings['header6-border-color']};
            }
        ";
    } 
    if(isset($cryptcio_settings['header6-mb-border-color']) && $cryptcio_settings['header6-mb-border-color'] !=''){
        $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .header-v6 .main-navigation .mega-menu > li.menu-item > a,
                .header-v6 .main-navigation .mega-menu > li.menu-item:first-child > a,
                .header-v6 .nav-sections ul.nav-tabs,
                .header-v6 .nav-sections .nav-tabs > li,
                .header-v6 .nav-tabs > li > a,
                .header-v6 .main-navigation .caret-submenu,
                .header-v6 .main-navigation .menu-block1,
                .header-v6 .main-navigation .menu-block2,
                .header-v6 #account .mega-menu li:first-child a,
                .header-v6 #account .mega-menu li a{
                    border-color: {$cryptcio_settings['header6-mb-border-color']};
                }
            }
        ";
    } 
    if(isset($cryptcio_settings['header6-fixed-bgcolor']) && $cryptcio_settings['header6-fixed-bgcolor'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v6:not(.is-sticky){
                background-color: {$cryptcio_settings['header6-fixed-bgcolor']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header6-fixed-color']) && $cryptcio_settings['header6-fixed-color'] !=''){
        $cryptcio_custom_css .= "
            .fixed-header .header-v6:not(.is-sticky) .btn-search i,
            .fixed-header .header-v6:not(.is-sticky) .header-profile ul a,
            .fixed-header .header-v6:not(.is-sticky) .mini-cart .cart_label,
            .fixed-header .header-v6:not(.is-sticky) .header-notice p,
            .fixed-header .header-v6:not(.is-sticky) .open-menu-mobile,
            .fixed-header .header-v6:not(.is-sticky) .languges-flags a{
                color: {$cryptcio_settings['header6-fixed-color']};
            }
            .fixed-header .header-v6:not(.is-sticky) .languges-flags a{
                border-color: {$cryptcio_settings['header6-fixed-color']};
            }
        ";         
    }  
    if(isset($cryptcio_settings['header6-fixed-menu-color']) && $cryptcio_settings['header6-fixed-menu-color'] !=''){
        $cryptcio_custom_css .= "
            @media (min-width: 992px){
                .fixed-header .header-v6:not(.is-sticky) .header-container .mega-menu > li.menu-item > a{
                    color: {$cryptcio_settings['header6-fixed-menu-color']};
                } 
            }
        ";         
    }  
    //Preload Options
    if(isset($cryptcio_settings['preloader-color']) && $cryptcio_settings['preloader-color'] !=''){
        $cryptcio_custom_css .= "
            .object, .loader:before,
            .object-2, .object-6,#object-7,
            .busy-loader .w-ball-wrapper .w-ball,
            .pacman > div:nth-child(3),
            .pacman > div:nth-child(4),
            .pacman > div:nth-child(5),
            .pacman > div:nth-child(6),
            .object-9,
            .preloader8 span,
            body .baby .back,
            body .baby .back .tail,
            body .baby .back .feet,
            body .baby .back .hand,
            body .baby .back .hand:after,
            body .baby .back .ass,
            body .baby .back .ass:after,
            body .baby .head,
            body .baby .head .horn{
                background-color: {$cryptcio_settings['preloader-color']};
            }
            .object-3{
                border-top-color: {$cryptcio_settings['preloader-color']};
            }
            .object-3{
                border-left-color: {$cryptcio_settings['preloader-color']};
            }
            .pacman > div:first-of-type,
            .pacman > div:nth-child(2){
                border-color: {$cryptcio_settings['preloader-color']};
            }
        ";         
    }
    if(isset($cryptcio_settings['preloader-bg']) && $cryptcio_settings['preloader-bg'] !=''){
        $cryptcio_custom_css .= "
            #loading, #loading-2, #loading-3, 
            .preloader-4, .preloader-5, #loading-6,
            #loading-7, #loading-9, .loader-8{
                background-color: {$cryptcio_settings['preloader-bg']};
            }
        ";         
    }
    if(isset($cryptcio_settings['header7-color']) && $cryptcio_settings['header7-color']!=''){
      $header7_family = (isset($cryptcio_settings['header7-color']['font-family'])&& $cryptcio_settings['header7-color']['font-family']!='')? $cryptcio_settings['header7-color']['font-family']:"Open Sans";
      $header7_fweight = (isset($cryptcio_settings['header7-color']['font-weight'])&& $cryptcio_settings['header7-color']['font-weight']!='')? $cryptcio_settings['header7-color']['font-weight']:'500';
      $header7_transform = (isset($cryptcio_settings['header7-color']['font-transform'])&& $cryptcio_settings['header7-color']['font-transform']!='')? $cryptcio_settings['header7-color']['font-transform']:'uppercase';
      $header7_fsize = (isset($cryptcio_settings['header7-color']['font-size'])&& $cryptcio_settings['header7-color']['font-size']!='')? $cryptcio_settings['header7-color']['font-size']:'14px';
      $header7_color = (isset($cryptcio_settings['header7-color']['color'])&& $cryptcio_settings['header7-color']['color']!='')? $cryptcio_settings['header7-color']['color']:'#fff';      
        $cryptcio_custom_css .= "
            @media (min-width: 992px){
                  .header-v7 .open-menu-mobile,.header-v7 .mega-menu > li.menu-item > a{
                        color: {$header7_color};
                  }
            }
            .header-v7 .mega-menu > li.menu-item > a{
                  font-weight: {$header7_fweight};
                  font-family: {$header7_family};
                  font-size: {$header7_fsize};
                  text-transform: {$header7_transform};
            }
        ";
    }
    if(isset($cryptcio_settings['header7-top-color']) && $cryptcio_settings['header7-top-color']!=''){
      $header7_family = (isset($cryptcio_settings['header7-top-color']['font-family'])&& $cryptcio_settings['header7-top-color']['font-family']!='')? $cryptcio_settings['header7-top-color']['font-family']:'Open Sans';
      $header7_fweight = (isset($cryptcio_settings['header7-top-color']['font-weight'])&& $cryptcio_settings['header7-top-color']['font-weight']!='')? $cryptcio_settings['header7-top-color']['font-weight']:'bold';
      $header7_transform = (isset($cryptcio_settings['header7-top-color']['font-transform'])&& $cryptcio_settings['header7-top-color']['font-transform']!='')? $cryptcio_settings['header7-top-color']['font-transform']:'uppercase';
      $header7_fsize = (isset($cryptcio_settings['header7-top-color']['font-size'])&& $cryptcio_settings['header7-top-color']['font-size']!='')? $cryptcio_settings['header7-top-color']['font-size']:'16px';
      $header7_color = (isset($cryptcio_settings['header7-top-color']['color'])&& $cryptcio_settings['header7-top-color']['color']!='')? $cryptcio_settings['header7-top-color']['color']:'#999';      
        $cryptcio_custom_css .= "
            .header-v7 .search-block-top > .btn-search, .header-v7 .top-link a{
                  color: {$header7_color};
                  font-weight: {$header7_fweight};
                  font-family: {$header7_family};
                  font-size: {$header7_fsize};
                  text-transform: {$header7_transform};
            }
        ";
    }
    
    if(isset($cryptcio_settings['footer7-t-font']) && $cryptcio_settings['footer7-t-font']!=''){
      $footer7_family = (isset($cryptcio_settings['footer7-t-font']['font-family'])&& $cryptcio_settings['footer7-t-font']['font-family']!='')? $cryptcio_settings['footer7-t-font']['font-family']:'Open Sans';
      $footer7_fweight = (isset($cryptcio_settings['footer7-t-font']['font-weight'])&& $cryptcio_settings['footer7-t-font']['font-weight']!='')? $cryptcio_settings['footer7-t-font']['font-weight']:'700';
      $footer7_transform = (isset($cryptcio_settings['footer7-t-font']['font-transform'])&& $cryptcio_settings['footer7-t-font']['font-transform']!='')? $cryptcio_settings['footer7-t-font']['font-transform']:'uppercase';
      $footer7_fsize = (isset($cryptcio_settings['footer7-t-font']['font-size'])&& $cryptcio_settings['footer7-t-font']['font-size']!='')? $cryptcio_settings['footer7-t-font']['font-size']:'16px';
      // $footer7_color = (isset($cryptcio_settings['footer7-t-font']['color'])&& $cryptcio_settings['footer7-t-font']['color']!='')? $cryptcio_settings['footer7-t-font']['color']:'#999';      
        $cryptcio_custom_css .= "
            .footer-v7 .footer-title{
                  font-weight: {$footer7_fweight};
                  font-family: {$footer7_family};
                  font-size: {$footer7_fsize};
                  text-transform: {$footer7_transform};
            }
        ";
    }          
    //Metabox options
    $cryptcio_body_bg = (cryptcio_get_meta_value('body_bg') != '') ? cryptcio_get_meta_value('body_bg') : '';
    $cryptcio_body_bg_image = (cryptcio_get_meta_value('body_bg_image') != '') ? cryptcio_get_meta_value('body_bg_image') : '';
    $cryptcio_header_bg = (cryptcio_get_meta_value('header_bg') != '') ? cryptcio_get_meta_value('header_bg') : '';  
    $cryptcio_header_bg_hover = (cryptcio_get_meta_value('header_bg_hover') != '') ? cryptcio_get_meta_value('header_bg_hover') : '';  
    $cryptcio_header_color = (cryptcio_get_meta_value('header_color') != '') ? cryptcio_get_meta_value('header_color') : '';  
    $cryptcio_header_border_color = (cryptcio_get_meta_value('header_border_color') != '') ? cryptcio_get_meta_value('header_border_color') : '';    
    $cryptcio_footer_bg = (cryptcio_get_meta_value('footer_bg') != '') ? cryptcio_get_meta_value('footer_bg') : '';
    $cryptcio_footer_bg_image = (cryptcio_get_meta_value('bg_image_footer_page') != '') ? cryptcio_get_meta_value('bg_image_footer_page') : '';
    $cryptcio_f_text_color = (cryptcio_get_meta_value('footer_text_color') != '') ? cryptcio_get_meta_value('footer_text_color') : '';
    $cryptcio_f_link_color = (cryptcio_get_meta_value('footer_link_color') != '') ? cryptcio_get_meta_value('footer_link_color') : '';
     $cryptcio_f_title_color = (cryptcio_get_meta_value('footer_title_color') != '') ? cryptcio_get_meta_value('footer_title_color') : '';
    $cryptcio_backgroud_bottom_color = (cryptcio_get_meta_value('footer_backgroud_bottom_color') != '') ? cryptcio_get_meta_value('footer_backgroud_bottom_color') : '';
    $cryptcio_f_border_color = (cryptcio_get_meta_value('footer_border_color') != '') ? cryptcio_get_meta_value('footer_border_color') : '';  
      if(isset($cryptcio_body_bg)&& $cryptcio_body_bg !='' ){
        $cryptcio_custom_css .= "
            html body, html #main{
                background-color: {$cryptcio_body_bg} !important;
            }
        ";        
      } 
      if(isset($cryptcio_page_highlight_color)&& $cryptcio_page_highlight_color !='' ){
        $cryptcio_custom_css .= "
        
        ";        
      }
      if(isset($cryptcio_body_bg) && $cryptcio_body_bg !='' && $cryptcio_body_bg_image =='' ){
        $cryptcio_custom_css .= "
            html body, html #main{
                background-image: none !important;
            }
        ";        
      } 

      if(isset($cryptcio_body_bg_image)&& $cryptcio_body_bg_image !='' ){
       $cryptcio_layout = cryptcio_get_layout();
        if($cryptcio_layout == 'boxed'){
            $cryptcio_custom_css .= "
                body{
                    background-image: url({$cryptcio_body_bg_image}) !important;
                    background-repeat: repeat !important;
                }
            ";  
        }else{
            $cryptcio_custom_css .= "
                body,#main{
                    background-image: url({$cryptcio_body_bg_image}) !important;
                    background-repeat: repeat !important;
                }
            ";              
        }       
      } 
      if(isset($cryptcio_header_bg) && $cryptcio_header_bg!='' ){
        $cryptcio_custom_css .= "
            .site-header,
            .header-v1,
            .top-search .search-field,
            .fixed-header .header-v1.is-sticky,
            .header-v1 .header-ver,
            .header-v1 .searchform_wrap{
                background-color: {$cryptcio_header_bg} !important;
            }
            @media (max-width: 991px){
                  .fixed-header .header-v1.header-bottom{
                        background-color: {$cryptcio_header_bg} !important;
                  }
            }
        ";        
      }
      if(isset($cryptcio_header_bg_hover) && $cryptcio_header_bg_hover!='' ){
        $cryptcio_custom_css .= "
            .header-container .mega-menu li .sub-menu li a:hover{
                background-color: {$cryptcio_header_bg_hover};
            }
        ";        
      }
      if(isset($cryptcio_header_color) && $cryptcio_header_color!='' ){
        $cryptcio_custom_css .= "
            header.site-header  .header_icon,
            header.site-header .top-search .search-field,
            header.site-header .languges-flags a,
            header.site-header .search-block-top,
            header.site-header .slogan,
            header.site-header .searchform_wrap input,
            header.site-header .searchform_wrap form button,
            header.site-header .mini-cart .product_list_widget .product-content .product-title,
            header.site-header .mega-menu .product_list_widget .product-content .product-title,
            header.site-header .open-menu, 
            header.site-header .open-menu-mobile,
            header.site-header .search-block-top > .btn-search{
                color: {$cryptcio_header_color};
            }
            @media (min-width: 992px){
                  header.site-header .social-mobile h5, 
                  header.site-header .contact-mobile h5,
                  header.site-header .mega-menu > li > a,
                  header.site-header .header-contact a,
                  header .header-container .mega-menu > li.menu-item > a,
                  .header-v1 .header-container .mega-menu > li.menu-item > a{
                    color: {$cryptcio_header_color};
                  }
            }
        ";        
      }
      if(isset($cryptcio_header_border_color) && $cryptcio_header_border_color!='' ){
        $cryptcio_custom_css .= "
            .mega-menu li .sub-menu li a,
            .searchform_wrap .vc_child,
            .social-mobile,
            .main-navigation .mega-menu li .sub-menu li:last-child > a,
            .widget_shopping_cart_content ul li,
            .header-profile ul li,
             .nav-sections .nav-tabs > li,
             .main-navigation .mega-menu > li.menu-item > a, 
             .nav-sections ul.nav-tabs, 
            .nav-tabs > li > a, 
            .main-navigation .caret-submenu, 
            .main-navigation .menu-block1, 
            .main-navigation .menu-block2, #account .mega-menu li a,
            .contact-mobile {
              border-color: {$cryptcio_header_border_color} !important;
            }
            @media (max-width: 991px){
                .main-navigation .mega-menu > li.menu-item > a,
                .nav-sections ul.nav-tabs,
                .nav-tabs > li > a,
                .main-navigation .caret-submenu,
                .main-navigation .menu-block1,
                .main-navigation .menu-block2,
                .header-v7 .header-center,
                .header-bottom.header-v7 .header-center{
                    border-color: {$cryptcio_header_border_color} !important; 
                }
            }
        ";        
      }
      if(isset($cryptcio_footer_bg) && $cryptcio_footer_bg!='' ){
        $cryptcio_custom_css .= "
            .footer-v1, .footer-v2,
            .footer-v3, .footer-v3 .footer_wrap, footer > div{
                background-color: {$cryptcio_footer_bg} !important;
            }
        ";        
      }
      if(isset($cryptcio_backgroud_bottom_color) && $cryptcio_backgroud_bottom_color!='' ){
        $cryptcio_custom_css .= "
            footer .footer-bottom{
                background-color: {$cryptcio_backgroud_bottom_color} !important;
            }
        ";        
      }
      if(isset($cryptcio_footer_bg_image) && $cryptcio_footer_bg_image!='' ){
        $cryptcio_custom_css .= "
            .footer-v1, .footer-v2,
            .footer-v3, .footer-v4{
                background-image: url({$cryptcio_footer_bg_image}) !important;
                background-size: cover;
                background-position: center center;
            }
        ";        
      }
      if(isset($cryptcio_f_title_color) && $cryptcio_f_title_color!=''){
        $cryptcio_custom_css .= "
            .footer .widget_nav_menu li a:hover,
            .footer-v7 .footer-title,
            .footer .contact-form label{
                color: {$cryptcio_f_title_color} !important;
            }
        ";          
      } 
      if(isset($cryptcio_f_text_color) && $cryptcio_f_text_color!=''){
        $cryptcio_custom_css .= "
        .footer-v1 .mc4wp-form-fields .form-mail input::-webkit-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v1 .mc4wp-form-fields .form-mail input:-ms-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v1 .mc4wp-form-fields .form-mail input::-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v1 .mc4wp-form-fields .form-mail input:-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v3 .contact-form .wpcf7-form-control-wrap input::-webkit-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v3 .contact-form .wpcf7-form-control-wrap input:-ms-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v3 .contact-form .wpcf7-form-control-wrap input::-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v3 .contact-form .wpcf7-form-control-wrap input:-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v3 .contact-form .wpcf7-form-control-wrap textarea::-webkit-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v3 .contact-form .wpcf7-form-control-wrap textarea:-ms-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v3 .contact-form .wpcf7-form-control-wrap textarea::-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v3 .contact-form .wpcf7-form-control-wrap textarea:-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form .wpcf7-form-control-wrap input::-webkit-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form .wpcf7-form-control-wrap input:-ms-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form .wpcf7-form-control-wrap input::-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form .wpcf7-form-control-wrap input:-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form .wpcf7-form-control-wrap textarea::-webkit-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form .wpcf7-form-control-wrap textarea:-ms-input-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form .wpcf7-form-control-wrap textarea::-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form .wpcf7-form-control-wrap textarea:-moz-placeholder{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer-v4 .contact-form label span,
        .footer-v4 .contact-form input,.footer-v4 .contact-form textarea{
            color: {$cryptcio_f_text_color} !important;
        }
        .footer .footer-v2 .copyright-content p,
        .footer .footer-v2 .copyright-content p a,
        .footer .footer-v2 .payment ul li a{
            color: {$cryptcio_f_text_color};
        }
        ";          
    }   
    if(isset($cryptcio_f_link_color) && $cryptcio_f_link_color!=''){
        $cryptcio_custom_css .= "
            .footer-v2 .widget_mc4wp_form_widget .footer-title,
            .footer-v2 .widget_nav_menu ul li a{
                color: {$cryptcio_f_link_color} !important;
            }
        ";
    }
     if(isset($cryptcio_f_border_color) && $cryptcio_f_border_color!=''){
        $cryptcio_custom_css .= "
            .footer-v4 .contact-form input,
            .footer-v4 .contact-form textarea,
            .footer-v1 .bottom-footer{
                border-color: {$cryptcio_f_border_color};
            }
        ";          
    }      
    if(isset($cryptcio_settings['logo_width']) && $cryptcio_settings['logo_width'] !=''){
        if(isset($cryptcio_settings['logo_width']['height']) && $cryptcio_settings['logo_width']['height']!=''){
            $cryptcio_custom_css .= "
                .header-logo img{
                    height: {$cryptcio_settings['logo_width']['height']} !important;
                }
            ";    
        }
        if(isset($cryptcio_settings['logo_width']['width']) && $cryptcio_settings['logo_width']['width']!=''){
            $cryptcio_custom_css .= "
                .header-logo img{
                    width: {$cryptcio_settings['logo_width']['width']} !important;
                }
            ";
        }        
    }   
    if(isset($cryptcio_settings['logo_sidebar']) && $cryptcio_settings['logo_sidebar'] !=''){
        if(isset($cryptcio_settings['logo_sidebar']['height']) && $cryptcio_settings['logo_sidebar']['height']!=''){
            $cryptcio_custom_css .= "
                .logo-sidebar img{
                    height: {$cryptcio_settings['logo_sidebar']['height']} !important;
                }
            ";    
        }
        if(isset($cryptcio_settings['logo_sidebar']['width']) && $cryptcio_settings['logo_sidebar']['width']!=''){
            $cryptcio_custom_css .= "
                .logo-sidebar img{
                    width: {$cryptcio_settings['logo_sidebar']['width']} !important;
                }
            ";
        }        
    }     
    if(isset($cryptcio_settings['logo_mobile']) && $cryptcio_settings['logo_mobile'] !=''){
        if(isset($cryptcio_settings['logo_mobile']['height']) && $cryptcio_settings['logo_mobile']['height']!=''){
            $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .logo-mobile img{
                    height: {$cryptcio_settings['logo_mobile']['height']} !important;
                }
            }
            ";    
        }
        if(isset($cryptcio_settings['logo_mobile']['width']) && $cryptcio_settings['logo_mobile']['width']!=''){
            $cryptcio_custom_css .= "
            @media (max-width: 991px){
                .logo-mobile img{
                    width: {$cryptcio_settings['logo_mobile']['width']} !important;
                }
            }
            ";
        }                       
    }   
    if(isset($cryptcio_settings['menu_spacing']) && $cryptcio_settings['menu_spacing'] !=''){
        if(isset($cryptcio_settings['menu_spacing']['margin-left']) && $cryptcio_settings['menu_spacing']['margin-left']!=''){
            $cryptcio_custom_css .= "
                @media (min-width: 991px){
                    .mega-menu > li > a{
                        padding-left: {$cryptcio_settings['menu_spacing']['margin-left']} !important;
                    }
                }
            "; 
        }
        if(isset($cryptcio_settings['menu_spacing']['margin-top']) && $cryptcio_settings['menu_spacing']['margin-top']!=''){
            $cryptcio_custom_css .= "
                @media (min-width: 991px){
                    .mega-menu > li > a{
                        padding-top: {$cryptcio_settings['menu_spacing']['margin-top']} !important;
                    }
                }
            "; 
        }        
        if(isset($cryptcio_settings['menu_spacing']['margin-right']) && $cryptcio_settings['menu_spacing']['margin-right']!=''){
            $cryptcio_custom_css .= "
                @media (min-width: 991px){
                    .mega-menu > li > a{
                        padding-right: {$cryptcio_settings['menu_spacing']['margin-right']} !important;
                    }
                }
            "; 
        } 
        if(isset($cryptcio_settings['menu_spacing']['margin-bottom']) && $cryptcio_settings['menu_spacing']['margin-bottom']!=''){
            $cryptcio_custom_css .= "
                @media (min-width: 991px){
                    .mega-menu > li > a{
                        padding-bottom: {$cryptcio_settings['menu_spacing']['margin-bottom']} !important;
                    }
                }
            "; 
        }                         
    }     
      if(isset($cryptcio_settings['logo_padding']) && $cryptcio_settings['logo_padding'] !=''){
        if(isset($cryptcio_settings['logo_padding']['margin-left']) && $cryptcio_settings['logo_padding']['margin-left']!=''){
            $cryptcio_custom_css .= "
                @media (min-width: 992px){
                    .header-logo,.header-v5 .kad-header-logo{
                        padding-left: {$cryptcio_settings['logo_padding']['margin-left']} !important;
                    }
                }
            "; 
        }
        if(isset($cryptcio_settings['logo_padding']['margin-top']) && $cryptcio_settings['logo_padding']['margin-top']!=''){
            $cryptcio_custom_css .= "
                @media (min-width: 992px){
                    .header-logo,.header-v5 .kad-header-logo{
                        padding-top: {$cryptcio_settings['logo_padding']['margin-top']} !important;
                    }
                }
            "; 
        }        
        if(isset($cryptcio_settings['logo_padding']['margin-right']) && $cryptcio_settings['logo_padding']['margin-right']!=''){
            $cryptcio_custom_css .= "
                @media (min-width: 992px){
                    .header-logo,.header-v5 .kad-header-logo{
                        padding-right: {$cryptcio_settings['logo_padding']['margin-right']} !important;
                    }
                }
            "; 
        } 
        if(isset($cryptcio_settings['logo_padding']['margin-bottom']) && $cryptcio_settings['logo_padding']['margin-bottom']!=''){
            $cryptcio_custom_css .= "
                @media (min-width: 992px){
                    .header-logo,.header-v5 .kad-header-logo{
                        padding-bottom: {$cryptcio_settings['logo_padding']['margin-bottom']} !important;
                    }
                }
            "; 
        }                         
    }        
    if(isset($cryptcio_settings['404-bg-image']) && $cryptcio_settings['404-bg-image'] !='' && $cryptcio_settings['404-bg-image']['url']){
        $cryptcio_custom_css .= "
            .page-404{
                background-image: url({$cryptcio_settings['404-bg-image']['url']});   
                background-size: initial;
                background-position: center top;
                background-repeat: no-repeat;
            }
        ";         
    }
    if(isset($cryptcio_settings['under-bg-image']) && $cryptcio_settings['under-bg-image'] !='' && $cryptcio_settings['under-bg-image']['url']){
        $cryptcio_custom_css .= "
            #content > .coming-soon-container{
                background: url({$cryptcio_settings['under-bg-image']['url']});   
                background-size: cover;
                background-position: center center;
            }
        ";         
    }    
    if(isset($cryptcio_settings['coming-color-gradient']) && $cryptcio_settings['coming-color-gradient'] !='' && isset($cryptcio_settings['coming-color-gradient']['from']) && $cryptcio_settings['coming-color-gradient']['from']!='' && isset($cryptcio_settings['coming-color-gradient']['from']) && $cryptcio_settings['coming-color-gradient']['from']!='' ){
        $cryptcio_custom_css .= "
            .page-coming-soon.has-overlay:before{
                background: {$cryptcio_settings['coming-color-gradient']['from']};
                background: linear-gradient(to right, {$cryptcio_settings['coming-color-gradient']['from']} , {$cryptcio_settings['coming-color-gradient']['to']});
            }
        ";        
    }  
    if(isset($cryptcio_settings['coming-overlay-opacity']) && $cryptcio_settings['coming-overlay-opacity']!=''){
        $cryptcio_custom_css .= "
            .page-coming-soon.has-overlay:before{
                opacity: {$cryptcio_settings['coming-overlay-opacity']};
            }
        ";        
    }
    if(isset($cryptcio_settings['404-color']) && $cryptcio_settings['404-color'] !=''){
        $cryptcio_custom_css .= "
            .page-404{
                color: {$cryptcio_settings['404-color']} !important;
            }
        ";        
    }   
    if(isset($cryptcio_settings['header6-stickybg']) && $cryptcio_settings['header6-stickybg'] !=''){
        $cryptcio_custom_css .= "
            .header-v6.site-header.is-sticky{
                background: {$cryptcio_settings['header6-stickybg']} !important;
            }
        ";         
    } 
    if(isset($cryptcio_settings['header6-menu-color']) && $cryptcio_settings['header6-menu-color'] !=''){
        $cryptcio_custom_css .= "
            .header-v6 .header-right,.header-v6 .mega-menu > li > a,.header-v6 .social_icon li a,
            .header-v6 .mini-cart .cart_label{
                color: {$cryptcio_settings['header6-menu-color']} !important;
            }
        ";         
    }   
    $cryptcio_breadcrumbs_bg = cryptcio_get_meta_value('breadcrumbs_bg');
    $cryptcio_breadcrumbs_color = cryptcio_get_meta_value('breadcrumbs_color');
    $cryptcio_breadcrumbs_font_size = cryptcio_get_meta_value('breadcrumbs_font_size');
    $cryptcio_breadcrumbs_font = cryptcio_get_meta_value('breadcrumbs_font');
    $cryptcio_breadcrumbs_padding = cryptcio_get_meta_value('breadcrumbs_padding');
    $cryptcio_breadcrumbs_font_weight = cryptcio_get_meta_value('breadcrumbs_font_weight');
    $cryptcio_breadcrumbs_letter_space = cryptcio_get_meta_value('breadcrumbs_letter_space');
    if ($cryptcio_breadcrumbs_bg != '') {
        $cryptcio_custom_css .="
        .side-breadcrumb{
            background-image: url({$cryptcio_breadcrumbs_bg}) !important;
        }
        ";
    }   
    if ($cryptcio_breadcrumbs_color != '') {
        $cryptcio_custom_css .="
        .side-breadcrumb h1,.side-breadcrumb h2 {
            color: {$cryptcio_breadcrumbs_color} !important;
        }
        ";
    }             
    if($cryptcio_breadcrumbs_font!=''){
        $cryptcio_custom_css .= "
           .side-breadcrumb h1,.side-breadcrumb h2{
                font-family: {$cryptcio_breadcrumbs_font} !important;
           }
        ";
    }
    if($cryptcio_breadcrumbs_font_size!=''){
        $cryptcio_custom_css .= "
            @media (min-width: 768px){
               .side-breadcrumb h1,.side-breadcrumb h2{
                    font-size: {$cryptcio_breadcrumbs_font_size}px !important;
               }
            }
        ";
    }  
      if($cryptcio_breadcrumbs_padding!=''){
            $cryptcio_custom_css .= "
                  @media (min-width: 768px){
                     body .side-breadcrumb{
                          padding-top: {$cryptcio_breadcrumbs_padding}px !important;
                          padding-bottom: {$cryptcio_breadcrumbs_padding}px !important;
                     }
                  }
            ";
      }  
      if($cryptcio_breadcrumbs_font_weight!=''){
        $cryptcio_custom_css .= "
            @media (min-width: 768px){
               .side-breadcrumb h1,.side-breadcrumb h2{
                    font-weight: {$cryptcio_breadcrumbs_font_weight} !important;
               }
            }
        ";
      }    
      if($cryptcio_breadcrumbs_letter_space!=''){
        $cryptcio_custom_css .= "
            @media (min-width: 768px){
               .side-breadcrumb h1,.side-breadcrumb h2{
                    letter-spacing: {$cryptcio_breadcrumbs_letter_space}px !important;
               }
            }
        ";
      }     
      if(isset($cryptcio_settings['gen_breadcrumbs_padding']) && $cryptcio_settings['gen_breadcrumbs_padding'] !=''){
            if(isset($cryptcio_settings['gen_breadcrumbs_padding']['margin-left']) && $cryptcio_settings['gen_breadcrumbs_padding']['margin-left']!=''){
                  $cryptcio_custom_css .= "
                      @media (min-width: 768px){
                          .side-breadcrumb{
                              padding-left: {$cryptcio_settings['gen_breadcrumbs_padding']['margin-left']} !important;
                          }
                      }
                  "; 
            }
            if(isset($cryptcio_settings['gen_breadcrumbs_padding']['margin-top']) && $cryptcio_settings['gen_breadcrumbs_padding']['margin-top']!=''){
                  $cryptcio_custom_css .= "
                      @media (min-width: 768px){
                          .side-breadcrumb{
                              padding-top: {$cryptcio_settings['gen_breadcrumbs_padding']['margin-top']} !important;
                          }
                      }
                  "; 
            }        
            if(isset($cryptcio_settings['gen_breadcrumbs_padding']['margin-right']) && $cryptcio_settings['gen_breadcrumbs_padding']['margin-right']!=''){
                  $cryptcio_custom_css .= "
                      @media (min-width: 768px){
                          .side-breadcrumb{
                              padding-right: {$cryptcio_settings['gen_breadcrumbs_padding']['margin-right']} !important;
                          }
                      }
                  "; 
            } 
            if(isset($cryptcio_settings['gen_breadcrumbs_padding']['margin-bottom']) && $cryptcio_settings['gen_breadcrumbs_padding']['margin-bottom']!=''){
                  $cryptcio_custom_css .= "
                      @media (min-width: 768px){
                          .side-breadcrumb{
                              padding-bottom: {$cryptcio_settings['gen_breadcrumbs_padding']['margin-bottom']} !important;
                          }
                      }
                  "; 
            }                         
      } 
    if(isset($cryptcio_settings['product-breadcrumb']) && $cryptcio_settings['product-breadcrumb']){
        if(function_exists('is_product_category') && is_product_category()){
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            $image='';
            if(isset($cat) && !empty($cat)){
                $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            }
            if(isset($thumbnail_id) && $thumbnail_id!=''){
                $image = wp_get_attachment_url( $thumbnail_id );
            }
            if($image !=''){
                $cryptcio_custom_css .= "
                    .side-breadcrumb{
                        background-image: url({$image}) !important;
                    }
                ";
            }
        }
    }       
    //Load font icon css
    $post_content = '';
    if(get_the_ID()!=''){
        $post = get_post(get_the_ID());
        $post_content = $post->post_content;
    }     

    $crypto_body_classes = get_body_class();

    global $wp_styles;
    $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
    $cryptcio_suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    if ( in_array('font-awesome.css', $srcs) || in_array('font-awesome.min.css', $srcs)  ) {
        wp_deregister_style('font-awesome'); 
        wp_deregister_style('yith-wcwl-font-awesome');
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css?ver=' . CRYPTCIO_VERSION);   
    } else {
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css?ver=' . CRYPTCIO_VERSION);  
    }           

    wp_enqueue_style('dashicons', get_template_directory_uri() . '/css/dashicons.css?ver=' . CRYPTCIO_VERSION);    
    wp_enqueue_style('linearicons', get_template_directory_uri() . '/css/linearicons/style.css?ver=' . CRYPTCIO_VERSION);   
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/plugin/bootstrap.min.css?ver=' . CRYPTCIO_VERSION);

    if(stripos($post_content,'fancybox') || stripos($post_content,'arrowpress_member') || get_post_type()=='post' || get_post_type()=='product' || in_array('fancybox-on',$crypto_body_classes) ){
        wp_enqueue_style('fancybox', get_template_directory_uri() . '/css/plugin/jquery.fancybox.min.css?ver=' . CRYPTCIO_VERSION);
    }

    if(stripos($post_content,'arrowpress_instagram_feed')|| stripos($post_content,'cate-archive') || stripos($post_content,'thumbs_list')|| get_post_type()=='product' || get_post_type()=='post' || get_post_type()=='service' || stripos($post_content, 'blog-grid-5') || stripos($post_content, 'arrowpress_blog') || stripos($post_content, 'arrowpress_slider_wrap') || stripos($post_content, 'arrowpress_event_list')){
        if ( in_array('slick.min.css', $srcs) || in_array('slick.css', $srcs)  ) {  
            wp_enqueue_style('slick', get_template_directory_uri() . '/css/plugin/slick.min.css?ver=' . CRYPTCIO_VERSION); 
        } else {
            wp_enqueue_style('slick', get_template_directory_uri() . '/css/plugin/slick.min.css?ver=' . CRYPTCIO_VERSION);   
        }                
    }

    if(stripos($post_content,'item_delay'))  {
        if ( in_array('animate.css', $srcs) || in_array('animate.min.css', $srcs)  ) {  
        } else {
            wp_enqueue_style('cryptcio-animate', get_template_directory_uri() . '/css/animate.min.css?ver=' . CRYPTCIO_VERSION);
        }        
    } 
     
    
    if (is_rtl()) {
        //Load theme RTL css
        wp_enqueue_style('cryptcio-theme-rtl', get_template_directory_uri() . '/css/theme_rtl'.$cryptcio_suffix.'.css?ver=' . CRYPTCIO_VERSION);
        wp_add_inline_style( 'cryptcio-theme-rtl', $cryptcio_custom_css );
    }
    else{
        //Load theme css
        wp_enqueue_style('cryptcio-theme', get_template_directory_uri() . '/css/theme'.$cryptcio_suffix.'.css?ver=' . CRYPTCIO_VERSION);
        wp_add_inline_style( 'cryptcio-theme', $cryptcio_custom_css );
    }
    
    // custom styles
    wp_deregister_style( 'cryptcio-style' );
    wp_register_style( 'cryptcio-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'cryptcio-style' );
    

}
add_action('wp_enqueue_scripts', 'cryptcio_scripts_styles');