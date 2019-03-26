<?php 
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
include_once( get_template_directory() .'/includes/acf-pro/acf.php' );

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

/*REDES SOCIAIS*/
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_583c2ad348d51',
	'title' => 'Redes Sociais',
	'fields' => array (
		array (
			'key' => 'field_583c2aefd1ac9',
			'label' => 'Facebook',
			'name' => 'facebook',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_583c2b00d1aca',
			'label' => 'Twitter',
			'name' => 'twitter',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_583c2b0dd1acb',
			'label' => 'Google Plus',
			'name' => 'google_plus',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_583c2b37d1acd',
			'label' => 'Instagram',
			'name' => 'instagram',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_583c2b27d1acc',
			'label' => 'Pinterest',
			'name' => 'pinterest',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_583c2b50d1ace',
			'label' => 'Youtube',
			'name' => 'youtube',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-redes-sociais',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
/*END REDES SOCIAIS*/