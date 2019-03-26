<?php get_header(); ?>

<?php
    if(isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
        if($type == 'products') {?>
        
	<div class="row">
		<?php get_sidebar(); ?>
		<div class="columns small-12 medium-8 large-9">
			<?php if (is_front_page()): ?>
			<div class="banner hide-for-medium">
				<img src="<?php bloginfo('template_url'); ?>/img/banner-home-quadrado.png" alt="">
			</div><!-- banner -->
			<div class="banner show-for-medium">
				<img src="<?php bloginfo('template_url'); ?>/img/banner-870x233.png" alt="">
			</div><!-- banner -->
			<?php endif; ?>
			<?php woocommerce_content(); ?>
		</div><!-- columns content-->
	</div><!-- row -->

	<?php } elseif ($type == 'post') {?>
             
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

        <?php }
    }
    ?>

<?php get_footer(); ?>


