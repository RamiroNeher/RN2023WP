<?php
 
/** 
 * Avoid simple hacks 
 */ 
if ( ! defined( 'ABSPATH' ) ) { 
	exit; // Silence is golden. 
};
 
get_header();
?>

<?php tha_content_before(); ?>

<div class="site-content">

    <?php tha_content_top(); ?>

    <div class="container">
        <div class="row">
            <h1 class="text-primary">Holi</h1>
        </div>
    </div>

    <?php tha_content_bottom(); ?>

</div><!-- .content -->

<?php tha_content_after(); ?>

<?php 
get_footer(); 
 ?>

