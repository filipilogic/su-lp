<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ilogic
 */

 $post_header_title = get_field('post_header_title', 'option');
 $post_header_title_color = get_field('post_header_title_color', 'option');
 $post_header_subtitle = get_field('post_header_subtitle', 'option');
 $post_header_subtitle_color = get_field('post_header_subtitle_color', 'option');
 $bg_img = get_field('post_header_background', 'option');
 $bg_img_mob = get_field('post_header_mobile_background', 'option');

 $categories = get_the_category();
 $post_subtitle = get_field('post_subtitle');

get_header();

?>
	<main id="primary" class="site-main">
		<div class="il_blog_post_header">
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
				<div class="il_blog_post_header-inner">
					<?php 
						if($post_header_title):
					?>
					<h1 <?php echo $post_header_title_color ?  'style="color: '.$post_header_title_color.'"' : '' ?> class="il_blog_post_header-title"><?php echo $post_header_title; ?></h1>
					<?php endif; 
						if($post_header_subtitle):
					?>
					<h3 <?php echo $post_header_subtitle_color ?  'style="color: '.$post_header_subtitle_color.'"' : '' ?> class="il_blog_post_header-subtitle"><?php echo $post_header_subtitle ?></h3>
					<?php endif; ?>
					<img src="<?php echo get_stylesheet_directory_uri().'/assets/icons/dots.svg' ?>" alt="dots">
				</div>
			</div>
		</div>
		<div class="post-content">
			<div class="container">
				<!-- <div class="il_sp_breadcrumb"> -->
					<?php the_breadcrumb(); ?>
				<!-- </div> -->
				<div class="il_sp_content_wrapper">
					<div class="il_sp_content">
					<?php
						while ( have_posts() ) :
							the_post();
							?>
							<div class="il_sp_content_header">
								<?php
									the_title('<h1 class="il_sp_title">','</h1>');
								?>
								<h3 class="il_sp_subtitle"><?php echo $post_subtitle; ?></h3>
							</div>
							<div class="il_sp_content_share">
								<?php
									echo il_social_share();
								?>
							</div>
							<div class="il_bp_post_date_category_wrapper">
								<span class="date"><?php echo get_the_date('d M Y'); ?></span>
								<?php
									the_category(', ');
								?>
							</div>
							<?php
								if (has_post_thumbnail()) {
									?>
									<div class="il_sp_content_featured_image">
										<?php the_post_thumbnail(); ?>
									</div>
									<?php
								}

							get_template_part( 'template-parts/content', get_post_type() ); ?>
							<?php if( get_field('dcta_switch') ) : ?>

							<div class="il_donate_cta">
								<h2 class="il_dcta_title">
									<?php the_field('dcta_title', 'option'); ?>
								</h2>
								<div class="il_dcta_text">
									<?php the_field('dcta_text', 'option'); ?>
								</div>
								<?php
								$dcta_link = get_field('dcta_link', 'option');
								if( $dcta_link ):
									$dcta_link_url = $dcta_link['url'];
									$dcta_link_title = $dcta_link['title'];
									$dcta_link_target = $dcta_link['target'] ? $dcta_link['target'] : '_self';
									?>
									<a class="il_btn button-color-green button-hover-color-pink" href="<?php echo esc_url( $dcta_link_url ); ?>" target="<?php echo esc_attr( $dcta_link_target ); ?>"><?php echo esc_html( $dcta_link_title ); ?></a>
								<?php endif; ?>
							</div>
							<?php endif; ?>
							<div class="post_container nav-container">
							<?php the_post_navigation(
								array(
									'prev_text' => '',
									'next_text' => '',
								)
							); ?>
							</div>

						<?php endwhile; // End of the loop. ?>
					</div>
					<div class="il_sp_content_sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
				<div class="il_sp_similar_posts">
					<?php
						// Get the current post's categories
						$categories = get_the_category();

						// Check if the post has at least one category
						if ($categories) {
							// Get the ID of the first category (you can change this to target a specific category)
							$category_id = $categories[0]->term_id;

							// Query parameters to get similar posts from the same category
							$args = array(
								'post_type' => 'post',
								'posts_per_page' => 3, // Change this number to adjust the number of similar posts displayed
								'post__not_in' => array(get_the_ID()), // Exclude the current post
								'category__in' => array($category_id), // Only show posts from the same category
							);

							// The query to get similar posts
							$similar_posts_query = new WP_Query($args);

							// Check if there are any similar posts
							if ($similar_posts_query->have_posts()) {
								?>

									<h2 class="il_sp_similar_posts_title">Explore More</h2>
									<div class="il_sp_similar_posts_content">
										<?php
										while ($similar_posts_query->have_posts()) {
												$similar_posts_query->the_post();
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
										}
										?>
									</div>
								<?php
							}
							// Restore original post data
							wp_reset_postdata();
						}
					?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
