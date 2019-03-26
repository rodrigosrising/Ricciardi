<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>
<div class="related-wrapper">
	
	<section class="related row product-list-container">
		<div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3 columns text-center">
			<h4 class="uppercase"><?php esc_html_e( 'Experimente Também', 'woocommerce' ); ?></h4>
			<p><small>Todas as nossas massas mantém o mesmo padrão de qualidade Ricciardi. Você tem toda a liberdade de escolher e experimentar novos sabores e combinações disponíveis em nosso cardápio!</small></p>
		</div>
	</section>
	<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>
		
</div><!-- related-wrapper -->
<?php endif;

wp_reset_postdata();
