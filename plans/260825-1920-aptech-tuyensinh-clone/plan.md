# Plan: Clone trang aptech.fpt.edu.vn/tuyensinh thành trang mới `chuong-trinh-dao-tao/aptech`

**Status:** Đã build xong trên WP local (Draft, Page ID `9840`) — xem [phase-04-build-log.md](phase-04-build-log.md). Còn thiếu hotline/email thật của Academy + QA thị giác trước khi go-live production.
**Trang nguồn:** `https://aptech.fpt.edu.vn/tuyensinh/` (đã fetch trực tiếp 2026-08-25, 16 khối nội dung, xem Phase 1)
**Trang đích:** Page **hoàn toàn mới** trên `academy.fpt.edu.vn` (chưa có ID/URL live cần bảo toàn) — đề xuất slug `/chuong-trinh-dao-tao/aptech/`
**Nền tảng:** WordPress / Flatsome Theme & UX Builder (giống các trang chị em `lap-trinh-aptech`, `jetking`, `cranes`, `arena`, `skiling`)
**Thư mục làm việc:** `AcademyFPT/pages/chuong-trinh-dao-tao/aptech/` (hiện đang trống)

## Khác biệt so với plan `lap-trinh-aptech-redesign` đã có

Plan trước (`plans/260825-1748-lap-trinh-aptech-redesign/`) dùng `aptech.fpt.edu.vn/tuyensinh` làm **tham chiếu thiết kế** để nâng cấp một trang **đã tồn tại** (giữ nội dung gốc, chỉ đổi hình thức). Plan này khác về bản chất: đây là **clone 1:1** nội dung + hình ảnh của chính trang mẫu đó thành **một trang độc lập, mới hoàn toàn**. Vì vậy:

- Không có ràng buộc giữ nguyên ID/slug/SEO của một trang live — go-live đơn giản hơn (Phase 3), không cần quy trình swap/rollback như SOP `update-flow/page-lap-trinh-aptech.md`.
- Nội dung copy nguyên văn từ trang mẫu, không tự viết lại/diễn giải — nhưng **không copy nguyên trạng thông tin liên hệ/hotline** vì đó là dữ liệu định danh của `aptech.fpt.edu.vn`, không phải của `academy.fpt.edu.vn` (xem câu hỏi mở #2).
- Kho ảnh `pages/chuong-trinh-dao-tao/lap-trinh-aptech/aptech_tuyensinh_assets/` (204 file, crawl từ đúng trang mẫu này) **tái dùng được gần như toàn bộ** — tiết kiệm hẳn bước crawl ảnh lại từ đầu (xem Phase 1).

## Phases

| Phase | File | Nội dung |
| :--- | :--- | :--- |
| 1 | [phase-01-content-asset-inventory.md](phase-01-content-asset-inventory.md) | Bảng kiểm 16 section của trang mẫu, đối chiếu với 204 ảnh đã crawl sẵn, danh sách ảnh cần copy sang thư mục `aptech/`, ảnh còn thiếu cần tải bổ sung |
| 2 | [phase-02-shortcode-css-build.md](phase-02-shortcode-css-build.md) | Cấu trúc shortcode Flatsome cho từng section, family class CSS mới `.aptech-ts-*` cần thêm vào `additional-css.css` |
| 3 | [phase-03-forms-embeds-golive.md](phase-03-forms-embeds-golive.md) | Form đăng ký, popup, video YouTube, checklist QA & quy trình go-live (đơn giản hơn SOP trang live vì là trang mới) |
| 4 | [phase-04-build-log.md](phase-04-build-log.md) | Kết quả build thực tế trên WP local: shortcode hoàn chỉnh, form CF7 mới, lỗi thuộc tính shortcode đã phát hiện & sửa, việc còn thiếu trước go-live |

## Nguyên tắc build

- Copy ảnh + nội dung text vào đúng thư mục `AcademyFPT/pages/chuong-trinh-dao-tao/aptech/` để trang mới tự chứa (self-contained), không phụ thuộc chéo vào thư mục `lap-trinh-aptech/`.
- Dùng đúng shortcode Flatsome UX Builder sẵn có trong theme, không cài thêm page builder/plugin mới.
- Class CSS mới đặt tên family riêng `.aptech-ts-*` (aptech tuyển sinh) — **không** dùng lại `laptrinhvien-*` (family đang dùng chung cho `jetking/cranes/arena/skiling`, không phải trang này) để tránh nhầm lẫn 2 hệ thống trang khác nhau. Cũng không dùng lại `fpt-v2-*` vì class đó xuất hiện trong `shortcode_v2_draft.txt` của `lap-trinh-aptech` nhưng chưa có định nghĩa trong `additional-css.css` hiện tại (uncommitted/thất lạc theo `phase-03-build-log.md` của plan trước) — tránh kế thừa một hệ CSS chưa xác nhận còn tồn tại.
- Build trên trang **Draft** trước, dùng Public Post Preview để review nội bộ trước khi Publish — dù là trang mới, không có nghĩa là bỏ qua bước review.

## Việc KHÔNG nằm trong scope plan này

- Viết lại/biên tập nội dung khác với trang mẫu (đây là clone, không phải redesign nội dung), ngoại trừ thông tin liên hệ (đổi sang của Academy theo quyết định #2) và layout học kỳ (theo quyết định #5).
- Xây dựng plugin popup mới cho modal đăng ký — Academy hiện chưa cài plugin popup nào; Phase 3 đề xuất bỏ popup modal, dùng lại form CF7 inline thay thế thay vì tự viết JS modal.

## Quyết định đã chốt (2026-08-25, theo xác nhận trực tiếp của content owner)

1. **Duplicate content & bản quyền bên thứ 3:** Được phép — clone nguyên ảnh/tên giảng viên, cựu sinh viên, logo doanh nghiệp, logo trường quốc tế sang `academy.fpt.edu.vn`, không cần xin phép lại (cùng nội bộ FPT).
2. **Thông tin liên hệ:** Dùng thông tin liên hệ của **Academy** (hotline, email, địa chỉ) — **không** giữ hotline `0833/0834 999 810` của Aptech. Số/địa chỉ cụ thể của Academy chưa có sẵn trong code repo (là nội dung động, không nằm trong theme) — lấy từ trang chủ/footer hiện hành của `academy.fpt.edu.vn` khi build Phase 1, không tự đoán số.
3. **Form đăng ký & Popup:** Dùng plugin sẵn có của Academy — đã xác nhận qua `LocalSite/wp-content/plugins/`: **Contact Form 7** (kèm `wpcf7-recaptcha`, `wpcf7-redirect`) là plugin form duy nhất đang cài. Không có plugin popup nào (không có Popup Maker/Elementor Popup/OptinMonster) → xem quyết định popup ở Phase 3.
4. **SEO:** Trang được tối ưu SEO như một trang **gốc của Academy** (không noindex, không canonical trỏ về Aptech) — Title/Meta Description/OG image viết riêng cho `academy.fpt.edu.vn`, không copy nguyên SEO tag của trang mẫu.
5. **Layout học kỳ (thay đổi so với dự kiến ban đầu, không dùng `[tabgroup]`):** Mỗi học kỳ = 1 `[row]` riêng, 2 `[col]`: 1 cột thông tin (môn học/kỹ năng/vị trí nghề nghiệp/chuẩn đầu ra, giữ nguyên text), 1 cột video YouTube (dùng video đồ án thật của đúng học kỳ đó — xem mapping ở Phase 1 mục 6/11 đã gộp). Nếu học kỳ chưa có link video hoặc link lỗi → fallback hiển thị ảnh banner tĩnh (`hk{N}_2025.jpg`) thay vì embed. Thứ tự cột **đảo (swap) xen kẽ mỗi hàng**: Kỳ 1 info-trái/video-phải, Kỳ 2 video-trái/info-phải, Kỳ 3 info-trái/video-phải, Kỳ 4 video-trái/info-phải. Chi tiết ở Phase 2.
