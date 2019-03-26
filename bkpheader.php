<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="wrapper user-info">
		<div class="row">
			<div class="small-12 columns">
				<?php if (is_user_logged_in()): $user = wp_get_current_user(); ?>
				<p class="float-left">Bem vindo, <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Minha Conta','woothemes'); ?>"><strong><?php echo $user->user_firstname; ?></strong></a>!</p>
				<?php endif ?>
				<p class="float-right">
					<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Minha Conta','woothemes'); ?>"><?php _e('Minha Conta','woothemes'); ?></a>
					•
					<a href="<?php echo wp_logout_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">Sair</a>
					<?php else : ?>
					<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="exibe-login">Login / Cadastro</a><!-- login -->
					<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
	<header class="header bg1">
		<div class="top-bar row">
			<div class="top-bar-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
					<?php 
						if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							};
						?>
					<!-- <img class="float-center text-center" src="<?php the_field('logo', 'option'); ?>" alt="<?php bloginfo( 'name' ); ?>"></a> -->
			</div>

			<div class="top-bar-left">
				<ul class="menu float-right menu-cart">
					<?php 
						if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : 
						$count = WC()->cart->cart_contents_count;
					?>
					<li>
						<span title="Ver Carrinho" class="btn-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
							<div class="cart-box">
							<?php                                               
								the_widget( 'WC_Widget_Cart', 'title=&hide_if_empty=0' );                                              
							?>
							</div><!--cart-box -->
						</span>
						<span class="item-holder-quantity">
							<span class="cart-itens"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></span>
						</span>
					</li>
					<?php endif; ?>
					<!-- <li class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></li> -->
					<li>
						<span data-responsive-toggle="top-menu" data-hide-for="medium" class="float-right icon-menu">
							<button class="menu-icon light" type="button" data-toggle></button>
						</span>
					</li>
				</ul><!-- menu -->
			</div><!-- top-bar-right -->

			<div class="top-bar-right" id="top-menu">
				<?php
					wp_nav_menu(array(
				    	'container' => false,
				    	'menu' => __( 'Top Bar Menu', 'bfd_shop' ),
				    	'menu_class' => 'dropdown menu vertical medium-horizontal float-right',
				    	// 'menu_class' => 'dropdown menu vertical medium-horizontal',
				    	'theme_location' => 'header-menu',
				    	'items_wrap'      => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
				    	'fallback_cb' => 'f6_topbar_menu_fallback',
				      'walker' => new F6_TOPBAR_MENU_WALKER(),
					));
				?>
			</div><!-- top-bar-right -->
		</div>
	</header><!-- header -->
	<div class="wrapper search-box-container">
		<div class="row">
			<div class="small-12 columns">
				<?php get_product_search_form(); ?>
			</div><!-- columns -->
		</div><!-- row -->
	</div><!-- searh-box-container -->
	<div class="wrapper breadcrumb">
		<div class="row">
			<div class="small-12 columns">
				<?php woocommerce_breadcrumb(); ?>
			</div><!-- columns -->
		</div><!-- row -->
	</div><!-- bradcrumb -->
	<main class="main">