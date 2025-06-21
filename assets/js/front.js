let osfw_modal = ( show = true ) => {
    if ( show ) {
        jQuery( '#offers-subscription-for-woocommerce-modal' ).show();
    } else {
        jQuery( '#offers-subscription-for-woocommerce-modal' ).hide();
    }
};

jQuery(function($){
    window.showOfferPopup = function(message) {
        $('#bo-offer-message').text(message);
        $('#bo-offer-popup').addClass('show');
    };

    $('#bo-popup-close').on('click', function() {
        $('#bo-offer-popup').removeClass('show');
    });

    $('.breakout-offer-form').on('submit', function(e) {
        e.preventDefault();

        var $form = $(this),
        fd    = new FormData(this);

        fd.append('action', 'bo_submit');
        fd.append('_wpnonce', Offers_Subscription_For_WooCommerce._wpnonce);

        $('#bo-offer-message').empty();
        $('#bo-offer-popup').removeClass('show');

        // show loader
        osfw_modal(true);

        $.ajax({
            url: Offers_Subscription_For_WooCommerce.ajaxurl,
            method: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json'
        })
        .done(function(resp) {
            if ( resp.success ) {
                // reset form
                $form[0].reset();
                // show success
                showOfferPopup(resp.data);
            } else {
                // show error
                showOfferPopup(resp.data || 'Submission failed.');
            }
        })
        .fail(function(jqXHR, textStatus) {
            showOfferPopup('AJAX error: ' + textStatus);
        })
        .always(function() {
            // hide loader
            osfw_modal(false);
            // re-enable button
            $form.find('button[type="submit"]')
                 .prop('disabled', false)
                 .text('Submit Offer');
        });

        // disable button + change text
        $form.find('button[type="submit"]')
             .prop('disabled', true)
             .text('Submitting…');
    });
});
