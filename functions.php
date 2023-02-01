<?php

/**
 * Incluye JQuery
 */
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11); 

function my_jquery_enqueue() { 

    wp_deregister_script('jquery'); 
    wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js", false, null, true ); 
    wp_enqueue_script('jquery');

}

/**
 * Agrega estilos y js
 */
function wpdocs_scripts_method() {

    // CSS 
    wp_register_style( 'primary-stylesheet', get_template_directory_uri() . '/style.css');
    wp_enqueue_style( 'primary-stylesheet' ); 

    wp_register_style( 'bootstrap-custom', get_template_directory_uri() . '/assets/css/custom.css');
    wp_enqueue_style( 'bootstrap-custom' ); 

    // JS 
    wp_register_script( 'bootstrap-scripts', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '', true ); 
    wp_enqueue_script('bootstrap-scripts');

    wp_register_script( 'custom-scripts', get_stylesheet_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '', true ); 
    wp_enqueue_script('custom-scripts'); 

} 

add_action( 'wp_enqueue_scripts', 'wpdocs_scripts_method' );

/**
 * Agrega soporte para tamaños de imagenes
 */
add_theme_support( 'post-thumbnails' ); 
//set_post_thumbnail_size( 50, 50, true ); 
// add_image_size( 'xlarge', 1200, 1200);

/**
 * Agrega soporte para menu
 */
add_theme_support( 'menus' );

/**
 * Registra el menú de Bootstrap con Navwalker
 * https://github.com/AlexWebLab/bootstrap-5-wordpress-navbar-walker
 */
include_once('includes/navwalker.php');

register_nav_menu('bootstrap-navbar-menu', 'Bootstrap Navbar Menu');

/**
 * Agrega soporte para svg
 */
function wpcontent_svg_mime_type( $mimes = array() ) {

    $mimes['svg'] = 'image/svg+xml'; 
    $mimes['svgz'] = 'image/svg+xml'; 
    return $mimes; 

} 

add_filter( 'upload_mimes', 'wpcontent_svg_mime_type' ); 

add_filter( 'wp_get_attachment_image_src', 'fix_wp_get_attachment_image_svg', 10, 4 ); /* the hook */ 

function fix_wp_get_attachment_image_svg($image, $attachment_id, $size, $icon) { 
    if (is_array($image) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1) { 

        if(is_array($size)) { 

            $image[1] = $size[0]; 
            $image[2] = $size[1]; 

        } elseif(($xml = simplexml_load_file($image[0])) !== false) { 

            $attr = $xml->attributes(); 
            $viewbox = explode(' ', $attr->viewBox); 
            $image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null); 
            $image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null); 

        } else { 

            $image[1] = $image[2] = null; 
        } 
    } 

    return $image; 

}

/**
 * Página de opciones de ACF
 * https://www.advancedcustomfields.com/resources/options-page/
 */
if( function_exists('acf_add_options_page') ) { 

	acf_add_options_page(array( 
		'page_title' 	=> 'Theme General Settings', 
		'menu_title'	=> 'Theme Settings', 
		'menu_slug' 	=> 'theme-general-settings', 
		'capability'	=> 'edit_posts', 
		'redirect'		=> false 
	)); 

}

/**
 * Incluye Hooks básicos
 * https://github.com/zamoose/themehookalliance
 */
include( 'includes/tha-theme-hooks.php' );