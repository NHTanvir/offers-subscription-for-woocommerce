let osfw_modal = ( show = true ) => {
	if(show) {
		jQuery('#offers-subscription-for-woocommerce-modal').show();
	}
	else {
		jQuery('#offers-subscription-for-woocommerce-modal').hide();
	}
}

jQuery(function($){
	 window.showOfferPopup = function(message) {
        $('#bo-offer-message').text(message);
        $('#bo-offer-popup').addClass('show');
    };

    $('#bo-popup-close').on('click', function() {
        $('#bo-offer-popup').removeClass('show');
    });
})