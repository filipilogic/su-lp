<?php
if ( have_rows('images') ) :

$cols = get_field_object('columns');
$tab_cols = get_field_object('tab_columns');
$mob_cols = get_field_object('mob_columns');
$use_lighbox = get_field('use_lightbox');

$margin = get_field_object('margin');
$padding = get_field_object('padding');


$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'il_block il_gallery';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}
if ( ! empty( $cols ) ) {
    $class .=  ' ' . $cols['value'];
}
if ( ! empty( $tab_cols ) ) {
    $class .=  ' ' . $tab_cols['value'];
}
if ( ! empty( $mob_cols ) ) {
    $class .=  ' ' . $mob_cols['value'];
}
if ( ! empty( $margin ) ) {
    $class .=  ' ' . $margin['value'];
}

if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}


 ?>
<div <?php echo $anchor; ?> class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="container">
		<?php get_template_part('components/intro'); ?>
		<div class="il_gallery_inner">
			<?php while( have_rows('images') ) : the_row();
				$image = get_sub_field('image');

				$url = $image['url'];
				$title = $image['title'];
				$alt = $image['alt'];
				$caption = $image['caption']; ?>
				<div class="column">
				<?php if($use_lighbox) { ?>
					<figure class="il_gallery-item" data-fancybox="il_gallery" title="<?php echo esc_attr($title); ?>" data-src="<?php echo esc_url($url); ?>" data-fancybox data-caption="<?php echo esc_attr($caption); ?>">
					<?php }
					else { ?>
						<figure class="il_gallery-item">
					<?php } ?>
					<img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>" />
					</figure>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php endif; ?>
