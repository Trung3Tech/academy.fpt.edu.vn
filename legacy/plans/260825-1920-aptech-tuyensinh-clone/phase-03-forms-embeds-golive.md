# Phase 3: Forms, Embeds, QA & Go-Live

## Form đăng ký (2 vị trí: đầu trang + CTA giữa trang)

- Plugin đã chốt: **Contact Form 7** (quyết định #3, xác nhận cài sẵn trong `LocalSite/wp-content/plugins/`, kèm `wpcf7-recaptcha` + `wpcf7-redirect`) — dùng plugin của Academy, không cài thêm.
- Tái dùng id `6057` (đã dùng ở `lap-trinh-aptech`, cùng mục đích tư vấn tuyển sinh, có sẵn field "Cơ sở học") nếu field khớp yêu cầu trang này; nếu cần field khác (ví dụ dropdown khác Hà Nội/TP.HCM) thì tạo form CF7 mới — xác nhận field cụ thể khi build (chưa export nội dung form `6057` trong lần scout này).
- CTA giữa trang tái dùng cùng 1 form `6057` (không cần form thứ 2 riêng) để giảm số lượng form phải bảo trì, trừ khi content owner muốn tách riêng để đo conversion theo vị trí.
- Test gửi thử: thông báo thành công hiển thị, dữ liệu về email quản trị + nơi lưu trữ (CRM/Sheet), giống checklist mục 2 trong `update-flow/page-lap-trinh-aptech.md`.

## Popup đăng ký (modal) — **đã chốt bỏ**

- Scout `LocalSite/wp-content/plugins/` xác nhận Academy **không cài plugin popup nào** (không có Popup Maker/Elementor Popup/OptinMonster). Quyết định: bỏ popup modal khỏi trang clone, không tự viết JS modal thủ công (tránh rủi ro xung đột z-index/script với theme không cần thiết). Section 15 (popup) ở Phase 1 coi như không build.

## Video YouTube

- 8 video đồ án (2/học kỳ) **không còn là section riêng** — đã chuyển vào cột video của mục 6 (4 học kỳ), dùng `[ux_video]` nhúng trực tiếp theo mapping URL ở Phase 1 mục 6/11, có fallback ảnh tĩnh nếu link lỗi (xem Phase 2 mục 6).
- 6 video testimonial cựu sinh viên (section 12) giữ nguyên cách trang mẫu: `[ux_image]` thumbnail + `link=` trỏ thẳng URL YouTube, `link_new_window="1"` (mở tab mới, không cần lightbox) — khác cách xử lý với video đồ án vì đây là thumbnail ảnh chân dung có sẵn, không phải video chính của section.

## Link ngoài

- 5 link trường đại học quốc tế (mdx.ac.uk, lincoln.edu.my, uclan.ac.uk) và 6 link bài viết cựu sinh viên (`aptech.fpt.edu.vn/*.html`) — giữ nguyên href, thêm `rel="noopener"` nếu mở tab mới. Không tự đổi thành link nội bộ `academy.fpt.edu.vn` (bài viết đó không tồn tại trên domain Academy).

## SEO

- Đã chốt (quyết định #4): trang được SEO như nội dung **gốc của Academy**, không noindex, không canonical trỏ về `aptech.fpt.edu.vn`.
- Title/Meta Description/OG image: viết riêng cho `academy.fpt.edu.vn` (tên chương trình, thương hiệu Academy), không copy nguyên SEO tag của trang mẫu (vốn cũng không lộ rõ qua WebFetch — cần "View Page Source" nếu muốn tham khảo thêm, nhưng không bắt buộc vì đã có hướng riêng).

## QA Checklist trước Go-Live

Tái dùng checklist Phần 3 của `update-flow/page-lap-trinh-aptech.md` (đã kiểm chứng cho page tương tự cùng theme):

- [ ] Desktop 1920/1440/1280px, Tablet ngang/dọc, Mobile — không tràn viền, không gãy dòng đột ngột.
- [ ] Đúng mã màu thương hiệu FPT (`#EF7125`, `#F56F21`, `#2B2B2B`), font Inter/Roboto không lỗi tiếng Việt.
- [ ] Form CF7 (đầu trang + CTA giữa trang) gửi thử thành công (thông báo rõ ràng, dữ liệu về đúng nơi nhận).
- [ ] 8 video đồ án nhúng đúng học kỳ (mục 6), fallback ảnh tĩnh hoạt động đúng nếu giả lập link lỗi.
- [ ] 6-8 link video testimonial (mục 12) mở đúng URL YouTube.
- [ ] 6 link bài viết cựu sinh viên + 5 link trường quốc tế mở đúng, không lỗi 404.
- [ ] Toàn bộ ảnh nén `.webp` hoặc tối ưu dung lượng < 200KB/ảnh trước khi upload Media Library.
- [ ] Duy nhất 1 thẻ `<h1>` trên trang.
- [ ] Rank Math: Title, Meta Description viết riêng cho Academy đã cấu hình (không noindex, không canonical ra ngoài — theo quyết định #4).
- [ ] Hotline/địa chỉ/social link trên trang là của Academy, không còn sót thông tin của Aptech.

## Go-Live (đơn giản hơn SOP trang live vì đây là trang mới, không có ID cần bảo toàn)

1. Tạo Page mới trong WP-Admin, slug `/chuong-trinh-dao-tao/aptech/`, trạng thái Draft.
2. Upload ảnh đã copy ở Phase 1 vào Media Library (môi trường build — local hoặc production tuỳ nơi build), ghi lại mapping filename → media ID vào `aptech/media-id-map.csv` (theo đúng pattern `media-id-map-local.csv` đã dùng ở `lap-trinh-aptech`, đổi tên bỏ hậu tố `-local` nếu build thẳng trên production).
3. Dán shortcode hoàn chỉnh (từ Phase 2) vào Draft, review qua Public Post Preview.
4. Sau khi duyệt nội dung + xác nhận các câu hỏi mở ở `plan.md`: Publish, thêm vào menu điều hướng nếu cần (xác nhận với content owner trang này có nằm trong menu chính không), xoá cache.
5. Không cần bước Rollback/Revisions phức tạp như SOP trang live — nếu lỗi, sửa trực tiếp trên Draft trước khi Publish, hoặc revert về Draft nếu đã lỡ Publish.
