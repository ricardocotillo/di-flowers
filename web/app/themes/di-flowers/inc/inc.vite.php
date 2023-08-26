<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;  
    
/*
 * VITE & Tailwind JIT development
 * Inspired by https://github.com/andrefelipe/vite-php-setup
 *
 */

// dist subfolder - defined in vite.config.json
define('DIST_DEF', 'dist');

// defining some base urls and paths
define('DIST_URI', get_template_directory_uri() . '/' . DIST_DEF);
define('DIST_PATH', get_template_directory() . '/' . DIST_DEF);

// js enqueue settings
define('JS_DEPENDENCY', array()); // array('jquery') as example
define('JS_LOAD_IN_FOOTER', true); // load scripts in footer?
// deafult server address, port and entry point can be customized in vite.config.json
define('VITE_SERVER', 'http://localhost:3000');
define('VITE_ENTRY_POINT', '/main.js');

// enqueue hook
add_action( 'wp_enqueue_scripts', function() {
    // production version, 'npm run build' must be executed in order to generate assets
    // ----------

    // read manifest.json to figure out what to enqueue
    $manifest = json_decode( file_get_contents( DIST_PATH . '/manifest.json'), true );
    // is ok
    if (is_array($manifest)) {
        
        if (isset($manifest['main.css'])) {
            // enqueue CSS files
            $css_file = @$manifest['main.css']['file'];
            if (!empty($css_file)) {
                wp_enqueue_style( 'main', DIST_URI . '/' . $css_file );
            }
        }
        if (isset($manifest['main.js'])) {
            // enqueue main JS file
            $js_file = @$manifest['main.js']['file'];
            if ( ! empty($js_file)) {
                wp_enqueue_script( 'main', DIST_URI . '/' . $js_file, JS_DEPENDENCY, '', JS_LOAD_IN_FOOTER );
            }
            
        }

    }
});