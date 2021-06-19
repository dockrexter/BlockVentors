<?php

function cryptcio_iconpicker_type_pestrokefont( $icons ) {
    $pestrokefont_icons = array(
        array('pe-7s-helm' => 'Helm'),
        array( 'pe-7s-back-2' => 'Back 2' ),
        array( 'pe-7s-next-2' => 'Next 2'),
        array( 'pe-7s-piggy' => 'Piggy' ),
        array( 'pe-7s-gift' => 'Gift' ),
        array( 'pe-7s-arc' => 'Archor' ),
        array( 'pe-7s-plane' => 'Plane' ),
        array( 'pe-7s-help2' => 'Help' ),
        array( 'pe-7s-clock' => 'Clock' ),
        array( 'pe-7s-junk' => 'Junk' ),
        array( 'pe-7s-edit' => 'Edit' ),
        array( 'pe-7s-download' => 'Download' ),
        array( 'pe-7s-config' => 'Config' ),
        array( 'pe-7s-drop' => 'Drop' ),
        array( 'pe-7s-refresh' => 'Refresh' ),
        array( 'pe-7s-album' => 'Album' ),
        array( 'pe-7s-diamond' => 'Diamond' ),
        array( 'pe-7s-door-lock' => 'Door lock' ),
        array( 'pe-7s-photo' => 'Photo' ),
        array( 'pe-7s-settings' => 'Settings' ),
        array( 'pe-7s-volume' => 'Volumn' ),
        array( 'pe-7s-users' => 'Users' ),
        array( 'pe-7s-tools' => 'Tools' ),
        array( 'pe-7s-star' => 'Star' ),
        array( 'pe-7s-like2' => 'Like' ),
        array( 'pe-7s-map-2' => 'Map 2' ),
        array( 'pe-7s-call' => 'Call' ),
        array( 'pe-7s-mail' => 'Mail' ),
        array( 'pe-7s-way' => 'Way' ),
        array( 'pe-7s-edit' => 'Edit' ),
        array( 'pe-7s-drop' => 'Drop' ),
        array( 'pe-7s-download' => 'Download' ),
        array( 'pe-7s-config' => 'Config' ),
        array( 'pe-7s-junk' => 'Junk' ),
        array( 'pe-7s-magic-wand' => 'Magic' ),
        array( 'pe-7s-like' => 'Like' ),
        array( 'pe-7s-cup' => 'Cup' ),
        array( 'pe-7s-cash' => 'Cash' ),
        array( 'pe-7s-target' => 'Target' ),
        array( 'pe-7s-help2' => 'Help' ),
        array( 'pe-7s-refresh-2' => 'Refresh' ),
        array( 'pe-7s-door-lock' => 'Door' ),
        array( 'pe-7s-global' => 'Global' ),
        array( 'pe-7s-cart' => 'Cart' ),
    );

    return array_merge( $icons, $pestrokefont_icons );
}

add_filter( 'vc_iconpicker-type-pestrokefont', 'cryptcio_iconpicker_type_pestrokefont' );

function cryptcio_vc_column() {
    $attributes = array(
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Add overlay background", "cryptcio"),
            'param_name' => 'overlay',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
        ),        
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Align inside element center horizontally and vertically", "cryptcio"),
            'param_name' => 'center_element',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
        ),     
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Add line separator", "cryptcio"),
            'param_name' => 'separator',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
        ), 
        array(
            "type" => "number",
            "class" => "",
            "heading" => esc_html__("Line Width", 'cryptcio'),
            "param_name" => "line_w",
            "value" => "",
            'dependency' => array(
                'element' => 'separator',
                'value' => 'yes',
            ),                 
            'description' => esc_html__( 'px', 'cryptcio' ),
            'weight' => 5,
        ), 
        array(
            "type" => "number",
            "class" => "",
            "heading" => esc_html__("Line Height", 'cryptcio'),
            "param_name" => "line_h",
            "value" => "",
            'dependency' => array(
                'element' => 'separator',
                'value' => 'yes',
            ),                 
            'description' => esc_html__( 'px', 'cryptcio' ),
            'weight' => 5,
        ), 
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Line color', 'cryptcio' ),
            'param_name' => 'line_color',
            'dependency' => array(
                'element' => 'separator',
                'value' => 'yes',
            ),
            'weight' => 5,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Hide background in tablet", "cryptcio"),
            'param_name' => 'hide_bg_table',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
            'admin_label'=> true,
        ),           
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Hide background in mobile", "cryptcio"),
            'param_name' => 'hide_bg_mobile',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
            'admin_label'=> true,
        ),                                 
    );
    vc_add_params('vc_column', $attributes); 
}
add_action('vc_before_init', 'cryptcio_vc_column'); 

function cryptcio_vc_separator() {
    $attributes = array(
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Hide in desktop", "cryptcio"),
            'param_name' => 'hide_in_desktop',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
            'admin_label'=> true,
        ),         
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Hide in tablet", "cryptcio"),
            'param_name' => 'hide_in_tablet',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
            'admin_label'=> true,
        ),           
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Hide in mobile", "cryptcio"),
            'param_name' => 'hide_in_mobile',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
            'admin_label'=> true,
        ),                                 
    );
    vc_add_params('vc_separator', $attributes); 
}
add_action('vc_before_init', 'cryptcio_vc_separator'); 

function cryptcio_vc_row() {
    $attributes = array(
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Wrap inside column in container", "cryptcio"),
            'param_name' => 'wrap_container',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
            'admin_label'=> true,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Add triangle background", "cryptcio"),
            'param_name' => 'triangle_bg',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
        ),   
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'First background color', 'cryptcio' ),
            'param_name' => 'bg_color1',
            'group' => esc_html__('Two-tone background setting','cryptcio'),
            'dependency' => array(
                'element' => 'triangle_bg',
                'value' =>  'yes',
            ),            
        ), 
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Second background color', 'cryptcio' ),
            'param_name' => 'bg_color2',
            'group' => esc_html__('Two-tone background setting','cryptcio'),
            'dependency' => array(
                'element' => 'triangle_bg',
                'value' =>  'yes',
            ),            
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__( "Diagonal line direction", 'cryptcio' ),
            "param_name" => "diagonal_line_direct",
            "value" => array(
                esc_html__('Top left to bottom', 'cryptcio') => 'left-bottom',
                esc_html__('Top right to bottom', 'cryptcio') => 'right-bottom',
                ),
            'group' => esc_html__('Two-tone background setting','cryptcio'),
            'default' => 'left-bottom',
            'dependency' => array(
                'element' => 'triangle_bg',
                'value' =>  'yes',
            ),            
        ), 
        array(
            "type" => "dropdown",
            "heading" => esc_html__( "Diagonal line position", 'cryptcio' ),
            "param_name" => "d_line_position",
            "value" => array(
                esc_html__('Left', 'cryptcio') => 'left',
                esc_html__('Right', 'cryptcio') => 'right',
                ),
            'group' => esc_html__('Two-tone background setting','cryptcio'),
            'default' => 'left',
            'dependency' => array(
                'element' => 'triangle_bg',
                'value' =>  'yes',
            ),            
        ),         
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => esc_html__("Width", 'cryptcio'),
            "param_name" => "d_line_w",
            'dependency' => array(
                'element' => 'triangle_bg',
                'value' =>  'yes',
            ),                 
            'description' => esc_html__( 'Add %, em or px after the width number.', 'cryptcio' ),
            'group' => esc_html__('Two-tone background setting','cryptcio'),
        ),                                        
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Hide background in mobile", "cryptcio"),
            'param_name' => 'hide_bg_mobile',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
            'admin_label'=> true,
        ),
    );
    vc_add_params('vc_row', $attributes); 
}
add_action('vc_before_init', 'cryptcio_vc_row'); 
function cryptcio_vc_row_inner() {
    $attributes = array(
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Wrap inside column in container", "cryptcio"),
            'param_name' => 'wrap_container',
            'value' => array( esc_html__( 'Yes', 'cryptcio' ) => 'yes' ),
            'weight' => 5,
        ),
    );
    vc_add_params('vc_row_inner', $attributes); 
}
add_action('vc_before_init', 'cryptcio_vc_row_inner'); 

function cryptcio_vc_gallery() {
    $attributes = array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Number of columns', 'cryptcio' ),
            'param_name' => 'col_num',
            'value' => array(
                esc_html__( 'Default', 'cryptcio' ) => 'default',
                esc_html__( '2', 'cryptcio' ) => '2',
                esc_html__( '3', 'cryptcio' ) => '3',
                esc_html__( '4', 'cryptcio' ) => '4',
                esc_html__( '5', 'cryptcio' ) => '5',
            ),
            'description' => esc_html__( 'Select number of columns to display images.', 'cryptcio' ),
             "group"     => esc_html__( "Column numbers", 'cryptcio' ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'image_grid',
            ),
        ),
    );

    vc_add_params('vc_gallery', $attributes);

}

add_action('vc_before_init', 'cryptcio_vc_gallery');

function cryptcio_vc_progress_bar() {
    $attributes = array(
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Values', 'cryptcio' ),
            'param_name' => 'values',
            'description' => esc_html__( 'Enter values for graph - value, title and color.', 'cryptcio' ),
            'value' => urlencode( json_encode( array(
                array(
                    'label' => esc_html__( 'Development', 'cryptcio' ),
                    'value' => '90',
                ),
                array(
                    'label' => esc_html__( 'Design', 'cryptcio' ),
                    'value' => '80',
                ),
                array(
                    'label' => esc_html__( 'Marketing', 'cryptcio' ),
                    'value' => '70',
                ),
            ) ) ),

            'params' => array(
                
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Label', 'cryptcio' ),
                    'param_name' => 'label',
                    'description' => esc_html__( 'Enter text used as title of bar.', 'cryptcio' ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Value', 'cryptcio' ),
                    'param_name' => 'value',
                    'description' => esc_html__( 'Enter value of bar.', 'cryptcio' ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Color', 'cryptcio' ),
                    'param_name' => 'color',
                    'value' => array(
                            esc_html__( 'Default', 'cryptcio' ) => '',
                        ) + array(
                            esc_html__( 'Classic Grey', 'cryptcio' ) => 'bar_grey',
                            esc_html__( 'Classic Blue', 'cryptcio' ) => 'bar_blue',
                            esc_html__( 'Classic Turquoise', 'cryptcio' ) => 'bar_turquoise',
                            esc_html__( 'Classic Green', 'cryptcio' ) => 'bar_green',
                            esc_html__( 'Classic Orange', 'cryptcio' ) => 'bar_orange',
                            esc_html__( 'Classic Red', 'cryptcio' ) => 'bar_red',
                            esc_html__( 'Classic Black', 'cryptcio' ) => 'bar_black',
                        ) + getVcShared( 'colors-dashed' ) + array(
                            esc_html__( 'Custom Color', 'cryptcio' ) => 'custom',
                        ),
                    'description' => esc_html__( 'Select single bar background color.', 'cryptcio' ),
                    'admin_label' => true,
                    'param_holder_class' => 'vc_colored-dropdown',
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Custom color', 'cryptcio' ),
                    'param_name' => 'customcolor',
                    'description' => esc_html__( 'Select custom single bar background color.', 'cryptcio' ),
                    'dependency' => array(
                        'element' => 'color',
                        'value' => array( 'custom' ),
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Custom text color', 'cryptcio' ),
                    'param_name' => 'customtxtcolor',
                    'description' => esc_html__( 'Select custom single bar text color.', 'cryptcio' ),
                    'dependency' => array(
                        'element' => 'color',
                        'value' => array( 'custom' ),
                    ),
                ),
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Layout", 'cryptcio'),
            "param_name" => "layout",
            'std' => 'layout1',
            'value' => array(
                esc_html__('Layout 1', 'cryptcio') => 'layout1',
                esc_html__('Layout 2', 'cryptcio') => 'layout2',
                esc_html__('Layout 3', 'cryptcio') => 'layout3',
            ),
            'weight' => 5,
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Image', 'cryptcio'),
            'param_name' => 'image',
            'value' => '',
            'description' => esc_html__( 'Upload image.', 'cryptcio' ),
            'group' => esc_html__('Top content','cryptcio'),
            "dependency" => array(
                'element' => 'layout',
                'value' => array('layout3')
            )             
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", 'cryptcio'),
            "param_name" => "big_title",
            "admin_label" => true,
            "dependency" => array(
                'element' => 'layout',
                'value' => array('layout3')
            ),
            'group' => esc_html__('Top content','cryptcio'),
        ),  
        array(
            "type" => "textarea",
            "heading" => esc_html__("Description", 'cryptcio'),
            "param_name" => "desc",
            "dependency" => array(
                'element' => 'layout',
                'value' => array('layout3')
            ),
            'group' => esc_html__('Top content','cryptcio'),
        ),         
    );

    vc_add_params('vc_progress_bar', $attributes);

}

add_action('vc_before_init', 'cryptcio_vc_progress_bar');


