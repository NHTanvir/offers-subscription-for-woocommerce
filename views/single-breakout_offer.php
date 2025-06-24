<?php get_header(); ?>

<div class="container" style="max-width: 800px; margin: auto; padding: 20px;">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		// Meta fields
		$business_name     = get_post_meta( get_the_ID(), 'business_name', true );
		$business_address  = get_post_meta( get_the_ID(), 'business_address', true );
		$business_website  = get_post_meta( get_the_ID(), 'business_website', true );
		$business_phone    = get_post_meta( get_the_ID(), 'business_phone', true );
		$offer_expiration  = get_post_meta( get_the_ID(), 'offer_expiration', true );
		$offer_rules       = get_post_meta( get_the_ID(), 'offer_rules', true );
		$comments          = get_post_meta( get_the_ID(), 'comments', true );

		$img1_id = get_post_meta( get_the_ID(), 'img1', true ); // Preview image
		$img2_id = get_post_meta( get_the_ID(), 'img2', true ); // Full image
		?>

		<!-- Offer Preview -->
		<h1><?php the_title(); ?></h1>

		<?php if ( $img1_id ) : ?>
			<div style="margin-bottom: 20px;">
				<?php echo wp_get_attachment_image( $img1_id, [400, 600], false, ['style' => 'width: 100%; max-width: 400px; height: auto;'] ); ?>
			</div>
		<?php endif; ?>

		<!-- Full Offer Info -->
		<div style="margin-top: 30px;">
			<h2>Business Info</h2>
			<p><strong>Name:</strong> <?php echo esc_html( $business_name ); ?></p>
			<p><strong>Address:</strong> <?php echo esc_html( $business_address ); ?></p>
			<p><strong>Phone:</strong> <?php echo esc_html( $business_phone ); ?></p>
			<p><strong>Website:</strong> <a href="<?php echo esc_url( $business_website ); ?>" target="_blank"><?php echo esc_html( $business_website ); ?></a></p>
		</div>

		<div style="margin-top: 30px;">
			<h2>Offer Details</h2>
			<?php the_content(); ?>
			<p><strong>Expires:</strong> <?php echo esc_html( $offer_expiration ); ?></p>
			<p><strong>Rules:</strong><br><?php echo nl2br( esc_html( $offer_rules ) ); ?></p>
			<p><strong>Comments:</strong><br><?php echo nl2br( esc_html( $comments ) ); ?></p>
		</div>

		<!-- Full Image -->
		<?php if ( $img2_id ) : ?>
			<div style="margin-top: 30px;">
				<?php echo wp_get_attachment_image( $img2_id, [800, 600], false, ['style' => 'width: 100%; max-width: 800px; height: auto;'] ); ?>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>
