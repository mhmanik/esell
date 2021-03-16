;(function($) {
$( document ).ready(function() {
   jQuery('.wooc img').removeAttr('srcset');
    if (wooc_var.wcaption == 'true') {var wooc_wcaption = 'title';} else {var wooc_wcaption = ' ';}	  
	 // alert(woocData.warrows)
	 $('.venobox').venobox({
	 	 framewidth: wooc_var.wLightboxframewidth+'px',  
	 	 titleattr:wooc_wcaption ,
	 	 numerationPosition: 'bottom',
	 	 numeratio:'true',
	 	 titlePosition:'bottom'
	 	 //
	 });  // lightbox
		$('.woocommerce-product-gallery__image img').load(function() {
	    var imageObj = $('.woocommerce-product-gallery__image img');
	    if (!(imageObj.width() == 1 && imageObj.height() == 1)) {
	    	//alert(imageObj.attr('src'));
	    //	$('.attachment-shop_thumbnail').attr('src', imageObj.attr('src'));
	    	$('.attachment-shop_thumbnail').trigger('click');	    	
	   			
	    }
	});

});   

})( jQuery );