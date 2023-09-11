<?php
$cols = get_field_object('columns');
$tab_cols = get_field_object('tab_columns');
$mob_cols = get_field_object('mob_columns');
$team_layout = get_field_object('layout');

$margin = get_field_object('margin');
$custom_padding = get_field('custom_padding');
$padding = get_field_object('padding');

$inner_columns_container_max_width = get_field('inner_columns_container_max_width');

$col_in_style = 'style="';

if( ! empty($inner_columns_container_max_width) ) {
	$col_in_style .= 'max-width: ' . $inner_columns_container_max_width . 'px;';
}


$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'il_block il_columns';
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
				$paddings .= ' --b-columns-space-top-ld: ' . $padding_top . ';';
			}
			if( ! empty($padding_bottom) ) {
				$paddings .= ' --b-columns-space-bottom-ld: ' . $padding_bottom . ';';
			}
			if( ! empty($padding_left) ) {
				$paddings .= ' --b-columns-space-left-ld: ' . $padding_left . ';';
			}
			if( ! empty($padding_right) ) {
				$paddings .= ' --b-columns-space-right-ld: ' . $padding_right . ';';
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
				$paddings .= ' --b-columns-space-top-mt: ' . $padding_top . ';';
			}
			if( ! empty($padding_bottom) ) {
				$paddings .= ' --b-columns-space-bottom-mt: ' . $padding_bottom . ';';
			}
			if( ! empty($padding_left) ) {
				$paddings .= ' --b-columns-space-left-mt: ' . $padding_left . ';';
			}
			if( ! empty($padding_right) ) {
				$paddings .= ' --b-columns-space-right-mt: ' . $padding_right . ';';
			}
		}
	}
}

?>

<div <?php echo $anchor; ?> class="<?php echo $class ?>" <?php if ( $custom_padding ) echo 'style="' . $paddings . '"'; ?>>
<?php get_template_part('components/background'); ?>
	<div class="container" <?php if ( ! empty($inner_columns_container_max_width) ) { echo $col_in_style . '"'; } ?>>
		<?php get_template_part('components/intro');
        $column_alignment = get_field('column_alignment');
        $text_color = get_field('text_color');
        $text_font_weight = get_field('text_font_weight');
        $inner_class = $column_alignment . ' ' . $text_color . ' ' . $text_font_weight;
        ?>
        <div class="il_columns_inner <?php echo $inner_class; ?>">
        <?php
            // Columns repeater
            if( have_rows('columns_block') ):

                while( have_rows('columns_block') ) : the_row();

				$link = get_sub_field('link');
                $text = get_sub_field('text');
                $image = get_sub_field('image');
                $size = 'full';

                // Title ?>

                <div class="il_col column">
					<a href="<?php echo $link; ?>" target="_blank">
						<?php if( $image ) {
							echo wp_get_attachment_image( $image, $size );
						}
						get_template_part('components/nested-title');

						?>

						<?php if ($text) { ?>
							<div class="il_col_text">
								<?php echo $text; ?>
							</div>
						<?php } ?>
						<?php get_template_part('components/buttons'); ?>
					</a>
                </div>
                <?php endwhile;
            endif; ?>
        </div>
	</div>
</div>