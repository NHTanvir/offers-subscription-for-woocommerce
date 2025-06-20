<?php
/**
 * All common functions to load in both admin and front
 */
namespace Codexpert\OffersSubscriptionForWoocommerce\App;
use Codexpert\Plugin\Base;

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
}