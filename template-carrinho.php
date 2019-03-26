<?php /*Template Name: carrinho*/ ?>
<?php get_header(); ?>
<div class="title-wrapper">
	<div class="row align-middle">
		<div class="small-12 medium-6 columns">
			<h1><?php the_title( ); ?></h1>
		</div><!-- columns -->
		<div class="small-12 medium-6 columns">
			<?php woocommerce_breadcrumb(); ?>
		</div><!-- columns -->
	</div><!-- row -->
</div><!-- title-weapper -->
<?php if (is_cart() ): ?>
	<div class="row template-content">
		<div class="columns small-12">
			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php the_content( ); ?>
			<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
		</div><!-- columns content-->
	</div><!-- row -->
<?php else: ?>
	<div class="row">
		<?php get_sidebar(); ?>
		<div class="columns small-12 medium-8 large-9">
			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<h1 class="page-title"><?php the_title( ); ?></h1>
			<?php the_content( ); ?>
			<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
		</div><!-- columns content-->
	</div><!-- row -->
<?php endif; ?>


<?php get_footer(); ?>