<div class="columns small-12 medium-4 large-3 sidebar">
		<div class="sidebar-menu">
			<h3 class="hide-for-small-only">Produtos</h3>
			<div class="title-bar" data-responsive-toggle="menu-sidebar-menu" data-hide-for="medium">
				<button class="menu-icon" type="button" data-toggle class="icon-menu"></button>
				<div class="title-bar-title" data-toggle>Menu de Produtos</div>
			</div>
			<?php 
				$taxonomy     = 'product_cat';
				$orderby      = 'name'; 
				$show_count   = false;
				$pad_counts   = false;
				$hierarchical = true;
				$title        = '';

				$args = array(
					'taxonomy'     => $taxonomy,
					'orderby'      => $orderby,
					'show_count'   => $show_count,
					'pad_counts'   => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li'     => $title,
					'walker'=> new Walker_Simple_Example
				);
			?>

			<ul class="dropdown menu vertical sidebar-menu" id="menu-sidebar-menu" data-responsive-menu="accordion">
				<?php wp_list_categories( $args ); ?>
			</ul>
		</div><!-- sidebar-menu -->
		<?php
			$image1 = get_field('imagem', 'option');
			$size3 = 'banner-vertical'; // (thumbnail, medium, large, full or custom size)
			$link = get_field('link_produto');
		?>				
		<div class="hide-for-small-only bottom1">
			<?php if( $link ): ?>	
			<a href="<?php echo $link; ?>"><?php echo wp_get_attachment_image( $image1, $size3 ); ?></a>
			<?php else: ?>
				<?php echo wp_get_attachment_image( $image1, $size3 ); ?>
			<?php endif; ?>
		</div>	
		<?php if ( is_active_sidebar( 'shop_sidebar' )  ) : ?>
			<aside id="secondary" class="sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'shop_sidebar' ); ?>
			</aside><!-- .sidebar .widget-area -->
		<?php endif; ?>
	</div><!-- columns sidebar-->

