<?php

if ( have_rows('timeline') ) :

	$margin = get_field_object('margin');
	$padding = get_field_object('padding');
	$style = get_field_object('style');
	$layout = get_field_object('layout');
	$anchor = '';
	if ( ! empty( $block['anchor'] ) ) {
		$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
	}
	$class = 'il_block il_timeline';
	if ( ! empty( $block['className'] ) ) {
		$class .= ' ' . $block['className'];
	}
	if ( ! empty( $margin ) ) {
		$class .=  ' ' . $margin['value'];
	}

	if ( ! empty( $padding) ) {
		$class .=  ' ' . $padding['value'];
	}

	if ( ! empty( $style) ) {
		$class .=  ' ' . $style['value'];
	}
	if ( ! empty( $layout) ) {
		$class .=  ' ' . $layout['value'];
	}

?>
<div id="<?php echo $anchor; ?>"class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="container">
		<?php get_template_part('components/intro'); ?>
	</div>
	<?php $item=1;?>
	<div class="il_timeline_inner container">
	<?php
	$timeline_last_item = count( get_field('timeline') );
	while( have_rows('timeline') ) : the_row();

	$tl_title = get_sub_field('tl_title');
	$tl_text = get_sub_field('tl_text');
		?>
		<div class="il_tl_item">
			<div class="il_tl_empty">

			</div>
			<div class="il_tl_arrow">
			<svg xmlns="http://www.w3.org/2000/svg" width="52.688" height="54.608" viewBox="0 0 52.688 54.608">
				<path id="Path_1466" data-name="Path 1466" d="M10.476,0,0,18.144H20.877L31.353,36.289h.075L41.9,18.144,31.427,0Z" transform="translate(31.106) rotate(59)" fill="<?php the_field('arrow_color') ?>"/>
			</svg>
			<?php if ( $item == $timeline_last_item ) : ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" class="il_tl_dot"><circle id="Ellipse_6" data-name="Ellipse 6" cx="5.5" cy="5.5" r="5.5" fill="<?php the_field('arrow_color') ?>"/></svg>
			<?php endif; ?>
			</div>
			<div class="il_tl_content">
				<?php if($tl_title) { ?>
				<h3 class="il_tl_header">
					<?php echo $tl_title; ?>
				</h3>
				<?php } ?>
				<div class="il_tl_body">
					<?php echo $tl_text; ?>
				</div>
			</div>
		</div>
	<?php $item++;?>
	<?php endwhile; ?>
	<figure class="il_tl_dot_mobile"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11"><circle id="Ellipse_6" data-name="Ellipse 6" cx="5.5" cy="5.5" r="5.5" fill="<?php the_field('arrow_color') ?>"/></svg></figure>
	</div>
</div>
<?php endif; ?>
