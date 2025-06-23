<?php
use Codexpert\OffersSubscriptionForWoocommerce\Helper;

if ( ! is_user_logged_in() ) {
    return sprintf(
        '<p>%s <a href="%s">%s</a>.</p>',
        esc_html__( 'Please log in to submit an offer.', 'breakout-offers' ),
        esc_url( wp_login_url( get_permalink() ) ),
        esc_html__( 'Log in', 'breakout-offers' )
    );
}

$user_id = get_current_user_id();
$active_subscriptions = 0;
if ( function_exists( 'wcs_get_users_subscriptions' ) ) {
    $subscriptions = wcs_get_users_subscriptions( $user_id );
    foreach ( $subscriptions as $subscription ) {
        if ( $subscription->has_status( 'active' ) ) {
            $active_subscriptions++;
        }
    }
}

$offers_submitted = (int) get_user_meta( $user_id, 'offers_submitted_count', true );


if ( $active_subscriptions <= 0 || $offers_submitted >= $active_subscriptions ) {
    return sprintf(
        '<p>%s <a href="%s">%s</a>.</p>',
        esc_html__( 'You need more active subscriptions to submit more offers.', 'breakout-offers' ),
        esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ),
        esc_html__( 'Subscribe here', 'breakout-offers' )
    );
}
?>


<form method="post" enctype="multipart/form-data" class="breakout-offer-form">

	<p>
		<label for="bo_first_name"><?php esc_html_e( 'First Name*', 'breakout-offers' ); ?><br>
			<input name="first_name" id="bo_first_name" type="text" required>
		</label>
	</p>

	<p>
		<label for="bo_last_name"><?php esc_html_e( 'Last Name*', 'breakout-offers' ); ?><br>
			<input name="last_name" id="bo_last_name" type="text" required>
		</label>
	</p>

	<p>
		<label for="bo_business_name"><?php esc_html_e( 'Business Name*', 'breakout-offers' ); ?><br>
			<input name="business_name" id="bo_business_name" type="text" required>
		</label>
	</p>

	<p>
		<label for="bo_business_address"><?php esc_html_e( 'Business Address (City/State/ZIP)*', 'breakout-offers' ); ?><br>
			<input name="business_address" id="bo_business_address" type="text" required>
		</label>
	</p>

	<p>
		<label for="bo_business_phone"><?php esc_html_e( 'Business Phone*', 'breakout-offers' ); ?><br>
			<input name="business_phone" id="bo_business_phone" type="text" required>
		</label>
	</p>

	<p>
		<label for="bo_business_website"><?php esc_html_e( 'Business Website*', 'breakout-offers' ); ?><br>
			<input name="business_website" id="bo_business_website" type="url" required>
		</label>
	</p>

	<p>
		<label for="bo_offer_headline"><?php esc_html_e( 'Offer Headline*', 'breakout-offers' ); ?><br>
			<input name="offer_headline" id="bo_offer_headline" type="text" required>
		</label>
	</p>

	<p>
		<label for="bo_offer_details"><?php esc_html_e( 'Offer Details*', 'breakout-offers' ); ?><br>
			<textarea name="offer_details" id="bo_offer_details" rows="5" required></textarea>
		</label>
	</p>

	<p>
		<label for="bo_offer_rules"><?php esc_html_e( 'Offer Rules*', 'breakout-offers' ); ?><br>
			<textarea name="offer_rules" id="bo_offer_rules" rows="5" required></textarea>
		</label>
	</p>

	<p>
		<label for="bo_offer_expiration"><?php esc_html_e( 'Offer Expiration', 'breakout-offers' ); ?><br>
			<input name="offer_expiration" id="bo_offer_expiration" type="date">
		</label>
	</p>

	<p>
		<label for="bo_img1"><?php esc_html_e( 'Offer Image (800×400)*', 'breakout-offers' ); ?><br>
			<input name="img1" id="bo_img1" type="file" accept="image/*" required>
		</label>
	</p>

	<p>
		<label for="bo_img2"><?php esc_html_e( 'Offer Image (400×600)', 'breakout-offers' ); ?><br>
			<input name="img2" id="bo_img2" type="file" accept="image/*">
		</label>
	</p>

	<p>
		<label for="bo_comments"><?php esc_html_e( 'Comments / Questions*', 'breakout-offers' ); ?><br>
			<textarea name="comments" id="bo_comments" rows="4" required></textarea>
		</label>
	</p>
	<p>
		<button type="submit" name="bo_submit" class="button button-primary">
			<?php esc_html_e( 'Submit Offer', 'breakout-offers' ); ?>
		</button>
	</p>
</form>
