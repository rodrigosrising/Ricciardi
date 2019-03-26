<?php 
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


/*custom excerpt*/
add_action( 'woocommerce_after_shop_loop_item_title', 'my_custom_excerpt', 15 );

function my_custom_excerpt(){
	echo '<p>' .excerpt(15) .'</p>';
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


// PRODUCT REDIRECT

add_filter( 'woocommerce_loop_add_to_cart_link', 'woo_archive_custom_cart_button_url' );    // 2.1 +

function woo_archive_custom_cart_button_url() {

	$product_url = '<a href="'.get_permalink().'" rel="nofollow" data-product_id="'.$product_id.'" data-product_sku="'.$product_sku.'" data-quantity="1" class="button alert float-left"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar</a>';
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

/*SHOP PAGE*/
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title2', 10 );
function woocommerce_template_loop_product_title2(){
	echo '<h3 class="uppercase">';
	the_title( );
	echo '</h3>';
}

remove_action( 'woocommerce_shop_loop_item_title', 'wc_tag_title_archive_products', 15 );
function wc_tag_title_archive_products(){
	$terms = get_the_terms( $post->ID , 'product_tag' );
	foreach ( $terms as $term ) {
		echo '<h6><small>'.$term->name.'</small></h6>';
	}
}

// function get_some_tags_man(){
//     $terms = get_terms( array( 
//         'hide_empty' => true, // only if you want to hide false
//         'taxonomy' => 'product_tag',
//      ) 
//     );
//     $html = '';
//     if($terms){
//         $html .= '<h6>';
//         foreach($terms as $term){
//             $html .= "<small>$term->name</small>";
//         }
//         $html .= '</h6>';
//     }
//     return $html;
// }
// function print_tag_title(){
// 	echo get_some_tags_man();
// }
// add_action( 'woocommerce_shop_loop_item_title', 'print_tag_title', 15 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop', 'custom_pagination', 10 );
function custom_pagination(){
	echo '<div class="row"><div class="small-12 columns">';
	bfc_custom_post_navigation();
	echo '</div></div>';
}

foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

/*SINGLE PRODUCT PAGE*/
// add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 3, 0 );
// remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_product_loop_tags', 60 );

function woocommerce_product_loop_tags() {
    global $post, $product;

    $tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
    echo $product->get_tags( ', ', '<h5 class="uppercase">' . _n( 'Conheça outros produtos com ', '', $tag_count, 'woocommerce' ) . ' ', '</h5>' );
}

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'the_content', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/** remove product tabs **/
remove_action( 'woocommerce_after_single_product_summary' ,'woocommerce_output_product_data_tabs',10);

// add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

// function woo_remove_product_tabs( $tabs ) {

//     // unset( $tabs['description'] );      	// Remove the description tab
//     unset( $tabs['reviews'] ); 			// Remove the reviews tab
//     unset( $tabs['additional_information'] );  	// Remove the additional information tab

//     return $tabs;
//   }

  /** remove related products **/
  // remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


/*BREADCRUMB*/
add_filter( 'woocommerce_breadcrumb_defaults', 'bfp_breadcrumb' );
function bfp_breadcrumb() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<nav aria-label="Você está em:" role="navigation" class="float-right" itemprop="breadcrumb"><ul class="breadcrumbs">',
            'wrap_after'  => '</ul></nav>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

// add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'mmx_remove_select_text');
// function mmx_remove_select_text( $args ){
//     $args['show_option_none'] = '';
//     return $args;
// }




  /*cart page*/
  remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );


  function searchfilter($query) {
    if ($query->is_search &&is_woocommerce() && !is_admin() ) {
        if(isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
                if($type == 'products') {
                    $query->set('post_type',array('products'));
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

/*MY ACCOUNT*/

remove_action( 'woocommerce_before_my_account', 'saldo_usuario', 1 );
function saldo_usuario(){
	echo do_shortcode( '[uw_balance display_username="true" separator=" - Crédito na loja:" username_type="display_name"]' );
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<div class="cart-itens"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></div>
	<?php

	$fragments['div.cart-itens'] = ob_get_clean();

	return $fragments;
}

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 2; // arranged in 2 columns
	return $args;
}

add_action( 'woocommerce_after_single_product_summary', 'caracteristicas_produto', 5 );
function caracteristicas_produto( ){
?>
<?php if (get_field( 'exibir_caracteristicas_do_produto' )): ?>
<div class="row">
	<div class="columns small-12">
		<h3 class="titulo-caracteristica">Características do Produto</h3>
	</div><!-- columns -->
</div><!-- row -->
<div class="row">
	<div class="columns small-12 medium-5 large-6">
		<div class="preparo-container">
			<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/ingredientes.jpg" alt="">
		</div><!-- preparo-container -->
	</div><!-- columns -->
	<div class="columns small-12 medium-7 large-6">
		<div class="preparo-container">
			<?php if (get_field( 'ingredientes' )): ?>
				<h4 class="uppercase">Ingredientes</h4>
				<p><?php the_field('ingredientes'); ?></p>
			<?php endif; ?>
			<h4 class="uppercase">Informações Nutricionais</h4>
			<p><small>Porção <?php the_field('tamanho_da_porcao'); ?> ( 1 unidade )</small></p>
			<!-- TABLE -->
			<?php the_field('informação_nutricional'); ?>
			<!-- TABLE -->
			<p><small>*% Valores Diários com base em uma dieta de 2.000 Kcal ou 8.400 KJ. Seus valores diários podem ser maiores ou menores dependendo de suas necessidades energéticas. <br>** VD não estabelecido</small></p>
		</div><!-- preparo-container -->
	</div><!-- columns -->
</div><!-- row -->
<?php endif; ?>
<?php
}/*caracteristicas_produto*/
add_action( 'woocommerce_after_single_product_summary', 'modo_preparo', 10 );
function modo_preparo( ){
?>
<?php if (get_field( 'exibir_caracteristicas_do_produto' )): ?>
	<?php if( get_field('modo_de_preparo') == 'nenhum' ): ?>
	<?php elseif( get_field('modo_de_preparo') == 'panela' ): ?>
		<div class="row">
			<div class="columns small-12">
				<h3 class="titulo-caracteristica">Modo de Preparo</h3>
			</div><!-- columns -->
		</div><!-- row -->
		<div class="row">
			<div class="columns small-12 medium-12">
				<div class="preparo-container">
					<div class="ico-title clearfix">
						<h5 class="preparo-title">Na panela</h5>
						<ul class="ico-title-ico text-center">
							<li class="ico ico-panela">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_panela.png" height="16" width="26" alt="">
								<span>Na panela</span>
							</li>
							<li class="ico ico-tempo">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_tempo.png" height="16" width="26" alt="">
								<span>Aprox. 9 min</span>
							</li>
						</ul><!-- ico-title-ico -->
					</div><!-- ico-title -->
					<ol class="passo-a-passo">
						<li>
							<h5>Primeiro Passo</h5>
							<p>Retire o Produto congelado da embalagem</p>
						</li>
						<li>
							<h5>Segundo Passo</h5>
							<p>Coloque o produto congelado na panela, com a parte do molho virada para baixo, em seguida acescente 120ml de água.</p>
						</li>
						<li>
							<h5>Terceiro Passo</h5>
							<p>Tampe a panela e deixe ferver por 9 minuto em fogo alto (quemador pequeno)</p>
						</li>
						<li>
							<h5>Quarto Passo</h5>
							<p>Após ferver, mexa suavemente e sirva.</p>
						</li>
					</ol><!-- lista -->
				</div><!-- preparo-container -->
			</div><!-- columns -->
		</div><!-- row -->
	<?php elseif( get_field('modo_de_preparo') == 'micro_forno' ): ?>
		<div class="row">
			<div class="columns small-12">
				<h3 class="titulo-caracteristica">Modo de Preparo</h3>
			</div><!-- columns -->
		</div><!-- row -->
		<div class="row">
			<div class="columns small-12 medium-12">
				<div class="preparo-container">
					<div class="ico-title clearfix">
						<h5 class="preparo-title">No forno ou no micro</h5>
						<ul class="ico-title-ico text-center">
							<li class="ico ico-forno">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_forno.png" height="16" width="26" alt="">
								<span>No forno</span>
							</li>
							<li class="ico ico-micro">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_micro.png" height="16" width="26" alt="">
								<span>No micro</span>
							</li>
							<li class="ico ico-tempo">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_tempo.png" height="16" width="26" alt="">
								<span>Aprox. 9 min</span>
							</li>
						</ul><!-- ico-title-ico -->
					</div><!-- ico-title -->
					<ol class="passo-a-passo">
						<li>
							<h5>Primeiro Passo</h5>
							<p>Transferir o conteúdo da ebalagem para um recepiente apropriado</p>
						</li>
						<li>
							<h5>Segundo Passo</h5>
							<p>Descongelar rapidamente no micro-ndas ou deixar descongelando lentamente na geladeira</p>
						</li>
						<li>
							<h5>Terceiro Passo</h5>
							<p>Aquecer no micro-ondas de 3 a 5 minutos ou no forno convencional por 15 minutos ou até dourar</p>
						</li>
					</ol><!-- lista -->
				</div><!-- preparo-container -->
			</div><!-- columns -->
		</div><!-- row -->
	<?php elseif( get_field('modo_de_preparo') == 'panela_micro_forno' ): ?>
		<div class="row">
			<div class="columns small-12">
				<h3 class="titulo-caracteristica">Modo de Preparo</h3>
			</div><!-- columns -->
		</div><!-- row -->
		<div class="row">
			<div class="columns small-12 medium-6">
				<div class="preparo-container">
					<div class="ico-title clearfix">
						<h5 class="preparo-title">Na panela</h5>
						<ul class="ico-title-ico text-center">
							<li class="ico ico-panela">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_panela.png" height="16" width="26" alt="">
								<span>Na panela</span>
							</li>
							<li class="ico ico-tempo">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_tempo.png" height="16" width="26" alt="">
								<span>Aprox. 9 min</span>
							</li>
						</ul><!-- ico-title-ico -->
					</div><!-- ico-title -->
					<ol class="passo-a-passo">
						<li>
							<h5>Primeiro Passo</h5>
							<p>Retire o Produto congelado da embalagem</p>
						</li>
						<li>
							<h5>Segundo Passo</h5>
							<p>Coloque o produto congelado na panela, com a parte do molho virada para baixo, em seguida acescente 120ml de água.</p>
						</li>
						<li>
							<h5>Terceiro Passo</h5>
							<p>Tampe a panela e deixe ferver por 9 minuto em fogo alto (quemador pequeno)</p>
						</li>
						<li>
							<h5>Quarto Passo</h5>
							<p>Após ferver, mexa suavemente e sirva.</p>
						</li>
					</ol><!-- lista -->
				</div><!-- preparo-container -->
			</div><!-- columns -->
			<div class="columns small-12 medium-6">
				<div class="preparo-container">
					<div class="ico-title clearfix">
						<h5 class="preparo-title">No forno ou no micro</h5>
						<ul class="ico-title-ico text-center">
							<li class="ico ico-forno">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_forno.png" height="16" width="26" alt="">
								<span>No forno</span>
							</li>
							<li class="ico ico-micro">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_micro.png" height="16" width="26" alt="">
								<span>No micro</span>
							</li>
							<li class="ico ico-tempo">
								<img src="<?php bloginfo('template_url'); ?>/assets/img/ico_tempo.png" height="16" width="26" alt="">
								<span>Aprox. 9 min</span>
							</li>
						</ul><!-- ico-title-ico -->
					</div><!-- ico-title -->
					<ol class="passo-a-passo">
						<li>
							<h5>Primeiro Passo</h5>
							<p>Transferir o conteúdo da ebalagem para um recepiente apropriado</p>
						</li>
						<li>
							<h5>Segundo Passo</h5>
							<p>Descongelar rapidamente no micro-ndas ou deixar descongelando lentamente na geladeira</p>
						</li>
						<li>
							<h5>Terceiro Passo</h5>
							<p>Aquecer no micro-ondas de 3 a 5 minutos ou no forno convencional por 15 minutos ou até dourar</p>
						</li>
					</ol><!-- lista -->
				</div><!-- preparo-container -->
			</div><!-- columns -->
		</div><!-- row -->
	<?php endif; ?>
<?php endif; ?>
<?php	
}

/*WOOCOMMERCE NEW ADMIN TAB*/


/**
 * https://gist.github.com/ChromeOrange/3cb3a16a6560795b972d 
*/
add_action( 'init', 'register_custom_post_status', 10 );
function register_custom_post_status() {
	register_post_status( 'wc-saiu-entrega', array(
		'label'                     => _x( 'Saiu para entrega', 'Order status', 'woocommerce' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Saiu para entrega <span class="count">(%s)</span>', 'Saiu para entrega <span class="count">(%s)</span>', 'woocommerce' )
	) );
}
/**
 * Add custom status to order page drop down
 */
add_filter( 'wc_order_statuses', 'custom_wc_order_statuses' );
function custom_wc_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-saiu-entrega'] = 'Saiu para entrega';
        }
    }
    return $new_order_statuses;
}
/**
 * Add order status icon CSS
 */
add_action('admin_head', 'saiu_entrega_font_icon');
function saiu_entrega_font_icon() {
  echo '<style>
			.widefat .column-order_status mark.saiu-entrega:after{
				font-family:WooCommerce;
				speak:none;
				font-weight:400;
				font-variant:normal;
				text-transform:none;
				line-height:1;
				-webkit-font-smoothing:antialiased;
				margin:0;
				text-indent:0;
				position:absolute;
				top:0;
				left:0;
				width:100%;
				height:100%;
				text-align:center;
			}
			.widefat .column-order_status mark.saiu-entrega:after{
				content:"\e01a";
				color:#08c317;
			}
  </style>';
}