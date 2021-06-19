<?php
/**
 * @package PXaas - Saas & Software Landing Page Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 23-09-2019
 * @since 1.0.6
 * @version 1.0.6
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


/**
 * PXaas: Kirki Customizer
 *
 */
add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Thumbnail_Size_Control extends WP_Customize_Control {
		public $type = 'thumbnail_size';

		public function __construct( $manager, $id, $args = array() ) {

			parent::__construct( $manager, $id, $args );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ), 999 );

		}

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'cth-thumbnail_size-css', get_theme_file_uri( '/assets/admin/css/thumbnail_size.css' ), null );
			wp_enqueue_script( 'cth-thumbnail_size', get_theme_file_uri( '/assets/admin/js/thumbnail_size.js' ), array( 'jquery', 'customize-base'), false, true );
			
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['default'] = $this->setting->default;
			if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			}
			$this->json['value']   = $this->sanitize( $this->value() ) ;
			$this->json['choices'] = $this->choices;
			$this->json['link']    = $this->get_link();
			$this->json['id']      = $this->id;

			$this->json['inputAttrs'] = '';
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}

			foreach ( array_keys( $this->json['value'] ) as $key ) {
				if ( ! in_array( $key, array( 'width', 'height', 'hard_crop' ) ) && ! isset( $this->json['default'][ $key ] ) ) {
					unset( $this->json['value'][ $key ] );
				}
			}

			// Fix for https://github.com/aristath/kirki/issues/1405.
			foreach ( array_keys( $this->json['value'] ) as $key ) {
				if ( isset( $this->json['default'][ $key ] ) && false === $this->json['default'][ $key ] ) {
					unset( $this->json['value'][ $key ] );
				}
			}
		}

		protected  function sanitize( $value ) {

			if ( ! is_array( $value ) ) {
				return array();
			}

			foreach ( $value as $key => $val ) {
				switch ( $key ) {
					case 'width':
						$value['width'] = esc_attr( $val );
						break;
					case 'height':
						$value['height'] = esc_attr( $val );
						break;
					case 'hard_crop':
						if ( ! isset($val) ) {
							$value['hard_crop'] = '1';
						}
						break;
					
				} // End switch().
			} // End foreach().

			return $value;

		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see WP_Customize_Control::print_template()
		 *
		 * @access protected
		 */
		protected function content_template() {
			?>
			<label class="customizer-text">
				<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
				<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>
			</label>

			<div class="wrapper">
				
				<div class="field-thumbnail-size-input input-prepend thumbnail_size-width">
                   	<span class="add-on"><?php esc_html_e( 'W', 'pxaas' );?></span>
                    <label for="{{ data.id }}-width"><?php esc_html_e( 'Image Width', 'pxaas' );?></label>
                    <input {{{ data.inputAttrs }}} placeholder="<?php esc_attr_e( 'Width', 'pxaas' );?>" type="text" id="{{ data.id }}-width" name="_customize-thumbnail_size-width-{{ data.id }}" value="{{ data.value['width'] }}">
                </div>

                <div class="field-thumbnail-size-input input-prepend"><span  class="ts-add-on"><?php esc_html_e( ' x ', 'pxaas' );?></span></div>

                <div class="field-thumbnail-size-input input-prepend thumbnail_size-height">
                   	<span class="add-on"><?php esc_html_e( 'H', 'pxaas' );?></span>
                    <label for="{{ data.id }}-height"><?php esc_html_e( 'Image Height', 'pxaas' );?></label>
                    <input {{{ data.inputAttrs }}} placeholder="<?php esc_attr_e( 'Height', 'pxaas' );?>" type="text" id="{{ data.id }}-height" name="_customize-thumbnail_size-height-{{ data.id }}" value="{{ data.value['height'] }}">
                </div>

                <div class="field-thumbnail-size-input input-prepend"><span  class="ts-add-on"><?php esc_html_e( ' px ', 'pxaas' );?></span></div>

                <div class="field-thumbnail-size-input thumbnail_size-hard_crop">
	                <label for="{{ data.id }}-hard_crop">
		                <input type="checkbox" id="{{ data.id }}-hard_crop" name="_customize-thumbnail_size-hard_crop-{{ data.id }}" value="1" <# if ( data.value['hard_crop'] === '1' ) { #> checked="checked"<# } #>>
		            	<?php esc_html_e( 'Hard Crop ', 'pxaas' );?>
		            </label>
                    
                </div>
				
			</div>
			<#
			
			valueJSON = JSON.stringify( data.value ).replace( /'/g, '&#39' );
			#>
			<input class="thumbnail_size-hidden-value" type="text" name="{{ data.id }}" value='{{{ valueJSON }}}' {{{ data.link }}}>
			<?php
		}	

		/**
		 * Render the control's content.
		 *
		 * @see WP_Customize_Control::render_content()
		 */
		protected function render_content() {}
	}
	// Register the class so that it's JS template is available in the Customizer.
    $wp_customize->register_control_type( 'Kirki_Controls_Thumbnail_Size_Control' );

	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['thumbnail_size'] = 'Kirki_Controls_Thumbnail_Size_Control';
		return $controls;
	} );

} );

// https://aristath.github.io/kirki/docs/getting-started/config.html
PXaas_Kirki::add_config( 'pxaas_configs', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'option', // theme_mod option
	'option_name'	=> 'pxaas_options' // for option type
) );

PXaas_Kirki::add_panel( 'woocommerce_panel', array(
    'priority'    => 170,
    'title'       => esc_html__( 'Woocommerce Option', 'pxaas' ),
    'description' => esc_html__( 'My Description', 'pxaas' ),
) );

PXaas_Kirki::add_section( 'woocommerce_view', array(
    'title'          => esc_html__( 'Woocommerce View', 'pxaas' ),
    'panel'          => 'woocommerce_panel', // Not typically needed.
    'priority'       => 170,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'radio-image',
	'settings'    => 'woo_layout',
	'label'       => esc_html__( 'Woocommerce Sidebar Layout', 'pxaas' ),
	'section'     => 'woocommerce_view',
	'default'     => 'right_sidebar',
	'priority'    => 10,
	'choices'     => array(
		'fullwidth' => get_template_directory_uri() . '/assets/admin/images/1c.png',
		'left_sidebar' => get_template_directory_uri() . '/assets/admin/images/2cl.png',
		'right_sidebar' => get_template_directory_uri() . '/assets/admin/images/2cr.png',
		
	),
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'select',
	'settings'    => 'woo-sidebar-width',
	'label'       => esc_html__( 'Sidebar Width', 'pxaas' ),
	'description'       => esc_html__( 'Based on Bootstrap 12 columns.', 'pxaas' ),
	'section'     => 'woocommerce_view',
	'default'     => '4',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'2' => esc_html__('2 Columns', 'pxaas'),
        '3' => esc_html__('3 Columns', 'pxaas'),
        '4' => esc_html__('4 Columns', 'pxaas'),
        '5' => esc_html__('5 Columns', 'pxaas'),
        '6' => esc_html__('6 Columns', 'pxaas'),
	),
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'radio-image',
	'settings'    => 'woo_layout',
	'label'       => esc_html__( 'Woocommerce Sidebar Layout', 'pxaas' ),
	'section'     => 'woocommerce_view',
	'default'     => 'right_sidebar',
	'priority'    => 10,
	'choices'     => array(
		'fullwidth' => get_template_directory_uri() . '/assets/admin/images/1c.png',
		'left_sidebar' => get_template_directory_uri() . '/assets/admin/images/2cl.png',
		'right_sidebar' => get_template_directory_uri() . '/assets/admin/images/2cr.png',
	),
) );

// Shop header **************************************************************************************************
PXaas_Kirki::add_section( 'shop_header', array(
    'title'          => esc_html__( 'Shop Header', 'pxaas' ),
    'panel'          => 'woocommerce_panel', // Not typically needed.
    'priority'       => 180,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_shop_breadcrumbs',
	'label'       => esc_html__( 'Show Breadcrumbs Shop', 'pxaas' ),
	'section'     => 'shop_header',
	'default'     => 1,
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_shop_header',
	'label'       => esc_html__( 'Show Shop Header', 'pxaas' ),
	'section'     => 'shop_header',
	'default'     => 1,
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'text',
	'settings'    => 'shop_head_title',
	'label'       => esc_html__( 'Shop Header Title', 'pxaas' ),
	'section'     => 'shop_header',
	'default'     => 'Our Last News',
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'textarea',
	'settings'    => 'shop_head_desc',
	'label'       => esc_html__( 'Shop Header description', 'pxaas' ),
	'section'     => 'shop_header',
	'default'     => '',
	'priority'    => 10,
	
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'shop_header_image',
	'label'       => esc_html__( 'Image Shop Header', 'pxaas' ),
	'section'     => 'shop_header',
	'default'     => get_template_directory_uri().'/assets/images/jk.png',
	'priority'    => 10,
	
) );

// General **************************************************************************************************
PXaas_Kirki::add_section( 'general_options', array(
    'title'          => esc_html__( 'General Options', 'pxaas' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 120,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_loader',
	'label'       => esc_html__( 'Show Loader', 'pxaas' ),
	'section'     => 'general_options',
	'default'     => '1',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'img_loader',
	'label'       => esc_html__( 'Image Loader', 'pxaas' ),
	'section'     => 'general_options',
	'default'     => '',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_color_picker',
	'label'       => esc_html__( 'Show 	Color Picker', 'pxaas' ),
	'section'     => 'general_options',
	'default'     => '0',
	'priority'    => 12,
) );

// Header option **************************************************************************************************
PXaas_Kirki::add_section( 'header_options', array(
    'title'          => esc_html__( 'Header Options', 'pxaas' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 130,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'header_bk',
	'label'       => esc_html__( 'Header Background', 'pxaas' ),
	'section'     => 'header_options',
	'default'     => '',
	'priority'    => 10,
	'choices'     => array(
		'save_as' => 'id',
	),
	
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'select',
	'settings'    => 'header_style',
	'label'       => esc_html__( 'Header Style', 'pxaas' ),
	'section'     => 'header_options',
	'default'     => 'default',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'default' => esc_html__('Default Style', 'pxaas'),
        'blog' => esc_html__('Blog Style', 'pxaas'),
        'fullwidth' => esc_html__('Fullwidth Style', 'pxaas'),
	),
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'display_menu_phone',
	'label'       => esc_html__( 'Displays all menus on the phone screen', 'pxaas' ),
	'section'     => 'header_options',
	'default'     => '0',
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'radio',
	'settings'    => 'show_breadcrumbs',
	'label'       => __( 'Show Breadcrumbs', 'pxaas' ),
	'section'     => 'header_options',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array(
		'yes'   => esc_attr__( 'Yes', 'pxaas' ),
		'no' => esc_attr__( 'No', 'pxaas' ),
	),
) );

// Thumbnail **************************************************************************************************
PXaas_Kirki::add_section( 'thumbnails_options', array(
    'title'          => esc_html__( 'Thumbnail Sizes', 'pxaas' ),
    'description'	=> esc_html__( 'These settings affect the display and dimensions of images in your pages.
Enter 9999 as Width value and uncheck Hard Crop to make your thumbnail dynamic width.
Enter 9999 as Height value and uncheck Hard Crop to make your thumbnail dynamic height.
Enter 9999 as Width and Height values to use full size image.
After changing these settings you may need using Regenerate Thumbnails plugin to regenerate your thumbnails', 'pxaas' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 140,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'enable_custom_sizes',
	'label'       => esc_html__( 'Enable Custom Image Sizes', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'default'     => '0',
	'priority'    => 10,
	'transport'		=> 'postMessage',
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_1',
	'label'       => esc_html__( 'Fullscreen Thumbnail', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 1920, Height - 754, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '1920',
		'height'	=> '754',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_2',
	'label'       => esc_html__( 'Carousel Thumbnail', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 9999, Height - 754, Hard crop - un-checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '9999',
		'height'	=> '754',
		'hard_crop'	=> '0',
	),
	'priority'    => 10,
	
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_3',
	'label'       => esc_html__( 'Portfolio List Gallery', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 9999, Height - 150, Hard crop - un-checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '9999',
		'height'	=> '150',
		'hard_crop'	=> '0',
	),
	'priority'    => 10,
	
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_4',
	'label'       => esc_html__( 'Portfolio Size One', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 460, Height - 305, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '460',
		'height'	=> '305',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_5',
	'label'       => esc_html__( 'Portfolio Size Two', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 920, Height - 610, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '920',
		'height'	=> '610',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_6',
	'label'       => esc_html__( 'Portfolio Size Two', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 1380, Height - 915, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '1380',
		'height'	=> '915',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_7',
	'label'       => esc_html__( 'Member Thumbnail', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 362, Height - 416, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '362',
		'height'	=> '416',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_8',
	'label'       => esc_html__( 'Service Thumbnail', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 362, Height - 281, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '362',
		'height'	=> '281',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_9',
	'label'       => esc_html__( 'Blog Thumbnail', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 764, Height - 504, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '764',
		'height'	=> '504',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_10',
	'label'       => esc_html__( 'Blog Single Thumbnail', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 764, Height - 504, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '764',
		'height'	=> '504',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_11',
	'label'       => esc_html__( 'Landing Thumbnail', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 998, Height - 485, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '998',
		'height'	=> '485',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_12',
	'label'       => esc_html__( 'Section Post Thumbnail', 'pxaas' ),
	'description'       => esc_html__( 'Demo: Width - 531, Height - 314, Hard crop - checked', 'pxaas' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '531',
		'height'	=> '314',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );

// Color **************************************************************************************************
PXaas_Kirki::add_section( 'color_options', array(
    'title'          => esc_html__( 'Colors & Fonts - Options', 'pxaas' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 150,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'radio-image',
	'settings'    => 'style_default',
	'label'       => esc_html__( 'Style Default', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => 'one',
	'priority'    => 10,
	'choices'     => array(
		'one' 	=> get_template_directory_uri() . '/assets/admin/images/a1.png',
		'two' 	=> get_template_directory_uri() . '/assets/admin/images/a2.png',
		'three' => get_template_directory_uri() . '/assets/admin/images/a3.png',	
		'four' 	=> get_template_directory_uri() . '/assets/admin/images/a4.png',
		'five' 	=> get_template_directory_uri() . '/assets/admin/images/a5.png',
		'six' 	=> get_template_directory_uri() . '/assets/admin/images/a6.png',
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'use_custom_color',
	'label'       => esc_html__( 'Use Custom Colors', 'pxaas' ),
	'description'       => wp_kses(__('Set this option to <b>Yes</b> if you want to use color variants bellow.', 'pxaas'), array('b'=>array(),'strong'=>array(),'p'=>array()) ),
	'section'     => 'color_options',
	'default'     => '0',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'theme-color',
	'label'       => esc_html__( 'Theme Color', 'pxaas' ), 
	'description'       => esc_html__( 'Default: #e38612', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '#3d8cc4',
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'main-bg-color',
	'label'       => esc_html__( 'Body Background Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #ffffff', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'body',
			'property' => 'background-color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'body-text-color',
	'label'       => esc_html__( 'Body Text Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #000000', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'body',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'paragraph-color',
	'label'       => esc_html__( 'Paragraph Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #000000', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'p',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Link Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #000000', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'a',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #000000', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'a:hover',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'link_active_color',
	'label'       => esc_html__( 'Link Active Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #000000', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'a:active,a:focus',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        	=> 'color',
	'settings'    	=> 'header-bg-color',
	'label'       	=> esc_html__( 'Header Bg Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #2F3B59', 'pxaas' ),
	'section'     	=> 'color_options',
	'default'     	=> '',
	'choices'     	=> array(
		'alpha' 	=> true,
	),
	'priority'    	=> 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'header.main-header',
			'property' => 'background-color',
		),
	),

	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'header-text-color',
	'label'       => esc_html__( 'Header Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #000000', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'choices'     => array(
		'alpha' 	=> true,
	),
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'header.main-header,.header-contacts ul li span,.show-search',
			'property' => 'color',
		),
		array(
			'element'	=> '.nav-button span,.sidebar-button-wrap:before',
			'property'	=> 'background-color'
		),
		array(
			'element'	=> '.sidebar-button-wrap',
			'property'	=> 'border-color'
		)
	),
) );  
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'submenu-bg-color',
	'label'       => esc_html__( 'Submenu Background Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: rgba(0,0,0,0.71)', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'choices'     => array(
		'alpha' 	=> true,
	),
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => '.nav-holder nav li ul',
			'property' => 'background-color',
		),
	),
) );          
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'mainmenu_color',
	'label'       => esc_html__( 'Menu Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #999999', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => '.nav-holder nav li a',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'mainmenu_hover_color',
	'label'       => esc_html__( 'Menu Hover Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #404040', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => '.nav-holder nav li a:hover',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'mainmenu_active_color',
	'label'       => esc_html__( 'Menu Active Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #404040', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => '.nav-holder nav li a:active,.nav-holder nav li a:focus, .nav-holder nav li.current-menu-ancestor > a, .nav-holder nav li.current-menu-parent > a,.nav-holder nav li.current-menu-item > a',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'submenu_color',
	'label'       => esc_html__( 'Submenu Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #ffffff', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => '.nav-holder nav li ul a',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'submenu_hover_color',
	'label'       => esc_html__( 'Submenu Hover Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #f5f5f5', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => '.nav-holder nav li ul a:hover',
			'property' => 'color',
		),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'submenu_active_color',
	'label'       => esc_html__( 'Submenu Active Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #f5f5f5', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => '.nav-holder nav li ul li a:active,.nav-holder nav li ul li a:focus,.nav-holder nav li ul li.current-menu-ancestor > a,.nav-holder nav li ul li.current-menu-parent > a,.nav-holder nav li ul li.current-menu-item > a',
			'property' => 'color',
		),
	),
) );           

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'color',
	'settings'    => 'footer-bg-color',
	'label'       => esc_html__( 'Footer Background Color', 'pxaas' ),
	'description'       => esc_html__( 'Default: #2C3B5A', 'pxaas' ),
	'section'     => 'color_options',
	'default'     => '',
	'choices'     => array(
		'alpha' 	=> true,
	),
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'footer.pxaas-footer',
			'property' => 'background-color',
		),
	),
) ); 

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'typography',
	'settings'    => 'body-font',
	'label'       => esc_html__( 'Body Font', 'pxaas' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: Fira Sans </br>font-size: 14px </br>font-weight: 400</p>', 'pxaas'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		'font-family'    => 'Fira Sans', 
	),
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'body',
		),
	),
) );          
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'typography',
	'settings'    => 'heading-font',
	'label'       => esc_html__( 'Heading Font', 'pxaas' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: Fira Sans </br>font-weight: 500</p>', 'pxaas'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		 'font-family'    => 'Fira Sans',
	),
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'h1,h2,h3,h4,h5,h6',
		),
	),
) ); 
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'typography',
	'settings'    => 'paragraph-font',
	'label'       => esc_html__( 'Paragraph Font', 'pxaas' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: Poppins </br>font-size: 14px </br>font-weight: 400</p>', 'pxaas'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		'font-family'    => 'Poppins',
	),
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => 'p',
		),
	),
) ); 
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'typography',
	'settings'    => 'theme-bolder-font',
	'label'       => esc_html__( 'PXaas Bolder Font', 'pxaas' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: Droid Serif </br>font-size: 12px </br>font-weight: 400</p>', 'pxaas'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		'font-family'    => 'Droid Serif',
	),
	'priority'    => 10,
	'transport'		=> 'auto',
	'output' 		=> array(
		array(
			'element'  => '.fixed-column-content-wrap h4,.entry-header h4,.transaparent-text h4,.intro-title-wrap h3,.hero-wrap p,.caption-wrap ul li span,.slider-content-nav li span,.vis-thumb-info .thumb-info p,.show-hid-info,.content-nav li span,.album-list a.album-cat,.testi-item p,.testilider  .swiper-pagination,.contact-details ul li span,.share-holder.block-share span,.blog-title-opt li,.pr-tags li',
		),
	),
) ); 

//create project panel to customize header section
PXaas_Kirki::add_panel( 'project_panel', array(
    'priority'    => 155,
    'title'       => esc_html__( 'Project Options', 'pxaas' ),
    'description' => esc_html__( 'My Description', 'pxaas' ),
) );

// project header **************************************************************************************************
PXaas_Kirki::add_section( 'project_header', array(
    'title'          => esc_html__( 'Project Top Header', 'pxaas' ),
    'description'    => esc_html__( 'These options are for your member list page: ' , 'pxaas') ,
    'panel'          => 'project_panel', // Not typically needed.
    'priority'       => 155,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_header_project',
	'label'       => esc_html__( 'Show Header', 'pxaas' ),
	'section'     => 'project_header',
	'default'     => 1,
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_breadcrumbs_project',
	'label'       => esc_html__( 'Show BreadCrumbs', 'pxaas' ),
	'section'     => 'project_header',
	'default'     => 1,
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'text',
	'settings'    => 'project_head_title',
	'label'       => esc_html__( 'Header Title', 'pxaas' ),
	'section'     => 'project_header',
	'default'     => 'Our Last News',
	'priority'    => 10,
	
) );

// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'textarea',
// 	'settings'    => 'project_head_desc',
// 	'label'       => esc_html__( 'Header description', 'pxaas' ),
// 	'section'     => 'project_header',
// 	'default'     => '',
// 	'priority'    => 10,
	
// ) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'project_header_image',
	'label'       => esc_html__( 'Image Header', 'pxaas' ),
	'section'     => 'project_header',
	'default'     => get_template_directory_uri().'/assets/images/jk.png',
	'priority'    => 10,
	
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'project_header_image_bot',
	'label'       => esc_html__( 'Image Header', 'pxaas' ),
	'section'     => 'project_header',
	'default'     => get_template_directory_uri().'/assets/images/bb.png',
	'priority'    => 10,
	
) );


// ----------------------------------------------------------------------------------------------------------------------
PXaas_Kirki::add_panel( 'member_panel', array(
    'priority'    => 155,
    'title'       => esc_html__( 'Member Options', 'pxaas' ),
    'description' => esc_html__( 'My Description', 'pxaas' ),
) );
	PXaas_Kirki::add_section( 'member_header', array(
	    'title'          => esc_html__( 'Member Header', 'pxaas' ),
	    'description'    => esc_html__( 'These options are for your member list page: ' , 'pxaas') ,
	    'panel'          => 'member_panel', // Not typically needed.
	    'priority'       => 155,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '', // Rarely needed.
	) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'toggle',
			'settings'    => 'show_breadcrumbs_member',
			'label'       => esc_html__( 'Show BreadCrumbs', 'pxaas' ),
			'section'     => 'member_header',
			'default'     => 1,
			'priority'    => 10,
		) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'toggle',
			'settings'    => 'show_header_member',
			'label'       => esc_html__( 'Show Header', 'pxaas' ),
			'section'     => 'member_header',
			'default'     => 1,
			'priority'    => 10,
		) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'text',
			'settings'    => 'member_head_title',
			'label'       => esc_html__( 'Header Title', 'pxaas' ),
			'section'     => 'member_header',
			'default'     => 'Our Last News',
			'priority'    => 10,
			
		) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'image',
			'settings'    => 'member_header_image',
			'label'       => esc_html__( 'Image Header', 'pxaas' ),
			'section'     => 'member_header',
			'default'     => get_template_directory_uri().'/assets/images/jk.png',
			'priority'    => 10,
			
		) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'image',
			'settings'    => 'member_header_image_bot',
			'label'       => esc_html__( 'Image Header Bottom', 'pxaas' ),
			'section'     => 'member_header',
			'default'     => get_template_directory_uri().'/assets/images/bb.png',
			'priority'    => 10,
			
		) );

	PXaas_Kirki::add_section( 'member_content', array(
	    'title'          => esc_html__( 'Member Content', 'pxaas' ),
	    'description'    => esc_html__( 'These options are for your member list page: ' , 'pxaas') ,
	    'panel'          => 'member_panel', // Not typically needed.
	    'priority'       => 155,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '', // Rarely needed.
	) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'number',
			'settings'    => 'number_mem',
			'label'       => esc_html__( 'Number of members displayed', 'pxaas' ),
			'section'     => 'member_content',
			'default'     => '6',
			'priority'    => 10,
			
		) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'select',
			'settings'    => 'member-width',
			'label'       => esc_html__( 'Member Width', 'pxaas' ),
			'description'       => esc_html__( 'Based on Bootstrap 12 columns.', 'pxaas' ),
			'section'     => 'member_content',
			'default'     => '3',
			'priority'    => 10,
			'multiple'    => 0,
			'choices'     => array(
				'6' => esc_html__('2 Columns', 'pxaas'),
		        '4' => esc_html__('3 Columns', 'pxaas'),
		        '3' => esc_html__('4 Columns', 'pxaas'),
		        // '5' => esc_html__('5 Columns', 'pxaas'),
		        '2' => esc_html__('6 Columns', 'pxaas'),
			),
		) );
// ----------------------------------------------------------------------------------------------------------------------
// Page Option
PXaas_Kirki::add_panel( 'page_panel', array(
    'priority'    => 158,
    'title'       => esc_html__( 'Page Options', 'pxaas' ),
    'description' => esc_html__( 'My Description', 'pxaas' ),
) );
	PXaas_Kirki::add_section( 'page_header', array(
	    'title'          => esc_html__( 'Page Header', 'pxaas' ),
	    'description'    => esc_html__( 'These options are for your blog list page: ' , 'pxaas') .esc_url(home_url('?post_type=post' )),
	    'panel'          => 'page_panel', // Not typically needed.
	    'priority'       => 158,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '', // Rarely needed.
	) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'toggle',
			'settings'    => 'show_breadcrumbs_page',
			'label'       => esc_html__( 'Show BreadCrumbs', 'pxaas' ),
			'section'     => 'page_header',
			'default'     => 1,
			'priority'    => 10,
		) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'toggle',
			'settings'    => 'show_page_header',
			'label'       => esc_html__( 'Show Image Header', 'pxaas' ),
			'section'     => 'page_header',
			'default'     => 1,
			'priority'    => 10,
		) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'image',
			'settings'    => 'page_header_image',
			'label'       => esc_html__( 'Image Header', 'pxaas' ),
			'section'     => 'page_header',
			'default'     => get_template_directory_uri().'/assets/images/jk.png',
			'priority'    => 10,
			
		) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'image',
			'settings'    => 'page_header_image_bt',
			'label'       => esc_html__( 'Image Header', 'pxaas' ),
			'section'     => 'page_header',
			'default'     => get_template_directory_uri().'/assets/images/bb.png',
			'priority'    => 10,
			
		) );
	PXaas_Kirki::add_section( 'page_content', array(
	    'title'          => esc_html__( 'Page Content', 'pxaas' ),
	    'description'    => esc_html__( 'These options are for your blog list page: ' , 'pxaas') .esc_url(home_url('?post_type=post' )),
	    'panel'          => 'page_panel', // Not typically needed.
	    'priority'       => 158,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '', // Rarely needed.
	) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
				'type'        => 'toggle',
				'settings'    => 'show_title_page',
				'label'       => esc_html__( 'Show Title Page', 'pxaas' ),
				'section'     => 'page_content',
				'default'     => 0,
				'priority'    => 10,
			) );
		PXaas_Kirki::add_field( 'pxaas_configs', array(
			'type'        => 'toggle',
			'settings'    => 'show_btn_edit_page',
			'label'       => esc_html__( 'Show Button Edit Page', 'pxaas' ),
			'section'     => 'page_content',
			'default'     => 0,
			'priority'    => 10,
		) );


// ----------------------------------------------------------------------------------------------------------------------
// for blog settings
PXaas_Kirki::add_panel( 'blog_panel', array(
    'priority'    => 160,
    'title'       => esc_html__( 'Blog Options', 'pxaas' ),
    'description' => esc_html__( 'My Description', 'pxaas' ),
) );

// blog header **************************************************************************************************
PXaas_Kirki::add_section( 'blog_header', array(
    'title'          => esc_html__( 'Blog Header', 'pxaas' ),
    'description'    => esc_html__( 'These options are for your blog list page: ' , 'pxaas') .esc_url(home_url('?post_type=post' )),
    'panel'          => 'blog_panel', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',	
	'settings'    => 'show_breadcrumbs',
	'label'       => esc_html__( 'Show BreadCrumbs', 'pxaas' ),
	'section'     => 'blog_header',
	'default'     => 1,
	'priority'    => 10,
) );

// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'toggle',
// 	'settings'    => 'show_blog_header_img',
// 	'label'       => esc_html__( 'Show Image Header', 'pxaas' ),
// 	'section'     => 'blog_header',
// 	'default'     => 1,
// 	'priority'    => 10,
// ) );
// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'text',
// 	'settings'    => 'blog_head_title',
// 	'label'       => esc_html__( 'Header Title', 'pxaas' ),
// 	'section'     => 'blog_header',
// 	'default'     => 'Our Last News',
// 	'priority'    => 10,
	
// ) );

// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'textarea',
// 	'settings'    => 'blog_head_desc',
// 	'label'       => esc_html__( 'Header description', 'pxaas' ),
// 	'section'     => 'blog_header',
// 	'default'     => '',
// 	'priority'    => 10,
	
// ) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'blog_header_image',
	'label'       => esc_html__( 'Image Header', 'pxaas' ),
	'section'     => 'blog_header',
	'default'     => get_template_directory_uri().'/assets/images/jk.png',
	'priority'    => 10,
	
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'blog_header_image_bt',
	'label'       => esc_html__( 'Image Header of Header', 'pxaas' ),
	'section'     => 'blog_header',
	'default'     => get_template_directory_uri().'/assets/images/bb.png',
	'priority'    => 10,
	
) );

// Blog list **************************************************************************************************
PXaas_Kirki::add_section( 'blog_list', array(
    'title'          => esc_html__( 'List View', 'pxaas' ),
    'description'    => esc_html__( 'These options are for your blog list page: ' , 'pxaas') .esc_url(home_url('?post_type=post' )),
    'panel'          => 'blog_panel', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'select',
	'settings'    => 'blog_content_width',
	'label'       => esc_html__( 'Content Width', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => 'big-container',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'boxed-container' => esc_html__( 'Small Boxed', 'pxaas' ),
		'big-container' => esc_html__( 'Wide Boxed', 'pxaas' ),
		'full-container' => esc_html__( 'Fullwidth', 'pxaas' ),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'radio-image',
	'settings'    => 'blog_layout',
	'label'       => esc_html__( 'Blog Sidebar Layout', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => 'right_sidebar',
	'priority'    => 10,
	'choices'     => array(
		'fullwidth' => get_template_directory_uri() . '/assets/admin/images/1c.png',
		'left_sidebar' => get_template_directory_uri() . '/assets/admin/images/2cl.png',
		'right_sidebar' => get_template_directory_uri() . '/assets/admin/images/2cr.png',
		
	),
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'select',
	'settings'    => 'blog-sidebar-width',
	'label'       => esc_html__( 'Sidebar Width', 'pxaas' ),
	'description'       => esc_html__( 'Based on Bootstrap 12 columns.', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => '4',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'2' => esc_html__('2 Columns', 'pxaas'),
        '3' => esc_html__('3 Columns', 'pxaas'),
        '4' => esc_html__('4 Columns', 'pxaas'),
        '5' => esc_html__('5 Columns', 'pxaas'),
        '6' => esc_html__('6 Columns', 'pxaas'),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_show_format',
	'label'       => esc_html__( 'Show Post Format on posts page', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => '1',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_date',
	'label'       => esc_html__( 'Show Date', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => '1',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_author',
	'label'       => esc_html__( 'Show Author', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => '0',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_cats',
	'label'       => esc_html__( 'Show Categories', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => '1',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_tags',
	'label'       => esc_html__( 'Show Tags', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => '0',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_comments',
	'label'       => esc_html__( 'Show Comments', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => '0',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_like',
	'label'       => esc_html__( 'Show Like', 'pxaas' ),
	'section'     => 'blog_list',
	'default'     => '0',
	'priority'    => 10,
) );

// Blog single **************************************************************************************************
PXaas_Kirki::add_section( 'blog_single', array(
    'title'          => esc_html__( 'Single Post View', 'pxaas' ),
    'description'    => esc_html__( 'Add custom CSS here' , 'pxaas'),
    'panel'          => 'blog_panel', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'select',
	'settings'    => 'blog_single_width',
	'label'       => esc_html__( 'Content Width', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => 'big-container',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'boxed-container' => esc_html__( 'Small Boxed', 'pxaas' ),
		'big-container' => esc_html__( 'Wide Boxed', 'pxaas' ),
		'full-container' => esc_html__( 'Fullwidth', 'pxaas' ),
	),
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'select',
	'settings'    => 'blog-single-sidebar-width',
	'label'       => esc_html__( 'Sidebar Width', 'pxaas' ),
	'description'       => esc_html__( 'Based on Bootstrap 12 columns.', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '4',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'2' => esc_html__('2 Columns', 'pxaas'),
        '3' => esc_html__('3 Columns', 'pxaas'),
        '4' => esc_html__('4 Columns', 'pxaas'),
        '5' => esc_html__('5 Columns', 'pxaas'),
        '6' => esc_html__('6 Columns', 'pxaas'),
	),
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_featured',
	'label'       => esc_html__( 'Show Featured Image', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_date',
	'label'       => esc_html__( 'Show Date', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_author',
	'label'       => esc_html__( 'Show Author', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '0',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_cats',
	'label'       => esc_html__( 'Show Categories', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_tags',
	'label'       => esc_html__( 'Show Tags', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '0',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_comments',
	'label'       => esc_html__( 'Show Comments', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '0',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_author_block',
	'label'       => esc_html__( 'Show Author Block', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_post_nav',
	'label'       => esc_html__( 'Show post navigation', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '0',
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_related',
	'label'       => esc_html__( 'Show related posts', 'pxaas' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );

// Footer Option **************************************************************************************************
PXaas_Kirki::add_section( 'footer_options', array(
    'title'          => esc_html__( 'Footer Options', 'pxaas' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'toggle',
// 	'settings'    => 'show_blog_footer',
// 	'label'       => esc_html__( 'Show Section Top Footer', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'default'     => 1,
// 	'priority'    => 10,
// ) );

// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'text',
// 	'settings'    => 'blog_foot_title',
// 	'label'       => esc_html__( 'Footer Title', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'default'     => 'Subscribe Our Newsletter',
// 	'priority'    => 10,
// ) );


// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'select',
// 	'settings'    => 'icon_footer_blog',
// 	'label'       => __( 'Icon Blog Top Footer', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'default'     => 'rocket',
// 	'priority'    => 10,
// 	'multiple'    => 1,
// 	'choices'     => array(
// 		'idea' => esc_attr__( 'Idea', 'pxaas' ),
// 		'pinwheel' => esc_attr__( 'Pinwheel', 'pxaas' ),
// 		'sun' => esc_attr__( 'Sun', 'pxaas' ),
// 		'wind-turbine' => esc_attr__( 'Wind-turbine', 'pxaas' ),
// 		'power' => esc_attr__( 'Power', 'pxaas' ),
// 		'user' => esc_attr__( 'User', 'pxaas' ),
// 		'cup' => esc_attr__( 'Cup', 'pxaas' ),
// 		'time' => esc_attr__( 'Time', 'pxaas' ),
// 		'menu' => esc_attr__( 'Menu', 'pxaas' ),
// 		'list' => esc_attr__( 'List', 'pxaas' ),
// 		'rocket' => esc_attr__( 'Rocket', 'pxaas' ),
// 		'new-email-outline' => esc_attr__( 'New Email Outline', 'pxaas' ),
// 		'internet' => esc_attr__( 'Internet', 'pxaas' ),
// 		'placeholder' => esc_attr__( 'Placeholder', 'pxaas' ),
// 	),
// ) );


// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'text',
// 	'settings'    => 'blog_foot_sub_title',
// 	'label'       => esc_html__( 'Footer Sub Title', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'default'     => 'Get the latest News & Offers..',
// 	'priority'    => 10,
// ) );

// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'text',
// 	'settings'    => 'blog_foot_placeholder',
// 	'label'       => esc_html__( 'Placeholder Input', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'default'     => 'Email*',
// 	'priority'    => 10,
// ) );
// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'text',
// 	'settings'    => 'blog_foot_button',
// 	'label'       => esc_html__( 'Button Name', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'default'     => 'Submit',
// 	'priority'    => 10,
// ) );
// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'url',
// 	'settings'    => 'blog_foot_button_link',
// 	'label'       => esc_html__( 'Button Link', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'default'     => '#!',
// 	'priority'    => 10,
// ) );

// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'textarea',
// 	'settings'    => 'blog_foot_desc',
// 	'label'       => esc_html__( 'Foot description', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'default'     => '',
// 	'priority'    => 10,
	
// ) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'blog_footer_image',
	'label'       => esc_html__( 'Image Footer', 'pxaas' ),
	'section'     => 'footer_options',
	'default'     => get_template_directory_uri().'/assets/images/logo.png',
	'priority'    => 10,
	
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Footer Widgets', 'pxaas' ),
	'section'     => 'footer_options',
	'priority'    => 10,
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_attr__('Widget Area', 'pxaas' ),
		'field' => 'title',
	),
	'settings'    => 'footer_widgets',
	'default'     => array(
		array(
			'title' => esc_attr__( 'About Us', 'pxaas' ),
			'classes'  => 'col-md-3 col-sm-6',
			'widid'	=> 'footer-about-us'
		),
		array(
			'title' => esc_attr__( 'Opening Hours', 'pxaas' ),
			'classes'  => 'col-md-3 col-sm-6',
			'widid'	=> 'footer-opengin-hours'
		),
		array(
			'title' => esc_attr__( 'Company Us', 'pxaas' ),
			'classes'  => 'col-md-3 col-sm-6',
			'widid'	=> 'footer-company-us'
		),
		array(
			'title' => esc_attr__( 'Contact Us', 'pxaas' ),
			'classes'  => 'col-md-3 col-sm-6',
			'widid'	=> 'footer-contact-us'
		),
		
	),
	'fields' => array(
		'title' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget Title', 'pxaas' ),
			'description' => esc_attr__( 'This will be the label for your widget area', 'pxaas' ),
			'default'     => 'Widget Title',
		),
		'classes' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget Classes', 'pxaas' ),
			'description' => esc_attr__( 'This will be used to layout your widget', 'pxaas' ),
			'default'     => 'col-md-3 col-sm-6',
		),
		'widid' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget ID', 'pxaas' ),
			'description' => esc_attr__( 'This value must be unique. And don\'t change it after.', 'pxaas' ),
			'default'     => 'widget-id-1',
		),
	)
) );

// PXaas_Kirki::add_field( 'pxaas_configs', array(
// 	'type'        => 'repeater',
// 	'label'       => esc_attr__( 'Footer Widgets Bottom', 'pxaas' ),
// 	'section'     => 'footer_options',
// 	'priority'    => 10,
// 	'row_label' => array(
// 		'type'  => 'field',
// 		'value' => esc_attr__('Widget Area', 'pxaas' ),
// 		'field' => 'title',
// 	),
// 	'settings'    => 'footer_widgets_bottom',
// 	'default'     => array(
// 		array(
// 			'title' => esc_attr__( 'Subscribe Text', 'pxaas' ),
// 			'classes'  => 'col-md-5',
// 			'widid'	=> 'footer-subscribe-text'
// 		),
// 		array(
// 			'title' => esc_attr__( 'Subscribe Form', 'pxaas' ),
// 			'classes'  => 'col-md-7',
// 			'widid'	=> 'footer-subscribe-form'
// 		),
		
// 	),
// 	'fields' => array(
// 		'title' => array(
// 			'type'        => 'text',
// 			'label'       => esc_attr__( 'Widget Title', 'pxaas' ),
// 			'description' => esc_attr__( 'This will be the label for your widget area', 'pxaas' ),
// 			'default'     => 'Widget Title',
// 		),
// 		'classes' => array(
// 			'type'        => 'text',
// 			'label'       => esc_attr__( 'Widget Classes', 'pxaas' ),
// 			'description' => esc_attr__( 'This will be used to layout your widget', 'pxaas' ),
// 			'default'     => 'col-md-6',
// 		),
// 		'widid' => array(
// 			'type'        => 'text',
// 			'label'       => esc_attr__( 'Widget ID', 'pxaas' ),
// 			'description' => esc_attr__( 'This value must be unique. And don\'t change it after.', 'pxaas' ),
// 			'default'     => 'widget-id-1',
// 		),
// 	)
// ) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'footer_logo',
	'label'       => esc_html__( 'Footer Background', 'pxaas' ),
	'section'     => 'footer_options',
	'default'     => '',
	'priority'    => 10,
	'choices'     => array(
		'save_as' => 'id',
	),
	
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'textarea',
	'settings'    => 'footer_copyright',
	'label'       => esc_html__( 'Copyright Text', 'pxaas' ),
	'description'       => esc_html__( 'Enter footer copyright text for your site.', 'pxaas' ),
	'section'     => 'footer_options',
	'default'     => '<h6 class="mb-0px"><span class="ft-copy">&copy; <a href="https://themeforest.net/user/cththemes" target="_blank">CTHthemes</a> 2019.  All rights reserved.</span></h6>',
	'priority'    => 10,
) );

// 404 error page **************************************************************************************************
PXaas_Kirki::add_section( 'error404_options', array(
    'title'          => esc_html__( 'Error 404 Options', 'pxaas' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'textarea',
	'settings'    => 'error404_msg',
	'label'       => esc_html__( 'Additional Message', 'pxaas' ),
	'section'     => 'error404_options',
	'default'     => '',
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'textarea',
	'settings'    => 'error404_title',
	'label'       => esc_html__( 'Title message', 'pxaas' ),
	'section'     => 'error404_options',
	'default'     => '1',
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'toggle',
	'settings'    => 'error404_form',
	'label'       => esc_html__( 'Show Form Search', 'pxaas' ),
	'section'     => 'error404_options',
	'default'     => '1',
	'priority'    => 10,
) );

PXaas_Kirki::add_field( 'pxaas_configs', array(
	'type'        => 'image',
	'settings'    => 'background_404',
	'label'       => esc_html__( 'Background Image', 'pxaas' ),
	'section'     => 'error404_options',
	'default'     => get_template_directory_uri().'/assets/images/error_img.png',
	'priority'    => 10,
) );

// Test option **************************************************************************************************
PXaas_Kirki::add_section( 'tets_options', array(
    'title'          => esc_html__( 'test Options', 'pxaas' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

