<?php

    if ( ! is_user_logged_in() ) {
        return '<p>' . esc_html__( 'Please log in to edit your offer.', 'breakout-offers' ) . '</p>';
    }

    $user_id = get_current_user_id();

    // Query user's single offer post (published)
    $args = [
        'post_type'      => 'breakout_offer',
        'author'         => $user_id,
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ];
    $query = new WP_Query($args);

    if ( ! $query->have_posts() ) {
        return '<p>' . esc_html__( 'You have no offer published yet.', 'breakout-offers' ) . '</p>';
    }

    $post = $query->posts[0];
    wp_reset_postdata();

    // Same meta retrieval function as before
    $meta = function($key) use ($post) {
        return get_post_meta( $post->ID, $key, true );
    };

    ob_start();
    ?>

    <form id="breakout-offer-edit-form" method="post" enctype="multipart/form-data">

        <input type="hidden" name="action" value="update_offer">
        <input type="hidden" name="post_id" value="<?php echo esc_attr( $post->ID ); ?>">

        <p>
            <label for="bo_first_name"><?php esc_html_e( 'First Name*', 'breakout-offers' ); ?><br>
                <input name="first_name" id="bo_first_name" type="text" required value="<?php echo esc_attr($meta('first_name')); ?>">
            </label>
        </p>

        <p>
            <label for="bo_last_name"><?php esc_html_e( 'Last Name*', 'breakout-offers' ); ?><br>
                <input name="last_name" id="bo_last_name" type="text" required value="<?php echo esc_attr($meta('last_name')); ?>">
            </label>
        </p>

        <p>
            <label for="bo_business_name"><?php esc_html_e( 'Business Name*', 'breakout-offers' ); ?><br>
                <input name="business_name" id="bo_business_name" type="text" required value="<?php echo esc_attr($meta('business_name')); ?>">
            </label>
        </p>

        <p>
            <label for="bo_business_address"><?php esc_html_e( 'Business Address*', 'breakout-offers' ); ?><br>
                <input name="business_address" id="bo_business_address" type="text" required value="<?php echo esc_attr($meta('business_address')); ?>">
            </label>
        </p>

        <p>
            <label for="bo_business_phone"><?php esc_html_e( 'Business Phone*', 'breakout-offers' ); ?><br>
                <input name="business_phone" id="bo_business_phone" type="text" required value="<?php echo esc_attr($meta('business_phone')); ?>">
            </label>
        </p>

        <p>
            <label for="bo_business_website"><?php esc_html_e( 'Business Website*', 'breakout-offers' ); ?><br>
                <input name="business_website" id="bo_business_website" type="url" required value="<?php echo esc_attr($meta('business_website')); ?>">
            </label>
        </p>

        <p>
            <label for="bo_offer_headline"><?php esc_html_e( 'Offer Headline*', 'breakout-offers' ); ?><br>
                <input name="offer_headline" id="bo_offer_headline" type="text" required value="<?php echo esc_attr( $post->post_title ); ?>">
            </label>
        </p>

        <p>
            <label for="bo_offer_details"><?php esc_html_e( 'Offer Details*', 'breakout-offers' ); ?><br>
                <textarea name="offer_details" id="bo_offer_details" rows="5" required><?php echo esc_textarea( $post->post_content ); ?></textarea>
            </label>
        </p>

        <p>
            <label for="bo_offer_rules"><?php esc_html_e( 'Offer Rules*', 'breakout-offers' ); ?><br>
                <textarea name="offer_rules" id="bo_offer_rules" rows="5" required><?php echo esc_textarea($meta('offer_rules')); ?></textarea>
            </label>
        </p>

        <p>
            <label for="bo_offer_expiration"><?php esc_html_e( 'Offer Expiration', 'breakout-offers' ); ?><br>
                <input name="offer_expiration" id="bo_offer_expiration" type="date" value="<?php echo esc_attr($meta('offer_expiration')); ?>">
            </label>
        </p>

        <p>
            <label><?php esc_html_e( 'Existing (800×400) Image', 'breakout-offers' ); ?><br>
                <?php
                $img1_id = $meta('large_image');
                if ( $img1_id ) {
                    echo wp_get_attachment_image( $img1_id, 'thumbnail' );
                } else {
                    echo esc_html__('No image uploaded', 'breakout-offers');
                }
                ?>
            </label><br>
            <label for="bo_img1"><?php esc_html_e( 'Change (800×400) Image', 'breakout-offers' ); ?><br>
                <input name="img1" id="bo_img1" type="file" accept="image/*">
            </label>
        </p>

        <p>
            <label><?php esc_html_e( 'Existing (400×600) Image', 'breakout-offers' ); ?><br>
                <?php
                $img2_id = $meta('small_image');
                if ( $img2_id ) {
                    echo wp_get_attachment_image( $img2_id, 'thumbnail' );
                } else {
                    echo esc_html__('No image uploaded', 'breakout-offers');
                }
                ?>
            </label><br>
            <label for="bo_img2"><?php esc_html_e( 'Change (400×600) Image', 'breakout-offers' ); ?><br>
                <input name="img2" id="bo_img2" type="file" accept="image/*">
            </label>
        </p>

        <p>
            <label for="bo_comments"><?php esc_html_e( 'Comments / Questions*', 'breakout-offers' ); ?><br>
                <textarea name="comments" id="bo_comments" rows="4" required><?php echo esc_textarea($meta('comments')); ?></textarea>
            </label>
        </p>

        <p>
            <button type="submit" class="button button-primary"><?php esc_html_e( 'Update Offer', 'breakout-offers' ); ?></button>
        </p>

        <div id="breakout-offer-edit-response"></div>
    </form>

    <?php