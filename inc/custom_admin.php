<?php
/*-------------------------------------------------------------------------*/
/*  Custom Wordpress Login
/*-------------------------------------------------------------------------*/

function custom_url( $url ) {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_url' );

function cutom_admin_style() {
	echo "<style type=\"text/css\">
	body.login{
		background: #131313;
	}
	body.login div#login h1 a {
		background: url(".get_bloginfo('template_directory')."/img/blackflag_branco.png) no-repeat 0 0;
		-webkit-background-size: 100%;
		-moz-background-size: 100%;
		background-size: 100%;
		width: auto;
		height:240px;
	}
	.login #backtoblog a, .login #nav a{
		color:#fff!important;
	}
	</style>";
}
add_action( 'login_enqueue_scripts', 'cutom_admin_style' );

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

// Customizar o Footer do WordPress
function remove_footer_admin () {
	echo '© <a href="http://blackflag.com.br/">Black Flag Publicidade</a> - Todos os direitos reservados';
}
add_filter('admin_footer_text', 'remove_footer_admin');

/*-------------------------------------------------------------------------*/
/*  WP VERSION
/*-------------------------------------------------------------------------*/

function bfc_remove_version(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','bfc_remove_version');
add_filter('pre_site_transient_update_plugins','bfc_remove_version');
add_filter('pre_site_transient_update_themes','bfc_remove_version');
/*-------------------------------------------------------------------------*/
/*  WP ADMIN VERSION
/*-------------------------------------------------------------------------*/
function change_footer_version() {
	return ' ';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );
