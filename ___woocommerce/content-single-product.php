<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}
	?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="small-12 medium-12 large-9 columns">
			<div class="row no-margin">
				<div class="small-12 medium-6 large-6 columns product-wrapper">
				<?php
				/**
				 * woocommerce_before_single_product_summary hook.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div><!-- columns -->
			<div class="small-12 medium-6 large-6 columns">
				<div class="summary entry-summary">
				<?php
				/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
					do_action( 'woocommerce_single_product_summary' );
				?>
				</div><!-- .summary -->
			</div><!-- columns -->
		</div>
	</div>
	<div class="columns small-12 medium-12 large-3">
		<?php
		$image1 = get_field('imagem', 'option');
		$image2 = get_field('imagem2', 'option');
		$image3 = get_field('imagem3', 'option');
		$size1 = 'banner-small'; // (thumbnail, medium, large, full or custom size)
		$size2= 'banner-large'; // (thumbnail, medium, large, full or custom size)
		$size3 = 'banner-vertical'; // (thumbnail, medium, large, full or custom size)
		$link = get_field('link_produto');
		?>				
		
		<div class="show-for-small-only">
			<div class="banner banner-product">
				<?php if( $link ): ?>	
				<a href="<?php echo $link; ?>"><?php echo wp_get_attachment_image( $image3, $size1 ); ?></a>
				<?php else: ?>
					<?php echo wp_get_attachment_image( $image3, $size1 ); ?>
				<?php endif; ?>
				<!-- <img src="<?php bloginfo('template_url') ?>/img/banner-home-quadrado.png" height="600" width="600" alt=""> -->
			</div><!-- banner -->
		</div>
		<div class="show-for-medium-only">
			<div class="banner banner-product">
				<?php if( $link ): ?>	
				<a href="<?php echo $link; ?>"><?php echo wp_get_attachment_image( $image2, $size2 ); ?></a>
				<?php else: ?>
					<?php echo wp_get_attachment_image( $image2, $size2 ); ?>
				<?php endif; ?>
				<!-- <img src="<?php bloginfo('template_url') ?>/img/banner-870x233.png" height="233" width="870" alt=""> -->
			</div><!-- banner -->
		</div>
		<div class="show-for-large">
			<?php if( $link ): ?>	
			<a href="<?php echo $link; ?>"><?php echo wp_get_attachment_image( $image1, $size3 ); ?></a>
			<?php else: ?>
				<?php echo wp_get_attachment_image( $image1, $size3 ); ?>
			<?php endif; ?>
			<!-- <img src="<?php bloginfo('template_url') ?>/img/banner-270x458.png" height="458" width="270" alt=""> -->
		</div>
	</div><!-- columns -->
</div>

<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>

		<meta itemprop="url" content="<?php the_permalink(); ?>" />

	</div><!-- #product-<?php the_ID(); ?> -->

	<?php do_action( 'woocommerce_after_single_product' ); ?>
