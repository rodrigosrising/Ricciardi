<?php 
function bfp_customize_register( $wp_customize ){
	
	$wp_customize->remove_control( 'blogname' );
	$wp_customize->remove_control( 'blogdescription' );
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->remove_section( 'custom_css' );
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	/*background color*/
	$wp_customize->add_setting('background_color', array(
		'default' => '#fefefe' , 
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'background_color', array(
		'label' => __('Mudar a cor do fundo', 'bfp_theme'),
		'section' => 'colors' , 
		'settings' => 'background_color' ,
	) ) );

	/*background color*/
	$wp_customize->add_setting('header_textcolor', array(
		'default' => '#fefefe' , 
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'header_textcolor', array(
		'label' => __('Mudar a cor do cabeçalho', 'bfp_theme'),
		'section' => 'colors' , 
		'settings' => 'header_textcolor' ,
	) ) );

	/*link color*/
	$wp_customize->add_setting('link_color', array(
		'default' => '#131313' , 
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'link_color', array(
		'label' => __('Mudar a cor do link', 'bfp_theme'),
		'section' => 'colors' , 
		'settings' => 'link_color' 
	) ) );

	/*text color*/
	$wp_customize->add_setting('text_color', array(
		'default' => '#6b6b6b' , 
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'text_color', array(
		'label' => __('Mudar a cor do text', 'bfp_theme'),
		'section' => 'colors' , 
		'settings' => 'text_color' 
	) ) );

	/*tag background color*/
	$wp_customize->add_setting('tag_background_color', array(
		'default' => '#EFEFEF' , 
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'tag_background_color', array(
		'label' => __('Mudar a cor do fundo da tag', 'bfp_theme'),
		'section' => 'colors' , 
		'settings' => 'tag_background_color' ,
	) ) );

	/*tag link color*/
	$wp_customize->add_setting('tag_link_color', array(
		'default' => '#131313' , 
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'tag_link_color', array(
		'label' => __('Mudar a cor do link da tag', 'bfp_theme'),
		'section' => 'colors' , 
		'settings' => 'tag_link_color' 
	) ) );

	/*button background color*/
	$wp_customize->add_setting('button_background_color', array(
		'default' => '#343434' , 
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'button_background_color', array(
		'label' => __('Mudar a cor do fundo do button', 'bfp_theme'),
		'section' => 'colors' , 
		'settings' => 'button_background_color' ,
	) ) );

	/*button link color*/
	$wp_customize->add_setting('button_link_color', array(
		'default' => '#FFF' , 
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'button_link_color', array(
		'label' => __('Mudar a cor do link do button', 'bfp_theme'),
		'section' => 'colors' , 
		'settings' => 'button_link_color' 
	) ) );
}
function bfp_css_customize(){
	?>
	<style type="text/css">
		body, .blog-wrapper{
			background-color: #<?php echo get_theme_mod( 'background_color' ); ?>; 
		}
		.inner-header{
			background-color: #<?php echo get_theme_mod( 'header_textcolor' ); ?>; 
		}
		.column-post .post-title a, .blog-container a, .inner-column-post a, .widget-sidebar a{
			color: <?php echo get_theme_mod( 'link_color' ); ?>;
		}
		.ver-blog, .ver-blog:hover, .ver-blog:focus{
			background: <?php echo get_theme_mod( 'link_color' ); ?>;
		}
		.column-post p, .inner-column-post p {
			color: <?php echo get_theme_mod( 'text_color' ); ?>;
		}
		.tagcloud a, .post-tags a {
			background-color: <?php echo get_theme_mod( 'tag_background_color' ); ?>;
			color: <?php echo get_theme_mod( 'tag_link_color' ); ?>;
		}
		.social-buttons a, .social-buttons a i, .button {
			background-color: <?php echo get_theme_mod( 'button_background_color' ); ?>;
			color: <?php echo get_theme_mod( 'button_link_color' ); ?>;
		}
	</style>
	<?php 
}
add_action( 'wp_head', 'bfp_css_customize' );
add_action( 'customize_register', 'bfp_customize_register' );




/**
 * Used by hook: 'customize_preview_init'
 * 
 * @see add_action('customize_preview_init',$func)
 */
function bfp_customizer_live_preview()
{
	wp_enqueue_script( 
		  'mytheme-themecustomizer',			//Give the script an ID
		  get_template_directory_uri().'/assets/js/theme-customizer.js',//Point to file
		  array( 'jquery','customize-preview' ),	//Define dependencies
		  '',						//Define a version (optional) 
		  true						//Put script in footer?
	);
}
add_action( 'customize_preview_init', 'bfp_customizer_live_preview' );
