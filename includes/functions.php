<?php 
// require_once 'functions/security.php';

if ( ! function_exists( 'bfc_setup' ) ) :
	function bfc_setup() {

/*-------------------------------------------------------------------------*/
/* TITLE TAG AND FEED LINKS
/*-------------------------------------------------------------------------*/
add_theme_support( 'title-tag' );
	// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

/*-------------------------------------------------------------------------*/
/* Enqueue CSS
/*-------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'bfc_enqueue_css', 99);
function bfc_enqueue_css() {
	wp_register_style( 'foundation', get_stylesheet_directory_uri() . '/css/__foundation.css' );
	wp_enqueue_style('foundation');
	wp_register_style( 'slick', get_stylesheet_directory_uri() . '/css/slick.css' );
	wp_enqueue_style('slick');
	wp_register_style( 'custom', get_stylesheet_directory_uri() . '/css/app.css' );
	wp_enqueue_style('custom');
	wp_enqueue_style('stylesheet', get_stylesheet_directory_uri() . '/style.css');
}

/*-------------------------------------------------------------------------*/
/*	Javascsript
/*-------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts','bfc_add_scripts');
function bfc_add_scripts() {
	// wp_register_script('principal', 'http://code.jquery.com/jquery-1.11.0.min.js', array(), 'null', true);
	wp_register_script('principal', get_template_directory_uri() . '/js/vendor/jquery.js', array(), 'null', true);
	wp_enqueue_script('principal');
	wp_register_script('foundation', get_template_directory_uri() . '/js/vendor/foundation.js', array(), 'null', true);
	wp_enqueue_script('foundation');
	wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), 'null', true);
	wp_enqueue_script('modernizr');
	wp_register_script('app', get_template_directory_uri() . '/js/app.js', array(), 'null', true);
	wp_enqueue_script('app');
	wp_register_script('slick', get_template_directory_uri() . '/js/slick.js', array(), 'null', true);
	wp_enqueue_script('slick');
}

/*-------------------------------------------------------------------------*/
/*  Post Thumbnail Support
/*-------------------------------------------------------------------------*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 600, 600, true );
	add_image_size( 'banner-large', 870, 233, false);// Hard crop left top
	add_image_size( 'banner-vertical', 270, 458, false); // Hard crop left top
	add_image_size( 'banner-small', 600, 600, false); // Hard crop left top

/*-------------------------------------------------------------------------*/
/*  Custom Menu Support
/*-------------------------------------------------------------------------*/
	
class F6_TOPBAR_MENU_WALKER extends Walker_Nav_Menu {   
		/*
		 * Add vertical menu class and submenu data attribute to sub menus
		 */

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"menu vertical sublevel-2\">\n";
		}
	}

	//Optional fallback
	function f6_topbar_menu_fallback($args) {
		/*
		 * Instantiate new Page Walker class instead of applying a filter to the
		 * "wp_page_menu" function in the event there are multiple active menus in theme.
		 */

		$walker_page = new Walker_Page();
		$fallback = $walker_page->walk(get_pages(), 0);
		$fallback = str_replace("<ul class='children'>", '<ul class="menu vertical sublevel-2">', $fallback);
		
		echo '<ul class="dropdown menu vertical medium-horizontal float-right" data-responsive-menu="accordion medium-dropdown">'.$fallback.'</ul>';
	}


	function _register_menu() {
		register_nav_menu( 'topbar-menu', __( 'Top Bar Menu','textdomain' ) );
		register_nav_menu( 'sidebar-menu', __( 'Sidebar Menu','textdomain' ) );
	}

	//Add Menu to theme setup hook
	add_action( 'after_setup_theme', '_theme_setup' );

	function _theme_setup(){
		add_action( 'init', '_register_menu' );

		//Theme Support
		add_theme_support( 'menus' );
	}

	// add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
				'header-menu' => 'Header Menu',
				)
			);
		// register_nav_menus(
		// 	array(
		// 		'sidebar-menu' => 'Sidebar Menu',
		// 		)
		// 	);
	}

	// ADD active class to current menu item
	add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
	function special_nav_class($classes, $item){
		if( in_array('current-menu-item', $classes) ){
			$classes[] = 'active ';
		}
		return $classes;
	}


	class F6_SIDEBAR_MENU_WALKER extends Walker_Nav_Menu {   
		/*
		 * Add vertical menu class and submenu data attribute to sub menus
		 */

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"menu vertical\">\n";
		}
	}

	//Optional fallback
	function f6_sidebar_menu_fallback($args) {
		/*
		 * Instantiate new Page Walker class instead of applying a filter to the
		 * "wp_page_menu" function in the event there are multiple active menus in theme.
		 */

		$walker_page = new Walker_Page();
		$fallback = $walker_page->walk(get_pages(), 0);
		$fallback = str_replace("<ul class='children'>", '<ul class="menu vertical">', $fallback);
		
		echo '<ul class="dropdown menu vertical sidebar-menu" id="sidebar-menu" data-responsive-menu="accordion"'.$fallback.'</ul>';
	}

	class Walker_Simple_Example extends Walker_Category {  

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"menu vertical\">\n";
		}
	}  
/*-------------------------------------------------------------------------*/
/*  REGISTER SIDEBAR
/*-------------------------------------------------------------------------*/
add_action( 'widgets_init', 'bfc_widgets_init' );
function bfc_widgets_init() {
	register_sidebar( array(
		'name'          => 'Blog',
		'id'            => 'right_sidebar',
		'before_widget' => '<aside class="widget-sidebar">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => 'Sidebar Loja',
		'id'            => 'shop_sidebar',
		'before_widget' => '<aside class="widget-sidebar">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => 'Footer Loja',
		'id'            => 'shop_footer',
		'before_widget' => '<div class="small-12 medium-6 large-3 columns" data-equalizer-watch>',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		) );
}

/*-------------------------------------------------------------------------*/
/*  HTML5 SUPORT
/*-------------------------------------------------------------------------*/
add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
	) );

/*-------------------------------------------------------------------------*/
/*  WOOCOMMERCE SUPPORT
/*-------------------------------------------------------------------------*/
add_theme_support( 'woocommerce' );

/*-------------------------------------------------------------------------*/
/*  POST FORMATS
/*-------------------------------------------------------------------------*/
add_theme_support( 'structured-post-formats', array(
	'link', 'video'
	) );
add_theme_support( 'post-formats', array(
	'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status'
	) );

} endif;/*bfc_setup*/
add_action( 'after_setup_theme', 'bfc_setup' );


/*-------------------------------------------------------------------------*/
/*  EDITOR MENU
/*-------------------------------------------------------------------------*/
// function remove_editor_menu() {
//   remove_action('admin_menu', '_add_themes_utility_last', 101);
// }

// add_action('_admin_menu', 'remove_editor_menu', 1);

/*-------------------------------------------------------------------------*/
/*  WP VERSION
/*-------------------------------------------------------------------------*/
add_filter('the_generator', 'bfc_remove_version');
function bfc_remove_version() {
	return '';
}

/*-------------------------------------------------------------------------*/
/*  WP ADMIN VERSION
/*-------------------------------------------------------------------------*/
add_filter( 'update_footer', 'change_footer_version', 9999 );
function change_footer_version() {
	return ' ';
}

/*-------------------------------------------------------------------------*/
/* FAVICON
/*-------------------------------------------------------------------------*/
	add_action( 'wp_head', 'add_my_favicon' ); //front end
	add_action( 'admin_head', 'add_my_favicon' ); //admin end
	function add_my_favicon() {
		$favicon_path = get_template_directory_uri() . '/images/favicon.ico';

		echo '<link rel="shortcut icon" href="' . $favicon_path . '" />';
	}

/*-------------------------------------------------------------------------*/
/*  CUSTOM ADMIN
/*-------------------------------------------------------------------------*/

function custom_url( $url ) {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_url' );

function cutom_admin_style() {
	echo "<style type=\"text/css\">
	body.login{
		background: #1A1A1A;
		webkit-background-size: cover;
		-moz-background-size: cover;
		background-size: cover;
	}
	body.login div#login h1 a {
		background-image: url(".get_bloginfo('template_directory')."/images/logo.png);
		-webkit-background-size: 100%;
		-moz-background-size: 100%;
		background-size: 100%;
		width: 150px;
		height:118px;
	}
	.login #backtoblog a, .login #nav a{
		color:#fff;
	}
	</style>";
}
add_action( 'login_enqueue_scripts', 'cutom_admin_style' );

//Custom dashboard logo
add_action('admin_head', 'my_custom_logo');
function my_custom_logo() {
	echo "<style type=\"text/css\">
#wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before {
	content: '';
	background-image: url(".get_bloginfo('template_directory')."/images/favicon.png);
	width:26px;
	height:26px;
	display:block;
	-webkit-background-size: 100%;
	-moz-background-size: 100%;
	background-size: 100%;
}
</style>";
}
remove_action('admin_head', 'my_custom_logo');
// Customizar o Footer do WordPress
function remove_footer_admin () {
	echo '© <a href="http://blackflag.com.br/">Black Flag Comunicação</a> - Todos os direitos reservados';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Saudação customizada
function replace_howdy( $wp_admin_bar ) {
	$my_account=$wp_admin_bar->get_node('my-account');
	$newtitle = str_replace( 'Olá', 'Bem vindo', $my_account->title );            
	$wp_admin_bar->add_node( array(
		'id' => 'my-account',
		'title' => $newtitle,
		) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

/** password strength **/
add_action( 'wp_print_scripts', 'bfd_remove_password_strength', 100 );

function bfd_remove_password_strength() {
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		wp_dequeue_script( 'wc-password-strength-meter' );
	}
}
/*-------------------------------------------------------------------------*/
/*  EXCLUDE CATEGORIES IN WIDGETS
/*-------------------------------------------------------------------------*/
add_filter("widget_categories_args","exclude_widget_categories");

function exclude_widget_categories($args){
//  $exclude = "24,25"; // The IDs of the excluding categories
	$args["exclude"] = $exclude;
	return $args;
}

/**
 * Recent_Posts widget w/ category exclude class
 * This allows specific Category IDs to be removed from the Sidebar Recent Posts list
 *
 */
class WP_Widget_Recent_Posts_Exclude extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts on your site") );
		parent::__construct('recent-posts', __('Recent Posts with Exclude'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		$r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__not_in' => explode(',', $exclude) ));
		if ($r->have_posts()) :
			?>
		<?php //echo print_r(explode(',', $exclude)); ?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
			<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
		<?php endwhile; ?>
	</ul>
	<?php echo $after_widget; ?>
	<?php
                // Reset the global $the_post as this query will have stomped on it
	wp_reset_postdata();

	endif;

	$cache[$args['widget_id']] = ob_get_flush();
	wp_cache_set('widget_recent_posts', $cache, 'widget');
}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['number'] = (int) $new_instance['number'];
	$instance['exclude'] = strip_tags( $new_instance['exclude'] );
	$this->flush_widget_cache();

	$alloptions = wp_cache_get( 'alloptions', 'options' );
	if ( isset($alloptions['widget_recent_entries']) )
		delete_option('widget_recent_entries');

	return $instance;
}

function flush_widget_cache() {
	wp_cache_delete('widget_recent_posts', 'widget');
}

function form( $instance ) {
	$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	$number = isset($instance['number']) ? absint($instance['number']) : 5;
	$exclude = esc_attr( $instance['exclude'] );
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

			<p>
				<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude Category(s):' ); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
				<br />
				<small><?php _e( 'Category IDs, separated by commas.' ); ?></small>
			</p>
			<?php
		}
	}

	add_action('widgets_init', 'WP_Widget_Recent_Posts_Exclude_init');

	function WP_Widget_Recent_Posts_Exclude_init() {
		unregister_widget('WP_Widget_Recent_Posts');
		register_widget('WP_Widget_Recent_Posts_Exclude');
	}

/*-------------------------------------------------------------------------*/
/*  EXCERPT
/*-------------------------------------------------------------------------*/
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}

/*-------------------------------------------------------------------------*/
/*  PAGINATION
/*-------------------------------------------------------------------------*/
function bfc_custom_post_navigation() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/** Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<ul class="pagination text-center" role="navigation" aria-label="Pagination">' . "\n";

	/** Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link('Anterior') );

	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="current"' : '';

		printf( '<li><a%s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li class="ellipsis"></li>';
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="current"' : '';
		printf( '<li><a%s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li class="ellipsis"></li>' . "\n";

		$class = $paged == $max ? ' class="current"' : '';
		printf( '<li><a%s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/** Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link('Próxima') );

	echo '</ul>' . "\n";

}

/*-------------------------------------------------------------------------*/
/*  POST TYPE SUPPORT
/*-------------------------------------------------------------------------*/
function is_post_type($type){
	global $wp_query;
	if($type == get_post_type($wp_query->post->ID)) return true;
	return false;
}

/*-------------------------------------------------------------------------*/
/*  SOCIAL SHARE
/*-------------------------------------------------------------------------*/
function social_share(){
	?>
	<style type="text/css">
		p.share-info{
			margin-bottom: 0;
		}
		.share-buttons .has-tip{
			border: none;
		}
		.share-buttons a{
			border: none;
			width: 33px;
			height: 33px;
		}
		.share-buttons a.button{
			padding: 0;
			margin-right: 3px;
		}
		.share-buttons a.button.facebook{
			background: rgb(59, 89, 152);
		}
		.share-buttons a.button.twitter{
			background: rgb(29, 161, 242);
		}
		.share-buttons a.button.linkedin{
			background: rgb(0, 119, 181);
		}
		.share-buttons a.button.google-plus{
			background: rgb(220, 78, 65);
		}
		.share-buttons a i{
			font-size: 1.4rem;
			line-height: 2.4rem;
		}
	</style>
	<p class="share-info"><small>Compartilhe:</small></p>
	<div class="button-group share-buttons">
		<span data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="1" title="Facebook">
			<a class="button facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'Compartilhar notícia', 'width=490,height=530');return false;"><i class="fa fa-facebook"></i></a>
		</span>
		<span data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="1" title="Twitter">
			<a class="button twitter" href="https://twitter.com/home?status=<?php the_permalink(); ?>" onclick="window.open(this.href, 'Compartilhar notícia', 'width=490,height=530');return false;"><i class="fa fa-twitter"></i></a>
		</span>
		<span data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="1" title="LinkedIn">
			<a class="button linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title( ); ?>&summary=&source=<?php bloginfo( 'url' ); ?>" onclick="window.open(this.href, 'Compartilhar notícia', 'width=490,height=530');return false;"><i class="fa fa-linkedin"></i></a>
		</span>
		<span data-tooltip aria-haspopup="true" class="has-tip top" data-disable-hover="false" tabindex="1" title="Google plus">
			<a class="button google-plus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'Compartilhar notícia', 'width=490,height=530');return false;"><i class="fa fa-google-plus"></i></a>
		</span>							
	</div>
	<?php
}

/*-------------------------------------------------------------------------*/
/*  ACF PRO OPTIONS
/*-------------------------------------------------------------------------*/

// HIDE ACF IF NOT ADMIN
add_filter('acf/settings/show_admin', 'my_acf_show_admin');

function my_acf_show_admin( $show ) {

	return current_user_can('manage_options');

}

// HIDE ACF FOR ALL USERS
// add_filter('acf/settings/show_admin', '__return_false');


// INCLUDE ACF
include_once( 'includes/acf-pro/acf.php' );

add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path( $path ) {

    // update path
	$path = get_stylesheet_directory() . "/includes/acf-pro/";
    // $path = get_bloginfo('stylesheet_directory') . '/includes/acf-pro/';

    // return
	return $path;

}

add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {

    // update path
	$dir = get_stylesheet_directory_uri() . '/includes/acf-pro/';


    // return
	return $dir;

}


// CREATE OPTIONS PAGE
if( function_exists('acf_add_options_page') ) {

 	// add parent
	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Opções Gerais do Tema',
		'menu_title' 	=> 'Opções do Tema',
		'redirect' 		=> true
		));
	
	
	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Banners',
		'menu_title' 	=> 'Banners',
		'parent_slug' 	=> $parent['menu_slug'],
		));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Redes Sociais',
		'menu_title' 	=> 'Redes Sociais',
		'parent_slug' 	=> $parent['menu_slug'],
		));
	
}

/*-------------------------------------------------------------------------*/
/*  WOOCOMMERCE
/*-------------------------------------------------------------------------*/
// Remove each style one by one
// add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
// function jk_dequeue_styles( $enqueue_styles ) {
// 	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
// 	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
// 	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
// 	return $enqueue_styles;
// }

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="Ver Carrinho">
        <i class="fa fa-shopping-cart"></i>
        <span class="cart-itens"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></span>
    </a>
    <?php

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}

/*custom excerpt*/
add_action( 'woocommerce_after_shop_loop_item_title', 'my_custom_excerpt', 15 );

function my_custom_excerpt(){
	echo '<p>' .excerpt(12) .'</p>';
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


// PRODUCT REDIRECT

add_filter( 'woocommerce_loop_add_to_cart_link', 'woo_archive_custom_cart_button_url' );    // 2.1 +

function woo_archive_custom_cart_button_url() {

	$product_url = '<a href="'.get_permalink().'" rel="nofollow" data-product_id="'.$product_id.'" data-product_sku="'.$product_sku.'" data-quantity="1" class="button alert float-left">Ver Produto</a>'.do_shortcode( "[yith_wcwl_add_to_wishlist]" );
	return $product_url;

}

/**
 * @snippet       Disable Variable Product Price Range
 * @how-to        Watch tutorial @ http://businessbloomer.com/?p=19055
 * @sourcecode    http://businessbloomer.com/disable-variable-product-price-range-woocommerce/
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 2.4.7
 */

add_filter( 'woocommerce_variable_sale_price_html', 'bbloomer_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'bbloomer_variation_price_format', 10, 2 );

function bbloomer_variation_price_format( $price, $product ) {

// Main Price
	$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
	$price = $prices[0] !== $prices[1] ? sprintf( __( '<span class="apartir">A partir de:</span> %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

// Sale Price
	$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
	sort( $prices );
	$saleprice = $prices[0] !== $prices[1] ? sprintf( __( '<span class="apartir">A partir de:</span> %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

	if ( $price !== $saleprice ) {
		$price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
	}
	return $price;
}

/** remove product tabs **/
remove_action( 'woocommerce_after_single_product_summary' ,'woocommerce_output_product_data_tabs',10);
// add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

// function woo_remove_product_tabs( $tabs ) {

//     unset( $tabs['description'] );      	// Remove the description tab
//     unset( $tabs['reviews'] ); 			// Remove the reviews tab
//     unset( $tabs['additional_information'] );  	// Remove the additional information tab

//     return $tabs;
//   }

  /** remove related products **/
  // remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*SHOP PAGE*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'custom_pagination', 10 );
function custom_pagination(){
	echo '<div class="row"><div class="small-12 columns">';
	bfc_custom_post_navigation();
	echo '</div></div>';
}

/*SINGLE PRODUCT PAGE*/
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


/*BREADCRUMB*/
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<nav aria-label="Você está em:" role="navigation" class="float-right" itemprop="breadcrumb"><ul class="breadcrumbs">',
            'wrap_after'  => '</ul></nav>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'mmx_remove_select_text');
function mmx_remove_select_text( $args ){
    $args['show_option_none'] = '';
    return $args;
}



// WooCommerce Product Variations Add-to-Cart Grid / Table
function woocommerce_variable_add_to_cart(){
	global $product, $post;

	$variations = find_valid_variations();

    // Check if the special 'price_grid' meta is set, if it is, load the default template:
	if ( get_post_meta($post->ID, 'price_grid', true) ) {
        // Enqueue variation scripts
		wp_enqueue_script( 'wc-add-to-cart-variation' );

        // Load the template
		wc_get_template( 'single-product/add-to-cart/variable.php', array(
			'available_variations'  => $product->get_available_variations(),
			'attributes'            => $product->get_variation_attributes(),
			'selected_attributes'   => $product->get_variation_default_attributes()
			) );
		return;
	}

  // Cool, lets do our own template!
?>
<ul class="variations variations-grid table-products no-bullet">
	<?php

	foreach ($variations as $key => $value) {
		if( !$value['variation_is_visible'] ) continue;
		?>
		<li class="product-row">
			<div class="product-title">
				<?php the_title( ); ?>
				<?php foreach($value['attributes'] as $key => $val ) {
					$val = str_replace(array('-','_'), ' ', $val);
					printf( '- <strong><span class="attr attr-%s">%s</span></strong>', $key, ucwords($val) );
				} ?>
			</div>
			<div class="product-price float-left">
				<?php echo $value['price_html'];?>
			</div>
			<div class="float-left">
				<?php if( $value['is_in_stock'] ) { ?>
				<form class="cart custom-cart" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" method="post" enctype='multipart/form-data'>
					<?php woocommerce_quantity_input(); ?>
					<?php
					if(!empty($value['attributes'])){
						foreach ($value['attributes'] as $attr_key => $attr_value) {
							?>
							<input type="hidden" name="<?php echo $attr_key?>" value="<?php echo $attr_value?>">
							<?php
						}
					}
					?>
					<button type="submit" class="single_add_to_cart_button button alt"><span class="glyphicon glyphicon-tag"></span>Comprar</button>
					<input type="hidden" name="variation_id" value="<?php echo $value['variation_id']?>" />
					<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $post->ID ); ?>" />
				</form>
				<?php } else { ?>
				<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
				<?php } ?>
			</div>
		</li>
		<?php } ?>
	</ul>
	<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
	<?php
}
// find_valid_variations loops through your product variations and fills in the ‘anys’

function find_valid_variations() {
global $product;

$variations = $product->get_available_variations();
$attributes = $product->get_attributes();
$new_variants = array();

// Loop through all variations
foreach( $variations as $variation ) {

    // Peruse the attributes.

    // 1. If both are explicitly set, this is a valid variation
    // 2. If one is not set, that means any, and we must 'create' the rest.

    $valid = true; // so far
    foreach( $attributes as $slug => $args ) {
    	if( array_key_exists("attribute_$slug", $variation['attributes']) && !empty($variation['attributes']["attribute_$slug"]) ) {
            // Exists

    	} else {
            // Not exists, create
            $valid = false; // it contains 'anys'
            // loop through all options for the 'ANY' attribute, and add each
            foreach( explode( '|', $attributes[$slug]['value']) as $attribute ) {
            	$attribute = trim( $attribute );
            	$new_variant = $variation;
            	$new_variant['attributes']["attribute_$slug"] = $attribute;
            	$new_variants[] = $new_variant;
            }

          }
        }

    // This contains ALL set attributes, and is itself a 'valid' variation.
        if( $valid )
        	$new_variants[] = $variation;

      }

      return $new_variants;
    }

  add_action( 'woocommerce_before_variations_form', 'wc_print_notices', 10 );

  /*cart page*/
  remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );


  function searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        if(isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
                if($type == 'book') {
                    $query->set('post_type',array('book'));
                }
        }       
    }
return $query;
}
add_filter('pre_get_posts','searchfilter');


function wpa_109409_is_purchasable( $purchasable, $product ){
    if( $product->get_price() == 0 )
        $purchasable = false;
    return $purchasable;
}
add_filter( 'woocommerce_is_purchasable', 'wpa_109409_is_purchasable', 10, 2 );

 /*
    * Swop the 'Free!' price notice and hide the cart with 'POA' in WooCommerce
 */
    add_filter( 'woocommerce_variable_free_price_html',  'hide_free_price_notice' );
    add_filter( 'woocommerce_free_price_html',           'hide_free_price_notice' );
    add_filter( 'woocommerce_variation_free_price_html', 'hide_free_price_notice' );

function hide_free_price_notice( $price ) {
    // remove_action ( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    return 'Preço sob consulta';
}