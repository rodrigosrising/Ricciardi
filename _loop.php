<?php if (is_page( ) : ?>
	<div class="row">
		<?php get_sidebar(); ?>
		<div class="columns small-12 medium-8 large-9">
			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<h1><?php the_title( ); ?></h1>
			<?php the_content( ); ?>
			<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
		</div><!-- columns content-->
	</div><!-- row -->
<?php elseif(is_home( )): ?>
	<div class="row">
	<div class="columns small-12 medium-8 large-9">
		<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts(array(
			'paged' => $paged,
			'post_type' => 'post',
			'order'    => 'DESC',
			));
		?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post columns small-12'); ?>>
			<h3><a href="<?php the_permalink(); ?>" alt="<?php the_title( ); ?>"><?php the_title( ); ?></a></h3>
			<?php echo excerpt( 30 ); ?>
		</article><!-- #post-## -->
		<?php endwhile; ?>
		
		<?php else:?>
		<article>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p> 
		</article>
		<?php endif; wp_reset_query(); ?>
		<div class="pagination-area pjm-spacer">
			<?php bfc_custom_post_navigation(); ?>
		</div><!-- Pagination -->
	</div><!-- columns content-->
	<?php get_sidebar( 'blog' ); ?>
</div><!-- row -->
<?php endif; ?>