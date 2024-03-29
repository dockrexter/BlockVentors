<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $values
 * @var $units
 * @var $layout
 * @var $bgcolor
 * @var $custombgcolor
 * @var $customtxtcolor
 * @var $options
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Progress_Bar
 */
$title = $values = $units =$layout = $bgcolor = $css = $custombgcolor = $customtxtcolor = $options = $el_class = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts = $this->convertAttributesToNewProgressBar( $atts );

extract( $atts );
wp_enqueue_script( 'waypoints' );

$el_class = $this->getExtraClass( $el_class );

$bar_options = array();
$options = explode( ',', $options );
if ( in_array( 'animated', $options ) ) {
	$bar_options[] = 'animated';
}
if ( in_array( 'striped', $options ) ) {
	$bar_options[] = 'striped';
}

if ( 'custom' === $bgcolor && '' !== $custombgcolor ) {
	$custombgcolor = ' style="' . vc_get_css_color( 'background-color', $custombgcolor ) . '"';
	if ( '' !== $customtxtcolor ) {
		$customtxtcolor = ' style="' . vc_get_css_color( 'color', $customtxtcolor ) . '"';
	}
	$bgcolor = '';
} else {
	$custombgcolor = '';
	$customtxtcolor = '';
	$bgcolor = 'vc_progress-bar-color-' . esc_attr( $bgcolor );
	$el_class .= ' ' . $bgcolor;
}

$class_to_filter = 'vc_progress_bar custom-progress wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '">';

$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_progress_bar_heading' ) );

$values = (array) vc_param_group_parse_atts( $values );
$max_value = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
	$new_line['bgcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custombgcolor;
	$new_line['txtcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $customtxtcolor;
	if ( isset( $data['customcolor'] ) && ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) ) {
		$new_line['bgcolor'] = ' style="background-color: ' . esc_attr( $data['customcolor'] ) . ';"';
	}
	if ( isset( $data['customtxtcolor'] ) && ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) ) {
		$new_line['txtcolor'] = ' style="color: ' . esc_attr( $data['customtxtcolor'] ) . ';"';
	}

	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}
if( $layout=="layout1"){
	foreach ( $graph_lines_data as $line ) {
		$unit = ( '' !== $units ) ? ' <span class="vc_label_units">' . $line['value'] . $units . '</span>' : '';
		$output .= '<h6 class="vc_label"' . $line['txtcolor'] . '>' . $line['label'] . $unit . '</h6>';
		$output .= '<div class="vc_general vc_single_bar' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
				' vc_progress-bar-color-' . $line['color'] : '' )
			. '">';
		if ( $max_value > 100.00 ) {
			$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		} else {
			$percentage_value = $line['value'];
		}
		$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . '><small class="vc_progress_value"' . '>' . $line['value'] .'%' . $unit . '</small></span>';
		$output .= '</div>';
	}
}elseif( $layout=="layout3"){
	$output .='<div class="cryptcio_vc_bar_layout3 text-center">';
	if($big_title!=''){
		$output .= '<h4 class="bar_title">'.esc_html($big_title).'</h4>';
	}
	if($image){
		$bgImage = wp_get_attachment_url($image);
		$output .= '<img src="'.esc_url($bgImage).'" alt="" />';
	}
	if($desc != ''){
		$output .= '<div class="bar_desc">'.esc_html($desc).'</div>';
	}
	foreach ( $graph_lines_data as $line ) {
		$unit = ( '' !== $units ) ? ' <span class="vc_label_units">' . $line['value'] . $units . '</span>' : '';
		$output .= '<h3 class="vc_label"' . $line['txtcolor'] . '>' . $line['label'] . $unit . '</h3>';
		$output .= '<div class="vc_general vc_single_bar' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
				' vc_progress-bar-color-' . $line['color'] : '' )
			. '">';
		if ( $max_value > 100.00 ) {
			$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		} else {
			$percentage_value = $line['value'];
		}
		$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . '><small class="vc_progress_value"' . '>' . $line['value'] .'%' . $unit . '</small></span>';
		$output .= '</div>';
	}
	$output .='</div>';
}else{
	foreach ( $graph_lines_data as $line ) {
		$unit = ( '' !== $units ) ? ' <span class="vc_label_units">' . $line['value'] . $units . '</span>' : '';
		$output .= '<div class="vc_general vc_single_bar progress-bar-style2' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
				' vc_progress-bar-color-' . $line['color'] : '' )
			. '">';
		$output .= '<small class="vc_label"' . $line['txtcolor'] . '>' . $line['label'] . $unit . '</small>';
			
		if ( $max_value > 100.00 ) {
			$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		} else {
			$percentage_value = $line['value'];
		}
		$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . '></span>';
		$output .= '</div>';
	}
}

$output .= '</div>';

echo $output;
