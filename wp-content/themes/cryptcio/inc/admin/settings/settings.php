<?php

/**
 * cryptcio Settings Options
 */
if (!class_exists('Framework_cryptcio_Settings')) {

    class Framework_cryptcio_Settings {

        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }

        public function initSettings() {
            $this->ReduxFramework = new ReduxFramework($this->cryptcio_get_setting_sections(), $this->cryptcio_get_setting_arguments());
        }

        public function cryptcio_get_setting_sections() {
            $page_layout = cryptcio_layouts();
            $sidebar_positions = cryptcio_sidebar_position();
            $block_name = cryptcio_get_block_name();
            $breadcrumbs_type = cryptcio_get_breadcrumbs_type();
			$cryptcio_seclect_slider = cryptcio_seclect_slider();
			unset($block_name['default']);
			unset($cryptcio_seclect_slider['default']);
            unset($page_layout['default']);
            unset($sidebar_positions['default']);
            $menus = get_terms('nav_menu');
            $menu_list = cryptcio_list_menu();            
            $sections = array(
                array(
                    'icon' => 'el-icon-edit',
                    'icon_class' => 'icon',
                    'title' => esc_html__('General', 'cryptcio'),
                    'fields' => array(
                    )
                ),
                array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Layout', 'cryptcio'),
                'fields' => array(
                        array(
                            'id' => 'layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'cryptcio'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => 'general-sidebar'
                        ),
                        array(
                            'id'=>'post_banner_block',
                            'type' => 'select',
                            'title' => esc_html__('Bottom Content', 'cryptcio'),
                            'options' => $block_name,
                            'desc' => esc_html__('Choose a block to display at the bottom of pages. You can create a block in Static Block/Add New.', 'cryptcio')
                        ),                         
                    )
                ),
                array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Logo, Favicon, Js Custom', 'cryptcio'),
                'fields' => array(
                        array(
                            'id' => 'logo',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Logo', 'cryptcio'),
                            'required' => array(
                                        array('header-type', 'equals', array(
                                        '1','5'
                                    )),
                                ),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo.png',
                                'height' => 88,
                                'wide' => 107
                            )
                        ),  
                        array(
                            'id' => 'favicon',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Favicon', 'cryptcio'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/favicon.ico'
                            )
                        ),
                    )
                ),
				array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('View, Language Switcher', 'cryptcio'),
                'fields' => array(
                        array(
                            'id'=>'wpml-switcher',
                            'type' => 'switch',
                            'title' => esc_html__('Show Language Switcher', 'cryptcio'),
                            'subtitle' => esc_html__('This option only works with WPML or Polylang plugins.','cryptcio'),
                            'desc' => esc_html__('Show language switcher instead of view switcher menu.', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),
                    )
                ),
                array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Preloader', 'cryptcio'),
                'fields' => array(
                        array(
                            'id'            => 'preload',
                            'type'          => 'button_set',
                            'title'         => esc_html__('Preload ', 'cryptcio'),
                            'description'   => esc_html__('Enable Preload site', 'cryptcio'),
                            'options'       => array(
                                'enable'  => esc_html__( 'Enable', 'cryptcio' ),
                                'disable'  => esc_html__( 'Disable', 'cryptcio' ),
                            ),
                            'default'       => 'disable', 
                        ),
                        array(
                            'id'            => 'preload-type',
                            'type'          => 'image_select',
                            'title'         => esc_html__('Preload Type', 'cryptcio'),
                            'subtitle' => esc_html__('Each page will have option for select preload type. Preload selection in each page will have higher priority than this general selection.','cryptcio'),
                            'options' => $this->cryptcio_preload_types(),
                            'default' => '1',
                            'required' => array(
                                    array('preload', 'equals', array(
                                    'enable'
                                )),
                            ),
                        ),
                        array(
                            'id' => 'logo-preload',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Logo', 'cryptcio'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo.png'
                            ),
                            'required' => array(
                                    array('preload-type', 'equals', array(
                                    '2','5'
                                )),
                            ),
                        ),
						array(
                            'id' => 'gif-preload',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Gif Loader', 'cryptcio'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/preloader.gif',
								'height' => 100,
                                'wide' => 100
                            ),
                            'required' => array(
                                    array('preload-type', 'equals', array(
                                    '6'
                                )),
                            ),
                        ),
                        array(
                            'id' => 'preloader-bg',
                            'type' => 'color',
                            'title' => esc_html__('Preload background color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '', 
                            'required' => array(
                                    array('preload', 'equals', array(
                                    'enable'
                                )),
                            ),
                        ), 
                        array(
                            'id' => 'preloader-color',
                            'type' => 'color',
                            'title' => esc_html__('Preload color icon', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '', 
                            'required' => array(
                                    array('preload', 'equals', array(
                                    'enable'
                                )),
                            ),
                        ), 
                    )
                ),
                array(
                    'icon' => 'el-icon-css',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Skin', 'cryptcio'),
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('General', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'general-bg',
                            'type' => 'background',
                            'title' => esc_html__('General Background', 'cryptcio'),
                            'default' => array(
                                'background-color' => '#fff',
                                'background-image' => '',
                                'background-size' => 'inherit',
                                'background-repeat' => 'repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit'
                            ),
                            'output' => array('#main','body','#error-page'),
                        ),
                        array(
                            'id' => 'general-font',
                            'type' => 'typography',
                            'title' => esc_html__('General Font', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-weight' => '400',
                                'font-family' => 'Poppins',
                                'font-size' => '14px',
                                'line-height' => '24px'
                            ),
                            'output' => array('body','#error-page'),
                        ),
						array(
                            'id' => 'primary-color',
                            'type' => 'color_gradient',
                            'title' => esc_html__('Primary color', 'efarm'),
                            'default'  => array(
                                'from' => '#f5b71f',
                                'to'   => '', 
                            ),
                            'validate' => 'color',
							'transparent' => false
                        ),
                        array(
                            'id' => 'highlight-color',
                            'type' => 'color',
                            'title' => esc_html__('Highlight color', 'cryptcio'),
                            'default' => '#13264a',
                            'validate' => 'color',
                            'transparent' => false
                        ),                        
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Breadcrumbs', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'breadcrumbs_style',
                            'type' => 'button_set',
                            'title' => esc_html__('Breadcrumbs Layout', 'cryptcio'),
                            'options' => cryptcio_get_breadcrumbs_type(),
                            'default' => 'type-2'
                        ),
                         array(

                            'id' => 'breadcrumbs-bg',
                            'type' => 'background',
                            'title' => esc_html__('Background', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-image' => get_template_directory_uri() . '/images/bg-breadcrumb.jpg',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit',
                                'background-color' => 'transparent'
                            ),
                            'required' => array('breadcrumbs_style', 'equals', array(
                                    'type-1'
                            )),
                            'output'    => array('.side-breadcrumb.use_bg_image'
                            ),                                                               
                        ),
                         array(

                            'id' => 'breadcrumbs2-bg',
                            'type' => 'background',
                            'title' => esc_html__('Background', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-image' => get_template_directory_uri() . '/images/bg-breadcrumb.jpg',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit',
                                'background-color' => 'transparent',
                            ),
                            'required' => array('breadcrumbs_style', 'equals', array(
                                    'type-2'
                            )),
                            'output'    => array('.side-breadcrumb.type-2.use_bg_image'
                            ),                                                               
                        ), 
                        array(

                            'id' => 'breadcrumbs3-bg',
                            'type' => 'background',
                            'title' => esc_html__('Background', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-image' => get_template_directory_uri() . '/images/bg-breadcrumb.jpg',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit',
                                'background-color' => 'transparent'
                            ),
                            'required' => array('breadcrumbs_style', 'equals', array(
                                    'type-3'
                            )),
                            'output'    => array('.side-breadcrumb.type-3.use_bg_image'),                                                               
                        ),
                        array(
                            'id' => 'breadcrumbs-overlay-color',
                            'type' => 'color',
                            'title' => esc_html__('Background Overlay Color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#00195f',                                                           
                        ), 
						array(
                            'id' => 'breadcrumbs_align',
                            'type' => 'button_set',
                            'title' => esc_html__('Breadcrumbs Align', 'cryptcio'),
                            'options' => cryptcio_get_align(),
                            'default' => 'left'
                        ),
						array(
                            'id'             => 'gen_breadcrumbs_padding',
                            'type'           => 'spacing',
                            'mode'           => 'padding',
                            'units'          => array('px'),
                            'units_extended' => 'false',
                            'title'          => esc_html__('Set padding for breadcrumb in desktop', 'cryptcio'),
                            'subtitle'       => esc_html__('Allow users to ajust breadcrumb spacing', 'cryptcio'),
                        ),
						array(
                            'id' => 'breadcrumbs-title',
                            'type' => 'switch',
                            'title' => esc_html__('Enable Title Page','cryptcio'),
                            'default' => true,    
							'required' => array(
                                    array('breadcrumbs_style', 'equals', array(
                                    'type-1','type-3'
                                )),
                            ),
                        ),
						array(
                            'id' => 'breadcrumbs-title-false',
                            'type' => 'switch',
                            'title' => esc_html__('Enable Title Page','cryptcio'),
                            'default' => false,
							'required' => array(
                                    array('breadcrumbs_style', 'equals', array(
                                    'type-2'
                                )),
                            ),
                        ),
						array(
                            'id' => 'title-breadcrumbs-font',
                            'type' => 'typography',
                            'title' => esc_html__('Title Page Option', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'text-transform' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#fff",
                                'google' => true,
                                'font-family' => 'Poppins',
                                'font-size' => '24px',
								'font-weight' => '700',
								'text-transform' => 'uppercase',
                            ),
							'required' => array('breadcrumbs-title', 'equals', array(
                                    true
                            )),
                        ),
						array(
                            'id' => 'breadcrumbs-link',
                            'type' => 'switch',
                            'title' => esc_html__('Enable Breadcrumbs Link','cryptcio'),
                            'default' => true,    
                        ),
						array(
							'id' => 'breadcrumbs-icon',
							'type' => 'text',
							'title' => esc_html__('Icon Home Breadcrumb', 'cryptcio'),
							'placeholder' => esc_html__('fa fa-home', 'cryptcio'),
                            'default'=> '',
							'desc' => wp_kses(__('Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, and <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a>','cryptcio'),array(
									'a' => array(
										'href'=>array(),
										'target' => array(),
										),
								))                         
						),
						array(
                            'id' => 'link-breadcrumbs-font',
                            'type' => 'typography',
                            'title' => esc_html__('Link Breadcrumb Option', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#fff",  
                                'google' => true,
                                'font-family' => 'Poppins',
                                'font-size' => '14px',
                                'font-weight' => '400',
                            )
                        ),  
					)
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Typography', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'h1-font',
                            'type' => 'typography',
                            'title' => esc_html__('H1 Font', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => '',
                                'font-size' => '56px',
                                'font-weight' => '700'
                            ),
                            'output' => array('h1'),
                        ),
                        array(
                            'id' => 'h2-font',
                            'type' => 'typography',
                            'title' => esc_html__('H2 Font', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => '',
                                'font-size' => '50px',
                                'font-weight' => '700'
                            ),
                            'output' => array('h2'),
                        ),
                        array(
                            'id' => 'h3-font',
                            'type' => 'typography',
                            'title' => esc_html__('H3 Font', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => '',
                                'font-size' => '24px',
                                'font-weight' => '700'
                            ),
                            'output' => array('h3'),
                        ),
                        array(
                            'id' => 'h4-font',
                            'type' => 'typography',
                            'title' => esc_html__('H4 Font', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => '',
                                'font-size' => '18px',
                                'font-weight' => '700'
                            ),
                            'output' => array('h4'),                            
                        ),
                        array(
                            'id' => 'h5-font',
                            'type' => 'typography',
                            'title' => esc_html__('H5 Font', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => '',
                                'font-size' => '16px',
                                'font-weight' => '700'
                            ),
                            'output' => array('h5'),
                        ),
                        array(
                            'id' => 'h6-font',
                            'type' => 'typography',
                            'title' => esc_html__('H6 Font', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => '',
                                'font-size' => '14px',
                                'font-weight' => '700'
                            ),
                            'output' => array('h6'),
                        ),
                        array(
                            'id' => 'other-font',
                            'type' => 'typography',
                            'title' => esc_html__('Button and some title font', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => false,
                            'line-height' => false,
                            'color' => false,
                            'font-size' => false,
                            'default' => array(
                                'google' => true,
                                'font-family' =>'',
                            ),
                            'output'=> array('.btn.btn-highlight.btn-border','.footer-title',
                                '.product_list_widget .price span',
                                '.product-content .price .amount','.cryptcio_product_main_info',
                                '.blog-item .post_link',
                                '.item_testimonial .item-desc',
                                '.arrowpress-heading.heading-5 .title-heading',
                                '.blog-slogan','.quote_section blockquote',
                                '.sticky-post-2 .post-name a', '.blog-cat-content .blog-cate .count-post > p',
                                '.post-single.single-2 #comments .widget-title',
                                '.tt-list span','.service_header h3','.content-404 p',
								'.newletter-1 .mc4wp-form-fields label',
								'.active-deal .price-deal',
								'.text-ct',
								'.info .price span, #yith-quick-view-content .price span',
                                '.count-down-3 .ult_countdown-section .ult_countdown-amount'),
                        ),                        
                    )
                ),
                $this->cryptcio_add_header_section_options(),
                array(
                    'icon_class' => 'el-icon-edit',
                    'subsection' => true,
                    'title' => esc_html__('Contact Information', 'cryptcio'),
                    'fields' => array(
                         array(
                            'id' => 'header-info',
                            'type' => 'switch',
                            'title' => esc_html__('Display Contact Information','cryptcio'),
                            'default' => false,  
							'required' => array('header-type', 'equals', array(
                                '3'
                            )),
                        ),  
                        array(
                            'id' => 'header-info-icon',
                            'type' => 'text',
                            'title' => esc_html__('Icon Information', 'cryptcio'),
                            'default' => 'fa fa-list-ul',
                            'placeholder' => esc_html__('fa fa-list-ul', 'cryptcio'),
                            'required' => array('header-info', 'equals', array(
                                true
                            )), 
                            'desc' => wp_kses(__('Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a>','cryptcio'),array(
                                'a' => array(
                                    'href'=>array(),
                                    'target' => array(),
                                    ),
                            ))                            
                        ),
                        array(
                            'id' => 'header-slogan',
                            'type' => 'textarea',
                            'title' => esc_html__('Slogan', 'cryptcio'),
                            'default' => 'Lorem ipsum dolor sit amet gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auci. Proin gravida nibh vel veliau ctor aliquenean.',
                            'required' => array('header-info', 'equals', array(
                                true
                            )),  
                        ),
                        array(
                            'id' => 'side-twitter',
                            'type' => 'switch',
                            'title' => esc_html__('Show Twitter', 'cryptcio'),
                            'default' => true,
                            'required' => array('header-info', 'equals', true),
                        ),
                        array(
                            'id' => 'side-contact',
                            'type' => 'switch',
                            'title' => esc_html__('Show Contact Form', 'cryptcio'),
                            'default' => false,
                            'required' => array('header-info', 'equals', true),
                        ),
                        array(
                            'id' => 'form_contact',
                            'type' => 'textarea',
                            'title' => esc_html__('Contact form shortcode', 'cryptcio'),
                            'default' => '',
                            'required' => array('side-contact', 'equals', true),
                            'desc' => esc_html__('Get contact form shortcode in Contact > Contact Forms','cryptcio'),
                        ),
                        array(
                            'id' => 'side-instagram',
                            'type' => 'switch',
                            'title' => esc_html__('Show Instagram', 'cryptcio'),
                            'default' => false,
                            'required' => array('header-info', 'equals', true),
                        ),
                        array(
                            'id' => "iframe-instagram",
                            'type' => 'textarea',
                            'required' => array('side-instagram', 'equals', true),
                            'title' => esc_html__('Iframe Instagram', 'cryptcio'),
                            'desc' => esc_html__('Get Iframe In Website http://instaembedder.com/ or http://widgets.websta.me/', 'cryptcio')
                        ),
                        array(
                            'id' => 'header-contact',
                            'type' => 'switch',
                            'title' => esc_html__('Show Contact Us', 'cryptcio'),
                            'default' => true,
                        ), 
						array(
                            'id' => 'header-address',
                            'type' => 'text',
                            'title' => esc_html__('Address', 'cryptcio'),
                            'default' => 'San Francisco, CA 94102, US 1234, Some Str',
                            'required' => array('header-contact', 'equals', array(
                                true
                            )),
                        ),
                        array(
                            'id' => 'header-callto',
                            'type' => 'text',
                            'title' => esc_html__('Phone Number 1', 'cryptcio'),
                            'default' => '(84)666-8888',
                            'required' => array('header-contact', 'equals', array(
                                true
                            )),
                        ), 
						array(
                            'id' => 'header-callto2',
                            'type' => 'text',
                            'title' => esc_html__('Phone Number 2', 'cryptcio'),
                            'default' => '(84)666-8888',
                            'required' => array('header-contact', 'equals', array(
                                true
                            )),
                        ), 
                        array(
                            'id' => 'header-mailto',
                            'type' => 'text',
                            'title' => esc_html__('Mailto', 'cryptcio'),
                            'default' => 'arrowpress@arrowhitech.com',
                            'required' => array('header-contact', 'equals', array(
                                true
                            )),
                        ),     
						array(
                            'id' => 'header-time',
                            'type' => 'text',
                            'title' => esc_html__('Open time', 'cryptcio'),
                            'default' => '7 Days a week from 9:00 am to 7:00 pm',
                            'required' => array('header-contact', 'equals', array(
                                true
                            )),
                        ),  
                    )
                ),
                array(
                    'icon_class' => 'el-icon-edit',
                    'subsection' => true,
                    'title' => esc_html__('Header Styling', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id'       => 'logo_width',
                            'type'     => 'dimensions',
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set logo image width and height', 'cryptcio'),
                            'subtitle' => esc_html__('Allow users to set width and height for header logo image', 'cryptcio'),
                            'height'   => true,
                        ),                    
                        array(
                            'id' => 'header-style',
                            'type' => 'select',
                            'title' => esc_html__('Select header for styling', 'cryptcio'),
                            'options' => cryptcio_header_types(),
                            'default' => '1',
                        ),   
						array(
							'id' => 'select_menu',
							'title' => esc_html__('Select Menu', 'cryptcio'),
							'type' => 'select',
							'options' => $menu_list,
							'default' => 'default',
							'required' => array('header-style', 'equals', array(
                                    '1','2','3'
                                )), 
						),
						array(
                            'id' => 'select_menu_top',
                            'title' => esc_html__('Select Menu Top', 'cryptcio'),
                            'type' => 'select',
                            'options' => $menu_list,
                            'default' => 'default',
                            'required' => array('header-style', 'equals', array(
                                    '6'
                                )), 
                        ),
						array(
							'id' => 'select_menu_left',
							'title' => esc_html__('Select Menu Left', 'cryptcio'),
							'type' => 'select',
							'options' => $menu_list,
							'default' => 'default',
							'required' => array('header-style', 'equals', array(
                                    '4'
                                )), 
						),
						array(
							'id' => 'select_menu_right',
							'title' => esc_html__('Select Menu Right', 'cryptcio'),
							'type' => 'select',
							'options' => $menu_list,
							'default' => 'default',
							'required' => array('header-style', 'equals', array(
                                    '4'
                                )), 
						),
						array(
                            'id'       => 'height_top',
                            'type'     => 'dimensions',
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set height top header', 'cryptcio'),
                            'width'   => false,
                        ),                          
                        array(
                            'id'       => 'height_middle',
                            'type'     => 'dimensions',
							'width'   => false,
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set height middle header', 'cryptcio'),
							'required' => array('header-style', 'equals', array(
                                    '1'
                                )), 
						),
                        array(
                            'id'       => 'height2_middle',
                            'type'     => 'dimensions',
							'width'   => false,
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set height middle header', 'cryptcio'),
							'required' => array('header-style', 'equals', array(
                                    '2'
                                )), 
                        ), 
						array(
                            'id'       => 'height3_middle',
                            'type'     => 'dimensions',
							'width'   => false,
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set height middle header', 'cryptcio'),
							'required' => array('header-style', 'equals', array(
                                    '3'
                                )), 
                        ),  
						array(
                            'id'       => 'height4_middle',
                            'type'     => 'dimensions',
							'width'   => false,
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set height middle header', 'cryptcio'),
							'required' => array('header-style', 'equals', array(
                                    '4'
                                )), 
                        ), 
                        array(
                            'id'       => 'height5_middle',
                            'type'     => 'dimensions',
                            'width'   => false,
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set height middle header', 'cryptcio'),
                            'required' => array('header-style', 'equals', array(
                                    '5'
                                )), 
                        ), 
						array(
                            'id'       => 'height6_middle',
                            'type'     => 'dimensions',
                            'width'   => false,
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set height middle header', 'cryptcio'),
                            'required' => array('header-style', 'equals', array(
                                    '6'
                                )), 
                        ), 
						array(
                            'id'       => 'height6_menu',
                            'type'     => 'dimensions',
                            'width'   => false,
                            'units'    => array('em','px','%'),
                            'title'    => esc_html__('Set height menu header', 'cryptcio'),
                            'required' => array('header-style', 'equals', array(
                                    '6'
                                )), 
                        ), 
						//header 1 
                        array(
                            'id' => 'header1-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header background color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#fff',
                            'required' => array('header-style', 'equals', array(
                                    '1'
                                )),    
                            'output'    => array('.header-v1'),                                                         
                        ),
						array(
                            'id' => 'header-top-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header top background color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#f5f5f5',                              
                        ),
						array(
                            'id' => 'header6-middle-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header middle background color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#282828',   
							'required' => array('header-style', 'equals', array(
                                    '6'
                                )), 
                        ),
						array(
                            'id' => 'header-menu-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header background menu color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#282828',
                            'required' => array('header-style', 'equals', array(
                                    '1'
                                )),                                
                        ),
						array(
                            'id' => 'header1-bg-image',
                            'type' => 'background',
                            'title' => esc_html__('Background Image', 'cryptcio'),
                            'background-color' => false, 
                            'default' => array(
                                'background-image' => '',
                                'background-size' => 'contain',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center top',
                                'background-attachment' => 'inherit',
                            ),
                            'output'    => array('header.header-v1', 
                                '.fixed-header header.header-v1.is-sticky',
                            ),  
							'required' => array('header-style', 'equals', array(
                                    '1'
                                )), 
                        ),    
						array(
                            'id' => 'header-bg-image',
                            'type' => 'background',
                            'title' => esc_html__('Background Image', 'cryptcio'),
                            'background-color' => false, 
                            'default' => array(
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed',
                            ),
                            'output'    => array('header.site-header', 
                                '.fixed-header header.site-header.is-sticky',
                            ),    
							'required' => array('header-style', 'equals', array(
                                    '2','3','4','5','6'
                                )), 
                        ),    
						array(
                            'id' => 'header-overlay-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Background Overlay Color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => 'transparent',                                                           
                        ),
						array(
                            'id' => 'header-opacity',
                            'type' => 'text',
							'placeholder' => esc_html__('0.6', 'cryptcio'),
                            'title' => esc_html__('Header Background Opacity', 'cryptcio'),
							'default' => '0.6',
                        ),
                        array(
                            'id' => 'header1-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#a5a5a5',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '1'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header1menu-option',
                            'type' => 'typography',
                            'title' => esc_html__('Header Menu Option', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
							'text-transform' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => 'Poppins',
								'text-transform' => 'uppercase',
                                'font-size' => '14px',
                                'font-weight' => '700',
                            ),
							'required' => array('header-style', 'equals', array(
                                    '1'
                                )),  
                        ),  
						array(
                            'id' => 'header-submenu-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header sub menu background color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#fff',
                            'required' => array('header-style', 'equals', array(
                                    '1'
                                )),                                
                        ),
						array(
                            'id' => 'header1-bg-hover',
                            'type' => 'color',
                            'title' => esc_html__('Submenu background color on hover', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#f7f6f6',
                            'required' => array('header-style', 'equals', array(
                                    '1'
                                )),                                
                        ), 
                        array(
                            'id' => 'header1-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Submenu Border Color', 'cryptcio'),
                            'default' => '#f0efef',
                            'validate' => 'color',
                            'transparent' => true,
                            'required' => array('header-style', 'equals', array(
                                    '1'             
                                )),                            
                        ),  
						array(
                            'id' => 'header1-mb-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Mobile Border Color', 'cryptcio'),
                            'default' => '',
                            'validate' => 'color',
                            'transparent' => '#f0efef',
                            'required' => array('header-style', 'equals', array(
                                    '1'             
                                )),                            
                        ),  
                    // Header 2
                        array(
                            'id' => 'header2-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header background color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#fff',
                            'required' => array('header-style', 'equals', array(
                                    '2'
                                )),                                
                        ), 
						array(
                            'id' => 'header2-top-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Top Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#a5a5a5',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '2'
                                )),                                                     
                        ), 
                        array(
                            'id' => 'header2-color',
                            'type' => 'typography',
                            'title' => esc_html__('Header Menu Option', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
							'text-transform' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => 'Poppins',
                                'font-size' => '14px',
								'text-transform' => 'uppercase',
                                'font-weight' => '700',
                            ),
							'required' => array('header-style', 'equals', array(
                                    '2'
                                )),  
                        ),     
                        array(
                            'id' => 'header2-bg-hover',
                            'type' => 'color',
                            'title' => esc_html__('Submenu background color on hover', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#f7f6f6',
                            'required' => array('header-style', 'equals', array(
                                    '2'
                                )),                                
                        ), 
                        array(
                            'id' => 'header2-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Submenu Border Color', 'cryptcio'),
                            'default' => '#f0efef',
                            'validate' => 'color',
                            'transparent' => true,
                            'required' => array('header-style', 'equals', array(
                                    '2'             
                                )),                            
                        ),  
						array(
                            'id' => 'header2-mb-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Mobile Border Color', 'cryptcio'),
                            'default' => '',
                            'validate' => 'color',
                            'transparent' => '#f0efef',
                            'required' => array('header-style', 'equals', array(
                                    '2'             
                                )),                            
                        ), 
                    //Header 3                         
                        array(
                            'id' => 'header3-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header Background Color', 'cryptcio'),
                            'default' => '#fff',
                            'validate' => 'color',
                            'transparent' => true,
                            'required' => array('header-style', 'equals', array(
                                    '3'
                                )),                                
                        ),  
						array(
                            'id' => 'header3-top-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Top Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#a5a5a5',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '3'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header3-color',
                            'type' => 'typography',
                            'title' => esc_html__('Header Menu Option', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
							'text-transform' => true,
                            'line-height' => false,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => 'Poppins',
                                'font-size' => '14px',
								'text-transform' => 'uppercase',
                                'font-weight' => '700',
                            ),
							'required' => array('header-style', 'equals', array(
                                    '3'
                                )),  
                        ),  
						array(
                            'id' => 'header3-active-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Menu Actice Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '3'
                                )),                                                     
                        ),
                        array(
                            'id' => 'header3-sticky-active-color',
                            'type' => 'color',
                            'title' => esc_html__('[Sticky] Header Menu Actice Color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#f5b71f',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '3'
                                )),                                                     
                        ),                        
                        array(
                            'id' => 'header3-bg-hover',
                            'type' => 'color',
                            'title' => esc_html__('Submenu background color on hover', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#f7f6f6',
                            'required' => array('header-style', 'equals', array(
                                    '3'
                                )),                                
                        ), 
                        array(
                            'id' => 'header3-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Submenu Border Color', 'cryptcio'),
                            'default' => '#f0efef',
                            'validate' => 'color',
                            'transparent' => true,
                            'required' => array('header-style', 'equals', array(
                                    '3'             
                                )),                            
                        ),  
						array(
                            'id' => 'header3-mb-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Mobile Border Color', 'cryptcio'),
                            'default' => '',
                            'validate' => 'color',
                            'transparent' => '#f0efef',
                            'required' => array('header-style', 'equals', array(
                                    '3'             
                                )),                            
                        ), 
                    // Header 4
                        array(
                            'id' => 'header4-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header background color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#fff',
                            'required' => array('header-style', 'equals', array(
                                    '4'
                                )),                                
                        ),  
						array(
                            'id' => 'header4-top-bg',
                            'type' => 'color',
                            'title' => esc_html__('Header top background color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#a5a5a5',
                            'required' => array('header-style', 'equals', array(
                                    '4'
                                )),                                
                        ), 
                        array(
                            'id' => 'header4-color',
                            'type' => 'typography',
                            'title' => esc_html__('Header Menu Option', 'cryptcio'),
                            'google' => true,
                            'subsets' => false,
                            'font-style' => false,
                            'text-align' => false,
                            'font-weight' => true,
                            'line-height' => false,
							'text-transform' => true,
                            'default' => array(
                                'color' => "#282828",
                                'google' => true,
                                'font-family' => 'Poppins',
                                'font-size' => '14px',
                                'font-weight' => '700',
								'text-transform' => 'uppercase',
                            ),
							'required' => array('header-style', 'equals', array(
                                    '4'
                                )),  
                        ),  
                        array(
                            'id' => 'header4-bg-hover',
                            'type' => 'color',
                            'title' => esc_html__('Submenu background color on hover', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#f7f6f6',
                            'required' => array('header-style', 'equals', array(
                                    '4'
                                )),                                
                        ), 
                        array(
                            'id' => 'header4-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Submenu Border Color', 'cryptcio'),
                            'default' => '#f0efef',
                            'validate' => 'color',
                            'transparent' => true,
                            'required' => array('header-style', 'equals', array(
                                    '4'             
                                )),                            
                        ),
						array(
                            'id' => 'header4-mb-border-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Mobile Border Color', 'cryptcio'),
                            'default' => '',
                            'validate' => 'color',
                            'transparent' => '#f0efef',
                            'required' => array('header-style', 'equals', array(
                                    '4'             
                                )),                            
                        ),   
					// Header 5
						array(
							'id' => 'header5-bg',
							'type' => 'color',
							'title' => esc_html__('Header background color', 'cryptcio'),
							'validate' => 'color',
							'default' => '#fff',
							'required' => array('header-style', 'equals', array(
									'5'
								)),                                
						), 
						array(
							'id' => 'header5-top-color',
							'type' => 'color',
							'title' => esc_html__('Header Top Color', 'cryptcio'),
							'validate' => 'color',
							'default' => '#a5a5a5',
							'transparent' => false, 
							'required' => array('header-style', 'equals', array(
									'5'
								)),                                                     
						), 
						array(
							'id' => 'header5-color',
							'type' => 'typography',
							'title' => esc_html__('Header Menu Option', 'cryptcio'),
							'google' => true,
							'subsets' => false,
							'font-style' => false,
							'text-align' => false,
							'font-weight' => true,
							'text-transform' => true,
							'line-height' => false,
							'default' => array(
								'color' => "#282828",
								'google' => true,
								'font-family' => 'Poppins',
								'font-size' => '14px',
								'text-transform' => 'uppercase',
								'font-weight' => '700',
							),
							'required' => array('header-style', 'equals', array(
									'5'
								)),  
						),     
						array(
							'id' => 'header5-bg-hover',
							'type' => 'color',
							'title' => esc_html__('Submenu background color on hover', 'cryptcio'),
							'validate' => 'color',
							'default' => '#f7f6f6',
							'required' => array('header-style', 'equals', array(
									'5'
								)),                                
						), 
						array(
							'id' => 'header5-border-color',
							'type' => 'color',
							'title' => esc_html__('Header Submenu Border Color', 'cryptcio'),
							'default' => '#f0efef',
							'validate' => 'color',
							'transparent' => true,
							'required' => array('header-style', 'equals', array(
									'5'             
								)),                            
						),  
						array(
							'id' => 'header5-mb-border-color',
							'type' => 'color',
							'title' => esc_html__('Header Mobile Border Color', 'cryptcio'),
							'default' => '',
							'validate' => 'color',
							'transparent' => '#f0efef',
							'required' => array('header-style', 'equals', array(
									'5'             
								)),                            
						), 
					// Header 6
						array(
							'id' => 'header6-bg',
							'type' => 'color',
							'title' => esc_html__('Header background color', 'cryptcio'),
							'validate' => 'color',
							'default' => '#fff',
							'required' => array('header-style', 'equals', array(
									'6'
								)),                                
						), 
						array(
							'id' => 'header6-menu-bg',
							'type' => 'color',
							'title' => esc_html__('Header menu background color', 'cryptcio'),
							'validate' => 'color',
							'default' => '#f5f5f5',
							'required' => array('header-style', 'equals', array(
									'6'
								)),                                
						), 
						array(
							'id' => 'header6-top-color',
							'type' => 'color',
							'title' => esc_html__('Header Top Color', 'cryptcio'),
							'validate' => 'color',
							'default' => '#a4a4a4',
							'transparent' => false, 
							'required' => array('header-style', 'equals', array(
									'6'
								)),                                                     
						), 
						array(
							'id' => 'header6-color',
							'type' => 'typography',
							'title' => esc_html__('Header Menu Option', 'cryptcio'),
							'google' => true,
							'subsets' => false,
							'font-style' => false,
							'text-align' => false,
							'font-weight' => true,
							'text-transform' => true,
							'line-height' => false,
							'default' => array(
								'color' => "#282828",
								'google' => true,
								'font-family' => 'Poppins',
								'font-size' => '14px',
								'text-transform' => 'uppercase',
								'font-weight' => '700',
							),
							'required' => array('header-style', 'equals', array(
									'6'
								)),  
						),     
						array(
							'id' => 'header6-bg-hover',
							'type' => 'color',
							'title' => esc_html__('Submenu background color on hover', 'cryptcio'),
							'validate' => 'color',
							'default' => '#f7f6f6',
							'required' => array('header-style', 'equals', array(
									'6'
								)),                                
						), 
						array(
							'id' => 'header6-border-color',
							'type' => 'color',
							'title' => esc_html__('Header Submenu Border Color', 'cryptcio'),
							'default' => '#f0efef',
							'validate' => 'color',
							'transparent' => true,
							'required' => array('header-style', 'equals', array(
									'6'             
								)),                            
						),  
						array(
							'id' => 'header6-mb-border-color',
							'type' => 'color',
							'title' => esc_html__('Header Mobile Border Color', 'cryptcio'),
							'default' => '',
							'validate' => 'color',
							'transparent' => '#f0efef',
							'required' => array('header-style', 'equals', array(
									'6'             
								)),                            
						), 
                    ),
                ), 
				array(
                    'icon_class' => 'el-icon-edit',
                    'subsection' => true,
                    'title' => esc_html__('Header Fixed', 'cryptcio'),
                    'fields' => array(
						array(
                            'id' => 'logo-fixed',
                            'type' => 'media',
                            'url' => true,    
                            'readonly' => false,
                            'title' => esc_html__('Logo Fixed', 'cryptcio'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo-fixed.png',
                            ),
							'required' => array('header-style', 'equals', array(
                                    '1','2','4'
                                )),   
                        ), 
						array(
                            'id' => 'logo3-fixed',
                            'type' => 'media',
                            'url' => true,    
                            'readonly' => false,
                            'title' => esc_html__('Logo Fixed', 'cryptcio'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo3-fixed.png',
                            ),
							'required' => array('header-style', 'equals', array(
                                    '3'
                                )),   
                        ), 
						array(
                            'id' => 'header1-fixed-bgcolor',
                            'type' => 'color',
                            'title' => esc_html__('Header Background Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '',
                            'transparent' => true, 
                            'required' => array('header-style', 'equals', array(
                                    '1'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header1-fixed-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '1'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header1-fixed-menu-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Menu Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '1'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header2-fixed-bgcolor',
                            'type' => 'color',
                            'title' => esc_html__('Header Background Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '',
                            'transparent' => true, 
                            'required' => array('header-style', 'equals', array(
                                    '2'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header2-fixed-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '2'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header2-fixed-menu-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Menu Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '2'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header3-fixed-bgcolor',
                            'type' => 'color',
                            'title' => esc_html__('[Fixed Header] Background Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '',
                            'transparent' => true, 
                            'required' => array('header-style', 'equals', array(
                                    '3'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header3-fixed-color',
                            'type' => 'color',
                            'title' => esc_html__('[Fixed Header] Header Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '3'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header3-fixed-menu-color',
                            'type' => 'color',
                            'title' => esc_html__('[Fixed Header] Header Menu Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#000',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '3'
                                )),                                                     
                        ),
						array(
                            'id' => 'header4-fixed-bgcolor',
                            'type' => 'color',
                            'title' => esc_html__('Header Background Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '',
                            'transparent' => true, 
                            'required' => array('header-style', 'equals', array(
                                    '4'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header4-fixed-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '4'
                                )),                                                     
                        ), 
						array(
                            'id' => 'header4-fixed-menu-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Menu Color', 'cryptcio'),
                            'validate' => 'color',
							'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '4'
                                )),                                                     
                        ),
                        array(
                            'id' => 'header5-fixed-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '5'
                                )),                                                     
                        ), 
                        array(
                            'id' => 'header5-fixed-menu-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Menu Color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '5'
                                )),                                                     
                        ),  
						array(
                            'id' => 'header6-fixed-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '6'
                                )),                                                     
                        ), 
                        array(
                            'id' => 'header6-fixed-menu-color',
                            'type' => 'color',
                            'title' => esc_html__('Header Menu Color', 'cryptcio'),
                            'validate' => 'color',
                            'default' => '#fff',
                            'transparent' => false, 
                            'required' => array('header-style', 'equals', array(
                                    '6'
                                )),                                                     
                        ),  	
					)
				),
                array(
                    'icon' => 'el-icon-edit',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Footer', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'footer-type',
                            'type' => 'image_select',
                            'title' => esc_html__('Footer Type', 'cryptcio'),
                            'options' => $this->cryptcio_footer_types(),
                            'subtitle' => esc_html__('Each page will have option for select footer type. Footer selection in each page will have higher priority than this general selection.','cryptcio'),
                            'default' => '1'
                        ),
                        array(
                            'id' => 'footer-position',
                            'type' => 'switch',
                            'title' => esc_html__('Footer Fixed', 'cryptcio'),
                            'default' => false,
                        ), 
                        array(
                            'id' => 'logo_footer',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Footer logo', 'cryptcio'), 
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo_footer.png',
                            ),
							'required' => array('footer-type', 'equals', array(
                                    '1','2','3'
                                )),  
                        ),  
						array(
                            'id' => 'logo_footer_2',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Footer logo', 'cryptcio'), 
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo.png',
                            ),
							'required' => array('footer-type', 'equals', array(
                                    '5'
                                )), 
                        ), 
						array(
                            'id' => 'show-footer-bottom',
                            'type' => 'switch',
                            'title' => esc_html__('Show Footer Bottom', 'cryptcio'),
                            'default' => false,
							'required' => array('footer-type', 'equals', array(
                                    '5'
                                )), 
                        ),
                        array(
                            'id' => "footer-copyright",
                            'type' => 'textarea',
                            'title' => esc_html__('Copyright', 'cryptcio'),
                            'default' => wp_kses( __(' <p>Design by <a href="#">AHT Studio</a>. &copy; 2018 All Right Reserved </p>', 'cryptcio'),
                                array(
                                'a' => array(
                                    'href' => array(),
                                    'title' => array(),
                                    'target' => array(),
                                ),
                                'p' => array('class' => array()),
                                'br' => array(),
                                'i' => array(
                                    'class' => array(),
                                    'aria-hidden' => array(),
                                ),
                            )),                   
                        ),                       
                        array(
                            'id' => "footer-info",
                            'type' => 'textarea',
                            'title' => esc_html__('Description  footer', 'cryptcio'),
                            'default' => wp_kses( __(' <p>Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'cryptcio'),
                                array(
                                'a' => array(
                                    'href' => array(),
                                    'title' => array(),
                                    'target' => array(),
                                ),
                                'p' => array('class' => array()),
                                'br' => array(),
                                'i' => array(
                                    'class' => array(),
                                    'aria-hidden' => array(),
                                ),
                            )), 
                            'required' => array('footer-type', 'equals', array(
                                    '2','3'
                                )),                            
                        ),
                        array(
                            'id' => 'show-payment',
                            'type' => 'switch',
                            'title' => esc_html__('Show Payment', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),
                         array(
                            'id' => 'link-paypal',
                            'type' => 'text',
                            'title' => esc_html__('Paypal', 'cryptcio'),
                            'required' => array('show-payment', 'equals', 1),
                            'default' => '#', 
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),
                        array(
                            'id' => 'link-visa',
                            'type' => 'text',
                            'title' => esc_html__('Visa', 'cryptcio'),
                            'required' => array('show-payment', 'equals', 1),
                            'default' => '#', 
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),
                        array(
                            'id' => 'link-mastercard',
                            'type' => 'text',
                            'title' => esc_html__('Master card', 'cryptcio'),
                            'required' => array('show-payment', 'equals', 1),
                            'default' => '#', 
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),
                        array(
                            'id' => 'link-discover',
                            'type' => 'text',
                            'title' => esc_html__('Discover', 'cryptcio'),
                            'required' => array('show-payment', 'equals', 1),
                            'default' => '#', 
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),
                        array(
                            'id' => 'link-amex',
                            'type' => 'text',
                            'title' => esc_html__('Amex', 'cryptcio'),
                            'required' => array('show-payment', 'equals', 1),
                            'default' => '#', 
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),
                        
                    )
                ),
                array(
                    'icon_class' => 'el-icon-edit',
                    'subsection' => true,
                    'title' => esc_html__('Social link', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'show-social',
                            'type' => 'switch',
                            'title' => esc_html__('Show footer social', 'cryptcio'),
                            'default' => false,
                        ),                                               
                        array(
                            'id' => 'social-facebook',
                            'type' => 'text',
                            'title' => esc_html__('Facebook', 'cryptcio'),
                            'default' => 'https://facebook.com/arrowpress',
                            'placeholder' => esc_html__('https://facebook.com/arrowpress', 'cryptcio')
                        ),                        
                        array(
                            'id' => 'social-twitter',
                            'type' => 'text',
                            'title' => esc_html__('Twitter', 'cryptcio'),
                            'default' => 'https://twitter.com/arrowpress1',
                            'placeholder' => esc_html__('https://twitter.com/arrowpress1', 'cryptcio'),
                        ),
                        array(
                            'id' => 'social-youtube',
                            'type' => 'text',
                            'title' => esc_html__('Youtube', 'cryptcio'),
                            'default' => '#',                            
                            'placeholder' => esc_html__('http://', 'cryptcio'),
                        ),                        
                        array(
                            'id' => 'social-skype',
                            'type' => 'text',
                            'title' => esc_html__('Skype', 'cryptcio'),
                            'placeholder' => esc_html__('http://', 'cryptcio'),
                        ),                        
                        array(
                            'id' => 'social-google',
                            'type' => 'text',
                            'title' => esc_html__('Google', 'cryptcio'),
                            'default' => '#', 
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ), 
                        array(
                            'id' => 'social-instagram',
                            'type' => 'text',
                            'title' => esc_html__('Instagram', 'cryptcio'),
                            'placeholder' => esc_html__('https://www.instagram.com/cryptciobaber/', 'cryptcio')
                        ),       
                        array(
                            'id' => 'social-pinterest',
                            'type' => 'text',
                            'title' => esc_html__('Pinterest', 'cryptcio'),
                            'default' => '#', 
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),
                        array(
                            'id' => 'social-dribbble',
                            'type' => 'text',
                            'title' => esc_html__('Dribbble', 'cryptcio'),
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),
                        array(
                            'id' => 'social-linkedin',
                            'type' => 'text',
                            'title' => esc_html__('Linkedin', 'cryptcio'),
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),                   
                        array(
                            'id' => 'social-behance',
                            'type' => 'text',
                            'title' => esc_html__('Behance', 'cryptcio'),
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ), 
                         array(
                            'id' => 'social-slack',
                            'type' => 'text',
                            'title' => esc_html__('Slack', 'cryptcio'),
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),                   
                        array(
                            'id' => 'social-github',
                            'type' => 'text',
                            'title' => esc_html__('Github', 'cryptcio'),
                            'placeholder' => esc_html__('http://', 'cryptcio')
                        ),                         
                    ),
                ),
                array(
                    'icon_class' => 'el-icon-edit',
                    'subsection' => true,
                    'title' => esc_html__('Footer Styling', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'footer-style',
                            'type' => 'select',
                            'title' => esc_html__('Select footer for styling', 'cryptcio'),
                            'options' => cryptcio_footer_types(),
                            'default' => '1',
                        ),
                        //Footer 1 
                        array(
                            'id' => 'bg_newsletter',
                            'type' => 'background',
                            'title' => esc_html__('Background newsletter', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#f5b71f',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '1'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-newsletter',
                                'background-size' => '.footer-newsletter',
                                'background-repeat' => '.footer-newsletter',
                                'background-position' => '.footer-newsletter',
                                'background-attachment' => '.footer-newsletter',
                                'background-color' =>'.footer-newsletter',
                            ),                                                              
                        ), 
                        array(
                            'id' => 'bg_img_footer1',
                            'type' => 'background',
                            'title' => esc_html__('Background footer', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#282828',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '1'
                            )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v1',
                                'background-size' => '.footer-v1',
                                'background-repeat' => '.footer-v1',
                                'background-position' => '.footer-v1',
                                'background-attachment' => '.footer-v1',
                                'background-color' =>'.footer-v1',
                            ),                                                              
                        ),    
                          array(
                            'id' => 'bg_footer1_bottom',
                            'type' => 'background',
                            'title' => esc_html__('Background Footer Bottom', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#1b1b1b',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '1'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-bottom',
                                'background-size' => '.footer-bottom',
                                'background-repeat' => '.footer-bottom',
                                'background-position' => '.footer-bottom',
                                'background-attachment' => '.footer-bottom',
                                'background-color' =>'.footer-bottom',
                            ),                                                              
                        ),                
                        array(
                            'id' => 'footer1-t-color',
                            'type' => 'color',
                            'title' => esc_html__('Title color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '1'
                                )),
                            'default' => '#f5b71f',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v1 .footer-title'),
                        ), 
                        array(
                            'id' => 'footer1-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer text color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '1'
                                )),
                            'default' => '#fff',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v1','.footer-v1 .widget_nav_menu li a','.footer-v1 .footer-social li a'),
                        ), 
                        array(
                            'id' => 'footer1-copyright-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer copyright color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '1'
                                )),
                            'default' => '#9a9a9a',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v1 .copyright-content p','.footer .footer-v1 .copyright-content p a'),
                        ), 
                        array(
                            'id' => 'footer1-payment-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer payment color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '1'
                                )),
                            'default' => '#fff',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v1 .payment ul li a'),
                        ), 
                         //Footer 2
                        array(
                            'id' => 'bg_img_footer2',
                            'type' => 'background',
                            'title' => esc_html__('Background footer', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#13264a',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '2'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v2',
                                'background-size' => '.footer-v2',
                                'background-repeat' => '.footer-v2',
                                'background-position' => '.footer-v2',
                                'background-attachment' => '.footer-v2',
                                'background-color' =>'.footer-v2',
                            ),                                                              
                        ),  
                        array(
                            'id' => 'bg_footer2_bottom',
                            'type' => 'background',
                            'title' => esc_html__('Background Footer Bottom', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#0e1e3e',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '2'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v2 .footer-bottom',
                                'background-size' => '.footer-v2 .footer-bottom',
                                'background-repeat' => '.footer-v2 .footer-bottom',
                                'background-position' => '.footer-v2 .footer-bottom',
                                'background-attachment' => '.footer-v2 .footer-bottom',
                                'background-color' =>'.footer-v2 .footer-bottom',
                            ),                                                              
                        ),                    
                        array(
                             'id' => 'footer2-t-color',
                            'type' => 'color',
                            'title' => esc_html__('Title color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '2'
                                )),
                            'default' => '#d5a853',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v2 .footer-title'),
                        ),    
                        array(
                            'id' => 'footer2-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer text color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '2'
                                )),
                            'default' => '#fff',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v2','.footer-v2 .list-info-footer li a',
                                '.footer-v2 .widget_nav_menu li a','.footer-v2 .tagcloud a',
                                '.footer-v2 .copyright-content p','.footer-v2 .payment ul li a'),
                        ), 
                         array(
                            'id' => 'footer2-copyright-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer copyright color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '2'
                                )),
                            'default' => '#2d3e5e',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v2 .copyright-content p','.footer .footer-v2 .copyright-content p a','.footer-v2 .payment ul li a'),
                        ), 
                        //Footer 3
                        array(
                            'id' => 'bg_img_footer3',
                            'type' => 'background',
                            'title' => esc_html__('Background footer', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#fcfcfc',
                                'background-image' => get_template_directory_uri() . '/images/bg-footer3.png',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '3'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v3 ',
                                'background-size' => '.footer-v3 ',
                                'background-repeat' => '.footer-v3 ',
                                'background-position' => '.footer-v3',
                                'background-attachment' => '.footer-v3 ',
                                'background-color' =>'.footer-v3 ',
                            ),                                                              
                        ),   
                         array(
                            'id' => 'bg_footer3_bottom',
                            'type' => 'background',
                            'title' => esc_html__('Background Footer Bottom', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#0e1e3e',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '3'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v3 .footer-bottom',
                                'background-size' => '.footer-v3 .footer-bottom',
                                'background-repeat' => '.footer-v3 .footer-bottom',
                                'background-position' => '.footer-v3 .footer-bottom',
                                'background-attachment' => '.footer-v3 .footer-bottom',
                                'background-color' =>'.footer-v3s .footer-bottom',
                            ),                                                              
                        ), 
                        array(
                            'id' => 'footer3-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer text color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '3'
                                )),
                            'default' => '#fff',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v3','.list-item-info .info-mail a', '.list-item-info .info-number a',
                                '.contact-form input[type="text"]', '.contact-form input[type="email"]', '.contact-form textarea, .contact-form input','.contact-form label span'
                                ),
                        ), 
                         array(
                            'id' => 'footer3-copyright-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer copyright color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '3'
                                )),
                            'default' => '#2d3e5e',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v3 .copyright-content p','.footer .footer-v3 .copyright-content p a','.footer-v3 .payment ul li a'),
                        ),
                         array(
                            'id'        => 'footer3-border',
                            'type'      => 'color_rgba',
                            'title'     => esc_html__('Footer border color', 'cryptcio'),                       
                            'output'    => array('border-color' => '.footer-v3 .footer-form'),
                            'options'       => array(
                                'show_input'                => true,
                                'show_initial'              => true,
                                'show_alpha'                => true,
                                'show_palette'              => true,
                                'show_palette_only'         => false,
                                'show_selection_palette'    => true,
                                'max_palette_size'          => 10,
                                'allow_empty'               => true,
                                'clickout_fires_change'     => false,
                                'choose_text'               => 'Choose',
                                'cancel_text'               => 'Cancel',
                                'show_buttons'              => true,
                                'use_extended_classes'      => true,
                                'palette'                   => null,  // show default
                                'input_text'                => 'Select Color'
                            ), 
                            'required' => array('footer-style', 'equals', array(
                                    '3'
                                )),                                               
                        ),   
                        array(
                            'id'        => 'footer3-border-form',
                            'type'      => 'color_rgba',
                            'title'     => esc_html__('Footer border form color', 'cryptcio'),                       
                            'output'    => array('border-color' => '.contact-form input[type="text"]', '.contact-form input[type="email"]', '.contact-form textarea', '.contact-form input'),
                            'options'       => array(
                                'show_input'                => true,
                                'show_initial'              => true,
                                'show_alpha'                => true,
                                'show_palette'              => true,
                                'show_palette_only'         => false,
                                'show_selection_palette'    => true,
                                'max_palette_size'          => 10,
                                'allow_empty'               => true,
                                'clickout_fires_change'     => false,
                                'choose_text'               => 'Choose',
                                'cancel_text'               => 'Cancel',
                                'show_buttons'              => true,
                                'use_extended_classes'      => true,
                                'palette'                   => null,  // show default
                                'input_text'                => 'Select Color'
                            ), 
                            'required' => array('footer-style', 'equals', array(
                                    '3'
                                )),                                               
                        ), 
                        //Footer 4
                        array(
                            'id' => 'bg_img_footer4',
                            'type' => 'background',
                            'title' => esc_html__('Background footer', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#f5f5f5',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '4'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v4 ',
                                'background-size' => '.footer-v4 ',
                                'background-repeat' => '.footer-v4 ',
                                'background-position' => '.footer-v4',
                                'background-attachment' => '.footer-v4 ',
                                'background-color' =>'.footer-v4 ',
                            ),                                                              
                        ),  
                         array(
                            'id' => 'bg_footer4_bottom',
                            'type' => 'background',
                            'title' => esc_html__('Background Footer Bottom', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#282828',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '4'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v4 .footer-bottom',
                                'background-size' => '.footer-v4 .footer-bottom',
                                'background-repeat' => '.footer-v4 .footer-bottom',
                                'background-position' => '.footer-v4 .footer-bottom',
                                'background-attachment' => 'footer-v4 .footer-bottom',
                                'background-color' =>'footer-v4 .footer-bottom',
                            ),                                                              
                        ),    
                         array(
                            'id' => 'footer4-t-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer title color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '4'
                                )),
                            'default' => '#282828',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v4 .contact-form label span'
                                ),
                        ),  
                        array(
                            'id' => 'footer4-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer text color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '4'
                                )),
                            'default' => '#8b8b8b',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v4',
                                '.footer-v4 .contact-form input[type="text"]', ' .footer-v4 .contact-form input[type="email"]', ' .footer-v4 .contact-form textarea,.footer-v4 .contact-form input[type="tel"]',
                                ),
                        ), 
                         array(
                            'id' => 'footer4-copyright-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer copyright color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '4'
                                )),
                            'default' => '#b6b6b6',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v4 .copyright-content p','.footer-v4 .copyright-content p a','.footer-v4 .payment ul li a'),
                        ), 
                        array(
                            'id'        => 'footer4-border-form',
                            'type'      => 'color_rgba',
                            'title'     => esc_html__('Footer border form color', 'cryptcio'),                       
                            'output'    => array('border-color' => '.footer-v4 .contact-form input[type="text"]', '.footer-v4 .contact-form input[type="email"]', '.footer-v4 .contact-form textarea', '.footer-v4 .contact-form input[type="tel"]'),
                            'options'       => array(
                                'show_input'                => true,
                                'show_initial'              => true,
                                'show_alpha'                => true,
                                'show_palette'              => true,
                                'show_palette_only'         => false,
                                'show_selection_palette'    => true,
                                'max_palette_size'          => 10,
                                'allow_empty'               => true,
                                'clickout_fires_change'     => false,
                                'choose_text'               => 'Choose',
                                'cancel_text'               => 'Cancel',
                                'show_buttons'              => true,
                                'use_extended_classes'      => true,
                                'palette'                   => null,  // show default
                                'input_text'                => 'Select Color'
                            ), 
                            'required' => array('footer-style', 'equals', array(
                                    '4'
                                )),                                               
                        ), 
						//Footer 5
						array(
                            'id' => 'footer_menu_top',
                            'title' => esc_html__('Select Menu Footer', 'cryptcio'),
                            'type' => 'select',
                            'options' => $menu_list,
                            'default' => 'default',
                            'required' => array('footer-style', 'equals', array(
                                    '5'
                                )), 
                        ),
                        array(
                            'id' => 'bg_img_footer5',
                            'type' => 'background',
                            'title' => esc_html__('Background footer', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#fff',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'inherit'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '5'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v5 ',
                                'background-size' => '.footer-v5 ',
                                'background-repeat' => '.footer-v5 ',
                                'background-position' => '.footer-v5',
                                'background-attachment' => '.footer-v5 ',
                                'background-color' =>'.footer-v5 ',
                            ),                                                              
                        ),  
						array(
                            'id' => 'bg_footer5_menu',
                            'type' => 'background',
                            'title' => esc_html__('Background Footer Menu', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#282828',
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '5'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v5 .footer-menu',
                                'background-size' => '.footer-v5 .footer-menu',
                                'background-repeat' => '.footer-v5 .footer-menu',
                                'background-position' => '.footer-v5 .footer-menu',
                                'background-attachment' => 'footer-v5 .footer-menu',
                                'background-color' =>'footer-v5 .footer-menu',
                            ),                                                              
                        ), 
                        array(
                            'id' => 'bg_footer5_bottom',
                            'type' => 'background',
                            'title' => esc_html__('Background Footer Bottom', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#fff',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '5'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v5 .footer-bottom',
                                'background-size' => '.footer-v5 .footer-bottom',
                                'background-repeat' => '.footer-v5 .footer-bottom',
                                'background-position' => '.footer-v5 .footer-bottom',
                                'background-attachment' => 'footer-v5 .footer-bottom',
                                'background-color' =>'footer-v5 .footer-bottom',
                            ),                                                              
                        ), 
						array(
                            'id' => 'footer5-icon-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer icon color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '5'
                                )),
                            'default' => '#a4a4a4',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v5',
                                '.footer-v5 .footer-social li a', 
                                ),
                        ), 
                        array(
                            'id' => 'footer5-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer text color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '5'
                                )),
                            'default' => '#575454',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v5',
                                '.footer-v5 .mc4wp-form-fields .form-mail input[type="email"]', 
								'.footer-v5 .mc4wp-form-fields .form-mail p.submit::before', 
                                ),
                        ), 
                        array(
                            'id' => 'footer5-copyright-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer copyright color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '4'
                                )),
                            'default' => '#575454',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v5 .copyright-content p','.footer-v5 .copyright-content p a','.footer-v5 .payment ul li a'),
                        ), 
                        array(
                            'id'        => 'footer5-border',
                            'type'      => 'color_rgba',
                            'title'     => esc_html__('Footer border form color', 'cryptcio'),                       
                            'output'    => array('border-color' => '.footer-v5 .bottom-footer'),
                            'options'       => array(
                                'show_input'                => true,
                                'show_initial'              => true,
                                'show_alpha'                => true,
                                'show_palette'              => true,
                                'show_palette_only'         => false,
                                'show_selection_palette'    => true,
                                'max_palette_size'          => 10,
                                'allow_empty'               => true,
                                'clickout_fires_change'     => false,
                                'choose_text'               => 'Choose',
                                'cancel_text'               => 'Cancel',
                                'show_buttons'              => true,
                                'use_extended_classes'      => true,
                                'palette'                   => null,  // show default
                                'input_text'                => 'Select Color'
                            ), 
                            'required' => array('footer-style', 'equals', array(
                                    '5'
                                )),                                               
                        ),
                        //Footer 6 
                        array(
                            'id' => 'bg_newsletter6',
                            'type' => 'background',
                            'title' => esc_html__('Background newsletter', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#f5b71f',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '6'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v6 .footer-newsletter',
                                'background-size' => '.footer-v6 .footer-newsletter',
                                'background-repeat' => '.footer-v6 .footer-newsletter',
                                'background-position' => '.footer-v6 .footer-newsletter',
                                'background-attachment' => '.footer-v6 .footer-newsletter',
                                'background-color' =>'.footer-v6 .footer-newsletter',
                            ),                                                              
                        ), 
                          array(
                            'id' => 'bg_footer6',
                            'type' => 'background',
                            'title' => esc_html__('Background Footer Bottom', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#282828',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '6'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v6',
                                'background-size' => '.footer-v6',
                                'background-repeat' => '.footer-v6',
                                'background-position' => '.footer-v6',
                                'background-attachment' => '.footer-v6',
                                'background-color' =>'.footer-v6',
                            ),                                                              
                        ),                
                        array(
                            'id' => 'footer6-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer text color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '6'
                                )),
                            'default' => '#fff',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v6','.footer-v6 .widget_nav_menu li a','.footer-v6 .footer-social li a'),
                        ), 
                        array(
                            'id' => 'footer6-newsletter-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer payment color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '6'
                                )),
                            'default' => '#000',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v6 .footer-newsletter'),
                        ), 
                         //Footer 7
                        array(
                            'id' => 'bg_img_footer7',
                            'type' => 'background',
                            'title' => esc_html__('Background footer', 'cryptcio'),
                            'background-color' => true, 
                            'default' => array(
                                'background-color' =>'#120436',
                                'background-image' => '',
                                'background-size' => 'cover',
                                'background-repeat' => 'no-repeat',
                                'background-position' => 'center center',
                                'background-attachment' => 'fixed'
                            ),
                            'required' => array('footer-style', 'equals', array(
                                    '7'
                                )),                            
                            'output'    => array(
                                'background-image' =>'.footer-v7',
                                'background-size' => '.footer-v7',
                                'background-repeat' => '.footer-v7',
                                'background-position' => '.footer-v7',
                                'background-attachment' => '.footer-v7',
                                'background-color' =>'.footer-v7',
                            ),                                                              
                        ),  
                           array(
                            'id' => 'footer7-t-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer title color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '7'
                                )),
                            'default' => '#45b7f4',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v7 .footer-title'),
                        ),              
                        array(
                            'id' => 'footer7-color',
                            'type' => 'color',
                            'title' => esc_html__('Footer text color', 'cryptcio'),
                            'required' => array('footer-style', 'equals', array(
                                    '7'
                                )),
                            'default' => '#fff',
                            'validate' => 'color',
                            'transparent' =>false,
                            'output' => array('.footer-v7','.footer-v7 .list-info-footer li a',
                                '.footer-v7 .widget_nav_menu li a','.footer-v7 .tagcloud a',
                                '.footer-v7 .copyright-content p','.footer-v7 .payment ul li a'),
                        ), 
                    )
                ),                
                array(
                    'icon' => 'el-icon-th',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Blog', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => '1',
                            'type' => 'info',
                            'desc' => esc_html__('Blog layout default', 'cryptcio')
                        ),
                        array(
                            'id' => 'blog-title',
                            'type' => 'text',
                            'title' => esc_html__('Page Title', 'cryptcio'),
                            'default' => 'Blog'
                        ),                        
                        array(
                            'id' => 'post-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'cryptcio'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-post-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-post-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id'=>'post-share',
                            'type' => 'button_set',
                            'title' => esc_html__('Post Share Links', 'cryptcio'),
                            'multi' => true,
                            'options'=> array(
                                'facebook' => esc_html__('Facebook', 'cryptcio'),
                                'twitter' => esc_html__('Twitter', 'cryptcio'),
                                'pin' => esc_html__('Pinterest', 'cryptcio'),
                                'insta' => esc_html__('Instagram', 'cryptcio'),
                                'linkedin' => esc_html__('Linkedin', 'cryptcio'),
                            ), 
                            'default' => array(''),
                        ),    
                        array(
                            'id' => 'post_default_date',
                            'type' => 'switch',
                            'title' => esc_html__('Use default date format in Settings > General', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ),                                                                                                                                       
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Blog Archive', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'post-layout-version',
                            'type' => 'button_set',
                            'title' => esc_html__('Blog Layout', 'cryptcio'),
                            'options' => cryptcio_page_blog_layouts(),
                            'default' => 'list'
                        ),
                        array(
                            'id' => 'post-layout-columns',
                            'type' => 'button_set',
                            'title' => esc_html__('Blog Columns', 'cryptcio'),
                            'options' => cryptcio_page_blog_columns(),
                            'default' => '3',
                            'required' => array('post-layout-version', 'equals', array(
                                    'grid','masonry',
                                )),                            
                        ),                                                               
                        array(
                            'id' => 'post_pagination',
                            'type' => 'button_set',
                            'title' => esc_html__('Pagination type', 'cryptcio'),
                            'options' => array(
                                '1' => esc_html__('Load more','cryptcio'),
                                '2' => esc_html__('Next/Prev','cryptcio'),
                                '3' => esc_html__('Number','cryptcio'),
                             ),
                            'default' => '3'
                        ), 
                        array(
                            'id'=>'toolbar-post',
                            'type' => 'button_set',
                            'title' => esc_html__('Toolbar', 'cryptcio'),
                            'multi' => true,
                            'options'=> array(
                                'count' => esc_html__('Count', 'cryptcio'),
                                'cat' => esc_html__('Categories', 'cryptcio'),
                                'archive' => esc_html__('Archive', 'cryptcio'),
                                'seach' => esc_html__('Search', 'cryptcio'),
                            ),
                            'default' => array('count','cat','archive','seach'),                            
                        ),                        
                        array(
                            'id'=>'post-meta2',
                            'type' => 'button_set',
                            'title' => esc_html__('Post Meta', 'cryptcio'),
                            'multi' => true,
                            'options'=> array(
                                'author' => esc_html__('Author', 'cryptcio'),
                                'comment' => esc_html__('Comment', 'cryptcio'),
                                'date' => esc_html__('Date', 'cryptcio'),
                                'like' => esc_html__('Like', 'cryptcio'),
                                'cat' => esc_html__('Categories', 'cryptcio'),
                                'tag' => esc_html__('Tags', 'cryptcio'),
                                'view' => esc_html__('View', 'cryptcio'),
                            ),
                            'default' => array('comment','tag','date','author'),                            
                        ),   
                           array(
                            'id'       => 'post_per_page',
                            'type'     => 'spinner', 
                            'title'    => esc_html__('Post show per page', 'cryptcio'),
                            'default'  => '4',
                            'min'      => '1',
                            'step'     => '1',
                            'max'      => '20',
                        )                                                                                     
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Single Blog', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'single-post-layout-version',
                            'type' => 'button_set',
                            'title' => esc_html__('Single Blog Layout', 'cryptcio'),
                            'options' => cryptcio_page_single_blog_layouts(),
                            'default' => 'single-1'
                        ),
                        array(
                            'id'=>'post-meta-single',
                            'type' => 'button_set',
                            'title' => esc_html__('Post Meta in post detail page', 'cryptcio'),
                            'multi' => true,
                            'options'=> array(
                                'author' => esc_html__('Author', 'cryptcio'),
                                'comment' => esc_html__('Comment', 'cryptcio'),
                                'date' => esc_html__('Date', 'cryptcio'),
                                'like' => esc_html__('Like', 'cryptcio'),
                                'cat' => esc_html__('Categories', 'cryptcio'),
                                'tag' => esc_html__('Tags', 'cryptcio'),
                                'view' => esc_html__('View', 'cryptcio'),
                            ),
                            'default' => array('comment','tag','date','author'),                          
                        ),
                    )
                ),
				array(
                    'icon' => 'el-icon-briefcase',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Project', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => '2',
                            'type' => 'info',
                            'desc' => esc_html__('Project Archive Page', 'cryptcio')
                        ),                                               
                        array(
                           'id' => 'section-start',
                           'type' => 'section',
                           'title' => esc_html__('Changing project slug', 'cryptcio'),
                           'indent' => true,                    
                        ),                        
                        array(
                            'id'        => 'project_slug',
                            'type'      => 'text',
                            'title'     => esc_html__('Custom Slug', 'cryptcio'),
                            'subtitle'  => esc_html__('If you want your project post type to have a custom slug in the url, please enter it here.', 'cryptcio'),
                            'desc'      => esc_html__('You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.', 'cryptcio'),
                            'validate'  => 'str_replace',
                            'str'       => array(
                                'search'        => ' ', 
                                'replacement'   => '-'
                            ),
                            'default'   => 'project',                    
                        ),  
                        array(
                            'id'        => 'project_cat_slug',
                            'type'      => 'text',
                            'title'     => esc_html__('Custom Project Category Slug', 'cryptcio'),
                            'subtitle'  => esc_html__('If you want your project post type to have a custom slug in the url, please enter it here.', 'cryptcio'),
                            'desc'      => esc_html__('You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.', 'cryptcio'),
                            'validate'  => 'str_replace',
                            'str'       => array(
                                'search'        => ' ', 
                                'replacement'   => '-'
                            ),
                            'default'   => 'project_cat',                    
                        ),                        
                        array(
                            'id'     => 'section-end',
                            'type'   => 'section',
                            'indent' => false,                        
                        ),                                                                                    
                        array(
                            'id' => 'project-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('General Layout', 'cryptcio'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(

                            'id' => 'left-project-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-project-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'project-cols',
                            'type' => 'button_set',
                            'title' => esc_html__('Project Columns', 'cryptcio'),
                            'options' => cryptcio_page_blog_columns(),
                            'default' => '3',
                        ),                              
                        array(
                            'id' => 'project_show_more',
                            'type' => 'switch',
                            'title' => esc_html__('Show view more', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ),         
                        array(
                            'id'       => 'project_per_page',
                            'type'     => 'spinner', 
                            'title'    => esc_html__('Post show per page', 'cryptcio'),
                            'default'  => '8',
                            'min'      => '1',
                            'step'     => '1',
                            'max'      => '20',
                        ),
                        array(
                            'id' => 'project_pagination',
                            'type' => 'button_set',
                            'title' => esc_html__('Pagination type', 'cryptcio'),
                            'options' => array(
                                '1' => esc_html__('Load more','cryptcio'),
                                '2' => esc_html__('Next/Prev','cryptcio'),
                                '3' => esc_html__('Number','cryptcio'),
                             ),
                            'default' => '3'
                        ),                         
                    )                      
                ),
				array(
                    'icon' => 'el-icon-user',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Service', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => '2',
                            'type' => 'info',
                            'desc' => esc_html__('Service Archive Page', 'cryptcio')
                        ),                                               
                        array(
                           'id' => 'section-start',
                           'type' => 'section',
                           'title' => esc_html__('Changing service slug', 'cryptcio'),
                           'indent' => true,                    
                        ),                        
                        array(
                            'id'        => 'service_slug',
                            'type'      => 'text',
                            'title'     => esc_html__('Custom Slug', 'cryptcio'),
                            'subtitle'  => esc_html__('If you want your service post type to have a custom slug in the url, please enter it here.', 'cryptcio'),
                            'desc'      => esc_html__('You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.', 'cryptcio'),
                            'validate'  => 'str_replace',
                            'str'       => array(
                                'search'        => ' ', 
                                'replacement'   => '-'
                            ),
                            'default'   => 'service',                    
                        ),  
                        array(
                            'id'        => 'service_cat_slug',
                            'type'      => 'text',
                            'title'     => esc_html__('Custom Service Category Slug', 'cryptcio'),
                            'subtitle'  => esc_html__('If you want your service post type to have a custom slug in the url, please enter it here.', 'cryptcio'),
                            'desc'      => esc_html__('You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.', 'cryptcio'),
                            'validate'  => 'str_replace',
                            'str'       => array(
                                'search'        => ' ', 
                                'replacement'   => '-'
                            ),
                            'default'   => 'service_cat',                    
                        ),                        
                        array(
                            'id'     => 'section-end',
                            'type'   => 'section',
                            'indent' => false,                        
                        ),                                                                                    
                        array(
                            'id' => 'service-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('General Layout', 'cryptcio'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(

                            'id' => 'left-service-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-service-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'service-cols',
                            'type' => 'button_set',
                            'title' => esc_html__('Service Columns', 'cryptcio'),
                            'options' => cryptcio_page_blog_columns(),
                            'default' => '3',
                        ),   
                        array(
                            'id'=>'service-metas',
                            'type' => 'button_set',
                            'title' => esc_html__('Post Meta', 'cryptcio'),
                            'multi' => true,
                            'options'=> array(
                                'author' => esc_html__('Author', 'cryptcio'),
                                'date' => esc_html__('Date', 'cryptcio'),
                            ),
                            'default' => array(''),                            
                        ),                            
                        array(
                            'id' => 'service_show_more',
                            'type' => 'switch',
                            'title' => esc_html__('Show view more', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ),         
                        array(
                            'id'       => 'service_per_page',
                            'type'     => 'spinner', 
                            'title'    => esc_html__('Post show per page', 'cryptcio'),
                            'default'  => '8',
                            'min'      => '1',
                            'step'     => '1',
                            'max'      => '20',
                        ),
                        array(
                            'id' => 'service_pagination',
                            'type' => 'button_set',
                            'title' => esc_html__('Pagination type', 'cryptcio'),
                            'options' => array(
                                '1' => esc_html__('Load more','cryptcio'),
                                '2' => esc_html__('Next/Prev','cryptcio'),
                                '3' => esc_html__('Number','cryptcio'),
                             ),
                            'default' => '3'
                        ),                         
                    )                      
                ),
				array(
                    'icon' => 'el-icon-calendar',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Events', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => '2',
                            'type' => 'info',
                            'desc' => esc_html__('Events Archive Page', 'cryptcio')
                        ),                                               
                        array(
                           'id' => 'section-start',
                           'type' => 'section',
                           'title' => esc_html__('Changing events slug', 'cryptcio'),
                           'indent' => true,                    
                        ),                        
                        array(
                            'id'        => 'events_slug',
                            'type'      => 'text',
                            'title'     => esc_html__('Custom Slug', 'cryptcio'),
                            'subtitle'  => esc_html__('If you want your events post type to have a custom slug in the url, please enter it here.', 'cryptcio'),
                            'desc'      => esc_html__('You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.', 'cryptcio'),
                            'validate'  => 'str_replace',
                            'str'       => array(
                                'search'        => ' ', 
                                'replacement'   => '-'
                            ),
                            'default'   => 'events',                    
                        ),  
                        array(
                            'id'        => 'events_cat_slug',
                            'type'      => 'text',
                            'title'     => esc_html__('Custom Events Category Slug', 'cryptcio'),
                            'subtitle'  => esc_html__('If you want your events post type to have a custom slug in the url, please enter it here.', 'cryptcio'),
                            'desc'      => esc_html__('You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.', 'cryptcio'),
                            'validate'  => 'str_replace',
                            'str'       => array(
                                'search'        => ' ', 
                                'replacement'   => '-'
                            ),
                            'default'   => 'events_cat',                    
                        ),                        
                        array(
                            'id'     => 'section-end',
                            'type'   => 'section',
                            'indent' => false,                        
                        ),                                                                                    
                        array(
                            'id' => 'events-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('General Layout', 'cryptcio'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(

                            'id' => 'left-events-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-events-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'events-cols',
                            'type' => 'button_set',
                            'title' => esc_html__('Events Columns', 'cryptcio'),
                            'options' => cryptcio_page_blog_columns(),
                            'default' => '2',
                        ),           
                        array(
                            'id'       => 'events_per_page',
                            'type'     => 'spinner', 
                            'title'    => esc_html__('Post show per page', 'cryptcio'),
                            'default'  => '8',
                            'min'      => '1',
                            'step'     => '1',
                            'max'      => '20',
                        ),
                        array(
                            'id' => 'events_pagination',
                            'type' => 'button_set',
                            'title' => esc_html__('Pagination type', 'cryptcio'),
                            'options' => array(
                                '1' => esc_html__('Load more','cryptcio'),
                                '2' => esc_html__('Next/Prev','cryptcio'),
                                '3' => esc_html__('Number','cryptcio'),
                             ),
                            'default' => '3'
                        ),  
                    )                      
                ),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title' => esc_html__('Single Event', 'cryptcio'),
					'fields' => array(
						array(
							'id'        => 'events_form',
							'type'      => 'text',
							'title'     => esc_html__('Event Form', 'cryptcio'),
							'desc'      => esc_html__('You can copy the shortcode in Contact -> Contacts Form', 'cryptcio'),                 
						),  
					)
				),
                array(
                    'icon' => 'el-icon-shopping-cart',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Shop', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'number-cate',
                            'type' => 'text',
                            'title' => esc_html__('[Desktop] Number of categories to show', 'cryptcio'),
                            'default' => '4',
                            'desc'  => esc_html__('This option will work if you select to display categories in shop archive page.','cryptcio'),
                        ),
						array(
                            'id' => 'product_show_all',
                            'type' => 'switch',
                            'title' => esc_html__('Show/Hiden all filter', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ), 
						array(
                            'id' => 'product-cart',
                            'type' => 'switch',
                            'title' => esc_html__('Show Add to Cart button', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ),
                        array(
                            'id' => 'product-price',
                            'type' => 'switch',
                            'title' => esc_html__('Show Product Price', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ),                        
                        array(
                            'id' => 'product-label',
                            'type' => 'switch',
                            'title' => esc_html__('Show Product Label', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),
                        array(
                            'id' => 'product-link',
                            'type' => 'switch',
                            'title' => esc_html__('Show desire product link', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),                        
						array(
							'id' => 'product-hot',
							'type' => 'switch',
							'title' => esc_html__('Show "Hot" Label', 'cryptcio'),
							'desc' => esc_html__('Will be show in the featured product.', 'cryptcio'),
							'default' => true,
							'on' => esc_html__('Yes', 'cryptcio'),
							'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-label', 'equals', array(
                                    true
                                )), 
						),
						array(
							'id' => 'product-news',
							'type' => 'switch',
							'title' => esc_html__('Show "New" Label', 'cryptcio'),
							'desc' => esc_html__('Will be show in the recent product.', 'cryptcio'),
							'default' => true,
							'on' => esc_html__('Yes', 'cryptcio'),
							'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-label', 'equals', array(
                                    true
                                )), 
						),
						array(
							'id' => 'product-sale',
							'type' => 'switch',
							'title' => esc_html__('Show "Sale" Label', 'cryptcio'),
							'desc' => esc_html__('Will be show in the special product.', 'cryptcio'),
							'default' => true,
							'on' => esc_html__('Yes', 'cryptcio'),
							'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-label', 'equals', array(
                                    true
                                )), 
						),
						array(
							'id' => 'product-sale-percent',
							'type' => 'switch',
							'title' => esc_html__('Show Sale Price Percentage', 'cryptcio'),
							'default' => false,
							'on' => esc_html__('Yes', 'cryptcio'),
							'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-label', 'equals', array(
                                    true
                                )), 
						),
						array(
							'id' => 'new_date',
							'type' => 'text',
							'title' => esc_html__('Days on display new label', 'cryptcio'),
							'default' => '7'
						),
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Product Archive', 'cryptcio'),
                    'fields' => array( 
                        array(
                            'id' => 'shop-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'cryptcio'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-shop-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-shop-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
						array(
							'id' => 'select-slider',
							'type' => 'select',
							'title' => esc_html__('Select Top Banner', 'cryptcio'),
							'options' => $cryptcio_seclect_slider,
							'desc' => esc_html__('Choose a slider to display at the top of pages. You can create a block in Static Block/Add New.', 'cryptcio'),
							'default' => '',
						),
						array(
							'id' => 'product_banner_bottom',
							'type' => 'select',
							'title' => esc_html__('Select Bottom Banner', 'cryptcio'),
							'options' => $block_name,
							'desc' => esc_html__('Choose a static block to display at the top of pages. You can create a block in Static Block/Add New.', 'cryptcio'),
							'default' => '',
						),
						array(
                            'id' => 'product-breadcrumb',
                            'type' => 'switch',
                            'title' => esc_html__('Show Thumbnail Breadcrumb', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ),
						array(
                            'id' => 'show-slogan',
                            'type' => 'switch',
                            'title' => esc_html__('Show Shop Description', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ),
                        array(
                            'id' => 'shop-slogan',
                            'type' => 'textarea',
                            'title' => esc_html__('Shop Description', 'cryptcio'),
                            'default' => esc_html__('It started with a simple idea: Create quality, well-designed products that I wanted myself.','cryptcio'),
							'required' => array('show-slogan', 'equals', array(
                                    true
                                )),  
						),
						array(
                            'id' => 'product-toolbar',
                            'type' => 'switch',
                            'title' => esc_html__('Show Toolbar', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ), 
						array(
                            'id' => 'product-left-toolbar',
                            'type' => 'switch',
							'default' => true,
                            'title' => esc_html__('Left Toolbar', 'cryptcio'),
							'required' => array('product-toolbar', 'equals', array(
                                    true
                                )), 
                        ),
						array(
                            'id' => 'product-right-toolbar',
                            'type' => 'switch',
                            'title' => esc_html__('Right Toolbar', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-toolbar', 'equals', array(
                                    true
                                )), 
                        ), 
						array(
                            'id' => 'product-price-ajax',
                            'type' => 'switch',
							'class' => 'redux_field_child',
                            'title' => esc_html__('Show Price Ajax', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-right-toolbar', 'equals', array(
                                    true
                                )),  
                        ), 
						array(
                            'id' => 'product-select-cate',
                            'type' => 'switch',
							'class' => 'redux_field_child',
                            'title' => esc_html__('Show Select Category', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-right-toolbar', 'equals', array(
                                    true
                                )),  
                        ), 
						array(
                            'id' => 'product-sortby',
                            'type' => 'switch',
							'class' => 'redux_field_child',
                            'title' => esc_html__('Show Sort By', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-right-toolbar', 'equals', array(
                                    true
                                )),  
                        ), 
						array(
                            'id' => 'product-result-count',
                            'type' => 'switch',
							'class' => 'redux_field_child',
                            'title' => esc_html__('Show Result Count', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-right-toolbar', 'equals', array(
                                    true
                                )),  
                        ), 
						array(
                            'id' => 'product-view-mode',
                            'type' => 'switch',
							'class' => 'redux_field_child',
                            'title' => esc_html__('Show View Mode', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
							'required' => array('product-right-toolbar', 'equals', array(
                                    true
                                )),  
                        ), 
                        array(
                            'id' => 'category-item',
                            'type' => 'text',
                            'title' => esc_html__('Products Per Page', 'cryptcio'),
                            'desc' => esc_html__('Comma separated list of product counts.', 'cryptcio'),
                            'default' => '12,16,24'
                        ),
                        array(
                            'id' => 'product-layouts',
                            'type' => 'button_set',
                            'title' => esc_html__('Product Layouts', 'cryptcio'),
                            'options' => cryptcio_product_type(),
                            'default' => 'grid-default',
                        ),
                        array(
                            'id' => 'product-cols',
                            'type' => 'button_set',
                            'title' => esc_html__('Product Columns', 'cryptcio'),
                            'options' => cryptcio_product_columns(),
                            'default' => '4',
                            'required' => array('product-layouts', 'equals', array(
                                    'only-grid'
                                )),                             
                        ),
						array(
                            'id' => 'product-pagination',
                            'type' => 'button_set',
                            'title' => esc_html__('Product Pagination', 'cryptcio'),
                            'default' => true,
                            'options' => cryptcio_pagination_types(),
                            'default' => 'loadmore'
                        ),
                        array(
                            'id' => 'product-quickview',
                            'type' => 'switch',
                            'title' => esc_html__('Show Quickview', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),
                        array(
                            'id' => 'product-compare',
                            'type' => 'switch',
                            'title' => esc_html__('Show Compare', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio')
                        ),
                        array(
                            'id' => 'product-wishlist',
                            'type' => 'switch',
                            'title' => esc_html__('Show Wishlist', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),  
                        array(
                            'id' => 'product-link',
                            'type' => 'switch',
                            'title' => esc_html__('Show Product Link Icon', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),                         
                    )
                ),
                array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => esc_html__('Single Product', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'single-product-layout',
                            'type' => 'button_set',
                            'title' => esc_html__('Layout', 'cryptcio'),
                            'options' => $page_layout,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id' => 'left-single-product-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Left Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
                        array(
                            'id' => 'right-single-product-sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Select Right Sidebar', 'cryptcio'),
                            'data' => 'sidebars',
                            'default' => ''
                        ),
						array(
                            'id' => 'single-product-style',
                            'type' => 'button_set',
                            'title' => esc_html__('Product display style', 'cryptcio'),
                            'options'=> array(
                                '1' => esc_html__('Style 1', 'cryptcio'),
                                '2' => esc_html__('Style 2', 'cryptcio'),
                                '3' => esc_html__('Style 3', 'cryptcio'),
                                '4' => esc_html__('Style 4', 'cryptcio'),
                            ),
                            'default' => '1'
                        ),
						array(
                            'id' => 'product-meta',
                            'type' => 'button_set',
							'multi' => true,
                            'title' => esc_html__('Product Meta', 'cryptcio'),
                            'options'=> array(
                                'availability' => esc_html__('Availability', 'cryptcio'),  
                                'sku' => esc_html__('SKU', 'cryptcio'),   
								'condition' => esc_html__('Condition', 'cryptcio'),   
								'brand' => esc_html__('Brand', 'cryptcio'),   
                                'reference' => esc_html__('Reference', 'cryptcio'),  
                                'tag' => esc_html__('Tag', 'cryptcio'),  
                            ),
                            'default' => array('availability')
                        ),
						array(
                            'id'=>'product-share',
                            'type' => 'button_set',
                            'title' => esc_html__('Show Product Share Link', 'cryptcio'),
                            'multi' => true,
                            'options'=> array(
                                'facebook' => esc_html__('Facebook', 'cryptcio'),
                                'twitter' => esc_html__('Twitter', 'cryptcio'),
								'google' => esc_html__('Goolge+', 'cryptcio'),
                                'pin' => esc_html__('Pinterest', 'cryptcio'),
                                'skype' => esc_html__('Skype', 'cryptcio'),
                                'youtube' => esc_html__('Youtube', 'cryptcio'),
                                'linkedin' => esc_html__('Linkedin', 'cryptcio'),
                                'email' => esc_html__('Email', 'cryptcio'),
                            ),
                            'required' => array(
                                    array('single-product-style', 'equals', array(
                                    '1','2','3','4'
                                )), 
                            ),                              
                            'default' => array('')
                        ),                        
						array(
                            'id'        => 'print_shortcode',
                            'type'      => 'text',
                            'title'     => esc_html__('Print Button Shortcode', 'cryptcio'),
                            'subtitle'  => esc_html__('Add shortcode for print button here. Default [print_button]', 'cryptcio'),
                            'default' => '',                
                        ),
                        array(
                            'id' => 'product-related',
                            'type' => 'switch',
                            'title' => esc_html__('Show Related Products', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                            'required' => array(
                                    array('single-product-style', 'equals', array(
                                    '1','2','3','4'
                                )), 
                            ),                             
                        ),
                        array(
                            'id' => 'product5-related',
                            'type' => 'switch',
                            'title' => esc_html__('Show Related Products', 'cryptcio'),
                            'default' => true,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                            'required' => array('single-product-style', 'equals', '5'),
                        ),                        
                        array(
                            'id' => 'product-reviewtab',
                            'type' => 'switch',
                            'title' => esc_html__('Remove Product Review tab', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),                                                    
                        array(
                            'id' => 'product-destab',
                            'type' => 'switch',
                            'title' => esc_html__('Remove Product Description tab', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),                                                 
                        array(
                            'id' => 'product-infotab',
                            'type' => 'switch',
                            'title' => esc_html__('Remove Additional Information tab', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),     
                        array(
                            'id' => 'product_tagtab',
                            'type' => 'switch',
                            'title' => esc_html__('Remove Tag Tab', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),  
                        array(
                            'id' => 'product-reviewtab-name',
                            'type' => 'text',
                            'title' => esc_html__('Rename Product Review Tab', 'cryptcio'),
                            'default' => esc_html__('Reviews', 'cryptcio')
                        ), 
                        array(
                            'id' => 'product-destab-name',
                            'type' => 'text',
                            'title' => esc_html__('Rename Product More Info Tab', 'cryptcio'),
                            'default' => esc_html__('Description', 'cryptcio')
                        ), 
                        array(
                            'id' => 'product-infotab-name',
                            'type' => 'text',
                            'title' => esc_html__('Rename Data Sheet Tab', 'cryptcio'),
                            'default' => esc_html__('Data sheet', 'cryptcio')
                        ),  
                        array(
                            'id' => 'product-tagtab-name',
                            'type' => 'text',
                            'title' => esc_html__('Rename Tag Tab', 'cryptcio'),
                            'default' => esc_html__('Tags', 'cryptcio')
                        ),                                                                                                     
                        array(
                            'id' => 'single_prd_pagination',
                            'type' => 'switch',
                            'title' => esc_html__('Show Prev/next post button', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),                                                                                                       
                    )
                ),
                array(
                    'icon' => 'el-icon-cog',
                    'icon_class' => 'icon',
                    'title' => esc_html__('404 Page', 'cryptcio'),
                    'customizer' => false,
                    'fields' => array(
                        array(
                            'id' => '404-bg-image',
                            'type' => 'media',
                            'url' => true,    
                            'readonly' => false,
                            'title' => esc_html__('Background image', 'cryptcio'),
                            'desc' => esc_html__('Background image for 404 page', 'cryptcio'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/bg_404.jpg',
                            )                            
                        ),                        
                        array(
                            'id' => '404-content',
                            'type' => 'text',
                            'title' => esc_html__('404 content', 'cryptcio'),
                            'default' => esc_html__("OPPS, The page you're looking for cannot be found", 'cryptcio')
                        ),  
                        array(
                            'id' => '404-color',
                            'type' => 'color',
                            'title' => esc_html__('Text color', 'cryptcio'),
                            'validate' => 'color',
                            'transparent' => false,
                        ),     
                        array(
                            'id' => '404-header-bordercolor',
                            'type' => 'color',
                            'title' => esc_html__('Text color', 'cryptcio'),
                            'validate' => 'color',
                            'transparent' => false,
                            'output'    => '.page-404 header'
                        ),                        
                        array(
                            'id' => '404-overlay',
                            'type' => 'switch',
                            'title' => esc_html__('Enable background overlay', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ), 
                        array(
                            'id'        => '404-overlay-color',
                            'type'      => 'color_rgba',
                            'title'     => 'Overlay Background Color',
                            'subtitle'  => 'Set color for background overlay color',                        
                            'output'    => array('background-color' => '.overlay404:before'),
                            'options'       => array(
                                'show_input'                => true,
                                'show_initial'              => true,
                                'show_alpha'                => true,
                                'show_palette'              => true,
                                'show_palette_only'         => false,
                                'show_selection_palette'    => true,
                                'max_palette_size'          => 10,
                                'allow_empty'               => true,
                                'clickout_fires_change'     => false,
                                'choose_text'               => 'Choose',
                                'cancel_text'               => 'Cancel',
                                'show_buttons'              => true,
                                'use_extended_classes'      => true,
                                'palette'                   => null,  // show default
                                'input_text'                => 'Select Color'
                            ),
                            'required' =>    array('404-overlay', 'equals', true),                     
                        ),   
						array(
                            'id' => '404-image',
                            'type' => 'media',
                            'url' => true,    
                            'readonly' => false,
                            'title' => esc_html__('Image', 'cryptcio'),
                            'desc' => esc_html__('Image for 404 page', 'cryptcio'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/img-404.png',
                            )                            
                        ),  
                        array(
                            'id' => '404-logo',
                            'type' => 'media',
                            'url' => true,    
                            'readonly' => false,
                            'title' => esc_html__('404 Logo', 'cryptcio'),         
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo_footer.png',
                            )                                            
                        ),                                                                              
                    )
                ),                        
                array(
                    'icon' => 'el-icon-cog',
                    'icon_class' => 'icon',
                    'customizer' => false,
                    'title' => esc_html__('Coming soon', 'cryptcio'),
                    'fields' => array(
                        array(
                            'id' => 'under-contr-mode',
                            'type' => 'switch',
                            'title' => esc_html__('Activate under construction mode', 'cryptcio'),
                            'default' => false,
                            'on' => esc_html__('Yes', 'cryptcio'),
                            'off' => esc_html__('No', 'cryptcio'),
                        ),   
                        array(
                            'id' => 'under-bg-image',
                            'type' => 'media',
                            'url' => true,
                            'readonly' => false,
                            'title' => esc_html__('Background image', 'cryptcio'),
                            'desc' => esc_html__('Background image for coming soon page', 'cryptcio'),
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/coming-soon.jpg',
                            ),
                        ), 
                        array(
                            'id' => 'coming-overlay-opacity',
                            'type' => 'text',
                            'title' => esc_html__('Opacity of Overlay Background', 'cryptcio'),  
                            'placeholder' => esc_html('0.8', 'cryptcio'),
                            'default'=> '',   
                        ), 
                        array(
                            'id'       => 'coming-color-gradient',
                            'type'     => 'color_gradient',
                            'title'    => esc_html__('Overlay Background Color Option', 'cryptcio'),
                            'subtitle' => esc_html__('Only color validation can be done on this field type', 'cryptcio'),
                            'validate' => 'color',
                            'default'  => array(
                                'from' => '',
                                'to'   => '', 
                            ),  
                        ),                                                              
                        array(
                            'id'=>'coming-soon-block',
                            'type' => 'select',
                            'title' => esc_html__('Choose content to display in coming soon page', 'cryptcio'),
                            'options' => $block_name,
                            'desc' => esc_html__('You should create a block in Static Block/Add New. Make sure to add Unique block name', 'cryptcio')
                        ),   
                        array(
                            'id' => 'coming_select_menu',
                            'title' => esc_html__('Enter link title', 'cryptcio'),
                            'type' => 'text',
                            'default' => esc_html__('Contact Us','cryptcio'),
                        ),                                                                                                       
                        array(
                            'id' => 'coming_menu_link',
                            'title' => esc_html__('Enter link', 'cryptcio'),
                            'type' => 'text',
                            'placeholder'=> '#',
                            'default' => '#',
                        ), 
                        array(
                            'id' => 'coming_subcribe_text',
                            'title' => esc_html__('Enter subcribe button title', 'cryptcio'),
                            'type' => 'text',
                            'default' => esc_html__('Notify me','cryptcio'),
                        ),                                                                      
                        array(
                            'id' => 'coming-logo',
                            'type' => 'media',
                            'url' => true,    
                            'readonly' => false,
                            'title' => esc_html__('Logo for Coming Soon Page ', 'cryptcio'),         
                            'default' => array(
                                'url' => get_template_directory_uri() . '/images/logo_footer.png',
                            )                                            
                        ),                                          
                    )
                ),
            );
            return $sections;
        }

        protected function cryptcio_add_header_section_options() {
            $cryptcio_seclect_slider = cryptcio_seclect_slider();
            unset($cryptcio_seclect_slider['default']);
			$block_top = cryptcio_get_block_name();
			unset($block_top['default']);
            $header = array(
                'icon' => 'el-icon-edit',
                'icon_class' => 'icon',
                'customizer' => false,
                'title' => esc_html__('Header', 'cryptcio'),
                'fields' => array(
                    array(
                        'id' => 'header-type',
                        'type' => 'image_select',
                        'title' => esc_html__('Header Type', 'cryptcio'),
                        'subtitle' => esc_html__('Each page will have option for select header type. Header selection in each page will have higher priority than this general selection.','cryptcio'),
                        'options' => $this->cryptcio_header_types(),
                        'default' => '1',
                    ),
					array(
						'id' => 'logo',
						'type' => 'media',
						'url' => true,
						'readonly' => false,
						'title' => esc_html__('Logo', 'cryptcio'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/logo.png',
							'height' => 226,
							'wide' => 47
						)
					),                  
                    array(
                        'id' => 'header-fixed',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Fixed Header (Header displays over content)', 'cryptcio'),
                        'default' => false,
                    ),  
                    array(
                        'id' => 'header_layout_style',
                        'type' => 'button_set',
                        'title' => esc_html__('Header Layout Style', 'cryptcio'),
                        'options' => array(
                                "1" => esc_html__("Wide","cryptcio"),
                                "2" => esc_html__("FullWidth","cryptcio"),
                                "3" => esc_html__("Boxed","cryptcio"),
                            ),
                        'default' => '2',
                        'required' => array(
                                array('header-type', 'equals', array(
                                '2','6'
                            )),
                        ),
                    ), 
                    array(
                        'id' => 'header_layout_style_2',
                        'type' => 'button_set',
                        'title' => esc_html__('Header Layout Style', 'cryptcio'),
                        'options' => array(
                                "1" => esc_html__("Wide","cryptcio"),
                                "2" => esc_html__("FullWidth","cryptcio"),
                                "3" => esc_html__("Boxed","cryptcio"),
                            ),
                        'default' => '3',
                        'required' => array(
                                array('header-type', 'equals', array(
                                '1','3','5',
                            )),
                        ),
                    ),
                    array(
                        'id' => 'header_layout_style_3',
                        'type' => 'button_set',
                        'title' => esc_html__('Header Layout', 'cryptcio'),
                        'options' => array(
                                "1" => esc_html__("Wide","cryptcio"),
                                "2" => esc_html__("FullWidth","cryptcio"),
                                "3" => esc_html__("Boxed","cryptcio"),
                            ),
                        'default' => '1',
                        'required' => array(
                                array('header-type', 'equals', array(
                                '6'
                            )),
                        ),
                    ), 
					array(
						'id' => 'header-topslide',
						'type' => 'switch',
						'title' => esc_html__('Display Top Slide','cryptcio'),
						'default' => false,   
                    ),
					array(
						'id'=>'top_banner_block',
						'type' => 'select',
						'title' => esc_html__('Top Slide Content', 'cryptcio'),
						'options' => $block_top,
						'desc' => esc_html__('Choose a block to display at the bottom of pages. You can create a block in Static Block/Add New.', 'cryptcio'),
					), 
					array(
						'id' => 'header-topinfo',
						'type' => 'switch',
						'title' => esc_html__('Display Top Header','cryptcio'),
						'default' => true,  
                        'required' => array(
                                array('header-type', 'equals', array(
                                '1','2','3','4'
                            )), 
                        ),
					), 
                    array(
                        'id' => 'header5-topinfo',
                        'type' => 'switch',
                        'title' => esc_html__('Display Top Header','cryptcio'),
                        'default' => false,  
                        'required' => array(
                                array('header-type', 'equals', array(
                                '5'
                            )), 
                        ),
                    ), 
					array(
                        'id' => 'header6-topinfo',
                        'type' => 'switch',
                        'title' => esc_html__('Display Top Header','cryptcio'),
                        'default' => false,  
                        'required' => array(
                                array('header-type', 'equals', array(
                                '6'
                            )), 
                        ),
                    ), 
					array(
                        'id' => 'header-notice',
                        'type' => 'textarea',
                        'title' => esc_html__('Enter Notice Text', 'cryptcio'),
                        'default' => '', 
                    ),  
                    array(
                        'id' => 'header1-search',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '1'
                            )), 
                        ),                            
                    ),             
                    array(
                        'id' => 'header2-search',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '2'
                            )), 
                        ),                            
                    ), 
                    array(
                        'id' => 'header3-search',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '3'
                            )), 
                        ),                            
                    ),
                    array(
                        'id' => 'header4-search',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '4'
                            )),  
                        ),                       
                    ),  
                    array(
                        'id' => 'header5-search',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '5'
                            )),  
                        ),                       
                    ), 
					array(
                        'id' => 'header6-search',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '6'
                            )),  
                        ),                       
                    ),
                    array(
                        'id' => 'header-search-icon',
                        'type' => 'text',
                        'title' => esc_html__('Icon Search', 'cryptcio'),
                        'default' => 'fa fa-search',
                        'placeholder' => esc_html__('fa fa-search', 'cryptcio'),
                        'desc' => wp_kses(__('Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a>','cryptcio'),array(
                                'a' => array(
                                    'href'=>array(),
                                    'target' => array(),
                                    ),
                            )) 
                    ),  
                    array(
                        'id' => 'header-search-icon-hidden',
                        'type' => 'text',
                        'title' => esc_html__('Icon Search', 'cryptcio'),
                        'default' => 'fa fa-search',
                        'placeholder' => esc_html__('fa fa-search', 'cryptcio'),
                        'required' => array('header-search-hidden', 'equals', array(
                            true
                        )), 
                        'desc' => wp_kses(__('Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a>','cryptcio'),array(
                                'a' => array(
                                    'href'=>array(),
                                    'target' => array(),
                                    ),
                            ))                         
                    ),
                    array(
                        'id' => 'header_search_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Header Search Type', 'cryptcio'),
                        'options' => array(
                                "1" => esc_html__("Product (if Woocommerce enable)","cryptcio"),
                                "2" => esc_html__("Blog","cryptcio"),
                            ),
                        'default' => '1',                         
                    ),
                    array(
                        'id' => 'header1-minicart',
                        'type' => 'switch',
                        'title' => esc_html__('Show Mini Cart', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '1'
                            )), 
                        ),                           
                    ),
                    array(
                        'id' => 'header2-minicart',
                        'type' => 'switch',
                        'title' => esc_html__('Show Mini Cart', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '2'
                            )), 
                        ),                           
                    ),
                    array(
                        'id' => 'header3-minicart',
                        'type' => 'switch',
                        'title' => esc_html__('Show Mini Cart', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '3'
                            )), 
                        ),                           
                    ),
                    array(
                        'id' => 'header4-minicart',
                        'type' => 'switch',
                        'title' => esc_html__('Show Mini Cart', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '4'
                            )), 
                        ),                           
                    ),   
                    array(
                        'id' => 'header5-minicart',
                        'type' => 'switch',
                        'title' => esc_html__('Show Mini Cart', 'cryptcio'),
                        'default' => true,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '5'
                            )), 
                        ),                           
                    ),  
					array(
                        'id' => 'header6-minicart',
                        'type' => 'switch',
                        'title' => esc_html__('Show Mini Cart', 'cryptcio'),
                        'default' => false,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '6'
                            )), 
                        ),                           
                    ),  
                    array(
                        'id' => 'header-cart-icon',
                        'type' => 'text',
                        'title' => esc_html__('Icon Mini Cart', 'cryptcio'),
                        'default' => 'fa fa-shopping-basket',
                        'placeholder' => esc_html__('fa fa-shopping-bag', 'cryptcio'),
                        'desc' => wp_kses(__('Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a>','cryptcio'),array(
                                'a' => array(
                                    'href'=>array(),
                                    'target' => array(),
                                    ),
                            )) ,
                        'required' => array(
                                array('header-type', 'equals', array(
                                '1','2','3','4','5','6'
                            )), 
                        ),                                                     
                    ),                        
                    array(
                        'id' => 'header-myaccount-show',
                        'type' => 'switch',
                        'title' => esc_html__('Show My Account', 'cryptcio'),
                        'default' => true,                           
                    ),                                                                                  
					array(
                        'id' => 'header-myaccount-icon',
                        'type' => 'text',
                        'title' => esc_html__('Icon My Account', 'cryptcio'),
                        'placeholder' => esc_html__('fa fa-user-circle-o', 'cryptcio'),
                        'default' => 'fa fa-user-o',
                        'required' => array(
                                array('header-type', 'equals', array(
                                '1','2','4','5'
                            )), 
                        ),      
                        'desc' => wp_kses(__('Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a> ','cryptcio'),array(
                                'a' => array(
                                    'href'=>array(),
                                    'target' => array(),
                                    ),
                            ))                          
                    ),
					array(
                        'id' => 'header3-myaccount-icon',
                        'type' => 'text',
                        'title' => esc_html__('Icon My Account', 'cryptcio'),
                        'placeholder' => esc_html__('fa fa-user-o', 'cryptcio'),
                        'default' => 'fa fa-user',
                        'required' => array(
                                array('header-type', 'equals', array(
                                '3'
                            )), 
                        ),  
                        'desc' => wp_kses(__('Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a>','cryptcio'),array(
                                'a' => array(
                                    'href'=>array(),
                                    'target' => array(),
                                    ),
                            ))                          
                    ),
                    array(
                        'id' => 'header-social',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Link', 'cryptcio'),
                        'default' => true                      
                    ), 
                    array(
                        'id' => 'social-header-twitter',
                        'type' => 'text',
                        'title' => esc_html__('Twitter', 'cryptcio'),
                        'default' => 'https://twitter.com/arrowpress1',
                        'placeholder' => esc_html__('http://', 'cryptcio'),
                        'required' => array('header-social', 'equals', array(
                            true
                        )),  
                    ),
                    array(
                        'id' => 'social-header-instagram',
                        'type' => 'text',
                        'title' => esc_html__('Instagram', 'cryptcio'),
                        'default' => 'https://instagram.com/arrowpress',
                        'placeholder' => esc_html__('http://', 'cryptcio'),
                        'required' => array('header-social', 'equals', array(
                            true
                        )),
                    ),
                    array(
                        'id' => 'social-header-facebook',
                        'type' => 'text',
                        'title' => esc_html__('Facebook', 'cryptcio'),
                        'default' => 'https://facebook.com/arrowpress',
                        'placeholder' => esc_html__('http://', 'cryptcio'),
                        'required' => array('header-social', 'equals', array(
                            true
                        )),
                    ),
                    array(
                        'id' => 'social-header-google',
                        'type' => 'text',
                        'title' => esc_html__('Google Plus', 'cryptcio'),
                        'default' => '',
                        'placeholder' => esc_html__('http://', 'cryptcio'),
                        'required' => array('header-social', 'equals', array(
                            true
                        )),
                    ),        
                    array(
                        'id' => 'social-header-pinterest',
                        'type' => 'text',
                        'title' => esc_html__('Pinterest', 'cryptcio'),
                        'default' => '',
                        'placeholder' => esc_html__('http://', 'cryptcio'),
                        'required' => array('header-social', 'equals', array(
                            true
                        )),
                    ),                                
                    array(
                        'id' => 'header-sticky',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Sticky', 'cryptcio'),
                        'default' => false
                    ),   
                    array(
                        'id' => 'header-sticky-mobile',
                        'type' => 'switch',
                        'required' => array('header-sticky', 'equals', 1,),
                        'title' => esc_html__('Enable Sticky On Mobile ', 'cryptcio'),
                        'default' => true
                    ),      
                    array(
                        'id' => 'header_postion',
                        'type' => 'button_set',
                        'title' => esc_html__('Header Mobile Position', 'cryptcio'),
                        'options' => array(
                                "1" => esc_html__("Top","cryptcio"),
                                "2" => esc_html__("Bottom","cryptcio"),
                            ),
                        'default' => '1',                         
                    ),   
                ),
            );

            return $header;
        }

        public function cryptcio_get_setting_arguments() {
            $theme = wp_get_theme();
            $args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'cryptcio_settings',
                'ajax_save '=> false,
                'display_name' => esc_html__('cryptcio', 'cryptcio'),
                'display_version' => $theme->get('Version'),
                'menu_type' => 'menu',
                'allow_sub_menu' => true,
                'menu_title' => esc_html__('Cryptcio Options', 'cryptcio'),
                'page_title' => esc_html__('cryptcio', 'cryptcio'),
                'google_api_key' => '',
                'google_update_weekly' => false,
                'async_typography' => true,
                'admin_bar' => true,
                'admin_bar_icon' => 'dashicons-admin-generic',
                'admin_bar_priority' => 50,
                'global_variable' => '',
                'dev_mode' => false,
                'update_notice' => true,
                'customizer' => true,
                'page_priority' => null,
                'page_parent' => 'themes.php',
                'page_permissions' => 'manage_options',
                'menu_icon' => '',
                'last_tab' => '',
                'page_icon' => 'icon-themes',
                'page_slug' => '',
                'save_defaults' => true,
                'default_show' => false,
                'default_mark' => '',
                'show_import_export' => true,
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                'output_tag' => true,
                'database' => '',
                'use_cdn' => true,
                // HINTS
                'hints' => array(
                    'icon' => 'el el-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'red',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
            );
            return $args;
        }

        protected function cryptcio_header_types() {
            return array(
                '1' => array('alt' => esc_html__('Header Type 1', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-1.jpg'),
                '2' => array('alt' => esc_html__('Header Type 2', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-2.jpg'),
                '3' => array('alt' => esc_html__('Header Type 3', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-3.jpg'),
                '4' => array('alt' => esc_html__('Header Type 4', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-4.jpg'),       
                '5' => array('alt' => esc_html__('Header Type 5', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-5.jpg'),                   
                '6' => array('alt' => esc_html__('Header Type 6', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-6.jpg'),                   
            );
        }

        protected function cryptcio_footer_types() {
            return array(
                '1' => array('alt' => esc_html__('Footer Type 1', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-1.jpg'),
                '2' => array('alt' => esc_html__('Footer Type 2', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-2.jpg'),
                '3' => array('alt' => esc_html__('Footer Type 3', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-3.jpg'),
                '4' => array('alt' => esc_html__('Footer Type 4', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-4.jpg'),               
                '5' => array('alt' => esc_html__('Footer Type 5', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-5.jpg'),
                '6' => array('alt' => esc_html__('Footer Type 6', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-6.jpg'), 
                '7' => array('alt' => esc_html__('Footer Type 7', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-7.jpg'),                
            );
        }
        
        protected function cryptcio_preload_types() {
            return array(
                '1' => array('alt' => esc_html__('Preload Type 1', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-1.jpg'),
                '2' => array('alt' => esc_html__('Preload Type 2', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-2.jpg'),
                '3' => array('alt' => esc_html__('Preload Type 3', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-3.jpg'),
                '4' => array('alt' => esc_html__('Preload Type 4', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-4.jpg'),
                '5' => array('alt' => esc_html__('Preload Type 5', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-5.jpg'),
                '6' => array('alt' => esc_html__('Preload Type 6', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-6.jpg'),
                '7' => array('alt' => esc_html__('Preload Type 7', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-7.jpg'),
                '8' => array('alt' => esc_html__('Preload Type 8', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-8.jpg'),
                '9' => array('alt' => esc_html__('Preload Type 9', 'cryptcio'), 'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-9.jpg'),
            );
        }

    }

    
    function cryptcio_get_framework_settings() {
        global $cryptcioReduxSettings;
        $cryptcioReduxSettings = new Framework_cryptcio_Settings();
        return $cryptcioReduxSettings;
    }
    cryptcio_get_framework_settings();
}