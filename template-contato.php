<?php /*Template Name: Fale Conosco*/ ?>
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
	<div class="small-12 medium-4 large-3 columns small-order-2 medium-order-1">
		<aside class="widget-sidebar">
			<div class="sidebar-widget">
				<h4>Contatos</h4>
				<p>A Ricciardi possui diversos canais de comunicação prontos para atender a sua necessidade, contate-nos!</p>
				<?php $query = new WP_Query( array( 'post_type' => 'lojas', 'p' => 182 ) ); ?>
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>  
					<address>
						<?php if( get_field('email') ): ?>
							<p><i class="fa fa-envelope" aria-hidden="true"></i><?php the_field('email'); ?></p>
						<?php endif; ?>
					</address>
				<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
			</div><!-- sidebar-widget -->
		</aside><!-- widget-sidebar -->
		<aside class="widget-sidebar">
			<div class="sidebar-widget">
				<h4>Lojas Físicas</h4>
				<p>Venha nos visitar em uma de nossas jojas , será um grande prazer atende-lo.</p>
				<?php $query = new WP_Query( array( 'post_type' => 'lojas' ) ); ?>
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>  
					<address>
						<p><strong><?php the_title( ); ?></strong></p>
						<?php if( get_field('telefone') ): ?>
							<p><i class="fa fa-phone" aria-hidden="true"></i><?php the_field('telefone'); ?></p>
						<?php endif; ?>
						<?php if( get_field('endereco_da_loja') ): ?>
							<p><i class="fa fa-map-marker" aria-hidden="true"></i><?php the_field('endereco_da_loja'); ?></p>
						<?php endif; ?>
						<?php if( get_field('email') ): ?>
							<p><i class="fa fa-envelope" aria-hidden="true"></i><?php the_field('email'); ?></p>
						<?php endif; ?>
					</address>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
				
			</div><!-- sidebar-widget -->
		</aside><!-- widget-sidebar -->
	</div><!-- columns -->
	<div class="small-12 medium-8 large-9 columns small-order-1 medium-order-2">
		<div class="content-container">
			<h4>Formulário de Contato</h4>
			<?php echo do_shortcode( '[contact-form-7 id="201" title="Contato"]' ); ?>
		</div><!-- content-container -->
		<div class="content-container hide">
			<h4>Faça Parte da Nossa Rede</h4>
			<div class="button-group social-buttons">
				<?php if( get_field('facebook', 'option') ): ?>
					<a href="<?php the_field('facebook', 'option'); ?>" class="button"><i class="fa fa-facebook"></i></a>
				<?php endif; ?>
				<?php if( get_field('twitter', 'option') ): ?>
					<a href="<?php the_field('twitter', 'option'); ?>" class="button"><i class="fa fa-twitter"></i></a>
				<?php endif; ?>
				<?php if( get_field('google_plus', 'option') ): ?>
					<a href="<?php the_field('google_plus', 'option'); ?>" class="button"><i class="fa fa-google-plus"></i></a>
				<?php endif; ?>
				<?php if( get_field('instagram', 'option') ): ?>
					<a href="<?php the_field('instagram', 'option'); ?>" class="button"><i class="fa fa-instagram"></i></a>
				<?php endif; ?>					
				<?php if( get_field('youtube', 'option') ): ?>
					<a href="<?php the_field('youtube', 'option'); ?>" class="button"><i class="fa fa-youtube-play"></i></a>
				<?php endif; ?>
			</div><!-- button-group social-buttons -->
		</div>
	</div><!-- columns -->
</div><!-- row -->

<?php get_footer(); ?>