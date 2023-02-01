<?php 
/** 
 * Avoid simple hacks 
 */ 
if ( ! defined( 'ABSPATH' ) ) { 
	exit; // Silence is golden. 
} ;
?>

<?php tha_html_before(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php tha_head_top(); ?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        
        <?php tha_head_bottom(); ?>
        <?php wp_head(  ); ?>
    </head>
    <body <?php body_class(); ?>>

        <?php tha_body_top(); ?>

        <?php tha_header_before(); ?>

        <header class="site-header">

            <?php tha_header_top(); ?>

            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Nombre del Sitio</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="main-menu">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'bootstrap-navbar-menu',
                            'container' => false,
                            'menu_class' => '',
                            'fallback_cb' => '__return_false',
                            'items_wrap' => '<ul id="%1$s" class="navbar-nav ms-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                            'depth' => 3,
                            'walker' => new bootstrap_5_wp_nav_menu_walker()
                        ));
                        ?>
                    </div>
                </div>
            </nav>
            
            <?php tha_header_bottom(); ?>

        </header>
        
        <?php tha_header_after(); ?>
