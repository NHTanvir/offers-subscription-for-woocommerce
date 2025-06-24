<?php get_header(); ?>

<div class="container">
	<h1>Breakout Offers</h1>

	<!-- Tag Filter -->
	<form method="get" class="tag-filter-form">
		<?php
		$tags = get_tags();
		if ( $tags ) {
			echo '<select name="tag" onchange="this.form.submit()">';
			echo '<option value="">Filter by Tag</option>';
			foreach ( $tags as $tag ) {
				$selected = ( isset($_GET['tag']) && $_GET['tag'] === $tag->slug ) ? 'selected' : '';
				echo '<option value="' . esc_attr($tag->slug) . '" ' . $selected . '>' . esc_html($tag->name) . '</option>';
			}
			echo '</select>';
		}
		?>
	</form>

	<!-- Offers Loop -->
    <div class="offers-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="offer-card">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'medium' ); ?>
				<?php endif; ?>
				<h2><?php the_title(); ?></h2>
			</a>
		</div>
	<?php endwhile; else : ?>
		<p>No offers found.</p>
	<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
