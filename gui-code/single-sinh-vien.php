<?php

get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div id="content" role="main" class="content-area">

		<?php 
		$post_type = get_post_type( get_the_ID() );
		if ( $post_type === 'su-kien' ) {
			$post_type_name = 'Sự kiện';
		} else {
			$post_type_name = 'Tin tức';
		}
	?>

	<?php
		echo do_shortcode('
		[section bg_color="rgb(237, 237, 237)" padding="0px"]
			[row]
				[col span__sm="12" padding="15px 0px 0px 0px" class="pad-bot-15"]
					[ux_text class="mb-0"]
						[rank_math_breadcrumb]
					[/ux_text]
				[/col]
			[/row]
			[/section]');
	?>

	<div class="row" style="margin-top: 15px;">
		<div class="col large-12 pad-bot-15">
			<?php echo do_shortcode('[banner_1]'); ?>
		</div>
	</div>

	<?php
		$after_content_img = get_field('after_content_img', 'option');
		$after_content_content = get_field('after_content_content', 'option');
	?>
	
	
	<div class="row detail-template ">
		<div class="col large-9">
			<div>
				<h2 class="text-linear title" style="font-size: 2rem;"><?php the_title(); ?></h2>
				<div class="single-post post-meta">
					<span class="post-date">
						<?php echo get_the_date('d/m/Y'); ?>
					</span>
					|
					<span class="post-author">
						<?php
							$author_id = get_post_field( 'post_author', get_the_ID() );
							echo get_the_author_meta( 'display_name', $author_id );
						?>
					</span>
				</div>
				
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumb">
						<img 
							 src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" 
							 alt="<?php echo esc_attr( get_the_title() ); ?>">
					</div>
				<?php endif; ?>
				<div class="content">
					<?php the_content(); ?>
				</div>
				
				<div class="detail-after-container">
					<?php
						echo do_shortcode('[ux_image id="'. $after_content_img .'" image_size="original" height="" width="80"]');
					?>
					<div>
						<?php echo $after_content_content; ?>
					</div>
					
				</div>
				
			</div>
		</div>
		<div class="col large-3">
			<div class="is-sticky-column" data-sticky-mode="javascript">
				<?php echo do_shortcode('[banner_2]'); ?>
				<div class="divider" style="height: 15px;"></div>
				<?php echo do_shortcode('[banner_3]'); ?>
				<div style="height: 15px;"></div>
				<div class="sidebar-container">
					<h2 class="text-linear">Nội dung mới</h2>
					<div>
						<?php echo do_shortcode('[newest_blogs]');?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col large-12">
			<div class="blog-quantam-container">
				<h2 style="margin-bottom: 1.5rem;">Có thể bạn quan tâm</h2>
				
				<div class="row row-equal">

					<?php
					$current_id = get_the_ID();
					$args = array(
						'post_type'      => 'sinh-vien',
						'posts_per_page' => 8, 
						'post_status'    => 'publish',
						'post__not_in'   => array($current_id), 
					);

					$query = new WP_Query($args);

					if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
					?>

					<div class="col large-3 small-6 post-item">
						<div class="col-inner">
							<div class="box box-normal box-text-bottom box-blog-post has-hover">

								<div class="box-image">
									<div class="image-cover" style="padding-top:75%;">
										<a href="<?php the_permalink(); ?>" class="plain" aria-label="<?php the_title_attribute(); ?>">
											<?php 
											if (has_post_thumbnail()) {
												the_post_thumbnail('original', array(
													'class' => 'attachment-original size-original wp-post-image'
												));
											}
											?>
										</a>
									</div>
								</div>

								<div class="box-text text-left">
									<div class="box-text-inner blog-post-inner">

										<p class="cat-label is-xxsmall op-7 uppercase">
											<?php
											$terms = get_the_terms(get_the_ID(), 'category');
											if ($terms && !is_wp_error($terms)) {
												echo esc_html($terms[0]->name);
											}
											?>
										</p>

										<h5 class="post-title is-large">
											<a href="<?php the_permalink(); ?>" class="plain">
												<?php the_title(); ?>
											</a>
										</h5>

										<div class="is-divider"></div>

										<p class="from_the_blog_excerpt">
											<?php echo wp_trim_words(get_the_excerpt(), 20); ?>
										</p>

									</div>
								</div>

							</div>
						</div>
					</div>

					<?php
					endwhile;
					wp_reset_postdata();
					endif;
					?>

				</div>
			</div>
		</div>
	</div>

</div>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
