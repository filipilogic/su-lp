<?php

// Nested Title Component uses all the same fields as the Title - Except the fields are inserted and loaded as sub_fields

$title = get_sub_field('title');
$tag = get_sub_field('heading_tag');
$title_color = get_sub_field('title_color');
$style = get_sub_field('title_style');

if( $title ) { ?>
<<?php echo esc_html($tag); ?> class="intro_title <?php echo $style; ?>" style="color: <?php echo $title_color; ?>;"><?php echo $title; ?></<?php echo esc_html($tag); ?>>
<?php }