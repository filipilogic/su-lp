<?php

if ( have_rows('accordion') ) :

	$margin = get_field_object('margin');
	$padding = get_field_object('padding');

	$anchor = 'il_accordion';
	if ( ! empty( $block['anchor'] ) ) {
		$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
	}
	$class = 'il_block il_accordion';
	if ( ! empty( $block['className'] ) ) {
		$class .= ' ' . $block['className'];
	}
	if ( ! empty( $margin ) ) {
		$class .=  ' ' . $margin['value'];
	}

	if ( ! empty( $padding) ) {
		$class .=  ' ' . $padding['value'];
	}

?>
<div id="<?php echo $anchor; ?>"class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="il_accordion_inner container">
	<?php get_template_part('components/intro');

		$item=1;?>
		<?php while( have_rows('accordion') ) : the_row();

		$accordion_title = get_sub_field('title');
		$accordion_content = get_sub_field('content');
		$image_desktop = get_sub_field('image_desktop');
		$image_mobile = get_sub_field('image_mobile');
		$size = 'full';

		if($item == 1 && get_field('first_open') ){

			$open = 'open';
			$display = 'display: flex';

			}else{
				$open = '';
				$display = 'display: none';
			}
			?>
			<div class="il_accordion-item <?php echo $open ?>">
				<h3 class="il_accordion-header">
					<?php echo $accordion_title; ?>
				</h3>
				<div class="il_accordion-body" style="<?php echo $display ?>">
					<div class="il_accordion-body-left">
					<?php echo $accordion_content; ?>
					</div>
					<?php
						if ($image_desktop || $image_mobile) { ?>
							<div class="il_accordion-body-right">
						<?php }
							if( $image_desktop ) {
								echo wp_get_attachment_image( $image_desktop, $size, "",array( 'class' => 'acc_desk_img' ) );
							}
							if( $image_mobile ) {
								echo wp_get_attachment_image( $image_mobile, $size, "",array( 'class' => 'acc_mob_img' ) );
							}
						?>
						<?php 
						if ($image_desktop || $image_mobile) { ?>
							</div>
						<?php } ?>
				</div>
			</div>

		<?php $item++;?>
		<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>
