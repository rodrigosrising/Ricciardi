<?php get_header(); ?>
<div class="title-wrapper">
	<div class="row align-middle">
		<div class="small-12 medium-6 columns">
			<h1 class="uppercase">Nossas Lojas</h1>
		</div><!-- columns -->
		<div class="small-12 medium-6 columns">
			<?php woocommerce_breadcrumb(); ?>
		</div><!-- columns -->
	</div><!-- row -->
</div><!-- title-weapper -->
<div class="row small-up-1 medium-up-2 large-up-3 container-lojas">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<div class="columns ">
		<div class="card">
			<?php if (has_post_thumbnail( )): ?>
				<?php the_post_thumbnail( ); ?>
			<?php endif; ?>
			<div class="card-section">
				<h4><?php the_title( ); ?></h4>
				<address>
					<?php if( get_field('email') ): ?>
						<p><i class="fa fa-envelope" aria-hidden="true"></i><?php the_field('email'); ?></p>
					<?php endif; ?>
					<?php if( get_field('telefone') ): ?>
						<p><i class="fa fa-phone" aria-hidden="true"></i><?php the_field('telefone'); ?></p>
					<?php endif; ?>
					<?php if( get_field('telefone_2') ): ?>
						<p><i class="fa fa-phone" aria-hidden="true"></i><?php the_field('telefone_2'); ?></p>
					<?php endif; ?>
					<?php if( get_field('telefone_3') ): ?>
						<p><i class="fa fa-mobile" aria-hidden="true"></i><?php the_field('telefone_3'); ?></p>
					<?php endif; ?>
					<?php if( get_field('endereco_da_loja') ): ?>
						<p><i class="fa fa-map-marker" aria-hidden="true"></i><?php the_field('endereco_da_loja'); ?></p>
					<?php endif; ?>
				</address>
			</div><!-- card-section -->
		</div><!-- card -->
	</div><!-- columns content-->
	<?php endwhile; ?>
	<?php endif; ?>
</div><!-- row -->
<?php get_footer(); ?>

