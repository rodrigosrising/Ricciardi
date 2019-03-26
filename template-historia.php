<?php /*Template Name: Nossa História*/ ?>
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
<div class="row template-content">
	<div class="columns small-12">
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php the_content( ); ?>

			<!-- INICIO GALERIA -->
			<?php 
			$images = get_field('galeria');
			if( $images ): ?>
			<div class="row">
			<?php foreach( $images as $image ): ?>
				<div class="small-12 medium-6 large-4 columns foto">
					<a href="<?php echo $image['url']; ?>"  data-lightbox="post-<?php the_ID(); ?>" data-title="<?php echo $image['alt']; ?>">
						<img src="<?php echo $image['sizes']['small']; ?>" alt="<?php echo $image['alt']; ?>" />
					</a>
				</div><!-- columns medium-12 -->
			<?php endforeach; ?>
			</div><!-- row -->
			<?php endif; ?>
			<!-- FIM GALERIA -->

		<?php endwhile; ?>
		<?php endif; ?>
	</div><!-- columns content-->
</div><!-- row -->

<?php get_footer(); ?>