# Phase 1: Content & Asset Mapping

Ký hiệu trạng thái: **KEEP** = giữ nguyên nội dung/khối hiện có · **UPDATE** = giữ nội dung, đổi hình thức/ảnh · **NEW** = khối chưa tồn tại trên trang hiện tại, cần build mới.

Toàn bộ đường dẫn ảnh tương đối tới:
`AcademyFPT/pages/chuong-trinh-dao-tao/lap-trinh-aptech/aptech_tuyensinh_assets/`

## 1. Hero Banner — UPDATE

- Giữ nguyên H1 "LẬP TRÌNH VIÊN QUỐC TẾ FPT APTECH" + đoạn mô tả Full-Stack/AI hiện có (dòng 11-16 file gốc) — nội dung tốt, đúng trọng tâm AI 240 giờ.
- Giữ nguyên hàng 4 ô nhanh (Đối tác / Chứng chỉ / Thời gian / Ca học) — đã khớp với trang mẫu.
- Đổi ảnh nền hero sang `Banner-FAT_LAP-TRINH-x-AI_NB_NLG_thuanhq-900x900-1.png` (có sẵn 4 size: 150/300/768/full) thay cho background hiện tại (media id `4187`).
- Thêm badge "26 năm" cạnh H1: `logo-26-nam-fat1999-400x145-1.png`.
- Ảnh OG/share (SEO checklist mục 3 trong SOP) dùng sẵn `Website-FAT_LAP-TRINH-x-AI-1200x628_Nen.png` — đúng chuẩn 1200x628.

## 2. Trust Bar / Số liệu uy tín — NEW

Trang mẫu có dải số liệu (26 năm, tỷ lệ việc làm...). **Không tự bịa số liệu mới.** Chỉ dùng số đã có trong nội dung hiện tại của trang:
- "27 năm kinh nghiệm đào tạo Lập trình tại Việt Nam từ năm 1999" (đã có ở dòng 182 file gốc).
- Các số khác (% việc làm, số cựu sinh viên...) — **câu hỏi mở**, cần content owner xác nhận số liệu thật trước khi đưa lên (xem Phase 2).

## 3. Ai nên tham gia khóa học — UPDATE (khớp gần như 1:1)

4 card hiện có khớp chính xác với 4 ảnh phân khúc học viên đã crawl:

| Card hiện tại (dòng) | Ảnh mới đề xuất |
| :--- | :--- |
| Học sinh muốn học CNTT bài bản (111) | `hoc-sinh-thpt-540x360-1.jpg` |
| Sinh viên CNTT/trái ngành (124) | `sinh-vien-540x360-1.jpg` |
| Người đi làm muốn chuyển ngành (137) | `nguoi-di-lam-540x360-1.jpg` |
| Bộ đội xuất ngũ (150) | `bo-doi-xuat-ngu-540x360-1.jpg` |

Giữ nguyên toàn bộ text, chỉ đổi `img=` id trong `[ux_image_box]` sang ảnh mới (cần upload vào Media Library trước, lấy ID mới).

## 4. Đặc điểm nổi bật / Lợi ích — UPDATE

Nội dung hiện tại có 8 mục dạng slider text-only (dòng 174-253). Trang mẫu trình bày dạng icon + text, 6 mục. Có sẵn 6 icon: `Loi-ich-01-2025.png` … `Loi-ich-06.png`.

**Câu hỏi mở:** 8 mục hiện tại → gộp còn 6 để khớp icon, hay giữ 8 mục và cần thêm 2 icon cùng bộ? Đề xuất gộp 2 cặp ý gần nhau (ví dụ "Dạy & học trên EduNext" + "MOOC Coursera/Udemy" → 1 mục "Nền tảng học tập đa dạng").

## 5. Công nghệ cốt lõi / 5 Kỹ năng — UPDATE

Nội dung hiện tại là 1 đoạn text liệt kê ngôn ngữ/công nghệ (dòng 271-281). Trang mẫu trình bày dạng infographic 5 kỹ năng. Có sẵn 5 icon: `5K1-V1-2025.png` … `5K5-V1-2025.png` (+ bản `-150x150` cho thumbnail).

**Câu hỏi mở:** cần content owner nhóm danh sách công nghệ hiện tại thành đúng 5 nhóm kỹ năng tương ứng 5 icon (icon không có text nhãn kèm theo trong asset đã crawl).

## 6. Lộ trình 4 học kỳ — KEEP nội dung, UPDATE hình thức

Đây là phần nội dung mạnh nhất của trang hiện tại (dòng 323-716: môn học, kỹ năng đạt được, vị trí nghề nghiệp, chuẩn đầu ra cho từng học kỳ) — **giữ nguyên 100% text**, không viết lại.

Chỉ bổ sung ảnh banner nhỏ đầu mỗi tab:
- Kỳ 1: `hk1_2025.jpg` (banner) / `hk1_2025-300x34.jpg` (dải nhãn nhỏ)
- Kỳ 2: `hk2-2025.jpg` / `hk2-2025-300x34.jpg`
- Kỳ 3: `hk3-2025.jpg` / `hk3-2025-300x34.jpg`
- Kỳ 4: `hk4-2025.jpg` / `hk4-2025-300x34.jpg`

## 7. Đồ án theo từng học kỳ — NEW (bổ sung trong mỗi tab)

Có sẵn 8 ảnh đồ án, đúng 2 ảnh/học kỳ: `do-an-sem-1-1.jpg`, `do-an-sem-1-2.jpg`, … `do-an-sem-4-1.jpg`, `do-an-sem-4-2.jpg`. Chèn thành 1 hàng ảnh nhỏ cuối mỗi tab học kỳ (dòng minh hoạ đồ án thực tế của kỳ đó) — làm phần "Chuẩn đầu ra" trực quan hơn thay vì chỉ text.

## 8. Vị trí nghề nghiệp — NEW (tùy chọn, không bắt buộc)

Hiện tại vị trí nghề nghiệp chỉ liệt kê text trong từng tab (đã đủ). Có thể bổ sung 1 khối tổng hợp dạng icon grid dùng `Cong-viec-V3-1.png` … `Cong-viec-V3-10.png` (10 icon nghề) đặt sau block 4 học kỳ, để tạo điểm nhấn thị giác tổng quan như trang mẫu. **Đánh dấu nice-to-have**, không chặn go-live nếu bỏ qua.

## 9. Liên thông trong nước — NEW

Chưa có trên trang hiện tại. Trang mẫu có mục liên thông Đại học FPT 3 cơ sở:
- `fpt-ha-noi.jpeg` (+ `-375x259`)
- `fpt-ho-chi-minh.jpg` (+ `-569x259`)
- `fpt-da-nang.jpg` / `fpt-da.jpg` (+ size nhỏ)
- Banner "liên thông": `landingpage-lien-thong-fptu-276x84-1.png`

Có thể liên kết chéo với card "Chuyển đổi tín chỉ" đã có sẵn ở cuối trang (dòng 1300-1312, link `/lien-thong-chuyen-doi-tin-chi/`) thay vì tạo nội dung trùng lặp.

## 10. Liên thông quốc tế — NEW

Chưa có trên trang hiện tại. Logo 3 trường đối tác quốc tế có sẵn:
- `MiddlesexUniversity.jpg` (+ `-189x74`)
- `LincolnUniversity.png` (+ `-200x70`)
- `UclanCampus-1.png` (+ `-143x75`) và ảnh campus `CampusofUCLanCyprus-scaled.jpg`

## 11. Đăng ký tư vấn (Contact Form 7) — KEEP

Form CF7 id `6057` giữ nguyên, đã hoạt động tốt. Nút Zalo nhanh (`ux_image_box img="9193"`) giữ nguyên.

`banner_popup_819x1024.jpg` có thể dùng cho popup exit-intent riêng — xem câu hỏi mở Phase 2 (phụ thuộc plugin popup đang cài).

## 12. FAQ — ⚠️ BLOCKING, chưa thể build

Toàn bộ 6 câu hỏi hiện tại là **Lorem Ipsum placeholder** (dòng 779-816). Đây là gap nội dung thật, không phải vấn đề hình ảnh. **Không tự viết nội dung FAQ thay content owner** (học phí, trả góp, điều kiện đầu vào, cam kết việc làm là thông tin chính sách, cần nguồn chính thức). Cần content owner cung cấp trước khi build session này.

## 13. Đội ngũ giảng viên — KEEP, ảnh tùy chọn nâng cấp

6 giảng viên hiện tại khớp gần như 1:1 với trang mẫu (Nguyễn Tuân, Đặng Kim Thi, Nguyễn Duy Hoàng, Trần Phước Sinh, Nguyễn Hạ Vy, Hoàng Đức Quang). Giữ nguyên text tiểu sử. Ảnh thay thế nếu cần nét hơn:
`gv-tran-phuoc-sinh.jpg`, `gv-hoang-duc-quang.jpg`, `gv-nguyen-ha-vy.jpg`, `Co-Dang-Kim-Thi.jpg`, `Thay-Nguyen-Duy-Hoang-1-scaled-e1670926117555.jpg`, `gv1-1.jpg` (Nguyễn Tuân).

## 14. Câu chuyện sinh viên — KEEP, ảnh tùy chọn nâng cấp

7 testimonial hiện tại khớp chính xác tên với 7 ảnh đã crawl:
`Ngo-Ngoc-Duc.png`/`cam-nhan-ngo-ngoc-duc.jpg`, `Ung-Vuong-Mai-Tra.png`/`cam-nhan-ung-vuong-mai-tra.jpg`, `Nguyen-Doan-Dai.jpg`, `Pham-Tien-Dung.png`/`cam-nhan-pham-tien-dung.jpg`, `Nguyen-Quynh-Thu.png`/`cam-nhan-nguyen-quynh-thu.jpg`, `Nguyen-Dinh-Hieu.png`/`cam-nhan-nguyen-dinh-hieu.jpg`, `Nguyen-Sy-Tuan.png`/`cam-nhan-nguyen-sy-tuan.jpg`.

Giữ nguyên toàn bộ quote. Video testimonial (trang mẫu có nhúng YouTube) — **câu hỏi mở**, chưa có link video trong assets đã crawl.

## 15. Đồ án tiêu biểu (portfolio widget) — UPDATE nhẹ

Giữ `[ux_portfolio cat="12"]` (widget động, vẫn scale tốt khi thêm đồ án mới). Có thể thêm dải 8 ảnh `do-an-sem-*.jpg` phía trên làm "nổi bật theo học kỳ" — trùng với mục 7, cân nhắc chỉ làm 1 trong 2 chỗ để tránh lặp ảnh.

## 16. Đối tác tuyển dụng — NEW

Chưa có trên trang hiện tại, đây là khối bổ sung giá trị lớn nhất so với bản gốc. 18 logo doanh nghiệp có sẵn: `logo-doanh-nghiep-01.jpg` … `logo-doanh-nghiep-18.jpg` (mỗi logo có 4 size 150/300/768/1024, dùng size 300 cho lưới, 150 nếu chạy dạng logo ticker/marquee).

## 17. Khám phá thêm — KEEP

Giữ nguyên 3 card cuối trang (dòng 1296-1350), không cần thay đổi.

## 18. Sticky CTA Bar (mobile) — NEW

Chưa có. Trang mẫu không có sticky bar rõ ràng ngoài nút Zalo nổi (đã có ở trang hiện tại, giữ nguyên). Đề xuất giữ nguyên như SOP cũ mô tả — xem Phase 2 mục kỹ thuật.

## Ảnh chưa xác định vai trò rõ ràng — cần xác nhận trước khi dùng

- `tttf.png` / `tttf-150x25.png` — chưa rõ mục đích (nhãn/ribbon nhỏ tỉ lệ 6:1), không đoán và gán bừa vào section nào.
- `nn1.png`/`nn1-370x208.png`, `nn2.jpeg`/`nn2-370x208.jpeg` — chưa rõ nội dung (không có tên file gợi ý rõ ràng).
- `icon_title.png` — có thể là icon trang trí trước tiêu đề section, cần xem thực tế trên trang mẫu để xác nhận vị trí dùng.
- `texture-phan-cam.png` — có thể là texture nền trang trí (background overlay), dùng tùy chọn cho hero hoặc CTA cuối trang.
- `Website-FAT_12-nam-den-sach_*.png` — asset chiến dịch cũ ("12 năm"), khả năng cao là banner sự kiện đã hết hạn, **không dùng** trừ khi content owner xác nhận vẫn còn hiệu lực.
