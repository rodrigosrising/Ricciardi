$(document).foundation()

$(".cart-box").hide();
$(".btn-cart").click(function(){
	$(".cart-box").slideToggle(350);
});

$(".search-box").hide();
$(".button-search").click(function(){
	$(".search-box").slideToggle(350);
});
// $(".search-box-container").hide();
// $(".search-icon").click(function(){
//     $(".search-box-container").slideToggle(350);
// });
 // The jQuery script that makes the Arrows for quantity work.
 jQuery(document).ready(function($) {
 	$(".product_quantity_minus").click(function(e){
 		var quantityInput = $(this).closest(".quantity").children("input[type='number']");
 		var currentQuantity = parseInt($(quantityInput).val());
 		var newQuantity = ( currentQuantity > 1 ) ?  ( currentQuantity - 1) : 1;
 		$(quantityInput).val(newQuantity);
 		$('#update_cart_button').attr('disabled',false);
 	});

 	$(".product_quantity_plus").click(function(e){
 		var max_quantity = 99999;
 		var quantityInput = $(this).closest(".quantity").children("input[type='number']");
 		var currentQuantity = parseInt($(quantityInput).val());
 		var newQuantity = ( currentQuantity >= max_quantity ) ?  max_quantity : ( currentQuantity+1 );
 		$(quantityInput).val(newQuantity);
 		$('#update_cart_button').attr('disabled',false);
 	});
 });

 $(document).ready(function(){
 	$('.slides-home').slick({
 		dots: true,
		arrows: true,
		infinite: true,
		speed: 500,
		autoplay: true,
		autoplaySpeed: 5000,
		slidesToShow: 1
 	});
 });
