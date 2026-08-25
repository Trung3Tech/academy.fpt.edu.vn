<?php
// Shortcode sử dụng trong phần bản đồ trang chủ
add_shortcode('facility_shortcode', 'facility_shortcode');

// Shortcode sử dụng làm slide sự kiện
add_shortcode('event_slide', 'event_slide');

// Shortcode lấy tin mới nhất 
add_shortcode('newest_blogs', 'newest_blogs');

// Shortcode lấy danh sách sự kiện
add_shortcode('event_list', 'event_list');

// Shortcode lấy timeline bên về chúng tôi
add_shortcode('timeline', 'timeline');

// Shortcode banner
add_shortcode('banner_1', 'banner_1');
add_shortcode('banner_2', 'banner_2');
add_shortcode('banner_3', 'banner_3');


// Shortcode sử dụng trong trang báo chí
add_shortcode('tieu_diem_bao_chi', 'tieu_diem_bao_chi');
add_shortcode('bao_chi', 'bao_chi');
add_shortcode('truyen_hinh', 'truyen_hinh');


// Shortcode sử dụng trong trang sinh viên
add_shortcode('sinh_vien_slide', 'sinh_vien_slide');
add_shortcode('sinh_vien_row', 'sinh_vien_row');

// Shortcode sử dụng trong trang dự án
add_shortcode('tieu_diem_du_an', 'tieu_diem_du_an');
add_shortcode('du_an_filter', 'du_an_filter');

// Shortcode sử dụng trong trang tin tưc sự kiện
add_shortcode('su_kien_calendar', 'su_kien_calendar');
add_shortcode('su_kien_cate', 'su_kien_cate');


function tieu_diem_bao_chi() {
	$tieu_diem = get_field('tieu_diem'); 
	$video_html = '';
	$video_url  = '';
	$link       = '';
	$has_video  = '';
?>
	<div class="swiper tieu-diem-swiper">
		<div class="swiper-wrapper">
			<?php foreach($tieu_diem as $tieu) :
				// Kiểm tra xem mục "tiêu điểm" có box video không
				if(!empty($tieu['box_video'])) {
					
					// Lấy URL video:
					// ưu tiên link_video, nếu không có thì lấy link_video_youtube
					$video_url = ($tieu['link_video'] ?: $tieu['link_video_youtube']) ?: '';
					$has_video = 'tieu-diem-video-box';
				} else {
					
					// Nếu không có video thì gán link bài viết bình thường
					$link = 'link="' . $tieu['link'] . '"';
				}
	
				// Nếu có video thì tạo HTML icon play
				if (!empty($video_url)) {
					$video_html = '
						<div class="video-meta" style="cursor: pointer;"><img src="/wp-content/uploads/2026/01/Frame-463-1.svg"></div>
					';
				}
	
	
			?>
				<div class="swiper-slide" style="">
					<?php
						echo do_shortcode('
							[ux_image_box class="tieu-diem-box '. $has_video .'" style="overlay" img="'. $tieu['thumb'] .'" image_height="75%" image_size="original" image_overlay="rgba(0, 0, 0, 0)" text_align="left" '. $link .']
								'. $video_html .'
								[featured_box img="'. $tieu['logo'] .'" inline_svg="0" pos="center" img_width="130"]
									[ux_text class="title" text_align="left"]
										<h3 style="font-size: 1rem;">'. $tieu['content'] .'</h3>
									[/ux_text]
									<p data-fancybox data-src="'. $video_url .'" class="mb-0" style="color: #F56F21; font-weight: bold; margin-top: .5rem; text-align: start;">Xem chi tiết</p>
								[/featured_box]
							[/ux_image_box]
						'); ?>
				</div>
			<?php 
			$video_url  = '';
			$video_html = '';
			$link = '';
			$has_video = '';
			endforeach; ?>
		</div>
	</div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
	<?php
}

function bao_chi() {
	$bao_chi = get_field('bao_chi'); 
?>
	<div class="swiper bao-chi-swiper">
		<div class="swiper-wrapper">
			<?php foreach($bao_chi as $tieu) :
			?>
				<div class="swiper-slide" style="">
					<a href="<?php echo $tieu['link']; ?>">
						<?php echo do_shortcode('[ux_image class="img-radius-10" id="'. $tieu['thumb'] .'" image_size="original" height="75%"]'); ?>
						<div class="title" style="font-weight: bold; margin-top: .8rem;">
							<h3 class="mb-0" style="font-size: 1rem;"><?php echo $tieu['content']; ?></h3>
						</div>
						<p class="mb-0" style="color: #F56F21; font-weight: bold; margin-top: .5rem;">Xem chi tiết</p>
					</a>
				</div>
			<?php 
			endforeach; ?>
		</div>
	</div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
	<?php
}

function truyen_hinh() {
	$tieu_diem = get_field('truyen_hinh'); 
	$video_html = '';
	$video_url  = '';
?>
	<div class="swiper truyen-hinh-swiper">
		<div class="swiper-wrapper">
			<?php foreach($tieu_diem as $tieu) :
				// Lấy link video:
				// ưu tiên 'link_video', nếu không có thì lấy 'link_video_youtube'
				$video_url = ($tieu['link_video'] ?: $tieu['link_video_youtube']) ?: '';
	
				// Nếu có video thì tạo HTML icon play
				if (!empty($video_url)) {
					$video_html = '
						<div class="video-meta" data-fancybox data-src="'. $video_url .'" style="cursor: pointer;"><img src="/wp-content/uploads/2026/01/Frame-463-1.svg"></div>
					';
				}
			?>
				<div class="swiper-slide truyen-hinh-slide" data-fancybox data-src="<?php echo $video_url ?>" style="cursor: pointer;">
					<?php
						// Hiển thị icon play nếu có video
						if (!empty($video_url)) : ?>
						<div class="video-meta-second"><img src="/wp-content/uploads/2026/01/Frame-463-1.svg"></div>
					<?php endif;?>
					
					<?php echo do_shortcode('[ux_image class="img-radius-10" id="'. $tieu['thumb'] .'" image_size="original" height="75%"]'); ?>
					<div class="title" style="font-weight: bold; margin-top: .8rem;">
						<h3 class="mb-0" style="font-size: 1rem;"><?php echo $tieu['content']; ?></h3>
					</div>
					<p class="mb-0" style="color: #F56F21; font-weight: bold; margin-top: .5rem;">Xem chi tiết</p>
				</div>
			<?php 
			$video_url  = '';
			$video_html = '';
			endforeach; ?>
		</div>
	</div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
	<?php
}

function banner_1() {
	$first_banner = get_field('first_banner', 'option');
	$first_banner_link = get_field('first_banner_link', 'option');
	// Kiểm tra nếu có ảnh banner thứ nhất
	if (!empty($first_banner)) {
		echo do_shortcode('[ux_image class="img-radius-10" id="'. $first_banner .'" image_size="original" height="" link="'. $first_banner_link .'"]');
	}
}

function banner_2() {
	$second_banner = get_field('second_banner', 'option');
	$second_banner_link = get_field('second_banner_link', 'option');
	
	// Kiểm tra nếu có ảnh banner thứ hai
	if (!empty($second_banner)) {
		echo do_shortcode('[ux_image class="img-radius-10" id="'. $second_banner .'" image_size="original" height="" link="'. $second_banner_link .'"]');
	}
}

function banner_3() {
	$third_banner = get_field('third_banner', 'option');
	$third_banner_link = get_field('third_banner_link', 'option');
	// Kiểm tra nếu có ảnh banner thứ ba
	if (!empty($third_banner)) {
		echo do_shortcode('[ux_image class="img-radius-10" id="'. $third_banner .'" image_size="original" height="" link="'. $third_banner_link .'"]');
	}
}


function timeline() {
	$timeline = get_field('timeline', 'option'); ?>
	
	<div class="row row-large">
		<!-- Cột bên trái: hiển thị nội dung timeline -->
		<div class="col large-10">
			<?php foreach($timeline as $time) { 
				$content = $time['content'];
				$year = $time['year'];
				$img_id  = $time['img'];
			?>
				<?php // -- Mỗi section tương ứng một mốc năm ?>
				<div class="history-section row align-middle" id="year-<?php echo $year; ?>">
					<div class="col large-1 small-col-first medium-col-first pad-bot-mobile-0">
						<div class="year"><?php echo $year; ?></div>
					</div>
					<div class="col large-6">
						<div class="text-justify"><?php echo $content; ?></div>
					</div>
					<div class="col large-5 small-col-first medium-col-first">
						<?php echo do_shortcode('[ux_image class="img-radius-10" id="'. $img_id .'" image_size="original" height="56.25%"]'); ?>
					</div>
				</div>

			<?php } ?>
		</div>
		
		<?php // Cột bên phải: menu timeline sticky để nhảy đến từng năm  ?>
		<div class="col large-2 small-col-first medium-col-first pad-bot-mobile-0">
			<div class="is-sticky-column" data-sticky-mode="javascript">
				<div class="timeline">
					<?php foreach($timeline as $time) { $year = $time['year']; ?>
					
						<?php // Anchor link tới section tương ứng ?>
						<a href="#year-<?php echo $year; ?>" class="timeline-year">
							<?php echo $year; ?>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php
}

function newest_blogs() {
	// Lấy 5 bài viết mới nhất
	$args = [
		'post_type'      => 'post',
		'posts_per_page' => 5,
		'post_status'    => 'publish',
	];

	$query = new WP_Query($args);
	
	while ($query->have_posts()) : $query->the_post();
		$img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		$excerpt = wp_trim_words( get_the_excerpt(), 15, '...' );
		$title    = get_the_title();
		$link     = get_permalink();
	
	    // đổ dữ liệu vào file blog-sideabar-item
		get_template_part_with_data('components/blog-sidebar-item', [
			'img_url' => $img_url,
			'title' => $title,
			'excerpt' => $excerpt,
			'link'  => $link,
		]);
	endwhile;
}


function event_list() {
	// Lấy 4 sự kiện mới nhất
	$args = [
		'post_type'      => 'su-kien',
		'posts_per_page' => 4,
		'post_status'    => 'publish',
	];

	$query = new WP_Query($args);

	if (!$query->have_posts()) return;
	ob_start(); ?>
		<div class="row">
			<?php
			while ($query->have_posts()) : $query->the_post();
				$thumb_id = get_post_thumbnail_id(get_the_ID());
				$title    = get_the_title();
				$hour     = get_field('hour');	
				$date = DateTime::createFromFormat('d/n/Y', get_field('date'));
				$day   = $date->format('d');
				$month = $date->format('m');
				$hour = date('H:i', strtotime($hour));
				$address  = get_field('address');
				$link     = get_permalink();
	 			// đổ dữ liệu vào file event-item
				echo '<div class="col large-6 medium-6 small-12">';
					get_template_part_with_data('components/event-item', [
						'thumb_id' => $thumb_id,
						'title' => $title,
						'hour' => $hour,
						'day' => $day,
						'month' => $month,
						'address' => $address,
						'link'  => $link,
					]);
					echo '</div>';
				endwhile;
			?>
		</div>
	<?php
	return ob_get_clean();
}


function event_slide() {
	// Lấy 8 sự kiện mới nhất
	$args = [
		'post_type'      => 'su-kien',
		'posts_per_page' => 8,
		'post_status'    => 'publish',
	];

	$query = new WP_Query($args);

	if ( ! $query->have_posts() ) return;

	ob_start();
	?>

	[ux_slider style="container" slide_width="441px" nav_pos="outside" class="sliderow" timer="2000"]
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();

					$thumb_id = get_post_thumbnail_id(get_the_ID());
					$title    = get_the_title();
					$hour     = get_field('hour');	
					$date = DateTime::createFromFormat('d/n/Y', get_field('date'));
					$day   = $date->format('d');
					$month = $date->format('m');
					$hour = date('H:i', strtotime($hour));
					$address  = get_field('address');
					$link     = get_permalink();
					
					?>
					[row]
						[col span__sm="12"]

					<?php 
					// đổ dữ liệu vào file event-item
					get_template_part_with_data(
						'components/event-item',
						[
							'thumb_id' => $thumb_id,
							'title'    => $title,
							'hour'     => $hour,
							'day'      => $day,
							'month'    => $month,
							'address'  => $address,
							'link'     => $link,
						]
					);
?>
	[/col]
		[/row]
				<?php endwhile;
				?>
	[/ux_slider]

	<?php
	wp_reset_postdata();

	// parse shortcode sau khi đã có HTML
	return do_shortcode( ob_get_clean() );
}



function facility_shortcode(){
	// Lấy map icon cho các chương trình đào tạo
	global $centers_icon_map;
	$regions = get_field('regions', 'option');
	?>
	<div class="row row-large">
		<?php // Cột trái: danh sách cơ sở theo từng khu vực ?>
		<div class="col large-7 medium-6">
			<div class="region-list">
				<?php foreach($regions as $region_index => $region) :
					$locations = $region['locations'];
					$region_name = $region['region_name'];
				?>
					<div class="region-listing" id="region-<?php echo $region_index; ?>">
						<p class="region-heading text-center"><?php echo $region_name; ?></p>
						<div class="row align-center">
							<div class="col large-7">
						<?php // Swiper hiển thị từng cơ sở cho từng khu vực ?>
						<div class="swiper map-img-swiper">
							<div class="swiper-wrapper">
								<?php foreach($locations as $index => $location) : 
									$gallery = $location['gallery'];
									$video_url = ($location['link_video_youtube'] ?: $location['video']) ?: '';
									$address = $location['address'];
									$phone_num = $location['phone_num'];
									$centers = $location['vien_dao_tao'];

									$unique_id = "gallery-" . $region_index . "-" . $index;
									$btn_title = $location['btn_title'];
									$btn_link = $location['btn_link'];
								?>
									<div class="swiper-slide">

										<div class="location-item">

											<div class="location-detail">
												<div class="location-item-img-container">
													
													<?php 
													// Ảnh đại diện + gallery ẩn cho Fancybox
													echo do_shortcode('[ux_image id="'. $gallery[0] .'" image_size="original" height="70%"]'); ?>
													<?php foreach($gallery as $index => $img) : ?>
														<img src="<?php echo $img; ?>" data-fancybox="gallery" style="display: none;">
													<?php endforeach;?>
													
													<?php // Nút mở video và gallery ?>
													<div class="media-container">
														<div class="media open-video" data-fancybox data-src="<?php echo esc_url($video_url); ?>">
															<img src="/wp-content/uploads/2026/01/Vector-3.svg">
															<span>Xem video</span>
														</div>
														<div class="media open-gallery" data-fancybox="gallery" >
															<img src="/wp-content/uploads/2026/01/16410-1.svg">
															<span>Xem ảnh</span>
														</div>
													</div>

												</div>

												<div class="location-info">
													<p><strong>Địa chỉ: </strong><?php echo $address; ?></p>
													<p><strong>SĐT: </strong><?php echo $phone_num; ?></p>
													<p><strong>Chương trình</strong></p>
													<div class="centers">
														<?php foreach($centers as $center) :
															// Lấy icon tương ứng với từng chương trình
															$img_url = $centers_icon_map[$center] ?? '';
														?>
															<img src="<?php echo $img_url; ?>">

														<?php endforeach; ?>
													</div>
													<a href="<?php echo $btn_link; ?>"><button class="button primary expanded"><?php echo $btn_title; ?></button></a>
												</div>

											</div>
										</div>
									</div>
								<?php endforeach; ?>
								
							</div>
						
						</div>
								<div class="swiper-button-next"></div>
								<div class="swiper-button-prev"></div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		<?php  // Cột phải: bản đồ + marker từng khu vự ?>
		<div class="col large-4 medium-6">
			<div class="" style="text-align: end;">
				<div class="col-inner">
					<img src="/wp-content/uploads/2026/01/Group-39649.svg" style="width: 100;">
					<?php foreach($regions as $index => $region) :
						$region_name = $region['region_name'];
						$top = $region['top'];
						$left = $region['left'];
						$title = $region['title'];
						$is_right = $region['is_right'];
						$flex_direction = 'row';
	
						// Xác định hướng hiển thị label
						if(!$is_right) {
							$flex_direction = 'row-reverse'; 
						}
					?>
						<?php // Marker khu vực ?>
						<div class="region-item region-<?php echo $index; ?>" style="height: auto;">
							<img class="region-marker region-<?php echo $index; ?>" src="/wp-content/uploads/2026/01/Vectorsss.svg">
							<span class="region-name"><?php echo $title; ?></span>
						</div>
						<?php // CSS động để đặt đúng vị trí marker ?>
						<style>
							.region-<?php echo $index; ?> {
								top: <?php echo $top; ?>;
								left: <?php echo $left; ?>;
								flex-direction: <?php echo $flex_direction; ?>
							}
						</style>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function sinh_vien_slide() {
	// Lấy tất cả sinh viên
	$args = array(
		'post_type'      => 'sinh-vien',
		'posts_per_page' => -1, 
		'post_status'    => 'publish',
	);

	$query = new WP_Query($args);
	?>
	<div class="swiper sinh-vien-noi-bat-swiper" style="width: 100%;">
		<div class="swiper-wrapper"  style="width: 100%;">
			<?php if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
						$thumbnail_id = get_post_thumbnail_id(get_the_ID());
						$study = get_field('study');
						$is_featured = get_field('is_featured');
	
						// Lấy danh mục thuộc taxonomy 'danh-muc-sinh-vien'
						$terms = get_the_terms(get_the_ID(), 'danh-muc-sinh-vien');

						// Nếu có danh mục, lấy tên của term đầu tiên
						if(!empty($terms) && !is_wp_error($terms)){
							foreach($terms as $term){
								$term_name = $term->name;
								break;
							}
						}
	
						// Bỏ qua nếu không phải sinh viên nổi bật
						if(!$is_featured) continue;
				?>
				<div class="swiper-slide sinh-vien-item" style="">
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<div class="row row-collapse align-middle">
							<div class='col large-6'>
								<?php echo do_shortcode('[ux_image id="'. $thumbnail_id .'" image_size="original" width="100%" height="60%" class="img"]'); ?>
							</div>
							<div class='col large-6 '>
								<div class="sinh-vien-info">
									<p style="margin-bottom: 8px; color: #F56F21; font-weight: bold;"><?php echo $term_name; ?></p>
									<p style="margin-bottom: 8px; font-weight: bold;"><?php the_title(); ?></p>
									<p style="margin-bottom: 8px;"><?php echo $study; ?></p>
									<div class="content">
										<?php echo wp_strip_all_tags(get_the_content()); ?>
									</div>
									<div style="display: flex; align-items: center; gap: .5rem; margin-top: .5rem;">
										<p class="mb-0" style="color: #F56F21; font-weight: bold; font-size: 14px;">Đọc bài viết</p>
										<img decoding="async" src="/wp-content/uploads/2026/02/faArrowRightLong.svg">
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<?php
					endwhile; 
					endif; 
				?>
		</div>
	</div>
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
	<?php
}

function sinh_vien_row($atts) {
	// Nhận tham số shortcode, mặc định term rỗng
	$atts = shortcode_atts(array(
        'term' => '',
    ), $atts, 'sinh_vien_row');

    $tax_query = array();

	// Nếu có truyền term thì lọc theo taxonomy 'danh-muc-sinh-vien'
    if (!empty($atts['term'])) {
        $tax_query[] = array(
            'taxonomy' => 'danh-muc-sinh-vien', 
            'field'    => 'slug',
            'terms'    => $atts['term'],
        );
    }

	// Lấy sinh viên
    $args = array(
        'post_type'      => 'sinh-vien',
        'posts_per_page' => 16,
        'post_status'    => 'publish',
        'tax_query'      => $tax_query,
    );

    $query = new WP_Query($args);


?>
	<div class="swiper sinh-vien-row-swiper">
		<div class="swiper-wrapper">
			<?php if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
						$thumbnail_id = get_post_thumbnail_id(get_the_ID());
				?>
				<div class="swiper-slide sinh-vien-item" style="">
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<?php echo do_shortcode('[ux_image class="img-radius-10" id="'. $thumbnail_id .'" image_size="original" height="75%"]'); ?>
						<div style="margin-top: 8px;">
							<p class="title" style="font-weight: bold; margin-bottom: 3px; font-size: 18px;"><?php echo the_title(); ?></p>
						</div>
						<div style="display: flex; align-items: center; gap: .5rem; margin-top: .5rem;">
							<p class="mb-0" style="color: #F56F21; font-weight: bold; font-size: 14px;">Đọc bài viết</p>
							<img src="/wp-content/uploads/2026/02/faArrowRightLong.svg">
						</div>
					</a>
				</div>
			<?php 
			endwhile;
			endif; ?>
		</div>
	</div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
	<?php
}

function tieu_diem_du_an() {
	// Lấy tất cả dự án
	$args = array(
		'post_type'      => 'featured_item',
		'posts_per_page' => -1, 
		'post_status'    => 'publish',
	);

	$query = new WP_Query($args);
	?>
	<div class="swiper du-an-noi-bat-swiper" style="width: 100%;">
		<div class="swiper-wrapper"  style="width: 100%;">
			<?php if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
						$thumbnail_id = get_post_thumbnail_id(get_the_ID());
						$is_featured = get_field('is_featured');
						// Bỏ qua nếu không phải dự án nổi bật
						if(!$is_featured) continue;
				?>
				<div class="swiper-slide du-an-item" style="">
					<a href="<?php echo esc_url(get_permalink()); ?>" style="color: black;">
						<?php echo do_shortcode('[ux_image id="'. $thumbnail_id .'" image_size="original" width="100%" height="75%" class="img-radius-10"]'); ?>
						<div style="margin-top: 8px;">
							<p class="title" style="margin-bottom: 8px; font-weight: bold; font-size: 18px;"><?php the_title(); ?></p>
							<div class="content">
								<?php // Hiển thị 20 từ đầu của nội dung bài viết ?>
								<?php echo wp_trim_words(get_the_content(), 20, '...'); ?>
							</div>
							<div style="display: flex; align-items: center; gap: .5rem; margin-top: .5rem;">
								<p class="mb-0" style="color: #F56F21; font-weight: bold; font-size: 14px;">Xem đồ án</p>
								<img src="/wp-content/uploads/2026/02/faArrowRightLong.svg">
							</div>
						</div>
					</a>
				</div>
				<?php
					endwhile; 
					endif; 
				?>
		</div>
	</div>
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
	<?php
}

function du_an_filter() {
	// Lấy trang hiện tại
    $paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	// Lấy giá trị filter từ URL
    $search   = $_GET['keyword'] ?? '';
    $category = $_GET['featured_category'] ?? '';
	
	// Nếu có lọc/tìm kiếm thì reset về trang 1
	if (!empty($search) || !empty($category)) {
   		$paged = 1;
	}
	
	// Lấy dự án
    $args = array(
        'post_type'      => 'featured_item',
        'posts_per_page' => 9,
        'post_status'    => 'publish',
        'paged'          => $paged,
    );

	// Nếu chọn ngành học thì lọc theo taxonomy
    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'featured_item_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

	// Nếu có từ khóa tìm kiếm thì chỉ search theo tiêu đề bài viết
    if (!empty($search)) {
        $search_filter = function($where) use ($search) {
            global $wpdb;
            $where .= $wpdb->prepare(
                " AND {$wpdb->posts}.post_title LIKE %s",
                '%' . $wpdb->esc_like($search) . '%'
            );
            return $where;
        };
        add_filter('posts_where', $search_filter);
    }

    $query = new WP_Query($args);

	// Xóa filter search để tránh ảnh hưởng query khác
    if (!empty($search)) {
        remove_filter('posts_where', $search_filter);
    }

	// Lấy danh sách taxonomy để render dropdown filter
    $taxonomy = 'featured_item_category';
    $terms    = get_terms([
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ]);
    ?>
	<div class="text-center">
		<div class="project-filter-bar">
			<?php // Form lọc theo ngành học ?>
			<form method="get" class="project-filter-bar">
				<div class="content" style="display: flex; width: 100%;">
					<select name="featured_category">
						<option value="">Chọn ngành học</option>
						<?php foreach ($terms as $term) : ?>
						<option 
								value="<?php echo esc_attr($term->slug); ?>"
								<?php selected($_GET['featured_category'] ?? '', $term->slug); ?>
								>
							<?php echo esc_html($term->name); ?>
						</option>
						<?php endforeach; ?>
					</select>

				</div>

				<button type="submit" class="submit">Tìm kiếm</button>
			</form>
		</div>
	</div>
	<div style="width: 100%;">
		<?php // Bộ sắp xếp (JS sort: nổi bật / mới nhất) ?>
		<div style="text-align:end; margin-bottom: 12px; padding-right: 15px; display: flex; align-items: center; justify-content: end;gap: 8px;">
			<strong>Sắp xếp: </strong>
			<div class="du-an-sort">
				<a href="#" class="sort-btn active" data-sort="featured"> Nổi bật</a> |
				<a href="#" class="sort-btn" data-sort="latest">Mới nhất</a>
			</div>
		</div>
		<?php // Danh sách dự án ?>
		<div class="row row-small list-du-an">
			<?php if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
						$thumbnail_id = get_post_thumbnail_id(get_the_ID());
						$is_featured = get_field('is_featured');
				?>
				<div class="col large-4 small-6" style="">
					<a href="<?php echo esc_url(get_permalink()); ?>" class="du-an-item" data-featured="<?php echo $is_featured ? '1' : '0'; ?>" data-date="<?php echo get_the_date('Y-m-d H:i:s'); ?>" >
						<?php echo do_shortcode('[ux_image image_hover="zoom" id="'. $thumbnail_id .'" image_size="original" width="100%" height="75%" class="img-radius-10 "]'); ?>
						<div style="margin-top: 8px;">
							<p class="title" style="margin-bottom: 8px; font-weight: bold; font-size: 18px;"><?php the_title(); ?></p>
							<div class="content">
								<?php
									$content = get_the_content();
									$content = wp_strip_all_tags($content);
									echo wp_trim_words($content, 30, '...');
								?>
							</div>
							<div style="display: flex; align-items: center; gap: .5rem; margin-top: .5rem;">
								<p class="mb-0" style="color: #F56F21; font-weight: bold; font-size: 14px;">Xem đồ án</p>
								<img src="/wp-content/uploads/2026/02/faArrowRightLong.svg">
							</div>
						</div>
					</a>
				</div>
				<?php
					endwhile; 
					else :
						echo '<div class="text-center">Không có kết quả</div>';
					endif; 
				?>
		
				<?php // Hiển thị phân trang nếu có nhiều hơn 1 trang ?>
				<?php if ($query->max_num_pages > 1) : ?>
					<div class="du-an-pagination" style="text-align:center; margin-top: 30px;">
						<?php
							echo paginate_links(array(
								'total'   => $query->max_num_pages,
								'current' => $paged,
								'format'  => '?paged=%#%',
								'prev_text' => '«',
								'next_text' => '»',
							));
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php
}

function su_kien_calendar() { 
	// Lấy năm và tháng hiện tại
	$current_year  = date('Y');
	$current_month = date('m');

	// Tạo chuỗi để tìm sự kiện theo field 'date' (ví dụ: 202602
	$search_string = $current_year . $current_month; 

	// Lấy tẩt cả sự kiện trong tháng hiện tại
	$args = [
		'post_type'      => 'su-kien',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'meta_query'     => [
			[
				'key'     => 'date',
				'value'   => $search_string,
				'compare' => 'LIKE',
			],
		],
	];

	$query = new WP_Query($args);
	
?>
	<div class="row row-small">
		<div class="col large-4">
			<div class="su-kien-main-large">
			<?php 
				// Hiển thị sự kiện đầu tiên làm sự kiện nổi bật
				if ($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post();

						$thumbnail_id = get_post_thumbnail_id();
						$hour = get_field('hour');
						$date = get_field('date');
						$address = get_field('address');
				?>
						<div class="event-main">
							<?php echo do_shortcode('[ux_image id="'. $thumbnail_id .'" image_size="original" width="100%" height="75%" class="event-main-img" link="'. get_permalink() .'"]'); ?>
							<div class="event-info">
								<h3 style="color: #EF7125;">
									<a href="<?php echo esc_url(get_permalink()); ?>">
										<?php the_title(); ?>
									</a></h3>
								<div class="event-info-detail" style="">
									<div style="display: flex; align-items: center; gap: 8px; color: #7F7F7F; font-size: 14px;"><img src="/wp-content/uploads/2026/02/Vector-7.svg"><?php echo $hour?> | <?php echo $date; ?></div>
									<div style="display: flex; align-items: center; gap: 8px; font-size: 14px;"><img src="/wp-content/uploads/2026/02/faMapMarkerAlt-3.svg"> <?php echo $address; ?></div>
								</div>
							</div>
						</div>
				<?php
						// Chỉ lấy sự kiện đầu tiên rồi dừng 
						break; 
					}

					wp_reset_postdata();

					} else {
						echo 'Chưa có sự kiện tháng này.';
					}
				?>
			</div>
		</div>
		<?php // Container để JS render lịch sự kiện ?>
		<div class="col large-4">
			<div id="eventsCalendar" style="height: 100%;"></div>
		</div>
		<div class="col large-4">
			<div class="event-result">
				<?php 
					// Reset con trỏ query để lặp lại danh sách sự kiện
					$query->rewind_posts();	
					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							$hour = get_field('hour');
							$hour = date('H:i', strtotime($hour));
							$address = get_field('address');
							
							// Chuyển ngày sang object để tách ngày/tháng
							$date = DateTime::createFromFormat('d/n/Y', get_field('date'));
							$day   = $date->format('d');
							$month = $date->format('m');
								?>
								<a href="<?php echo get_permalink(); ?>" class="event-sub event-item">
									<div class="event-time">
										<?php if ($hour): ?>
										<div class="event-hour">
											<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
												<g clip-path="url(#clip0_2006_4616)">
													<path d="M7 0C8.85652 0 10.637 0.737498 11.9497 2.05025C13.2625 3.36301 14 5.14348 14 7C14 8.85652 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85652 14 7 14C5.14348 14 3.36301 13.2625 2.05025 11.9497C0.737498 10.637 0 8.85652 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0ZM6.34375 3.28125V7C6.34375 7.21875 6.45312 7.42383 6.63633 7.54688L9.26133 9.29688C9.56211 9.49922 9.96953 9.41719 10.1719 9.11367C10.3742 8.81016 10.2922 8.40547 9.98867 8.20312L7.65625 6.65V3.28125C7.65625 2.91758 7.36367 2.625 7 2.625C6.63633 2.625 6.34375 2.91758 6.34375 3.28125Z" fill="white"/>
												</g>
												<defs>
													<clipPath id="clip0_2006_4616">
														<rect width="14" height="14" fill="white"/>
													</clipPath>
												</defs>
											</svg>
											<span><?php echo esc_html($hour); ?></span>
										</div>
										<?php endif; ?>
										<div class="event-date">
											<div class="event-day"><span><?php echo esc_html($day); ?></span></div>
											<div class="event-month">Tháng <?php echo esc_html($month); ?></div>
										</div>
									</div>
									<div class="event-info">
										<h3 style="color: #EF7125; font-size: 18px;"><?php the_title(); ?></h3>
										<div style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #969696;"><img src="/wp-content/uploads/2026/02/faMapMarkerAlt-4.svg"> <?php echo $address; ?></div>
									</div>
								</a>
								<?php
						}

						// Reset dữ liệu global sau custom query
						wp_reset_postdata();
					} else {
						echo 'Chưa có sự kiện tháng này.';
					}
				?>
			</div>
		</div>
	</div>
<?php
}

function su_kien_cate() {
	// Lấy danh mục sự kiện
	$terms = get_terms([
		'taxonomy'   => 'danh-muc-su-kien',
		'hide_empty' => false,
	]);

	// Sắp xếp theo field ACF number để hiển thị dựa trên vị trí đã nhập
	if (!empty($terms) && !is_wp_error($terms)) {
		usort($terms, function ($a, $b) {
			$order_a = (int) get_field('number', 'danh-muc-su-kien_' . $a->term_id);
			$order_b = (int) get_field('number', 'danh-muc-su-kien_' . $b->term_id);

			return $order_a <=> $order_b;
		});
	}
?>
	<div class="tabbed-content su-kien-tab">
		<?php // Navigation tabs: tab theo từng danh mục ?>
		<ul class="nav nav-pills nav-normal nav-size-normal nav-left" role="tablist">
			<?php if (!empty($terms) && !is_wp_error($terms)) : ?>
				<?php foreach ($terms as $index => $term) : ?>
					<li
						id="tab-<?php echo esc_attr($term->slug); ?>-title"
						class="tab has-icon <?php echo $index === 0 ? 'active' : ''; ?>"
						role="presentation">
						<a
							href="#tab_<?php echo esc_attr($term->slug); ?>"
							role="tab"
							aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
							aria-controls="tab_<?php echo esc_attr($term->slug); ?>">
							<span><?php echo esc_html($term->name); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>

		<div class="tab-panels">

			<?php // Render các tab theo từng danh mục sự kiện ?>
			<?php if (!empty($terms) && !is_wp_error($terms)) : ?>
				<?php foreach ($terms as $index => $term) : ?>

					<div id="tab_<?php echo esc_attr($term->slug); ?>"
						 class="panel entry-content <?php echo $index === 0 ? 'active' : ''; ?>"
						 role="tabpanel">

						<div class="row row-large tin-tuc-su-kien-row">
							<?php
							$term_events = new WP_Query([
								'post_type'      => 'su-kien',
								'posts_per_page' => 6,
								'tax_query'      => [
									[
										'taxonomy' => 'danh-muc-su-kien',
										'field'    => 'term_id',
										'terms'    => $term->term_id,
									],
								],
							]);

							if ($term_events->have_posts()) :
								while ($term_events->have_posts()) :
									$term_events->the_post();

									$thumb_id = get_post_thumbnail_id(get_the_ID());
									$title    = get_the_title();
									$hour     = get_field('hour');
									$date     = DateTime::createFromFormat('d/n/Y', get_field('date'));

									$day      = $date ? $date->format('d') : '';
									$month    = $date ? $date->format('m') : '';

									$hour     = $hour ? date('H:i', strtotime($hour)) : '';
									$address  = get_field('address');
									$link     = get_permalink();

									// Đổ dữ liệu vào file event-item
									echo '<div class="col large-4">';
									get_template_part_with_data('components/event-item', [
										'thumb_id' => $thumb_id,
										'title'    => $title,
										'hour'     => $hour,
										'day'      => $day,
										'month'    => $month,
										'address'  => $address,
										'link'     => $link,
									]);
									echo '</div>';

								endwhile;
							else :
								echo '<div class="text-center">Chưa có sự kiện</div>';
							endif;
							?>
						</div>

						<!-- 		Slide		 -->
						<div class="tin-tuc-su-kien-slide">
							<?php if (!$term_events->have_posts() && $term_events->post_count === 0) : ?>
								<div class="text-center">Chưa có sự kiện</div>
							<?php else : ?>

								<div class="swiper tin-tuc-su-kien-row-swiper">
									<div class="swiper-wrapper">
										<?php
										$term_events->rewind_posts();

										if ($term_events->have_posts()) :
											while ($term_events->have_posts()) :
												$term_events->the_post();

												$thumb_id = get_post_thumbnail_id(get_the_ID());
												$title    = get_the_title();
												$hour     = get_field('hour');
												$date     = DateTime::createFromFormat('d/n/Y', get_field('date'));

												$day      = $date ? $date->format('d') : '';
												$month    = $date ? $date->format('m') : '';

												$hour     = $hour ? date('H:i', strtotime($hour)) : '';
												$address  = get_field('address');
												$link     = get_permalink();
										?>
												<div class="swiper-slide tin-tuc-su-kien-item">
													<?php
													// Đổ dữ liệu vào file event-item
													get_template_part_with_data('components/event-item', [
														'thumb_id' => $thumb_id,
														'title'    => $title,
														'hour'     => $hour,
														'day'      => $day,
														'month'    => $month,
														'address'  => $address,
														'link'     => $link,
													]);
													?>
												</div>
										<?php
											endwhile;
										endif;
										?>
									</div>
								</div>

								<div class="swiper-button-prev"></div>
								<div class="swiper-button-next"></div>

							<?php endif; ?>
						</div>

						<?php wp_reset_postdata(); ?>

					</div>

				<?php endforeach; ?>
			<?php endif; ?>

		</div>
	</div>

<?php
}