<?php
// Include file helper và file shortcode
include_once get_stylesheet_directory() . '/shortcodes.php';
include_once get_stylesheet_directory() . '/helper.php';
function enqueue_scripts() {
    $dir = get_stylesheet_directory();
    $uri = get_stylesheet_directory_uri();

	// Load các thư viện dùng chung 	
    wp_enqueue_script('jquery');
	wp_enqueue_style('swiper-style', $uri . '/assets/css/swiper-bundle.min.css', [], filemtime($dir . '/assets/css/swiper-bundle.min.css'));
    wp_enqueue_script('swiper-script', $uri . '/assets/js/swiper-bundle.min.js', [], filemtime($dir . '/assets/js/swiper-bundle.min.js'), true);
	
	wp_enqueue_script('timeline', $uri . '/assets/js/timeline.js', [], null, true);
	
	// Chỉ load ở những trang cụ thể 	
	if (is_page('trang-chu')) {
		wp_enqueue_style('fancybox-style', $uri . '/assets/css/fancybox.css', [], filemtime($dir . '/assets/css/fancybox.css'));
		wp_enqueue_script('fancybox-script', $uri . '/assets/js/fancybox.umd.js', [], filemtime($dir . '/assets/js/fancybox.umd.js'), true);
		wp_enqueue_script('map-script', $uri . '/assets/js/map.js', [], null, true);
	}
	
	if (is_page('tin-tuc-su-kien')) {
		wp_enqueue_style('vanilarCalendar-style', $uri . '/assets/css/vanilaCalender.css', [], filemtime($dir . '/assets/css/vanilaCalender.css'));
		wp_enqueue_script('vanilarCalendar-script', $uri . '/assets/js/vanilaCalendar.js', [], filemtime($dir . '/assets/js/vanilaCalendar.js'), true);
	}
	
	if ( is_page('bao-chi') ) {
		wp_enqueue_script('bao-chi', $uri . '/assets/js/bao-chi.js', [], null, true);
		wp_enqueue_style('fancybox-style', $uri . '/assets/css/fancybox.css', [], filemtime($dir . '/assets/css/fancybox.css'));
		wp_enqueue_script('fancybox-script', $uri . '/assets/js/fancybox.umd.js', [], filemtime($dir . '/assets/js/fancybox.umd.js'), true);
	}
	
	if ( is_page('guong-mat-truyen-cam-hung') ) {
		wp_enqueue_script('guong-mat-tieu-bieu', $uri . '/assets/js/sinh-vien.js', [], null, true);
	}
	
	if ( is_page('do-an-sinh-vien-fai') ) {
		wp_enqueue_script('do-an-xuat-sac', $uri . '/assets/js/du-an.js', [], null, true);
	}
	
	if ( is_page('tin-tuc-su-kien') ) {
		wp_enqueue_script('tin-tuc-su-kien', $uri . '/assets/js/tin-tuc-su-kien.js', [], null, true);
	}
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');


// Tạo option page có tên cài đặt trang
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
        'page_title'    => 'Cài đặt trang',
        'menu_title'    => 'Cài đặt trang',
        'menu_slug'     => 'page-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// Tạo 2 CPT sự kiện và sinh viên
PostTypeBuilder::make('su-kien', 'Sự kiện')
				->setArgs(['menu_icon' => 'dashicons-clipboard', 'menu_position' => 5,])
				->addTaxonomy('danh-muc-su-kien', 'Danh mục sự kiện')
				->register();

PostTypeBuilder::make('sinh-vien', 'Sinh viên tiêu biểu')
				->setArgs(['menu_icon' => 'dashicons-groups', 'menu_position' => 6,])
				->addTaxonomy('danh-muc-sinh-vien', 'Danh mục sinh viên')
				->register();

// Tùy chỉnh dữ liệu cho ACF field (select / checkbox)
// Dùng để khi thêm viện đào tạo mới ở cài đặt trang, bên khu vực cũng sẽ hiển thị viện đào tạo tương ứng để chọn
add_filter('acf/load_field/key=field_695b8a59203d4', function ($field) {

    // Reset danh sách lựa chọn của field
    $field['choices'] = [];

    // Tạo biến global để map tên chương trình => icon
    global $centers_icon_map;
    $centers_icon_map = [];

    // Lấy dữ liệu từ repeater field trong Options Page
    if (have_rows('field_695b8a1b203d0', 'option')) {

        while (have_rows('field_695b8a1b203d0', 'option')) {
            the_row();

            // Lấy tên chương trình và icon tương ứng
            $name = get_sub_field('name');
            $icon = get_sub_field('icon');

            if ($name) {

                // Thêm option vào field ACF
                $field['choices'][$name] = $name;

                // Lưu mapping để dùng ngoài frontend
                $centers_icon_map[$name] = $icon;
            }
        }
    }

    // Trả về field đã được cập nhật choices
    return $field;
});

// Hàm dùng để đổ dữ liệu vào block 
function get_template_part_with_data($template, $vars = []) {
    if (!empty($vars)) {
        extract($vars);
    }
    include locate_template($template . '.php');
}

// Thêm custom category badge vào trước mỗi blog post item
add_action('flatsome_blog_post_before', 'add_blog_badge', 5);

function add_blog_badge() {
    $categories = get_the_category();

    if (empty($categories)) return;

    // Chỉ lấy 2 category đầu
    $categories = array_slice($categories, 0, 2);
    ?>

    <div class="custom-post-cats">
        <?php foreach ($categories as $index => $category): ?>
            <span class="cat-item">
                <?php echo esc_html($category->name); ?>
            </span>
		
            <?php // Không phải danh mục cuối thì sẽ hiển thị dấu cam phía sau để chia danh mục ?>
	    <?php if ($index < count($categories) - 1): ?>
		<span class="cat-dot"></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <?php
}

/// Cấu hình post type và taxonomy cần hiển thị thêm cột
$post_type = 'sinh-vien';
$taxonomies = [
    'danh-muc-sinh-vien' => 'Danh mục',
];


// Thêm cột nổi bật vào trang danh sách sinh viên
add_filter("manage_{$post_type}_posts_columns", function($columns) use ($taxonomies){
    
    foreach ($taxonomies as $taxonomy => $label) {
        $columns[$taxonomy] = $label;
    }

    $columns['is_featured'] = 'Nổi bật';

    return $columns;
});

// Thêm value vào cột nổi bật
add_action("manage_{$post_type}_posts_custom_column", function($column, $post_id) use ($taxonomies){

    if (isset($taxonomies[$column])) {
        $terms = get_the_terms($post_id, $column);
        if (!empty($terms) && !is_wp_error($terms)) {
            $out = [];
            foreach ($terms as $term) {
                $out[] = $term->name;
            }
            echo implode(', ', $out);
        } else {
            echo '—';
        }
    }
 	
    if ($column === 'is_featured') {
        $is_featured = get_field('is_featured', $post_id);

        if ($is_featured) {
            echo '<span style="color:#16a34a;font-weight:600;">Có</span>';
        } else {
            echo '<span style="color:#9ca3af;">Không</span>';
        }
    }

}, 10, 2);
// END


// Đăng ký REST API cho dữ liệu sự kiện
add_action('rest_api_init', function () {

	// Lấy danh sách sự kiện theo tháng và năm
	register_rest_route('custom/v1', '/events', [
		'methods'  => 'GET',
		'callback' => function ($request) {

			// Lấy tham số month và year
			$month_param = intval($request->get_param('month'));
			$year_param  = intval($request->get_param('year'));

			// Nếu thiếu tham số thì trả về rỗng
			if (!$month_param  || !$year_param ) {
				return [];
			}

			// Query toàn bộ sự kiện
			$args = [
				'post_type'      => 'su-kien',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
			];

			$query = new WP_Query($args);

			$results = [];

			while ($query->have_posts()) {
				$query->the_post();

				$date = get_field('date'); 
				$hour = get_field('hour');
				$hour = date('H:i', strtotime($hour));
				$address = get_field('address');
				$date = DateTime::createFromFormat('d/n/Y', get_field('date'));
				$day   = $date->format('d');
				$month = $date->format('m');

				
				$date = get_field('date'); 
				if (!$date) continue;

				// Convert ngày sang DateTime để lọc
				$dateObj = DateTime::createFromFormat('d/m/Y', $date);
				
				// Lọc đúng tháng và năm
				if (
					intval($dateObj->format('n')) === $month_param  &&
					intval($dateObj->format('Y')) === $year_param 
				) {
					$results[] = [
						'title' => get_the_title(),
						'link'  => get_permalink(),
						'date'  => $date,
						'date_iso' => $dateObj->format('Y-m-d'),
						'hour' => $hour,
						'address' => $address,
						'day' => $day,
						'month' => $month,
						'thumbnail_link' => get_the_post_thumbnail_url(get_the_ID(), 'original'),
						'content' => get_the_content()
					];
				}
			}

			wp_reset_postdata();

			return $results;
		},
		'permission_callback' => '__return_true',
	]);
	
	
	// Lấy danh sách sự kiện theo ngày cụ thể
	register_rest_route('custom/v1', '/event-by-date', [
		'methods'  => 'GET',
		'callback' => function ($request) {
			
			// Lấy tham số ngày
			$date_param = sanitize_text_field(
				$request->get_param('date')
			);

			if (!$date_param) {
				return [];
			}

			$args = [
				'post_type'      => 'su-kien',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
			];

			$query = new WP_Query($args);

			$results = [];

			while ($query->have_posts()) {
				$query->the_post();

				$date = get_field('date');
				if (!$date) continue;

				// Convert ngày sang DateTime
				$dateObj = DateTime::createFromFormat(
					'd/m/Y',
					$date
				);

				if (!$dateObj) continue;

				$date_iso = $dateObj->format('Y-m-d');

				// Chỉ lấy sự kiện đúng ngày yêu cầu
				if ($date_iso !== $date_param) {
					continue;
				}

				$hour = get_field('hour');
				$hour = $hour
					? date('H:i', strtotime($hour))
					: '';

				$address = get_field('address');

				$results[] = [
					'title' => get_the_title(),
					'link'  => get_permalink(),
					'date'  => $date,
					'date_iso' => $date_iso,
					'hour' => $hour,
					'address' => $address,
					'day' => $dateObj->format('d'),
					'month' => $dateObj->format('m'),
					'thumbnail_link' => get_the_post_thumbnail_url(
						get_the_ID(),
						'original'
					),
					'content' => get_the_content()
				];
			}

			wp_reset_postdata();

			return $results;
		},
		'permission_callback' => '__return_true',
	]);
});

// Override Flatsome shortcodes để thay đổi thẻ heading
add_action('init', function() {
    remove_shortcode('blog_posts');
    remove_shortcode('ux_gallery');
    remove_shortcode('featured_items_slider');
    remove_shortcode('featured_items_grid');
    remove_shortcode('ux_portfolio');

    add_shortcode('blog_posts',          'child_shortcode_latest_from_blog');
    add_shortcode('ux_gallery',          'child_ux_gallery');
    add_shortcode('featured_items_slider', 'child_flatsome_portfolio_shortcode');
    add_shortcode('featured_items_grid',   'child_flatsome_portfolio_shortcode');
    add_shortcode('ux_portfolio',          'child_flatsome_portfolio_shortcode');
}, 20);

// Thay tiêu đề post từ h5 -> h3
function child_shortcode_latest_from_blog($atts, $content = null, $tag = '') {
    $output = shortcode_latest_from_blog($atts, $content, $tag);

	// Nếu là ở các trang sau thì sẽ từ h5 -> h2
	if (is_page(['khoa-hoc-truc-tuyen', 'hoat-dong-doanh-nghiep', 'tuyen-dung-sinh-vien'])) {
		$output = preg_replace('/<h5([^>]*class="post-title[^"]*")>/i', '<h2$1>', $output);
		$output = preg_replace('/<\/h5>/i', '</h2>', $output);
		return $output;
	}
	
    // Trang chi tiết bài viết, bỏ heading 
    if (is_single()) {
        $output = preg_replace('/<h5([^>]*class="post-title[^"]*")>/i', '<p$1>', $output);
        $output = preg_replace('/<\/h5>/i', '</p>', $output);
        return $output;
    }

    // Các trang khác: h5 -> h3
    $output = preg_replace('/<h5([^>]*class="post-title[^"]*")>/i', '<h3$1>', $output);
    $output = preg_replace('/<\/h5>/i', '</h3>', $output);
    return $output;
}

// Bọc khối img của gallery bằng h3
function child_ux_gallery($atts, $content = null, $tag = '') {
    $output = ux_gallery($atts);
    $output = preg_replace(
        '/(<div class="[^"]*box[^"]*has-hover[^"]*gallery-box[^"]*">)(.*?)(<\/div>\s*<\/div>\s*<\/div>)/s',
        '<h3>$1$2$3</h3>',
        $output
    );
    return $output;
}

// Thay h6 -> h3
function child_flatsome_portfolio_shortcode($atts, $content = null, $tag = '') {
    $output = flatsome_portfolio_shortcode($atts, $content, $tag);
    $output = preg_replace('/<h6([^>]*class="[^"]*portfolio-box-title[^"]*")>/i', '<h3$1>', $output);
    $output = preg_replace('/<\/h6>/i', '</h3>', $output);
    return $output;
}

// Đổi tên menu hiển thị của post type "featured_item" thành "Đồ án tiêu biểu"
add_filter('featured_itemposttype_args', function ($args){

    $args['labels']['menu_name'] = 'Đồ án tiêu biểu';

    return $args;
});

// Thêm script accordion cho section "Khám phá đào tạo" trên mobile
add_action('wp_footer', function () { ?>
	<script>
		jQuery(function($){

			// Xử lý accordion theo responsive
			function handleAccordion(){

				// Mobile: bật accordion
				if ($(window).width() < 850) {

					// Ẩn toàn bộ nội dung mặc định
					$('.kham-pha-dao-tao-item').hide();

					// Gắn sự kiện click mở/đóng accordion
					$(document).off('click.mobileAccordion').on(
						'click.mobileAccordion',
						'.kham-pha-dao-tao-item-top',
						function(){

							const $row = $(this).closest('.row');
							const $content = $row.find('.kham-pha-dao-tao-item');

							// Đóng các accordion khác
							$('.kham-pha-dao-tao-item')
								.not($content)
								.stop(true, true)
								.slideUp(100);

							// Toggle accordion hiện tại
							$content
								.stop(true, true)
								.slideToggle(100);
						}
					);

				} else {

					// Desktop: luôn hiển thị toàn bộ nội dung
					$('.kham-pha-dao-tao-item').show();

					// Gỡ sự kiện accordion trên mobile
					$(document).off('click.mobileAccordion');
				}
			}

			// Khởi tạo khi load trang
			handleAccordion();

			// Re-init khi resize màn hình
			$(window).on('resize', function(){
				handleAccordion();
			});

		});
	</script>
<?php });

// Redirect trang "/sinh-vien" sang trang "Gương mặt truyền cảm hứng"
add_action('template_redirect', function () {
    if (trim($_SERVER['REQUEST_URI'], '/') === 'sinh-vien') {
        wp_redirect(home_url('/guong-mat-truyen-cam-hung/'), 301);
        exit;
    }
});

// Ẩn một số menu admin
/*
add_action( 'admin_init', 'remove_menu_pages' );
function remove_menu_pages() {
	remove_menu_page( 'admin.php?page=fonts-plugin' );
	remove_menu_page( 'index.php' );
	remove_menu_page( 'tools.php' );
// 	remove_menu_page( 'edit.php?post_type=acf-field-group' );
	remove_menu_page( 'options-general.php' );
    remove_menu_page( 'edit-comments.php' );
}

add_action('admin_head', 'wpcb_disable_notice');
function wpcb_disable_notice() { ?> <style> .notice { display: none;} </style> <?php }

add_filter('pre_site_transient_update_plugins', '__return_null');
*/

// END


// Bao Mat 
/**
 * TỔNG HỢP CODE BẢO MẬT GIẢI QUYẾT LỖI QUÉT TỪ OWASP ZAP
 */

// 1. Thêm các Security Headers (CSP, HSTS, Anti-clickjacking, X-Content-Type)
function add_security_headers_optimized() {
/*	Comment by ThuanHQ - 09/05/2026
    // Cấu hình Content Security Policy (CSP) khắt khe nhưng vẫn cho phép YouTube, FB, Zalo, Google Fonts hoạt động
    $csp = "default-src 'self'; " .
           "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://*.youtube.com https://*.youtube-nocookie.com https://*.facebook.com https://connect.facebook.net https://*.zalo.me https://sp.zalo.me https://www.googletagmanager.com https://www.google-analytics.com; " .
           "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
           "img-src 'self' data: https://*.facebook.com https://*.zalo.me https://*.youtube.com https://i.ytimg.com https://secure.gravatar.com; " .
           "font-src 'self' data: https://fonts.gstatic.com; " .
           "frame-src 'self' https://*.youtube.com https://*.youtube-nocookie.com https://*.facebook.com https://*.zalo.me; " .
           "frame-ancestors 'self'; " .
           "form-action 'self'; " .
           "worker-src 'self';";
           
    header("Content-Security-Policy: " . $csp);
*/	

    // Sửa lỗi Strict-Transport-Security (HSTS)
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");

    // Sửa lỗi Missing Anti-clickjacking Header (X-Frame-Options)
    header("X-Frame-Options: SAMEORIGIN");

    // Sửa lỗi X-Content-Type-Options Header Missing
    header("X-Content-Type-Options: nosniff");

    // Ẩn thông tin X-Powered-By (Phiên bản PHP)
    if (function_exists('header_remove')) {
        header_remove('X-Powered-By');
    }
}
add_action('send_headers', 'add_security_headers_optimized');

// 2. Sửa lỗi Timestamp Disclosure - Unix (Loại bỏ ?ver=timestamp khỏi CSS/JS)
function remove_css_js_ver_strings( $src ) {
    if ( strpos( $src, 'ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_ver_strings', 9999 );
add_filter( 'script_loader_src', 'remove_css_js_ver_strings', 9999 );

// 3. Ẩn phiên bản WordPress để tránh Information Disclosure
remove_action('wp_head', 'wp_generator');


add_filter('acf/load_field/key=field_69b4b92545482', function ($field) {

    // reset choices
    $field['choices'] = [];

    // lấy dữ liệu repeater
    if (have_rows('area', 'option')) {

        while (have_rows('area', 'option')) {
            the_row();

            $area_name = get_sub_field('area_name');

            if ($area_name) {
                $field['choices'][$area_name] = $area_name;
            }
        }

    }

    return $field;

});



add_action('init', function () {

    remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');

    add_filter('rest_pre_serve_request', function($served) {

        $current_origin = parse_url(home_url(), PHP_URL_SCHEME) . '://' . parse_url(home_url(), PHP_URL_HOST);

        $allowed_origins = [
            $current_origin,
            str_replace('://', '://www.', $current_origin),
        ];

        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        if (in_array($origin, $allowed_origins, true)) {
            header("Access-Control-Allow-Origin: $origin");
        } else {
            header("Access-Control-Allow-Origin: $current_origin");
        }

        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, X-WP-Nonce, Content-Type');
        header('Vary: Origin');

        return $served;
    }, 999);
});

// BEGIN edited by ThuanHQ - 25/05/2026
function custom_filter_wpcf7_is_tel($result, $tel){
	$result= preg_match('/^(0|\+84)(3|5|7|8|9)[0-9]{8}$/', $tel);
	return $result;
}
add_filter('wpcf7_is_tel', 'custom_filter_wpcf7_is_tel', 10, 2);
// END edited by ThuanHQ - 25/05/2026

// BEGIN edited by ThuanHQ - 30/05/2026
add_action('wpcf7_mail_sent', 'cf7_to_crm');
function cf7_to_crm($ThuanHQ){
	$submission= WPCF7_Submission::get_instance();
	if($submission){
		$data= $submission->get_posted_data();
		error_log(print_r($data, true));
		// Lay du lieu tu CF7
		if($ThuanHQ->id() == 5576){				// Form landing page tuyen sinh			
			$ho_ten= sanitize_text_field($data['ten'] ?? '');
			$dien_thoai= sanitize_text_field($data['dien-thoai'] ?? '');
			$email= sanitize_email($data['email'] ?? '');
			$map_khoahoc = [
				'01' => [
					'he_dao_tao'	=> 'FAT',
					'khoa_hoc'		=> 'Lập trình viên quốc tế',
				],
				'02' => [
					'he_dao_tao'	=> 'FCN',
					'khoa_hoc'		=> 'Data Analytics online',
				],
				'03' => [
					'he_dao_tao'	=> 'FJK',
					'khoa_hoc'		=> 'Lập trình AI Agent cho Doanh nghiệp',
				],								
				'04' => [
					'he_dao_tao'	=> 'FJK',
					'khoa_hoc'		=> 'Thiết kế vi mạch bán dẫn',
				],
				'05' => [
					'he_dao_tao'	=> 'FJK',
					'khoa_hoc'		=> 'Quản trị an ninh mạng và Đám mây',
				],
				'06' => [
					'he_dao_tao'	=> 'FCN',
					'khoa_hoc'		=> 'Data Science',
				],								
				'07' => [
					'he_dao_tao'	=> 'FCN',
					'khoa_hoc'		=> 'Thiết kế và Vận hành hệ thống Drone',
				],
				'08' => [
					'he_dao_tao'	=> 'FAN',
					'khoa_hoc'		=> 'Thiết kế mỹ thuật đa phương tiện',
				],
				'09' => [
					'he_dao_tao'	=> 'FAN',
					'khoa_hoc'		=> 'Thiết kế đồ hoạ và Kỹ xảo',
				],								
				'10' => [
					'he_dao_tao'	=> 'FAN',
					'khoa_hoc'		=> 'Thiết kế truyền thông thị giác',
				],
				'11' => [
					'he_dao_tao'	=> 'FAN',
					'khoa_hoc'		=> 'Thiết kế đồ hoạ chuyển động',
				],
				'12' => [
					'he_dao_tao'	=> 'FAN',
					'khoa_hoc'		=> 'Truyền thông thị giác & Thiết kế số',
				],
				'13' => [
					'he_dao_tao'	=> 'FSK',
					'khoa_hoc'		=> 'Marketing số ứng dụng AI',
				],
				'14' => [
					'he_dao_tao'	=> 'FSK',
					'khoa_hoc'		=> 'Sáng tạo và Hiệu suất Social Media',
				],
				'15' => [
					'he_dao_tao'	=> 'FSK',
					'khoa_hoc'		=> 'Search Marketing và Phân tích dữ liệu',
				],
				'16' => [
					'he_dao_tao'	=> 'FSK',
					'khoa_hoc'		=> 'Chiến lược thương hiệu và marketing tích hợp',
				],
			];
			$ma_khoa_hoc = substr(
				sanitize_text_field($data['khoa-hoc'][0] ?? ''),
				0,
				2
			);
			$he_dao_tao = $map_khoahoc[$ma_khoa_hoc]['he_dao_tao'] ?? '';
			$khoa_hoc_mong_muon = $map_khoahoc[$ma_khoa_hoc]['khoa_hoc'] ?? '';

			$map_branch_hau_to = [
				'1' => 'HCM',
				'2' => 'CT',
				'3' => 'DNI',
			];
			$ma_co_so = substr(
				sanitize_text_field($data['noi-dang-ky-xet-tuyen'][0] ?? ''),
				0,
				1
			);
			$branch_hau_to = $map_branch_hau_to[$ma_co_so] ?? '';	
		} elseif($ThuanHQ->id() == 6057){			// Form dang ky tu van tai cac trang con chuong trinh hoc
			$ho_ten= sanitize_text_field($data['ho_ten'] ?? '');
			$dien_thoai= sanitize_text_field($data['dien_thoai'] ?? '');
			$email= sanitize_email($data['email'] ?? '');
			$map_khoahoc = [
				'5606'	=>	[
					'he_dao_tao'	=>	'FAT',
					'khoa_hoc'		=>	'Lập trình viên quốc tế',
				],
				'5609'	=>	[
					'he_dao_tao'	=>	'FAN',
					'khoa_hoc'		=>	'Thiết kế mỹ thuật đa phương tiện',
				],
				'5613'	=>	[
					'he_dao_tao'	=>	'FAN',
					'khoa_hoc'		=>	'Truyền thông thị giác & Thiết kế số',
				],
				'5617'	=>	[
					'he_dao_tao'	=>	'FJK',
					'khoa_hoc'		=>	'Quản trị an ninh mạng và Đám mây',
				],
				'5620'	=>	[
					'he_dao_tao'	=>	'FJK',
					'khoa_hoc'		=>	'Thiết kế vi mạch bán dẫn',
				],
				'5623'	=>	[
					'he_dao_tao'	=>	'FJK',
					'khoa_hoc'		=>	'Lập trình AI Agent cho Doanh nghiệp',
				],
				'5626'	=>	[
					'he_dao_tao'	=>	'FSK',
					'khoa_hoc'		=>	'Marketing số ứng dụng AI',
				],
				'5630'	=>	[
					'he_dao_tao'	=>	'FCN',
					'khoa_hoc'		=>	'Phát triển Phần mềm Ô tô Thông minh',
				],
				'5633'	=>	[
					'he_dao_tao'	=>	'FCN',
					'khoa_hoc'		=>	'Data Science',
				],
				'5636'	=>	[
					'he_dao_tao'	=>	'FCN',
					'khoa_hoc'		=>	'Phát triển Phần mềm Ứng dụng',
				],
				'5639'	=>	[
					'he_dao_tao'	=>	'FCN',
					'khoa_hoc'		=>	'Công nghệ Tài chính số',
				],
				'5642'	=>	[
					'he_dao_tao'	=>	'FCN',
					'khoa_hoc'		=>	'Thiết kế và Vận hành hệ thống Drone',
				],
			];
			$ma_khoa_hoc = absint($_POST['_wpcf7_container_post'] ?? 0);
			$he_dao_tao = $map_khoahoc[$ma_khoa_hoc]['he_dao_tao'] ?? '';
			$khoa_hoc_mong_muon = $map_khoahoc[$ma_khoa_hoc]['khoa_hoc'] ?? '';
			
			$map_branch_hau_to = [
				'1'	=>	'HCM',
				'2'	=>	'CT',
				'3'	=>	'DNI',
			];
			$ma_co_so = substr(
				sanitize_text_field($data['co_so'][0] ?? ''),
				0,
				1
			);
			$branch_hau_to = $map_branch_hau_to[$ma_co_so] ?? '';			
		}else{
			return;
		}
		
		// Lay du lieu UTM 
		//$utm_source, $utm_medium, $utm_campaign, $utm_term, $utm_content, 		
		$utm_source= sanitize_text_field($data['utm_source'] ?? '');
		$utm_medium= sanitize_text_field($data['utm_medium'] ?? '');
		$utm_campaign= sanitize_text_field($data['utm_campaign'] ?? '');
		$utm_term= sanitize_text_field($data['utm_term'] ?? '');
		$utm_content= sanitize_text_field($data['utm_content'] ?? '');
		
		// Gan gia tri ma SCRM can		
		$branch= $he_dao_tao. '-' .$branch_hau_to;
		$body= [
			//name, phone, email, branch (FAT-HCM), program (FAT), majors (), channel, keyword, campaign 
			'name' 		=> $ho_ten,
			'phone'		=> $dien_thoai,
			'email'		=> $email,
			'branch'	=> $branch,
			'program'	=> $he_dao_tao,
			'majors' 	=> $khoa_hoc_mong_muon,
			//'channel'	=> !empty($utm_source) ? $utm_source : 'Website',
			'channel'	=> !empty($utm_source) ? $utm_source : 'Google',
			'keyword' 	=> $utm_medium,
			'campaign'	=> $utm_campaign,
			'facebook'	=> null,
		];
		error_log(print_r($body, true));
		
		// Goi POST request den CRM
		$response= wp_remote_post('https://scrm.fptacademy.vn/api/v1/lead', [
			'method'	=> 'POST',
			'headers'	=> [
				'Content-Type' 		=> 'application/json',
				'Authorization' 	=> 'Bearer ' . FPT_SCRM_TOKEN // neu can (Token luu trong WP-CONFIG.php)
			],
			'body'		=> json_encode($body),
			'timeout'	=> 20,
			'sslverify'	=> false,
		]);
		
		// Ghi vao file log
		if(is_wp_error($response)){
			error_log('Gui du lieu toi CRM that bai' .$response->get_error_message());
		}else{
			error_log('CRM HTTP Code: ' .wp_remote_retrieve_response_code($response));
			error_log('CRM Response: ' .wp_remote_retrieve_body($response));
		}
	}
}
// END edited by ThuanHQ - 30/05/2026

// Đổi thẻ H3 thành P của phần Để lại bình luận trong trang chi tiết bài tin, sự kiện
add_action('wp_footer', function () {
    if (!is_singular(['post', 'su-kien'])) return;
    ?>
    <script>
    (function () {
        var h3 = document.querySelector("h3.comment-reply-title");
        if (!h3) return;
        var p = document.createElement("p");
        p.className = h3.className;
        p.id = h3.id;
        p.style.marginBottom = "15px";
        p.innerHTML = "<strong>" + h3.innerHTML + "</strong>";
        h3.parentNode.replaceChild(p, h3);
    })();
    </script>
    <?php
});

// Xoá thẻ h3 bọc khổi logo bên trang đối tác
add_action('wp_footer', function () {
    if (!is_page(1053)) return;
    ?>
    <script>
    (function () {
        document.querySelectorAll('.doitac-slide .gallery-col h3').forEach(function (h3) {
            var div = document.createElement('div');
            div.innerHTML = h3.innerHTML;
            h3.parentNode.replaceChild(div, h3);
        });
    })();
    </script>
    <?php
});

/**
 * Thêm Article Schema - áp dụng cho TẤT CẢ single content: post + Custom Post Type
 */
add_action( 'wp_head', function() {

    // Áp dụng cho mọi post type singular, TRỪ page và attachment
    if ( ! is_singular() || is_page() || is_attachment() ) {
        return;
    }

    $post_id = get_the_ID();

    $headline        = get_the_title( $post_id );
    $description     = get_the_excerpt( $post_id ) ?: wp_trim_words( get_the_content(), 30 );
    $permalink       = get_permalink( $post_id );
    $date_published  = get_the_date( 'Y-m-d\TH:i:sP', $post_id );
    $date_modified   = get_the_modified_date( 'Y-m-d\TH:i:sP', $post_id );
    $featured_image  = get_the_post_thumbnail_url( $post_id, 'full' );
    $author_url      = get_author_posts_url( get_the_author_meta( 'ID', get_post_field( 'post_author', $post_id ) ) );

    $org_name = 'Viện Đào Tạo Quốc Tế FPT';
    $org_logo = 'https://academy.fpt.edu.vn/wp-content/uploads/2026/05/fai0-1-4-1-1024x230.png';
    $org_id   = home_url( '/#organization' );

    $image_object = null;
    if ( $featured_image ) {
        $image_object = [
            '@type' => 'ImageObject',
            '@id'   => $featured_image,
            'url'   => $featured_image,
        ];
    }

    // mentions: chỉ áp dụng ACF repeater nếu field group có gán cho post type hiện tại
    $mentions = [];
    if ( function_exists( 'have_rows' ) && have_rows( 'schema_mentions', $post_id ) ) {
        while ( have_rows( 'schema_mentions', $post_id ) ) {
            the_row();
            $m_type   = get_sub_field( 'mention_type' );
            $m_name   = get_sub_field( 'mention_name' );
            $m_sameas = get_sub_field( 'mention_sameas' );

            if ( $m_name ) {
                $mentions[] = array_filter( [
                    '@type'  => $m_type ?: 'Thing',
                    'name'   => $m_name,
                    'sameAs' => $m_sameas,
                ] );
            }
        }
    }
    $mentions[] = [
        '@type' => 'Organization',
        'name'  => $org_name,
        '@id'   => $org_id,
    ];

    $schema = array_filter( [
        '@context'    => 'https://schema.org',
        '@type'       => 'Article',
        'headline'    => $headline,
        'description' => $description,
        'image'       => $image_object,
        'author'      => [
            '@type' => 'Person',
            'name'  => $org_name,
            'url'   => $author_url,
        ],
        'publisher'   => [
            '@type' => 'Organization',
            'name'  => $org_name,
            'logo'  => [
                '@type' => 'ImageObject',
                'url'   => $org_logo,
            ],
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id'   => $permalink,
        ],
        'datePublished' => $date_published,
        'dateModified'  => $date_modified,
        'mentions'      => $mentions,
    ] );

    echo '<script type="application/ld+json">' .
        wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) .
        '</script>' . "\n";

}, 5 );


/**
 * Thêm BreadcrumbList Schema - áp dụng TOÀN BỘ trang  - TRỪ trang chủ
 */
add_action( 'wp_head', function() {

    // Duy nhất loại trừ trang chủ
    if ( is_front_page() || is_home() ) {
        return;
    }

    $items    = [];
    $position = 1;

    $items[] = [
        '@type'    => 'ListItem',
        'position' => $position++,
        'name'     => 'Trang chủ',
        'item'     => home_url( '/' ),
    ];

    if ( is_singular() && ! is_page() ) {
        // ----- Post hoặc Custom Post Type -----
        $post_id   = get_the_ID();
        $post_type = get_post_type( $post_id );

        // Tìm taxonomy hierarchical đầu tiên được gắn cho post type này (vd: category, hoặc taxonomy tuỳ biến)
        $taxonomies = get_object_taxonomies( $post_type, 'objects' );
        $term       = null;

        foreach ( $taxonomies as $tax ) {
            if ( ! $tax->hierarchical ) continue; // bỏ qua tag (non-hierarchical)
            $terms = get_the_terms( $post_id, $tax->name );
            if ( $terms && ! is_wp_error( $terms ) ) {
                // Ưu tiên term có parent (danh mục con) để lấy đúng nhánh sâu nhất
                usort( $terms, fn( $a, $b ) => $b->parent <=> $a->parent );
                $term = $terms[0];
                break;
            }
        }

        if ( $term ) {
            // Nếu term có danh mục cha, thêm trước
            if ( $term->parent ) {
                $parent_term = get_term( $term->parent, $term->taxonomy );
                if ( $parent_term && ! is_wp_error( $parent_term ) ) {
                    $items[] = [
                        '@type'    => 'ListItem',
                        'position' => $position++,
                        'name'     => $parent_term->name,
                        'item'     => get_term_link( $parent_term ),
                    ];
                }
            }

            $items[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => $term->name,
                'item'     => get_term_link( $term ),
            ];
        } elseif ( ! is_post_type_hierarchical( $post_type ) ) {
            // Nếu CPT không có taxonomy hierarchical nào, thử chèn archive page của CPT (nếu có)
            $archive_link = get_post_type_archive_link( $post_type );
            if ( $archive_link ) {
                $post_type_obj = get_post_type_object( $post_type );
                $items[] = [
                    '@type'    => 'ListItem',
                    'position' => $position++,
                    'name'     => $post_type_obj->labels->name ?? $post_type,
                    'item'     => $archive_link,
                ];
            }
        }

        // Nếu CPT có hỗ trợ parent-child (hierarchical post type, giống Page)
        if ( is_post_type_hierarchical( $post_type ) ) {
            $ancestors = array_reverse( get_post_ancestors( $post_id ) );
            foreach ( $ancestors as $ancestor_id ) {
                $items[] = [
                    '@type'    => 'ListItem',
                    'position' => $position++,
                    'name'     => get_the_title( $ancestor_id ),
                    'item'     => get_permalink( $ancestor_id ),
                ];
            }
        }

        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title( $post_id ),
            'item'     => get_permalink( $post_id ),
        ];

    } elseif ( is_page() ) {
        // ----- Trang tĩnh -----
        $ancestors = array_reverse( get_post_ancestors( get_the_ID() ) );

        foreach ( $ancestors as $ancestor_id ) {
            $items[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => get_the_title( $ancestor_id ),
                'item'     => get_permalink( $ancestor_id ),
            ];
        }

        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        ];

    } elseif ( is_category() || is_tag() || is_tax() ) {
        // ----- Danh mục / Tag / Taxonomy tuỳ biến -----
        $term = get_queried_object();

        if ( $term && ! empty( $term->parent ) ) {
            $parent_term = get_term( $term->parent, $term->taxonomy );
            if ( $parent_term && ! is_wp_error( $parent_term ) ) {
                $items[] = [
                    '@type'    => 'ListItem',
                    'position' => $position++,
                    'name'     => $parent_term->name,
                    'item'     => get_term_link( $parent_term ),
                ];
            }
        }

        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => single_term_title( '', false ) ?: ( $term->name ?? '' ),
            'item'     => get_term_link( $term ),
        ];

    } elseif ( is_post_type_archive() ) {
        // ----- Trang Archive của Custom Post Type -----
        $post_type_obj = get_queried_object();
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => $post_type_obj->labels->name ?? post_type_archive_title( '', false ),
            'item'     => get_post_type_archive_link( get_query_var( 'post_type' ) ),
        ];

    } elseif ( is_search() ) {
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => 'Kết quả tìm kiếm',
            'item'     => home_url( '/?s=' . get_search_query() ),
        ];

    } elseif ( ! is_404() ) {
        // Fallback: archive tác giả, ngày tháng, hoặc các trường hợp khác
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => wp_get_document_title(),
            'item'     => home_url( add_query_arg( null, null ) ),
        ];
    }

    if ( count( $items ) < 2 ) {
        return;
    }

    $breadcrumb_schema = [
        '@context'        => 'https://schema.org/',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];

    echo '<script type="application/ld+json">' .
        wp_json_encode( $breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) .
        '</script>' . "\n";

}, 6 );

// BEGIN edited by ThuanHQ - 27/07/2026
function getUrlPage($form_tag){

	switch ($form_tag['name']) {
		
		case 'url-referer':
			if (isset($_SERVER['HTTP_REFERER'])) {
				$form_tag['values'][] = htmlspecialchars($_SERVER['HTTP_REFERER']);
			}
			break;

		case 'url-page':
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
			$form_tag['values'][] = esc_url($protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			break;

		case 'post-title':
			if ( is_singular() ) {
				$form_tag['values'][] = get_the_title( get_queried_object_id() );
			}
			break;
	}

	return $form_tag;
}

add_filter('wpcf7_form_tag', 'getUrlPage');

// END edited by ThuanHQ - 27/07/2026
