<?php get_header(); ?>
<!-- START LOOP -->
		<?php 	if ( is_singular( 'product' ) ) :
		woocommerce_content();

		else :
		//For ANY product archive.
		//Product taxonomy, product search or /shop landing
		woocommerce_get_template( 'archive-product.php' );
		endif; ?>

		<!-- END LOOP -->
<?php get_footer(); ?>


		
	