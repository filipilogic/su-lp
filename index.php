<?php

get_header();
$archive_background_class = '';
$category = false;

if (is_home()) :

	$blog_title = get_field('blog_title', 'option');
	$title_color = get_field('blog_title_color', 'option');
	$blog_subtitle = get_field('blog_subtitle', 'option');
	$subtitle_color = get_field('blog_subtitle_color', 'option');
	$bg_img = get_field('blog_background', 'option');
	$bg_img_mob = get_field('blog_mobile_background', 'option');
	$archive_background_class = 'il_blog_archive_background';
	
endif;

if(is_category()) :

	$category = get_queried_object();

	$blog_title = get_field('category_custom_title', $category);
	if ( ! $blog_title ) {
		$blog_title = $category->name;
	}
	$title_color = get_field('category_title_color', $category);
	if ( ! $title_color ) {
		$title_color = get_field('category_title_color', 'option');
	}
	$blog_subtitle = get_field('category_custom_subtitle', $category);
	$subtitle_color = get_field('category_subtitle_color', $category);
	if ( ! $subtitle_color ) {
		$subtitle_color = get_field('category_subtitle_color', 'option');
	}
	$bg_img = get_field('category_header_background', $category);
	if ( ! $bg_img ) {
		$bg_img = get_field('category_header_background', 'option');
	}
	$bg_img_mob = get_field('category_mobile_header_background', $category);
	if ( ! $bg_img_mob ) {
		$bg_img_mob = get_field('category_mobile_header_background', 'option');
	}

	$archive_background_class = 'il_category_archive_background';

endif;

$load_more_text = get_field('load_more_button_text', 'option');
$load_more_color = get_field('load_more_button_color', 'option');
$load_more_background = get_field('load_more_button_background', 'option');
?>

	<main id="primary" class="site-main block_space_1_2">
		<div class="il_blog_archive_header">
			<div class="il_block_bg">
				<?php
					$size = 'full';

					$bg_class = 'desk_bg';
					if( $bg_img_mob ) {
						$bg_class .= ' hide_desk_bg_mob';
					}
					if( $bg_img ) {
						echo wp_get_attachment_image( $bg_img, $size, "",array( 'class' => $bg_class ) );
					}
					if( $bg_img_mob ) {
						echo wp_get_attachment_image( $bg_img_mob, $size, "",array( 'class' => 'mob_bg' ) );
					}
				?>
			</div>
			<div class="container">
				<div class="il_blog_archive_header-inner">
					<?php 
						if($blog_title):
					?>
					<h1 <?php echo $title_color ?  'style="color: '.$title_color.'"' : '' ?> class="il_blog_archive_header-title"><?php echo $blog_title; ?></h1>
					<?php endif; 
						if($blog_subtitle):
					?>
					<h3 <?php echo $subtitle_color ?  'style="color: '.$subtitle_color.'"' : '' ?> class="il_blog_archive_header-subtitle"><?php echo $blog_subtitle ?></h3>
					<?php endif; ?>
					<img src="<?php echo get_stylesheet_directory_uri().'/assets/icons/dots.svg' ?>" alt="dots">
				</div>
			</div>
		</div>
		
	    <div class="il_blog_archive_content <?php echo $archive_background_class; ?>">
			<div class="container">
				<div class="il_blog_archive_wrapper">
					<div class="il_blog_posts_container_wrapper">
						<div class="il_blog_posts_container">
								<?php
								if ( have_posts() ) :
								/* Start the Loop */
								$post_count = 0;
								while ( have_posts() ) :
									the_post(); 
									?>
										<div class="il_blog_post">
											<div class="il_bp_left">
												<div class="il_bp_post_date_category_wrapper">
													<span class="date"><?php echo get_the_date('d M Y'); ?></span>
												</div>
											
											<a class="il_bp_title" href="<?php echo get_permalink(get_the_ID()) ?>"><h2 class="tg_title_1 tg_dark"><?php the_title(); ?><?php ?></h2></a>
												<div class="il_bp_text">
												<?php if (get_the_excerpt()) {
													echo get_the_excerpt();
												} else {
													echo wp_trim_words(get_the_content(), 5);
												} ?>
											</div>
											<a class="il_bp_link" href="<?php echo get_permalink(get_the_ID()) ?>"><span class="il_bp_link_text">Learn More</span></a>
											</div>
											<div class="il_bp_right">
												<?php the_post_thumbnail(); ?>
											</div>
										</div>
										
								<?php 
									$post_count++;
									endwhile;
									
									// Access and display the found_posts count
									global $wp_query;
									$total_posts = $wp_query->found_posts;
								?>
								
								<div class="il_archive_more"></div>
									<?php if ($total_posts > $post_count && $load_more_text): ?>
										<button <?php echo $category ? 'data-category="'.$category->slug.'"' : ''?> style="<?php echo $load_more_color ? 'color:'.$load_more_color.';' : ''?> <?php echo $load_more_background ? 'background-color:'.$load_more_background.';' : ''?>" class="ilLoadMore">
											<?php echo $load_more_text; ?>
											<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M12.8633 8.47029C13.123 8.2106 13.123 7.78956 12.8633 7.52987C12.6038 7.27035 12.183 7.27016 11.9233 7.52945L8.66683 10.7801L8.66683 3.33341C8.66683 2.96522 8.36835 2.66675 8.00016 2.66675C7.63197 2.66675 7.3335 2.96522 7.3335 3.33341L7.3335 10.7801L4.07704 7.52945C3.81728 7.27016 3.39657 7.27035 3.13704 7.52987C2.87735 7.78956 2.87735 8.2106 3.13704 8.47029L8.00016 13.3334L12.8633 8.47029Z" fill="black" fill-opacity="0.7"/>
												<mask id="mask0_752_874" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="2" width="12" height="12">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M12.8633 8.47029C13.123 8.2106 13.123 7.78956 12.8633 7.52987C12.6038 7.27035 12.183 7.27016 11.9233 7.52945L8.66683 10.7801L8.66683 3.33341C8.66683 2.96522 8.36835 2.66675 8.00016 2.66675C7.63197 2.66675 7.3335 2.96522 7.3335 3.33341L7.3335 10.7801L4.07704 7.52945C3.81728 7.27016 3.39657 7.27035 3.13704 7.52987C2.87735 7.78956 2.87735 8.2106 3.13704 8.47029L8.00016 13.3334L12.8633 8.47029Z" fill="white"/>
												</mask>
												<g mask="url(#mask0_752_874)">
												<rect width="16" height="16" fill="white"/>
												</g>
											</svg>
										</button>
									<?php endif; ?>
								</div>
							<div class="il_blog_sidebar">
								<?php get_sidebar(); ?>
							</div>
								<?php else: ?>
									<h3 style="color: var(--color-1);">No posts found.</h3>
								<?php endif; ?>					
						</div>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
