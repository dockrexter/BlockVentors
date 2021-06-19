<?php

add_action('redux/options/cryptcio_settings/saved', 'cryptcio_save_theme_settings', 10, 2);
add_action('redux/options/cryptcio_settings/import', 'cryptcio_save_theme_settings', 10, 2);
add_action('redux/options/cryptcio_settings/reset', 'cryptcio_save_theme_settings');
add_action('redux/options/cryptcio_settings/section/reset', 'cryptcio_save_theme_settings');

function cryptcio_config_value($value) {
    return isset($value) ? $value : 0;
}

//complie scss
function cryptcio_save_theme_settings() {
    global $cryptcio_settings;
    update_option('cryptcio_init_theme', '1');
    global $cryptcioReduxSettings;

    $reduxFramework = $cryptcioReduxSettings->ReduxFramework;
    $template_dir = get_template_directory();

    // Compile SCSS Files
    if (!class_exists('scssc')) {
        require_once( CRYPTCIO_ADMIN . '/sassphp/scss.inc.php' );
    }
}
