<?php
/**
 * All AJAX related functions
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
 * @subpackage AJAX
 * @author Codexpert <hi@codexpert.io>
 */
class AJAX extends Base {

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

	public function submit_offer() {

		$user_id = get_current_user_id();

		// Required fields
		$required_fields = [
			'first_name', 'last_name', 'business_name', 'business_address',
			'business_phone', 'business_website', 'offer_headline',
			'offer_details', 'offer_rules', 'comments'
		];

		foreach ( $required_fields as $field ) {
			if ( empty( $_POST[ $field ] ) ) {
				wp_send_json_error( sprintf( __( '%s is required.', 'breakout-offers' ), ucfirst( str_replace('_', ' ', $field) ) ) );
			}
		}

		// Handle image uploads
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';

		$img1_id = $img2_id = null;

		foreach ( [ 'img1', 'img2' ] as $img_key ) {
			if ( ! empty( $_FILES[ $img_key ]['name'] ) ) {
				$file = $_FILES[ $img_key ];
				$upload = wp_handle_upload( $file, [ 'test_form' => false ] );

				if ( isset( $upload['error'] ) ) {
					wp_send_json_error( $upload['error'] );
				}

				$attachment = [
					'post_mime_type' => $upload['type'],
					'post_title'     => sanitize_file_name( $file['name'] ),
					'post_content'   => '',
					'post_status'    => 'inherit'
				];

				$attach_id = wp_insert_attachment( $attachment, $upload['file'] );
				$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				if ( $img_key === 'img2' ) {
					$img2_id = $attach_id;
				} elseif ( $img_key === 'img1' ) {
					$img1_id = $attach_id;
				}
			}
		}

		// Create post
		$post_id = wp_insert_post( [
			'post_title'   => sanitize_text_field( $_POST['offer_headline'] ),
			'post_content' => sanitize_textarea_field( $_POST['offer_details'] ),
			'post_status'  => 'publish',
			'post_type'    => 'breakout_offer',
			'post_author'  => $user_id,
			'tags_input'   => [ 'All' ],
		] );

		if ( is_wp_error( $post_id ) ) {
			wp_send_json_error( __( 'Failed to create offer.', 'breakout-offers' ) );
		}

		$offers_submitted = (int) get_user_meta( $user_id, 'offers_submitted_count', true );
		$offers_submitted++;
		update_user_meta( $user_id, 'offers_submitted_count', $offers_submitted );

		// Save meta fields
		$meta_fields = [
			'first_name', 'last_name', 'business_name', 'business_address',
			'business_phone', 'business_website', 'offer_rules',
			'offer_expiration', 'comments', 'consent'
		];

		foreach ( $meta_fields as $key ) {
			$value = isset($_POST[ $key ]) ? sanitize_text_field( $_POST[ $key ] ) : '';
			update_post_meta( $post_id, $key, $value );
		}

		if ( $img2_id ) {
			set_post_thumbnail( $post_id, $img2_id );
		}

		if ( $img1_id ) {
			update_post_meta( $post_id, 'large_image', $img1_id );
		}

		wp_send_json_success( __( 'Offer submitted successfully!', 'breakout-offers' ) );
	}

}