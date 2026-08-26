# Plan: Redesign trang "Lập trình viên quốc tế FPT Aptech"

**Status:** Draft — ready for content-owner review before build
**Page:** `academy.fpt.edu.vn/chuong-trinh-dao-tao/lap-trinh-aptech/` (ID 5606, Flatsome UX Builder)
**Mẫu tham chiếu:** `https://aptech.fpt.edu.vn/tuyensinh`
**SOP quy trình build/go-live/rollback:** đã có sẵn tại `AcademyFPT/update-flow/page-lap-trinh-aptech.md` — plan này **không lặp lại** SOP đó, chỉ bổ sung phần còn thiếu: mapping nội dung/hình ảnh cụ thể + đối chiếu với trang mẫu thật.

## Vì sao cần plan riêng thay vì build thẳng theo SOP cũ

SOP cũ đề xuất cấu trúc 10 session dựa trên suy đoán xu hướng EdTech chung. Plan này đối chiếu lại với:
1. Cấu trúc thật của `aptech.fpt.edu.vn/tuyensinh` (đã fetch trực tiếp, 20 khối nội dung).
2. 204 file ảnh đã có sẵn tại `pages/chuong-trinh-dao-tao/lap-trinh-aptech/aptech_tuyensinh_assets/` (crawl từ chính trang mẫu).
3. Nội dung hiện có trong `shortcode_250826.txt` — phần lớn nội dung chương trình học đã tốt, **không cần viết lại**, chỉ cần đổi khung hiển thị + bổ sung ảnh.

Kết quả: giữ nguyên những gì đã tốt, chỉ build mới phần thực sự thiếu, tránh làm lại từ đầu.

## Phases

| Phase | File | Nội dung |
| :--- | :--- | :--- |
| 1 | [phase-01-content-asset-mapping.md](phase-01-content-asset-mapping.md) | Bảng đối chiếu từng session: giữ / cập nhật / mới, nội dung nguồn, file ảnh cụ thể dùng |
| 2 | [phase-02-build-css-qa.md](phase-02-build-css-qa.md) | Cấu trúc shortcode Flatsome cần build, class CSS mới cần thêm vào `additional-css.css`, và các câu hỏi cần chốt trước khi build |

## Nguyên tắc build

- **Không sửa trực tiếp trang live.** Theo đúng SOP đã có: build ở trang Draft riêng, review qua Public Post Preview, swap shortcode vào ID 5606 khi đã duyệt, giữ nguyên URL/slug.
- Tái dùng nội dung chương trình đào tạo (4 học kỳ, môn học, kỹ năng, vị trí nghề nghiệp, chuẩn đầu ra) **nguyên văn** từ `shortcode_250826.txt` — nội dung này chi tiết và chính xác hơn cả trang mẫu, chỉ đổi cách trình bày (thêm banner học kỳ, ảnh minh hoạ).
- Ảnh dùng từ `aptech_tuyensinh_assets/` là ảnh của chính thương hiệu FPT Aptech (cùng hệ thống FPT), việc tái sử dụng giữa `aptech.fpt.edu.vn` và `academy.fpt.edu.vn` là quyết định thương hiệu nội bộ — cần xác nhận với content owner trước khi upload vào thư viện media (xem câu hỏi mở ở Phase 2).
- Giữ family class CSS `laptrinhvien-*` đã có (dùng chung với các trang chị em `jetking`/`cranes`/`arena`/`skiling`), không tạo hệ class mới song song.

## Việc KHÔNG nằm trong scope plan này

- Viết lại nội dung FAQ (hiện đang là Lorem Ipsum — xem Phase 2, mục câu hỏi mở, cần content owner cung cấp Q&A thật trước khi build session này).
- Popup đăng ký dạng modal (banner_popup asset có sẵn) — cần xác nhận plugin popup đang dùng trên site trước khi thiết kế, không giả định plugin nào.
- Video testimonial (trang mẫu có nhúng YouTube) — cần link video thật từ content owner, hiện chưa có trong assets đã crawl.
