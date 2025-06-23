<?php
/**
 * All common functions to load in both admin and front
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
 * @subpackage Common
 * @author Codexpert <hi@codexpert.io>
 */
class Common extends Base {

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

	public function register_post_type() {
		$labels = array(
			'name'               => __( 'Breakout Offers', 'breakout-offers' ),
			'singular_name'      => __( 'Breakout Offer', 'breakout-offers' ),
			'add_new_item'       => __( 'Add New Offer', 'breakout-offers' ),
			'edit_item'          => __( 'Edit Offer', 'breakout-offers' ),
			'new_item'           => __( 'New Offer', 'breakout-offers' ),
			'view_item'          => __( 'View Offer', 'breakout-offers' ),
			'search_items'       => __( 'Search Offers', 'breakout-offers' ),
			'not_found'          => __( 'No offers found', 'breakout-offers' ),
			'not_found_in_trash' => __( 'No offers found in Trash', 'breakout-offers' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'show_in_rest'       => true,
			'has_archive'        => true,
			'rewrite'            => array( 'slug' => 'breakout-offers' ),
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' ),
			'taxonomies'         => array( 'post_tag' ),
		);

		register_post_type( 'breakout_offer', $args );
	}

	public function make_user_author_on_subscription( $subscription ) {

		$subscription_id 	= $subscription->get_id();
		$user_id 			= $subscription->get_user_id();
		$user 				= get_user_by( 'id', $user_id );

		if ( ! $user || in_array( 'author', $user->roles ) ) return;

		$user->set_role( 'author' );
	}

	public function decrement_offer_count( $subscription ) {
  		$user_id 			= $subscription->get_user_id();
    	$subscription_id 	= $subscription->get_id();
		$previous_count 	= get_user_meta( $user_id, 'breakout_offers_count', true );
		$new_count 			= $previous_count - 1;
		update_user_meta( $user_id, 'breakout_offers_count', $new_count );
	}

	public function redirect_to_custom_page() {
		if ( is_wc_endpoint_url('order-received') && isset( $_GET['key'] ) ) {

			$form_page_id = Helper::get_option( 'offers-subscription-for-woocommerce_advanced', 'offer_form_page_id' );

			if ($form_page_id) {
				$custom_page_url = get_permalink($form_page_id);
				wp_safe_redirect($custom_page_url);
				exit;
			}
		}
	}
}