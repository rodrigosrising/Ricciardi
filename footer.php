	</main><!-- main -->
	<footer class="footer">
		<div class="row inner-footer">
			<div class="columns small-12 medium-6 large-2">
				<h5 class="uppercase">Institucional</h5>
				<nav>
					<?php
						wp_nav_menu(array(
							'container' =>false,
							'menu' => __( 'Footer Menu', 'bfd_shop' ),
							'menu_class' => 'menu vertical footer-menu',
							'theme_location' => 'footer-menu-institucional',
							));
						?>
				</nav><!-- nav -->
			</div><!-- columns -->
			<div class="columns small-12 medium-6 large-2">
				<h5 class="uppercase">Loja</h5>
				<nav>
					<?php
						wp_nav_menu(array(
							'container' =>false,
							'menu' => __( 'Footer Menu', 'bfd_shop' ),
							'menu_class' => 'menu vertical footer-menu',
							'theme_location' => 'footer-menu-loja',
							));
						?>
				</nav><!-- nav -->
			</div><!-- columns -->
			<div class="columns small-12 medium-6 large-2">
				<h5 class="uppercase">Pagamento</h5>
				<img src="<?php bloginfo('template_directory'); ?>/assets/img/ico-cartoes.png" height="49" width="120" alt="">
			</div><!-- columns -->
			<div class="columns small-12 medium-6 large-3">
				<h5 class="uppercase">Atendimento</h5>
				<p><small>Segunda a Sexta, das 9h às 18h</small></p>
				<p><small>contato@eupreparo.com</small></p>
			</div><!-- columns -->
			<div class="columns small-12 medium-12 large-3">
				<h5 class="uppercase">Ofertas e Descontos</h5>
				<p><small>Inscreva-se para receber ofertas e descontos exclusivos</small></p>
				<?php echo do_shortcode( '[contact-form-7 id="294" title="Newsletter"]' ); ?>
			</div><!-- columns -->
			<div class="small-12 columns">
				<h5 class="uppercase">Redes Sociais</h5>
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
		</div><!-- row -->
		<hr>
		<div class="row">
			<div class="columns copy">
				<p><small>©2017 Ricciardi Massas. Todos os direitos reservados. <a href="http://blackflag.com.br">Black Flag Publicidade</a></small></p>
			</div><!-- columns -->
		</div><!-- row -->
	</footer><!-- footer -->

<?php wp_footer(); ?>
</body>
</html>