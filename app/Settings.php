<?php
/**
 * All settings related functions
 */
namespace Codexpert\OffersSubscriptionForWoocommerce\App;
use Codexpert\OffersSubscriptionForWoocommerce\Helper;
use Codexpert\Plugin\Base;
use Codexpert\Plugin\Settings as Settings_API;

/**
 * @package Plugin
 * @subpackage Settings
 * @author Codexpert <hi@codexpert.io>
 */
class Settings extends Base {

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
	
	public function init_menu() {
		
		$site_config = [
			'PHP Version'				=> PHP_VERSION,
			'WordPress Version' 		=> get_bloginfo( 'version' ),
			'WooCommerce Version'		=> is_plugin_active( 'woocommerce/woocommerce.php' ) ? get_option( 'woocommerce_version' ) : 'Not Active',
			'Memory Limit'				=> defined( 'WP_MEMORY_LIMIT' ) && WP_MEMORY_LIMIT ? WP_MEMORY_LIMIT : 'Not Defined',
			'Debug Mode'				=> defined( 'WP_DEBUG' ) && WP_DEBUG ? 'Enabled' : 'Disabled',
			'Active Plugins'			=> get_option( 'active_plugins' ),
		];

		$settings = [
			'id'            => $this->slug,
			'label'         => 'Offers Subscription',
			'title'         => "{$this->name} v{$this->version}",
			'header'        => $this->name,
			// 'parent'     => 'woocommerce',
			// 'priority'   => 10,
			// 'capability' => 'manage_options',
			// 'icon'       => 'dashicons-wordpress',
			// 'position'   => 25,
			// 'topnav'	=> true,
			'sections'      => [
				'offers-subscription-for-woocommerce_advanced'	=> [
					'id'        => 'offers-subscription-for-woocommerce_advanced',
					'label'     => __( 'Advanced Settings', 'offers-subscription-for-woocommerce' ),
					'icon'      => 'dashicons-admin-generic',
					// 'color'		=> '#d30c5c',
					'sticky'	=> false,
					'fields'    => [
						'subscription_id' => [
							'id'      => 'subscription_id',
							'label'     => __( 'Subscription product id', 'offers-subscription-for-woocommerce' ),
							'type'      => 'select',
							'desc'      => __( 'Select with subscription product id', 'offers-subscription-for-woocommerce' ),
							// 'class'     => '',
							'options'   => Helper::get_posts( [ 'post_type' => 'product' ], false, true ),
							'default'   => 2,
							'disabled'  => false, // true|false
							'multiple'  => false, // true|false
							'chosen'    => true
						],
					]
				],
			],
		];

		new Settings_API( $settings );
	}
}