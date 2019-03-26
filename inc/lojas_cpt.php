<?php

function register_cpt_lojas() {
  $labels = array(
    				'name' => __( 'Lojas', 'ricciardi_theme' ),
				'singular_name' => __( 'Lojas', 'ricciardi_theme' ),
				'add_new' => _x( 'Adicionar nova', 'ricciardi_theme' ),
				'all_items' => _x( 'Todas as lojas', 'ricciardi_theme' ),
				'add_new_item' => _x( 'Adicionar novo lojas', 'ricciardi_theme' ),
				'edit_item' => _x( 'Editar lojas', 'ricciardi_theme' ),
				'new_item' => _x( 'Nova lojas', 'ricciardi_theme' ),
				'view_item' => _x( 'Ver lojas', 'ricciardi_theme' ),
				'search_items' => _x( 'Procurar lojas', 'ricciardi_theme' ),
				'not_found' => _x( 'Nenhuma lojas encontrada', 'ricciardi_theme' ),
				'not_found_in_trash' => _x( 'Nenhuma lojas encontrada na lixeira', 'ricciardi_theme' ),
				'parent_item_colon' => null,
				'menu_name' => _x( 'Lojas', 'ricciardi_theme' ),
  );
  $args = array(
				'labels'        => $labels,
				'public'        => true,
				'menu_position' => 5,
				'menu_icon'           => 'dashicons-admin-multisite',
				'supports'      => array( 'title', 'thumbnail', 'editor' ),
				'has_archive'   => true,
				'capability_type' => 'post',
				'rewrite' => array('slug' => 'lojas') // <--- definimos o slug aqui...
  );
  register_post_type( 'lojas', $args ); 
}
add_action( 'init', 'register_cpt_lojas' );