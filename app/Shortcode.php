<?php
/**
 * All Shortcode related functions
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
 * @subpackage Shortcode
 * @author Codexpert <hi@codexpert.io>
 */
class Shortcode extends Base {

    public $plugin;

    /**
     * Constructor function
     */
    public function __construct( $plugin ) {
        $this->plugin   = $plugin;
        $this->slug     = $this->plugin['TextDomain'];
        $this->name     = $this->plugin['Name'];
        $this->version  = $this->plugin['Version'];
    }

    public function offers_form() {
        return Helper::get_template( 'offer-form' );
    }
}