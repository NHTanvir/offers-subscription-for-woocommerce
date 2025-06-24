<?php
if( ! function_exists( 'get_plugin_data' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/**
 * Gets the site's base URL
 * 
 * @uses get_bloginfo()
 * 
 * @return string $url the site URL
 */
if( ! function_exists( 'osfw_site_url' ) ) :
function osfw_site_url() {
	$url = get_bloginfo( 'url' );

	return $url;
}
endif;
add_filter( 'template_include', function( $template ) {
	if ( is_post_type_archive( 'breakout_offer' ) ) {
		$custom = plugin_dir_path( __FILE__ ) . '../views/archive-breakout_offer.php';
		if ( file_exists( $custom ) ) {
			return $custom;
		}
	}
	return $template;
});
add_action( 'pre_get_posts', function( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'breakout_offer' ) && isset($_GET['tag']) ) {
		$query->set( 'tag', sanitize_text_field( $_GET['tag'] ) );
	}
});
add_filter( 'single_template', function( $template ) {
	if ( get_post_type() === 'breakout_offer' ) {
		$custom = plugin_dir_path( __FILE__ ) . '../views/single-breakout_offer.php';
		if ( file_exists( $custom ) ) {
			return $custom;
		}
	}
	return $template;
});
