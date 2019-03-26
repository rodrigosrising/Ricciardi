<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>




	<body <?php body_class( ); ?>>
	<header class="header">
		<div class="top-header">
			<div class="row align-middle">
				<div class="columns">
					<p><i class="fa fa-truck" aria-hidden="true"></i> <em>Frete Grátis para compras acima de 24 unidades</em></p>
				</div><!-- columns -->
				<div class="columns shrink">
					<div class="button-group float-right menu-login">
						<span data-tooltip aria-haspopup="true" class="has-tip bottom" data-disable-hover="false" tabindex="2" title="Minha Conta">
							<a class="button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Minha Conta','woothemes'); ?>"><i class="fa fa-lock" aria-hidden="true"></i></a>
						</span>
						<span data-tooltip aria-haspopup="true" class="has-tip bottom" data-disable-hover="false" tabindex="2" title="Buscar Produtos">
							<a class="button button-search"><i class="fa fa-search" aria-hidden="true"></i></a>
						</span>
					</div><!-- button-group -->
					<nav class="float-right hide-for-small-only">
						<?php
						wp_nav_menu(array(
							'container' =>false,
							'menu' => __( 'Top Bar Menu', 'bfd_shop' ),
							'menu_class' => 'menu menu-sup',
							'theme_location' => 'header-menu-sup',
							));
						?>
					</nav>
				</div><!-- columns -->
			</div><!-- row -->

			<div class="search-box">
				<div class="row">
					<div class="small-12 columns">
						<?php
						 // get_product_search_form();
						echo do_shortcode( '[aws_search_form]' );
						 ?>
					</div><!-- columns -->
				</div><!-- row -->
			</div><!-- search-box -->
		</div><!-- top-header -->

		<div class="row">
			<div class="small-12 columns inner-header">
				<div class="row align-middle">
					<div class="shrink columns logo-home">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
							<?php
							if ( function_exists( 'the_custom_logo' ) ) {
									the_custom_logo();
								};
							?>
						</a>
					</div><!-- shrink logo -->
					<div class="columns">
						<div class="delivery-box">
						<small><strong>Receba em casa</strong></small>
							<ul class="menu delivery-menu align-right">
								<li>
									<a target="_blank" href="https://www.ubereats.com/pt-BR/curitiba/food-delivery/ricciardi-massas/YPtzzjkiQ1iXUnvH-wmGEA/"><img src="<?php echo get_theme_file_uri( '/assets/img/ubereats.jpg' ) ?>" alt=""></a>
								</li>
								<li>
									<a target="_blank" href="https://www.ifood.com.br/delivery/curitiba-pr/ricciardi-massas-bacacheri"><img src="<?php echo get_theme_file_uri( '/assets/img/ifood.jpg' ) ?>" alt=""></a>
								</li>
							</ul><!-- menu -->
						</div>


					</div><!-- columns menu -->
				</div><!-- inner-row -->
			</div><!-- columns -->
			<div class="small-12 columns inner-header">
				<div class="row align-middle">
					<div class="columns nav-menu-column">
						<div class="nav-menu-wrapper">
							<nav class="main-nav-menu hide-for-small-only">
								<?php
								wp_nav_menu(array(
									'container' =>false,
									'menu' => __( 'Top Bar Menu', 'bfd_shop' ),
									'menu_class' => 'menu menu-header',
									'theme_location' => 'header-menu',
									));
								?>
							</nav><!-- nav -->

							<ul class="menu float-right menu-cart  menu-cart-small">
								<?php
									if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
									$count = WC()->cart->cart_contents_count;
								?>
								<li>
									<span data-responsive-toggle="top-menu" data-hide-for="medium" class="float-right icon-menu">
										<button class="menu-icon dark" type="button" data-toggle></button>
									</span>
								</li>

								<li class="menu-cart-icon">
									<span title="Ver Carrinho" class="btn-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span class="item-holder-quantity">
											<div class="cart-itens"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></div>
										</span>
										<div class="cart-box">
											<?php
												the_widget( 'WC_Widget_Cart', 'title=&hide_if_empty=0' );
											?>
										</div><!--cart-box -->
									</span>
								</li>

								<?php endif; ?>
							</ul><!-- menu -->

						</div><!-- nav-menu-wrapper -->
					</div><!-- columns menu -->
				</div><!-- inner-row -->
			</div><!-- columns -->
		</div><!-- row -->
		<div class="row">
			<div class="small-12 columns">
				<nav class="hide-for-medium small-nav-menu" id="top-menu">
					<?php
					wp_nav_menu(array(
						'container' =>false,
						'menu' => __( 'Top Bar Menu', 'bfd_shop' ),
						'menu_class' => 'menu vertical menu-header',
						'theme_location' => 'header-menu',
						));
					?>
				</nav><!-- nav -->
			</div><!-- columns -->
		</div><!-- row -->
		<?php if (is_front_page() ): ?>
			<?php if( have_rows('banner', 'option') ): ?>
				<div class="slides slides-home">
				<?php while( have_rows('banner', 'option') ): the_row();
					// vars
					$image = get_sub_field('imagem');
					// $size = 'banner-large'; // (thumbnail, medium, large, full or custom size)
					$background =$image['url'];
					$link = get_sub_field('link_do_produto');
				?>
					<?php if( $link ): ?>
						<div class="the_slide" style="background-image: url('<?php echo $background; ?>');">
							<a href="<?php echo $link; ?>"><div class="link-placeholder"></div></a>
						</div><!-- background-->
					<?php else: ?>
						<div class="the_slide" style="background-image: url('<?php echo $background; ?>');"></div><!-- background-->
					<?php endif; ?>
				<?php endwhile; ?>
				</div><!-- home-slides -->
			<?php endif; ?><!-- banner if -->
		<?php endif; ?>
	</header><!-- header -->
	<main class="main">