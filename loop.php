<?php if ( is_home() ) : ?>
	<?php
     /* Run the loop to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-index.php and that will be used instead.
     */
     get_template_part( 'loop', 'posts' );
     ?>
   <?php elseif ( is_category() ): ?>
   <?php
     /* Run the loop to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-index.php and that will be used instead.
     */
     get_template_part( 'loop', 'category' );
     ?>
   <?php elseif ( is_date() ): ?>
   <?php
     /* Run the loop to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-index.php and that will be used instead.
     */
     get_template_part( 'loop', 'category' );
     ?>
   <?php elseif ( is_tag() ): ?>
   <?php
     /* Run the loop to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-index.php and that will be used instead.
     */
     get_template_part( 'loop', 'category' );
     ?>
   <?php elseif ( is_search() ): ?>
   <?php
     /* Run the loop to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-index.php and that will be used instead.
     */
     get_template_part( 'loop', 'search' );
     ?>
   <?php elseif ( is_404() ): ?>
   <?php
     /* Run the loop to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-index.php and that will be used instead.
     */
     get_template_part( 'loop', '404' );
     ?>
   <?php else: ?>
<div class="row">
	<?php get_sidebar(); ?>
	<div class="columns small-12 medium-8 large-9">
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<h1 class="page-title"><?php the_title( ); ?></h1>
		<?php the_content( ); ?>
		<?php endwhile; ?>
		<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; wp_reset_query(); ?>
	</div><!-- columns content-->
</div><!-- row -->
<?php endif; ?>
