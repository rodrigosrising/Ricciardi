<?php /* Template Name: Custom home page2 */ ?>
<?php get_header(); ?>
	<div class="row ">
		<div class="small-12 ">
			<div class="row small-up-1 medium-up-2 large-up-3 collapse especialidades" data-equalizer>
				<div class="columns especialidade" data-equalizer-watch>
					<div class="especialidade-box-content">
						<div class="inner-box-content">
							<h3 class="uppercase">Especialidades</h3>
							<p><small><?php the_field('texto_superior'); ?></small></p>
						</div><!-- inner-box-content -->
					</div><!-- especialidade-box-content -->
				</div><!-- columns -->
				<?php
				$taxonomy = 'product_cat';
				$terms = get_terms($taxonomy, 'orderby=slug'); // Get all terms of a taxonomy
				if ( $terms && !is_wp_error( $terms ) ) : ?>
					<?php foreach( $terms as $term ): ?>
					<?php 					
					$cat_thumb_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
					$shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'product-category' );
					 ?>
					<div class="columns especialidade" data-equalizer-watch>
						<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><img src="<?php echo $shop_catalog_img[0]; ?>" alt="<?php echo $term->name; ?>"></a>
						<span class="especialidade-title"><h2><?php echo $term->name; ?></h2></span>
					</div><!-- columns -->
					<?php endforeach; ?>
				<?php endif;?>
				<div class="columns especialidade" data-equalizer-watch>
					<div class="especialidade-box-content">
						<div class="inner-box-content">
							<p><small><?php the_field('texto_inferior'); ?></small></p>
						</div><!-- inner-box-content -->
					</div><!-- especialidade-box-content -->
				</div><!-- columns -->
			</div><!-- row -->
		</div>
	</div>
<?php get_footer(); ?>