<?php
/**
 * All public facing functions
 */
namespace Codexpert\OffersSubscriptionForWoocommerce\App;
use Codexpert\Plugin\Base;
use Codexpert\OffersSubscriptionForWoocommerce\Helper;
/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Front
 * @author Codexpert <hi@codexpert.io>
 */
class Front extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
	}

	public function head() {}
	
	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'Offers_Subscription_For_WooCommerce_DEBUG' ) && Offers_Subscription_For_WooCommerce_DEBUG ? '' : '.min';

		wp_enqueue_style( $this->slug, plugins_url( "/assets/css/front{$min}.css", Offers_Subscription_For_WooCommerce ), '', $this->version, 'all' );

		wp_enqueue_script( $this->slug, plugins_url( "/assets/js/front{$min}.js", Offers_Subscription_For_WooCommerce ), [ 'jquery' ], $this->version, true );
		
		$localized = [
			'ajaxurl'	=> admin_url( 'admin-ajax.php' ),
			'_wpnonce'	=> wp_create_nonce(),
		];
		wp_localize_script( $this->slug, 'Offers_Subscription_For_WooCommerce', apply_filters( "{$this->slug}-localized", $localized ) );
	}

	public function modal() {
		echo '
		<div id="offers-subscription-for-woocommerce-modal" style="display: none">
			<img id="offers-subscription-for-woocommerce-modal-loader" src="' . esc_attr( Offers_Subscription_For_WooCommerce_ASSET . '/img/loader.gif' ) . '" />
		</div>';
	}

	public function offer_form_popup_markup() {
		?>
		<div id="bo-offer-popup">
			<button id="bo-popup-close" aria-label="Close">&times;</button>
			<p id="bo-offer-message"></p>
		</div>
		<?php
	}

	public function checkout_consent_checkbox() {
		woocommerce_form_field( 'bo_consent', [
			'type'    => 'checkbox',
			'class'   => ['form-row'],
			'label'   => __( 'I authorize KidsDenBirthdays to charge the amount listed above to the credit card I have provided. I agree to pay for this purchase in accordance with the issuing bank cardholder agreement. I understand this is a recurring subscription and that I will automatically be charged at each renewal interval.', 'breakout-offers' ),
			'required' => true,
		] );
	}

	public function validate_consent_checkbox() {
		if ( empty( $_POST['bo_consent'] ) ) {
			wc_add_notice( __( 'You must agree to the subscription terms.', 'breakout-offers' ), 'error' );
		}
	}
}