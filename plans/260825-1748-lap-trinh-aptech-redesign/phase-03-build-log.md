# Phase 3: Build Log & Kết quả thực thi

**Ngày thực hiện:** 2026-08-25

## Đã làm

1. **Phát hiện môi trường có sẵn:** local WordPress (`LocalSite/`, MariaDB qua `LocalDb/docker-compose.yml`, `wp-cli`) và trang Draft đã tồn tại sẵn (Page ID `9450`, clone từ trang live `9451`) — đúng Bước 2 trong SOP (`update-flow/page-lap-trinh-aptech.md`). Đồng thời phát hiện `css/additional-css.css` đã có sẵn (uncommitted, chưa rõ tác giả) một bộ class `.fpt-v2-*` / `.fpt-hero-*` / `.fpt-trust-*` / `.fpt-audience-*` / `.fpt-roadmap-*` / `.fpt-lecturer-*` / `.fpt-sticky-cta-*` được thiết kế khớp gần như chính xác với cấu trúc session trong plan — **đã dùng nguyên bộ class này** thay vì mở rộng `laptrinhvien-*` như phase-02 dự kiến ban đầu, để tránh trùng lặp 2 hệ CSS.
2. **Upload 72 ảnh** từ `aptech_tuyensinh_assets/` vào Media Library của WP local (script `import_media.sh`, log gốc + `media_map_clean.csv`). Danh sách ID đã lưu tại [media-id-map-local.csv](../../pages/chuong-trinh-dao-tao/lap-trinh-aptech/media-id-map-local.csv) trong thư mục page.
3. **Viết shortcode hoàn chỉnh** tại [shortcode_v2_draft.txt](../../pages/chuong-trinh-dao-tao/lap-trinh-aptech/shortcode_v2_draft.txt) — tái sử dụng 100% nội dung xác thực đã có (mô tả chương trình, 4 học kỳ, bios giảng viên, testimonial sinh viên), chỉ đổi khung hiển thị (class `fpt-v2-*`) và gắn ảnh thật (ID media local).
4. **Đẩy vào trang Draft** (`wp post update 9450 shortcode_v2_draft.txt`, đổi tiêu đề thành `[DRAFT V2] Lập trình viên quốc tế FPT Aptech`, giữ `post_status=draft`) để xem trước ngay trên site local.
5. **Kiểm tra tự động:** đối chiếu số lượng mở/đóng của từng shortcode tag (section/row/col/tab/accordion...) bằng script Python — khớp 100%. Render thử qua `apply_filters('the_content', ...)` — không còn shortcode nào chưa được parse, toàn bộ 78 thẻ `<img>` đều có `src` hợp lệ (bao gồm 18 logo doanh nghiệp, banner hero, ảnh 4 học kỳ...).

## Cấu trúc file trong `pages/chuong-trinh-dao-tao/lap-trinh-aptech/`

```
shortcode_250826.txt        # bản gốc (giữ nguyên = backup lớp 1 theo SOP)
shortcode_v2_draft.txt      # bản mới đã build (nội dung đã nạp vào Page ID 9450 local)
media-id-map-local.csv      # ánh xạ filename -> media ID trên WP LOCAL (không dùng được trên production)
aptech_tuyensinh_assets/    # 204 ảnh nguồn crawl từ trang mẫu (đã dùng 72/204)
```

## ⚠️ Việc PHẢI làm lại khi go-live lên site production

`media-id-map-local.csv` chỉ đúng trên WordPress **local**. Khi build ở site production (`academy.fpt.edu.vn`), **phải upload lại 72 ảnh trong `aptech_tuyensinh_assets/` vào Media Library production để lấy ID mới**, rồi thay toàn bộ ID trong `shortcode_v2_draft.txt` (tìm-thay theo bảng mapping key → filename trong CSV, không thể copy ID trực tiếp).

## Những gì CHƯA làm — giữ nguyên như bản gốc, cần content owner xác nhận trước go-live

Đúng như câu hỏi mở đã nêu ở phase-02, các mục sau **chưa** được xử lý (để tránh tự bịa nội dung):

1. **FAQ (6 câu hỏi):** vẫn còn nguyên Lorem Ipsum trong `shortcode_v2_draft.txt` — **blocking**, không được go-live khi chưa có nội dung thật.
2. **5 kỹ năng cốt lõi (5K1-5K5):** không dùng icon này trong bản build — giữ nguyên đoạn text "Công nghệ cốt lõi" gốc, chỉ bọc khung card mới. Icon 5K chưa được upload/gán vì không rõ ý nghĩa từng icon.
3. **10 icon vị trí nghề nghiệp (Cong-viec-V3):** đã chèn dạng ảnh thuần (không thêm nhãn text tự chế) vì không chắc icon nào ứng với vị trí nào.
4. **Trust bar:** chỉ dùng 4 số liệu đã có sẵn trong nội dung gốc (27 năm, 240 giờ, 4 học kỳ, 70% thực hành) — không thêm số liệu mới (% việc làm, số cựu SV...) vì chưa được xác nhận.
5. **6 mục "Đặc điểm nổi bật":** đã gộp 8 mục gốc thành 6 card để khớp 6 icon `Loi-ich-01~06` — toàn bộ text gốc được giữ nguyên, chỉ gộp 2 cặp câu có chủ đề gần nhau vào chung 1 card (xem card 2 và card 6 trong shortcode).
6. **Popup đăng ký, video testimonial, xin phép dùng logo bên thứ 3 (Middlesex/Lincoln/UCLan/18 doanh nghiệp):** chưa triển khai / chưa xin phép — như đã nêu ở phase-02.

## Cách xem thử

Site local chạy tại `http://localhost:8000` (theo `router.php`/`wp-config.php`). Đăng nhập wp-admin và mở Page ID `9450` ở chế độ Preview hoặc Edit để xem giao diện mới.
