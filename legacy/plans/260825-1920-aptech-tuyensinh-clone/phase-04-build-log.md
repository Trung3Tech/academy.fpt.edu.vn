# Phase 4: Build Log & Kết quả thực thi

**Ngày thực hiện:** 2026-08-25

## Đã làm

1. **Xác nhận 86/86 ảnh cần dùng có sẵn** trong `pages/chuong-trinh-dao-tao/lap-trinh-aptech/aptech_tuyensinh_assets/` (204 file), không thiếu file nào — copy sang `pages/chuong-trinh-dao-tao/aptech/aptech_assets/` để trang mới tự chứa.
2. **Lấy lại nội dung nguyên văn tiếng Việt** cho các đoạn dài (giới thiệu, 4 học kỳ, 6 lý do, 6 giảng viên, 6 testimonial, thông tin tuyển sinh) bằng fetch trực tiếp có kiểm chứng bằng dấu ngoặc kép — bản fetch đầu tiên ở Phase 1 vô tình trả về diễn giải tiếng Anh cho phần học kỳ, đã fetch lại đúng nguyên văn tiếng Việt trước khi đưa vào shortcode.
3. **Scout `LocalSite/wp-content/plugins/`** xác nhận Academy chỉ có Contact Form 7 (không có plugin popup) — khớp quyết định #3 đã chốt.
4. **Scout form CF7 hiện có (id 33/571)** trên WP local: field `ho_ten` / `email-hv` / `sdt_hv` / `co_so` với 3 cơ sở thật của Academy (**Tp.HCM / Đồng Nai / Cần Thơ** — khác hẳn Hà Nội/HCM của Aptech). Form `6057` (dùng ở `lap-trinh-aptech`) không tồn tại trên DB local này.
5. **Tạo form CF7 mới `id=9838`** ("Đăng ký tư vấn - FPT Aptech") trên WP local — cùng field convention với form Academy có sẵn, bỏ các nhóm chọn lớp học thử (không áp dụng cho trang chương trình dài hạn này), dùng đúng 3 cơ sở thật của Academy. Dùng chung 1 form này cho cả 2 vị trí (hero + CTA giữa trang) theo quyết định ở Phase 3.
6. **Upload 86 ảnh vào Media Library WP local** (`media-id-map-local.csv` trong thư mục page) và **viết đầy đủ shortcode** tại [shortcode_draft.txt](../../pages/chuong-trinh-dao-tao/aptech/shortcode_draft.txt) theo đúng 16 mục ở Phase 1 (semester section gộp với video đồ án theo quyết định #5).
7. **Đẩy vào trang Draft** (Page ID `9840` trên WP local, slug `aptech`, `post_status=draft`).
8. **QA kỹ thuật bằng script** (không phải chỉ đọc mắt): đếm mở/đóng từng shortcode tag → khớp 100%; render qua `apply_filters('the_content', ...)` → không còn shortcode nào chưa parse (ngoại trừ `[cf7sr-recaptcha]`, xem mục cảnh báo bên dưới); 70/70 thẻ `<img>` có `src` hợp lệ; 2 form CF7 và 4 video YouTube (mỗi học kỳ) đều render thành `<iframe>`/form HTML thật, không còn shortcode thô.

## Lỗi đã phát hiện & sửa trong lúc build (quan trọng, không giả định lần sau)

Nhiều thuộc tính shortcode ban đầu viết theo suy đoán/kinh nghiệm từ page builder khác đã **sai** — phát hiện được nhờ đọc trực tiếp source code shortcode trong `LocalSite/wp-content/themes/flatsome/inc/shortcodes/`, không phải nhờ đoán:

- **Markdown không được parse** trong `[ux_text]` (`## `, `**bold**`, `[text](url)` hiển thị nguyên văn ký tự, không thành heading/bold/link). Đã thay bằng HTML thật (`<h2>`, `<h3>`, `<strong>`, `<a href>`, `<ul><li>`).
- **`[slide]`/`[/slide]`** không phải cú pháp của `[ux_slider]` trong theme này — mỗi `[row_inner]` chính là 1 slide (xác nhận qua `shortcode_v2_draft.txt` của `lap-trinh-aptech`). Đã bỏ 2 cặp tag thừa.
- **`poster="ID"` trên `[ux_video]` không tồn tại** (đọc `ux_video.php`: chỉ có `url/height/class/visibility/depth/depth_hover`) — đã xoá, không có tác dụng gì nên không giữ lại code chết.
- **`image_circle="1"` không tồn tại** trên `[ux_image]` (đọc `ux_image.php`) — đã thay bằng class CSS `.aptech-ts-avatar-circle` (border-radius 50%, thêm vào `additional-css.css`).
- **`link_new_window="1"` không tồn tại** — thuộc tính đúng là `target="_blank" rel="noopener"` (đọc `ux_image.php`) — đã sửa toàn bộ 9 chỗ dùng.
- **`arrows="always" bullets="dots"` sai giá trị** (`ux_slider.php` chỉ nhận `true`/`false`) — đã đổi sang đúng pattern đã dùng thật ở `lap-trinh-aptech` (`style="container" slide_width nav_pos="outside" nav_style="simple" nav_color="dark"`).
- **`span__order__sm` không tồn tại** trên `[col]` (đọc `row.php`, không có thuộc tính order nào) — đã bỏ, giữ lại cách đảo cột bằng CSS flexbox `order` (`.aptech-ts-semester-row.is-reversed` trong `additional-css.css`) vốn đã viết đúng từ Phase 2.

## Việc CHƯA làm — cần content owner cung cấp trước khi go-live

1. **Hotline & email Academy thật:** không tìm thấy trong repo (theme code) lẫn DB local (dữ liệu demo, social link toàn placeholder `http://url`). Đã đặt marker rõ ràng trong hero: `HOTLINE ACADEMY — CẦN ĐIỀN TRƯỚC KHI PUBLISH` / `EMAIL ACADEMY — CẦN ĐIỀN TRƯỚC KHI PUBLISH` — **không tự bịa số**, cần content owner điền trước khi Publish.
2. **Form CF7 `id=9838` mới tạo trên LOCAL**, cần review nội dung email nhận/CRM đích thật trước khi dùng — hiện dùng lại cấu hình mail generic giống form `33` có sẵn (`dev@example.com` placeholder, chưa phải hộp mail thật của Academy).
3. **`[cf7sr-recaptcha]` còn hiện dạng thô** trong HTML render — kế thừa nguyên từ form `33` có sẵn của Academy (không phải lỗi do trang mới gây ra), nhiều khả năng do reCAPTCHA site key chưa cấu hình trên môi trường local. Cần kiểm tra trên production, nơi `wpcf7-recaptcha` addon đã có site key thật.
4. **Fallback video → ảnh tĩnh khi link lỗi:** hiện KHÔNG tự động (Flatsome không có cơ chế phát hiện link YouTube hỏng) — cả 4 học kỳ hiện có video thật hợp lệ nên chưa cần kích hoạt. Nếu 1 video hỏng trong tương lai, cách xử lý thủ công: thay `[ux_video url="..."]` bằng `[ux_image id="{hk_N media id}"]` (id có trong `media-id-map-local.csv`).
5. **Chưa xác nhận trực quan bằng trình duyệt** (responsive thật trên nhiều kích thước màn hình) — hành động publish/preview trên WP local đã bị chặn bởi permission classifier của phiên làm việc này (coi publish là thay đổi trạng thái cần xác nhận thủ công dù chỉ là site local). Trang vẫn ở trạng thái Draft (Page ID `9840`, an toàn). QA mới dừng ở mức kỹ thuật (script kiểm tra shortcode/HTML), **chưa phải QA thị giác** — cần mở Draft trong trình duyệt qua wp-admin hoặc Public Post Preview để xác nhận layout trước khi go-live.
6. **Media ID chỉ đúng trên WP local** — khi build trên production `academy.fpt.edu.vn`, phải upload lại 86 ảnh trong `aptech_assets/` để lấy ID mới, rồi thay ID trong `shortcode_draft.txt` theo mapping filename ở `media-id-map-local.csv` (không copy ID trực tiếp), đúng như lưu ý đã có ở SOP `lap-trinh-aptech`.
7. **8 ảnh `do-an-sem-*.jpg`** đã copy + upload (ID `9794`-`9801`) nhưng **chưa dùng trong shortcode** (video YouTube dùng oEmbed tự lấy thumbnail, không cần ảnh poster riêng vì `ux_video` không hỗ trợ thuộc tính này) — giữ lại trong thư mục asset để dùng làm ảnh dự phòng thủ công nếu cần sau này, không phải file thừa cần xoá.

## Cấu trúc file trong `pages/chuong-trinh-dao-tao/aptech/`

```
shortcode_draft.txt         # shortcode hoàn chỉnh, đã nạp vào Page ID 9840 (WP local, draft)
media-id-map-local.csv      # ánh xạ filename -> media ID trên WP LOCAL (không dùng được trên production)
aptech_assets/               # 86 ảnh đã dùng, copy từ kho crawl của lap-trinh-aptech
```

## Phase 4b: Fix nền trắng ở Hero (2026-08-25, sau phản hồi content owner)

**Triệu chứng:** Preview `?page_id=9840&preview=true` cho thấy section Hero hiển thị nền trắng, không giống trang mẫu.

**Cách chẩn đoán:** Tạo cookie đăng nhập tạm qua `wp_generate_auth_cookie()` (không đổi `post_status`, không publish) để `curl` được đúng trang Draft đã render đầy đủ CSS/JS như trình duyệt thật, thay vì đoán qua mắt.

**Nguyên nhân xác nhận qua HTML render thật:** `[section bg="9757" bg_size="original" bg_pos="0% 100%"]` dùng `bg_size="original"` — ảnh nền 900×900 chỉ hiển thị đúng kích thước gốc, neo góc dưới-trái (`bg_pos="0% 100%"`), **không phủ kín section**. Thuộc tính này copy nguyên từ `shortcode_v2_draft.txt` của `lap-trinh-aptech`, nơi nó hoạt động đúng vì section đó có sẵn `background-color: #0A1128` từ class `.fpt-hero-section` (đọc thấy trong `additional-css.css` dòng 2792) — class `.aptech-ts-hero` của trang mới **không có** màu nền fallback tương tự nên phần ảnh không phủ tới bị lộ nền trắng mặc định của trình duyệt/theme.

**Đã sửa** trong `additional-css.css` (family `.aptech-ts-*`):
- `.aptech-ts-hero`: thêm `background-color`/gradient tối (`#0a1128` → `#1b2a4a`) làm nền fallback, `position: relative; overflow: hidden;`.
- Thêm style dạng "card" (nền trắng, bo góc, đổ bóng nhẹ) cho `.aptech-ts-audience-card`, `.aptech-ts-benefit-icon`, `.aptech-ts-transfer-col`, và slide bên trong `.aptech-ts-slider .row` (giảng viên + testimonial) — trước đó các khối này chỉ là text/ảnh trần không có khung, nhìn phẳng/thiếu điểm nhấn so với trang mẫu.
- `.aptech-ts-hero-form-col`: đổi từ nền đen mờ đơn giản sang khung "glass" (kính mờ, viền sáng, đổ bóng) khớp phong cách `.fpt-hero-glass-form` đã có sẵn cho trang chị em.

**⚠️ Sự cố suýt xảy ra khi đồng bộ CSS — cần rút kinh nghiệm:** Lúc đồng bộ `additional-css.css` sang `LocalSite/wp-content/themes/flatsome-child/style.css` bằng lệnh `cp` trực tiếp (không đọc file gốc trước), đã **vô tình xoá mất theme header** (`Theme Name`/`Template: flatsome`/...) bắt buộc phải có ở đầu `style.css` của một child theme — khiến `wp theme list` không còn nhận diện được `flatsome-child` (theme biến mất khỏi danh sách, dù site vẫn chạy tạm thời vì WP dùng option `stylesheet`/`template` đã lưu, không parse lại header mỗi request). Đã phát hiện ngay và khôi phục header chuẩn (`Theme Name: Flatsome Child`, `Template: flatsome`, `Version: 3.0` — khớp version cũ suy ra từ query string enqueue trước đó), xác nhận lại `wp theme list` hiển thị `active` bình thường và các trang khác (`9749`, `9450`, `9848`) vẫn HTTP 200. **Bài học:** không `cp` đè trực tiếp lên `style.css` của theme (child hay parent) — file này bắt buộc có header đặc biệt, khác với các file CSS thường; nếu cần đồng bộ, phải đọc & giữ lại phần header, hoặc chỉ dùng "Additional CSS" (post `42`) làm kênh phân phối CSS như đã làm ở Phase 4.

## Phase 4c: Dựng lại Hero theo đúng ảnh chụp trang mẫu (2026-08-25)

Content owner gửi ảnh chụp thật của hero trên `aptech.fpt.edu.vn/tuyensinh` (nền chéo cam→xanh navy, robot AI, banner "LẬP TRÌNH TÍCH HỢP AI / X2 TỐC ĐỘ", form trắng bên phải). Đối chiếu phát hiện: ảnh `Banner-FAT_LAP-TRINH-x-AI_NB_NLG_thuanhq-900x900-1.png` (đã dùng từ Phase 4) **chính là toàn bộ phần nghệ thuật đó** (robot + chữ + ảnh sinh viên), nhưng nền PNG trong suốt — phần nền chéo cam/xanh là 1 lớp riêng trên trang mẫu, không nằm trong file ảnh đã crawl. Dùng file này làm `bg=` của `[section]` (Phase 4) là sai cách: `bg_size="original"` chỉ hiển thị đúng kích thước gốc neo góc, để lộ nền trắng — đúng như phản hồi "nền vẫn chưa hiển thị".

**Đã dựng lại toàn bộ Hero:**
- Tách thành 2 section: topbar trắng (logo 26 năm + Aptech + FPT Education, và pill hotline) + hero riêng.
- Ảnh `9757` chuyển sang dùng như `[ux_image]` thường (không phải `bg=`), đặt lớn bên trái.
- Nền hero dựng bằng CSS `linear-gradient` chéo cam (`#f7941d`) → xanh navy (`#1b3a63`) mô phỏng nền thật (**lưu ý: đây là gradient CSS dựng lại, không phải ảnh gốc — sẽ không khớp 100% pixel với bản gốc** vì không có file nền chéo thật trong kho ảnh đã crawl).
- Form panel đổi sang kính mờ (glass) đặt trực tiếp trên nền cam, nút submit đổi màu cam `#ef7125`.
- Thêm nút tròn đỏ nổi "Đăng ký tư vấn" góc dưới-trái hero (khớp thiết kế trang mẫu), trỏ neo tới form qua `#aptech-ts-form`.

**Phát hiện thêm khi soi ảnh chụp thật:** tag `[cf7sr-recaptcha]` trong form `9838` (copy nguyên từ form `33` có sẵn của Academy) hiển thị **thô, chưa parse** trên giao diện — kiểm tra `wpcf7-recaptcha` plugin đang cài xác nhận tag đúng phải là `[recaptcha]` (`recaptcha-v2.php` dòng 40), không phải `[cf7sr-recaptcha]` (tên tag của 1 plugin recaptcha khác, có thể đã gỡ khỏi site nhưng form cũ `33`/`571` chưa cập nhật lại — vấn đề có sẵn từ trước, ngoài phạm vi trang này). Đã sửa tag trong form `9838` (form mới tạo riêng cho trang aptech) thành `[recaptcha]` đúng plugin hiện tại.

**Xác minh bằng ảnh chụp màn hình thật** (Playwright + cookie đăng nhập tạm, không đổi `post_status`) thay vì chỉ đọc HTML — đối chiếu trực quan với ảnh content owner gửi, khớp gần đúng cấu trúc: topbar, nền chéo, artwork, form, nút nổi. Card lợi ích/đối tượng học viên (Phase 4b) cũng lên hình đúng như CSS đã viết (nền trắng, bo góc, icon tròn cam).

## Cách xem thử

Site local chạy tại `http://localhost:8000`. Đăng nhập wp-admin, mở Page ID `9840` (slug nháp `aptech`) ở chế độ Edit/Preview để xem giao diện — trang vẫn ở trạng thái Draft, chưa publish.
