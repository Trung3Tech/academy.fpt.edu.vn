# Phase 2: Build Structure, CSS Extensions & Open Questions

## Cấu trúc shortcode đề xuất (thứ tự session)

Dùng đúng shortcode Flatsome UX Builder đã có trong theme (không cần plugin builder mới):

1. `[section]` Hero — giữ `[ux_image]` + `[ux_text]` H1/mô tả hiện có, đổi `bg=` sang media ID mới của `Banner-FAT_LAP-TRINH-x-AI...png`, thêm `[ux_image]` badge 26 năm trong `[row_inner]` cạnh H1.
2. `[row_inner]` Trust bar — 1 hàng `[featured_box]` số liệu (tái dùng pattern đã có ở dòng 22-83 file gốc, không cần shortcode mới).
3. `[row]` 4 card đối tượng — giữ nguyên `[ux_image_box]` hiện có (dòng 103-158), chỉ đổi `img=` id.
4. `[ux_slider]` 6 lợi ích icon — đổi từ `[row_inner]`/`[col_inner]` text-only (dòng 174-253) sang `[featured_box]` icon+text như pattern đã dùng ở section "Đối tác/Chứng chỉ/Thời gian/Ca học" (dòng 22-33).
5. 5 kỹ năng — `[row_inner]` 5 `[col_inner]` dạng `[featured_box]`, dùng icon `5K1`…`5K5`.
6. `[tabgroup]` 4 học kỳ — **giữ nguyên toàn bộ cấu trúc `[tab title="Học kỳ N"]` hiện có (dòng 323-716)**, chỉ chèn thêm `[ux_image]` banner đầu mỗi tab và 1 `[row_inner]` 2 ảnh đồ án cuối mỗi tab.
7. (tùy chọn) `[row_inner]` icon grid 10 vị trí nghề nghiệp.
8. `[row]` Liên thông trong nước — 3 `[ux_image_box]` cơ sở Hà Nội/HCM/Đà Nẵng.
9. `[row]` Liên thông quốc tế — 3 `[ux_image]` logo trường đối tác.
10. Form đăng ký — giữ nguyên `[contact-form-7 id="6057"]` (dòng 744).
11. FAQ — giữ nguyên `[accordion]` (dòng 773-822), **chỉ thay nội dung khi có Q&A thật**.
12. Đội ngũ giảng viên — giữ nguyên `[ux_slider]` (dòng 838-953), đổi `img=` nếu dùng ảnh mới.
13. Câu chuyện sinh viên — giữ nguyên `[ux_slider]` (dòng 969-1260), đổi `img=` nếu dùng ảnh mới.
14. Đồ án tiêu biểu — giữ nguyên `[ux_portfolio cat="12"]` (dòng 1274).
15. `[ux_slider]` hoặc marquee CSS — 18 logo đối tác tuyển dụng.
16. Khám phá thêm — giữ nguyên (dòng 1296-1350).

## CSS cần bổ sung vào `AcademyFPT/css/additional-css.css`

Family class hiện có (`laptrinhvien-*`, dùng chung `jetking`/`cranes`/`arena`/`skiling`) đã đủ chuẩn để mở rộng — **không tạo hệ class song song mới**. Cần thêm (đặt tiếp sau block `laptrinhvien-*` hiện có, khoảng dòng 2079-2350):

- `.laptrinhvien-trust-badge` — style badge 26 năm cạnh H1.
- `.laptrinhvien-loi-ich-icon` — style card icon+text cho mục lợi ích (thay thế slider text-only).
- `.laptrinhvien-5k-icon` — style grid 5 kỹ năng.
- `.laptrinhvien-hk-banner` — style banner nhỏ đầu mỗi tab học kỳ.
- `.laptrinhvien-lien-thong-col` — style card liên thông trong nước/quốc tế.
- `.laptrinhvien-doanh-nghiep-logo` / logo marquee — nếu dùng carousel tự chạy cho 18 logo, cần thêm keyframe animation (chưa có trong file hiện tại, kiểm tra xem theme Flatsome có sẵn marquee style nào trước khi viết mới).

Nếu dùng sticky CTA bar mobile: kiểm tra Flatsome đã có tuỳ chọn "Sticky Bar" dựng sẵn trong UX Builder trước khi viết CSS `position: fixed` thủ công — tránh trùng lặp/ xung đột z-index với header sticky hiện có.

## Trình tự thực hiện (theo SOP đã có, không lặp lại chi tiết)

Bám đúng 5 bước trong `update-flow/page-lap-trinh-aptech.md`: Backup (3 lớp) → Build trang Draft → Public Post Preview review → Swap shortcode vào ID 5606 → Rollback plan nếu lỗi. Trước khi build, tất cả ảnh trong `aptech_tuyensinh_assets/` cần **upload vào Media Library WordPress** để lấy ID — hiện tại là file local, chưa dùng được trực tiếp trong shortcode `img="ID"`.

## Câu hỏi mở — cần content owner xác nhận trước khi build

1. **FAQ**: cần 6 câu hỏi/trả lời thật (học phí, trả góp, điều kiện đầu vào, cam kết việc làm...) thay Lorem Ipsum — blocking cho session 11.
2. **Số liệu Trust Bar**: ngoài "27 năm kinh nghiệm" đã có sẵn, có số liệu chính thức nào khác (tỷ lệ việc làm, số cựu sinh viên...) được phép công bố không?
3. **Nhóm 5 kỹ năng cốt lõi**: cách nhóm danh sách công nghệ hiện tại (dòng 271-281) thành đúng 5 nhóm khớp 5 icon `5K1-5K5` — icon không kèm nhãn text trong asset đã crawl.
4. **6 vs 8 mục lợi ích**: gộp 8 mục hiện có xuống 6 để khớp icon `Loi-ich-01~06`, hay giữ 8 và cần thêm icon?
5. **Bản quyền tái sử dụng ảnh**: xác nhận việc dùng ảnh crawl từ `aptech.fpt.edu.vn` (logo doanh nghiệp, ảnh giảng viên/sinh viên, ảnh trường đối tác quốc tế) trên `academy.fpt.edu.vn` là được phép nội bộ (cùng hệ thống FPT) — đặc biệt logo 18 doanh nghiệp đối tác và logo 3 trường quốc tế (Middlesex/Lincoln/UCLan) có thể cần xin phép riêng vì là thương hiệu bên thứ ba.
6. **Popup đăng ký** (`banner_popup_819x1024.jpg`): site đang dùng plugin popup nào (nếu có)? Không giả định plugin để tránh đề xuất sai kỹ thuật.
7. **Video testimonial**: cần link YouTube thật từ content owner, hiện chưa có trong assets đã crawl.
8. **Asset không rõ vai trò**: `tttf.png`, `nn1.png`, `nn2.jpeg`, `icon_title.png` — xem lại trực tiếp trên `aptech.fpt.edu.vn/tuyensinh` (giao diện thật) để xác nhận vị trí dùng trước khi đưa vào build, tránh gán sai.
