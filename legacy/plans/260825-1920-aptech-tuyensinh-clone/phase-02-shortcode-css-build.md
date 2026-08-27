# Phase 2: Shortcode Structure & CSS

## Cấu trúc shortcode đề xuất (Flatsome UX Builder, theo đúng 16 section Phase 1)

1. `[section]` Header/Hero — `[row]`/`[col]` chứa logo 26 năm + banner AI, hotline dạng `[ux_text]` link `tel:`. Cân nhắc dùng chính header/topbar có sẵn của theme thay vì section riêng nếu Academy đã có topbar hotline chuẩn — kiểm tra trước khi build trùng.
2. `[row]` Registration CTA — `[contact-form-7 id="..."]` (id xác nhận ở Phase 3) + `[ux_text]` mô tả + dropdown cơ sở (field `<select>` trong chính CF7, không phải shortcode riêng).
3. `[row]` Giới thiệu FPT Aptech — `[ux_text]` thuần, không cần shortcode đặc biệt.
4. `[row]` 4 card đối tượng học viên — `[ux_image_box]` x4, giống pattern đã dùng ở `lap-trinh-aptech` (dòng 103-158 file gốc), đổi ảnh theo Phase 1 mục 4.
5. `[row_inner]`/`[ux_slider]` 6 lý do — `[featured_box]` icon + text x6.
6. Chương trình 4 học kỳ — **layout đã chốt (quyết định #5 plan.md), không dùng `[tabgroup]`**: 4 `[row]` riêng biệt (không phải tab), mỗi row 2 `[col span="6" span__sm="12"]`:
   - Cột info: `[ux_text]` môn học/kỹ năng/vị trí nghề nghiệp/chuẩn đầu ra, giữ nguyên nội dung gốc.
   - Cột video: nhúng YouTube của đúng học kỳ (mapping URL ở Phase 1 mục 6/11) — dùng `[ux_video url="..."]` (shortcode Flatsome hỗ trợ oEmbed YouTube) làm phần tử chính; nếu học kỳ có 2 video, ưu tiên 1 video đại diện, video còn lại đặt link nhỏ bên dưới ("Xem thêm đồ án khác").
   - Fallback: nếu `url` video rỗng hoặc oEmbed lỗi (kiểm tra thủ công lúc QA, Flatsome không tự validate link YouTube) → thay `[ux_video]` bằng `[ux_image]` banner tĩnh `hk{N}_2025.jpg` tương ứng.
   - Thứ tự cột đảo xen kẽ mỗi row bằng cách đổi vị trí khai báo 2 `[col]` (row 1: info trước/video sau; row 2: video trước/info sau; lặp lại).
   - Class: `.aptech-ts-semester-row` trên `[row]`, thêm modifier `.is-reversed` cho row 2 và 4 nếu cần CSS riêng ngoài việc đổi thứ tự khai báo (ví dụ giữ căn lề nhất quán).
7. `[row_inner]` grid 10 icon công việc — `[col_inner]` nhỏ x10, ảnh thuần không cần text nhãn tự chế (giữ nguyên như trang mẫu, không có label kèm icon).
8. `[row]` Học chuyển tiếp — 2 khối con: trong nước (3 `[ux_image_box]` campus FPTU) + quốc tế (3 `[ux_image]` logo trường, link ra ngoài qua `link=` attribute).
9. `[ux_slider]` 6 giảng viên (card ảnh tròn + tiểu sử) + `[row_inner]` 5 kỹ năng (`[featured_box]` icon, không text nhãn — giữ đúng như trang mẫu).
10. `[row]` Thông tin tuyển sinh — `[ux_text]` list 3 mục hồ sơ, không cần accordion vì trang mẫu không dùng accordion ở đây.
11. ~~`[row_inner]` 8 thumbnail đồ án riêng~~ — **đã gộp vào mục 6** theo quyết định #5, không tạo section riêng.
12. `[ux_slider]` 6 câu chuyện sinh viên — card ảnh chân dung + quote + `[ux_image]` thumbnail video (link YouTube) + `link=` bài viết gốc.
13. Logo doanh nghiệp — `[row_inner]` grid tĩnh 18 logo (đơn giản nhất) hoặc `[ux_slider]`/marquee CSS nếu muốn hiệu ứng chạy liên tục như trang mẫu — xác nhận qua xem trực tiếp trang mẫu có marquee hay grid tĩnh trước khi build.
14. `[section]` CTA giữa trang — `[ux_banner]` ảnh nền + `[contact-form-7]` (form thứ 2 hoặc dùng lại id form ở mục 2, xác nhận Phase 3).
15. Popup — phụ thuộc plugin xác nhận ở Phase 3, không dựng bằng CSS `position:fixed` thủ công nếu theme/plugin đã có sẵn cơ chế popup.
16. Footer — dùng đúng footer/social icon mặc định của theme Academy nếu đã có sẵn, chỉ thêm `[ux_text]` 3 địa chỉ nếu footer chuẩn của theme chưa hiển thị địa chỉ theo trang.

## CSS mới cần thêm vào `AcademyFPT/css/additional-css.css`

Family class mới, tên riêng để không đụng `laptrinhvien-*` (family `jetking/cranes/arena/skiling`) và không kế thừa `fpt-v2-*` chưa xác nhận còn tồn tại (xem lý do ở `plan.md`):

- `.aptech-ts-hero` — style header/hero (logo + banner + hotline).
- `.aptech-ts-audience-card` — 4 card đối tượng học viên (nếu pattern `ux_image_box` mặc định của Flatsome chưa đủ, tái dùng trước khi viết CSS mới).
- `.aptech-ts-benefit-icon` — 6 card lý do icon + text.
- `.aptech-ts-semester-row` (+ `.is-reversed`) — style row 2 cột info/video mỗi học kỳ, đảm bảo căn giữa/vertical-align nhất quán khi thứ tự cột đảo.
- `.aptech-ts-job-icon-grid` — grid 10 icon công việc.
- `.aptech-ts-transfer-col` — card học chuyển tiếp trong nước/quốc tế.
- `.aptech-ts-lecturer-card`, `.aptech-ts-skill-icon` — giảng viên + 5 kỹ năng.
- `.aptech-ts-testimonial-card` — 6 câu chuyện sinh viên.
- `.aptech-ts-partner-logo` (+ marquee keyframe nếu Phase build xác nhận trang mẫu dùng hiệu ứng chạy) — 18 logo doanh nghiệp.

Không cần `.aptech-ts-popup` — đã chốt bỏ popup modal (không có plugin popup cài sẵn, xem Phase 3).

Nguyên tắc: trước khi viết bất kỳ class nào ở trên, kiểm tra Flatsome UX Builder đã có option dựng sẵn tương đương chưa (spacing, image box style, slider autoplay...) để tránh viết CSS thừa — chỉ thêm class khi option có sẵn không đáp ứng đúng layout trang mẫu.

## Vị trí thêm trong file CSS

Thêm thành 1 block mới ở cuối `additional-css.css` (sau block `laptrinhvien-*` hiện tại, khoảng dòng 3213+), có comment ngắn phân tách khối (`/* aptech-ts — trang clone tuyển sinh aptech.fpt.edu.vn */`) để dễ tìm/xoá độc lập nếu cần, không xen giữa các block family khác.
