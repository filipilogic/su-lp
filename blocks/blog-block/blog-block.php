<?php
$margin = get_field_object('margin');
$custom_padding = get_field('custom_padding');
$padding = get_field_object('padding');

$picked_category = get_field('pick_a_category_blog_block');

$class = 'il_block il_blog-block-section';
if ( ! empty( $margin ) ) {
    $class .=  ' ' . $margin['value'];
}
if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}
if( $custom_padding ) {
	$paddings = '';

	if ( have_rows('custom_padding_ld')) {
		while (have_rows('custom_padding_ld')) {
			the_row();
			$padding_top = get_sub_field('padding_top');
			$padding_bottom = get_sub_field('padding_bottom');
			$padding_left = get_sub_field('padding_left');
			$padding_right = get_sub_field('padding_right');

			if( ! empty($padding_top) ) {
				$paddings .= ' --b-blog-block-space-top-ld: ' . $padding_top . ';';
			}
			if( ! empty($padding_bottom) ) {
				$paddings .= ' --b-blog-block-space-bottom-ld: ' . $padding_bottom . ';';
			}
			if( ! empty($padding_left) ) {
				$paddings .= ' --b-blog-block-space-left-ld: ' . $padding_left . ';';
			}
			if( ! empty($padding_right) ) {
				$paddings .= ' --b-blog-block-space-right-ld: ' . $padding_right . ';';
			}
		}
	}
	if ( have_rows('custom_padding_mt')) {
		while (have_rows('custom_padding_mt')) {
			the_row();
			$padding_top = get_sub_field('padding_top');
			$padding_bottom = get_sub_field('padding_bottom');
			$padding_left = get_sub_field('padding_left');
			$padding_right = get_sub_field('padding_right');

			if( ! empty($padding_top) ) {
				$paddings .= ' --b-blog-block-space-top-mt: ' . $padding_top . ';';
			}
			if( ! empty($padding_bottom) ) {
				$paddings .= ' --b-blog-block-space-bottom-mt: ' . $padding_bottom . ';';
			}
			if( ! empty($padding_left) ) {
				$paddings .= ' --b-blog-block-space-left-mt: ' . $padding_left . ';';
			}
			if( ! empty($padding_right) ) {
				$paddings .= ' --b-blog-block-space-right-mt: ' . $padding_right . ';';
			}
		}
	}
}

?>

<div class="<?php echo $class; ?>" <?php if ( $custom_padding ) echo 'style="' . $paddings . '"'; ?>>
    <?php get_template_part('components/background'); ?>
    <div class="container">
        <?php get_template_part('components/intro'); ?>
        <div class="il_past_events_section_posts">
            <?php 
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                    'cat' => $picked_category
                );
                $posts = new WP_Query( $args );
                
                if ( $posts->have_posts() ) :
                
                    while ( $posts->have_posts() ) :
                        $posts->the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                the_post_thumbnail( array(508, 250) );
                                ?>
                                <div class="article-container">
                                    <header class="entry-header">
                                        <h3 class="entry-title"><?php the_title(); ?></h3>
                                    </header>
                                    <div class="entry-content">
                                        <p>
                                            <?php if (get_the_excerpt()) {
                                                echo get_the_excerpt();
                                            } else {
                                                echo wp_trim_words(get_the_content(), 25);
                                            } ?>
                                        </p> 
                                    </div>
                                    <span class="entry_btn">Learn more</span>
                                </div>
                            </a>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_query();
                endif;
            ?>

            <?php if ( have_rows('buttons_after_blog_group') && get_field('buttons_after_blog_group')['buttons'] !== false) { ?>
                
                <div class="buttons-after-blog">
                    <?php while (have_rows('buttons_after_blog_group')) {
                        the_row();
                        get_template_part('components/buttons');
                    } ?>
                </div>
            <?php } ?>
        </div>

    </div>
</div>
