<?php
$tags = get_terms('post_tag', ['hide_empty' => true]);

$args = [
    'post_type'      => 'breakout_offer',
    'post_status'    => 'publish',
    'posts_per_page' => 12,
];

if (!empty($_GET['kd_tag'])) {
    $args['tax_query'] = [[
        'taxonomy' => 'post_tag',
        'field'    => 'slug',
        'terms'    => sanitize_text_field($_GET['kd_tag']),
    ]];
}

$offers = new WP_Query($args);
?>

<form method="get" id="kd-tag-filter">
    <select name="kd_tag" onchange="this.form.submit()">
        <option value="">All Tags</option>
        <?php foreach ($tags as $tag): ?>
            <option value="<?php echo esc_attr($tag->slug); ?>"
                <?php selected($_GET['kd_tag'] ?? '', $tag->slug); ?>>
                <?php echo esc_html($tag->name); ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if ($offers->have_posts()): ?>
    <div class="kd-offer-grid">
        <?php while ($offers->have_posts()): $offers->the_post(); ?>
            <div class="kd-offer-item">
                <h3><?php the_title(); ?></h3>
                <div><?php the_excerpt(); ?></div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <p>No offers found.</p>
<?php endif; ?>
