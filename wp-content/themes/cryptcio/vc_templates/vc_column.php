<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $width = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}
if($overlay){
	$css_classes[]='has_overlay';
}
if($center_element) {
	$css_classes[]='center_element';
}
if($hide_bg_mobile){
	$css_classes[] = 'hidden_bg_xs';
}
if($hide_bg_table){
	$css_classes[] = 'hidden_bg_tablet';
}
$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';

$se_style = 'style="';
if(isset($line_w) && $line_w !=''){
	$se_style .= ' width:'.$line_w.'px;';
}
if(isset($line_h) && $line_h !=''){
	$se_style .= ' height:'.$line_h.'px;';
}
if(isset($line_color) && $line_color !=''){
	$se_style .= ' background:'.$line_color.';';
}
$se_style .= '"';
if($separator){
	$output .= '<div class="line-separator"'.$se_style.'>';
	$output .= '</div>';
}
$output .= '</div>';
echo $output;
