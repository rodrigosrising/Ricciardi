<?php 
/*-------------------------------------------------------------------------*/
/*  CUSTOM ADMIN
/*-------------------------------------------------------------------------*/

function custom_url( $url ) {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_url' );

function cutom_admin_style() {
	echo "<style type=\"text/assets/css\">
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
	echo "<style type=\"text/assets/css\">
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