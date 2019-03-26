<?php get_header(); ?>
<div class="row">
	<div class="columns small-12 medium-8 large-9">
		<?php
		 /* Run the loop to output the posts.
		 * If you want to overload this in a child theme then include a file
		 * called loop-index.php and that will be used instead.
		 */
		 get_template_part( 'loop' );
		 ?>
	</div><!-- columns content-->
	<?php get_sidebar( 'blog' ); ?>
</div><!-- row -->
<?php get_footer(); ?>

