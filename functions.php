<?php

update_option('siteurl','http://eupreparo.local');
update_option('home','http://eupreparo.local');

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

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
	wp_register_style( 'foundation', get_stylesheet_directory_uri() . '/assets/css/__foundation.css' );
	wp_enqueue_style('foundation');
	wp_register_style( 'slick', get_stylesheet_directory_uri() . '/assets/css/slick.css' );
	wp_enqueue_style('slick');
	wp_register_style( 'font-awesome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style('font-awesome');
	wp_register_style( 'app', get_stylesheet_directory_uri() . '/assets/css/app.css' );
	wp_enqueue_style('app');
	wp_enqueue_style('stylesheet', get_stylesheet_directory_uri() . '/style.css');
}

/*-------------------------------------------------------------------------*/
/*	Javascsript
/*-------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts','bfc_add_scripts', 5);
function bfc_add_scripts() {
	// wp_register_script('principal', 'http://code.jquery.com/jquery-1.11.0.min.js', array(), 'null', true);
	wp_register_script('principal', get_template_directory_uri() . '/assets/js/vendor/jquery.js', array(), 'null', true);
	wp_enqueue_script('principal');
	wp_register_script('foundation', get_template_directory_uri() . '/assets/js/vendor/foundation.js', array(), 'null', true);
	wp_enqueue_script('foundation');
	wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array(), 'null', true);
	wp_enqueue_script('modernizr');
	 if ( 'galeria' == get_post_type() && is_singular( ) || is_page() ){
	 	wp_register_script('lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array(), 'null', true);
		wp_enqueue_script('lightbox');
	 }
	wp_register_script('slick', get_template_directory_uri() . '/assets/js/slick.js', array(), 'null', true);
	wp_enqueue_script('slick');

	// if (is_product()) {
	// 	# code...
	// 	wp_register_script('magnific', get_template_directory_uri() . '/assets/js/vendor/jquery.magnific-popup.js', array(), 'null', true);
	// 	wp_enqueue_script('magnific');
	// }
	wp_register_script('app', get_template_directory_uri() . '/assets/js/app.js', array(), 'null', true);
	wp_enqueue_script('app');
}

/*-------------------------------------------------------------------------*/
/*  Post Thumbnail Support
/*-------------------------------------------------------------------------*/
add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 600, 600, true );
	add_image_size( 'small', 370, 370, true);// Hard crop left top
	add_image_size( 'banner', 870, 233, false);// Hard crop left top
	add_image_size( 'banner-large', 870, 233, false);// Hard crop left top
	add_image_size( 'product-category', 390, 300, true);// Hard crop left top

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
		register_nav_menu( 'topbar-menu', __( 'Top Bar Menu','ricciardi_theme' ) );
		register_nav_menu( 'sidebar-menu', __( 'Sidebar Menu','ricciardi_theme' ) );
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
				'header-menu-sup' => 'Header Menu Sup',
				'footer-menu-institucional' => 'Footer Menu Institucional',
				'footer-menu-loja' => 'Footer Menu Loja',
				)
			);
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
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		) );

	register_sidebar( array(
		'name'          => 'Sidebar Loja',
		'id'            => 'shop_sidebar',
		'before_widget' => '<aside class="widget-sidebar">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
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
add_theme_support( 'custom-logo' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

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
/*NEW STICKY CLASS NAME*/
/*-------------------------------------------------------------------------*/
function change_sticky_class( $classes ) {
    if ( in_array( 'sticky', $classes, true ) ) {
        $classes = array_diff($classes, array('sticky'));
        $classes[] = 'wp-sticky';
    }
    return $classes;
}
add_filter( 'post_class', 'change_sticky_class' );

/*-------------------------------------------------------------------------*/
/*  SOCIAL SHARE
/*-------------------------------------------------------------------------*/
function social_share(){
	?>
	<style type="text/assets/css">
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

add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});


/*-------------------------------------------------------------------------*/
/*  ANALYTICS CODE
/*-------------------------------------------------------------------------*/
add_action('wp_footer', 'add_googleanalytics', 50);
function add_googleanalytics() { ?>
<!-- analytics async -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-112663645-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- analytics -->
<?php }

/*-------------------------------------------------------------------------*/
/*  Custom
/*-------------------------------------------------------------------------*/
require('inc/lojas_cpt.php');
require get_template_directory() . '/inc/theme_custom_admin.php';
require get_template_directory() . '/inc/theme_acf_func.php';
require get_template_directory() . '/inc/theme_woocommerce_func.php';
// require get_template_directory() . '/inc/customizer2.php';

