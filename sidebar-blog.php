<div class="columns small-12 medium-4 large-3 sidebar">
<?php if ( is_active_sidebar( 'right_sidebar' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'right_sidebar' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
</div><!-- sidebar -->
