<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <section class="blog-post clearfix post-image-thumb">
            <div class="blog-post-content clearfix">
                <?php if ( has_post_thumbnail() ) :  ?>
	            	<div class="post-image">
	            		<a href="<?php the_permalink(); ?>" title="<?php the_title( ); ?>"><?php the_post_thumbnail('blog-image'); ?></a>
	            	</div><!-- post-thumbnail -->
	            <?php else: ?>
		            <div class="post-image">
		            	<img src="http://placehold.it/870x300">
		            </div><!-- post-thumbnail -->
	          <?php endif; ?>
                <div class="post-entry clearfix">
                    <header class="entry-header">
                        <h1><a href="<?php the_permalink(); ?>" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></h1>
                        <div class="entry-meta">
                            <?php $user_post_count = count_user_posts( get_the_author_meta('ID') ); ?>
                            <span class="posted-on"><?php the_time('d/m/Y');?> | <?php the_author_posts_link(); ?> <?php echo "Posts Publicados: {$user_post_count}"; ?> | <?php the_category(' e ');?></span><!-- entry-meta -->
                            <span class="comments-link"><?php comments_number( ); ?></span><!-- comment-links -->
                        </div><!-- entry-meta -->
                    </header><!-- entry-header -->
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div><!-- entry-content -->    
                </div><!-- post-entry -->   
            </div><!-- blog-post-content -->                        
            <?php if (has_tag( )): ?>
            <div class="entry-footer clearfix">
			<div class="post-tags">
				<p><?php the_tags( 'Marcados em: ', '   ', '<br />' ); ?></p>
			</div><!-- post-tags -->
            </div><!-- entry-footer -->
            <?php endif; ?>
        </section><!-- blog-post -->
<?php endwhile; ?>

    <!-- pagination here -->
        <div class="pagination-area">
            <?php bfc_custom_post_navigation(); ?>
        </div>                  
    <!-- pagination here -->
    <?php else:  ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; wp_reset_query(); ?>