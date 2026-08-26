# Phase 1: Content & Asset Inventory

Nguồn: fetch trực tiếp `https://aptech.fpt.edu.vn/tuyensinh/` ngày 2026-08-25. 16 section theo thứ tự trên trang, kèm ảnh dùng trong từng section và trạng thái đối chiếu với kho ảnh đã crawl sẵn tại `pages/chuong-trinh-dao-tao/lap-trinh-aptech/aptech_tuyensinh_assets/` (204 file, crawl từ đúng trang mẫu này).

Ký hiệu: **CÓ SẴN** = đã thấy tên file khớp trong kho 204 ảnh (xác nhận qua `phase-01-content-asset-mapping.md` của plan `lap-trinh-aptech-redesign` hoặc qua `find` trực tiếp) · **CẦN XÁC NHẬN** = chưa thấy trực tiếp, cần `ls` lại toàn bộ 204 file trước khi build · **CẦN TẢI MỚI** = không có trong kho, phải tải từ trang mẫu.

## 1. Header & Nav
- Text: "FPT Aptech Tuyển Sinh Năm 2025" → đổi tiêu đề theo trang Academy (ví dụ "FPT Academy Tuyển Sinh..." hoặc tên chương trình thật, chốt khi build). Hotline **đổi sang số của Academy** (quyết định #2) — cần lấy số hiện hành từ trang chủ/footer `academy.fpt.edu.vn` khi build, không dùng `0833/0834 999 810` của Aptech, không có số Academy sẵn trong repo để tự điền trước.
- Ảnh: `logo-26-nam-fat1999-400x145-1.png` (CÓ SẴN), `Banner-FAT_LAP-TRINH-x-AI_NB_NLG_thuanhq-900x900-1.png` (CÓ SẴN).

## 2. Registration CTA (form đầu trang)
- Text: "Đăng ký nhận tư vấn tại đây!" + mô tả ngắn, dropdown chọn cơ sở (Hà Nội / TP.HCM).
- Form: `[contact-form-7]` — plugin đã xác nhận (quyết định #3). Tái dùng id `6057` (đã dùng cho `lap-trinh-aptech`, cùng mục đích tư vấn tuyển sinh) nếu field khớp yêu cầu, hoặc tạo form CF7 riêng nếu cần field "Cơ sở học" khác — chốt cụ thể ở Phase 3.

## 3. Giới thiệu FPT Aptech
- Text thuần: mô tả 26 năm phát triển, sứ mệnh. Copy nguyên văn (verified lại full text khi build, bản tóm tắt ở đây chưa đầy đủ 100%).
- Không có ảnh riêng.

## 4. Đối tượng học viên (4 card)
- Heading: "NHỮNG AI NÊN THAM GIA KHOÁ HỌC LẬP TRÌNH TẠI FPT APTECH?"
- Ảnh: `hoc-sinh-thpt-540x360-1.jpg`, `sinh-vien-540x360-1.jpg`, `nguoi-di-lam-540x360-1.jpg`, `bo-doi-xuat-ngu-540x360-1.jpg` — **CÓ SẴN** cả 4 (đã xác nhận qua find trực tiếp).

## 5. 6 lý do nên học (icon + text)
- Ảnh: `Loi-ich-01-2025.png`, `Loi-ich-02.png` … `Loi-ich-06.png` — **CÓ SẴN** cả 6.

## 6. Chương trình đào tạo 4 học kỳ — **gộp với mục 11 (video đồ án) theo quyết định #5**
- Heading: "CHƯƠNG TRÌNH ĐÀO TẠO LẬP TRÌNH FULL-STACK TÍCH HỢP AI". Nội dung môn học/công nghệ từng kỳ — copy nguyên văn từ trang mẫu (không dùng lại text của `lap-trinh-aptech` vì có thể lệch phiên bản).
- Layout mới (quyết định #5, khác trang mẫu): mỗi học kỳ = 1 row 2 cột — cột info (text môn học/kỹ năng/vị trí nghề nghiệp/chuẩn đầu ra) + cột video YouTube. Cột thứ tự đảo xen kẽ mỗi hàng (Kỳ 1: info-trái/video-phải; Kỳ 2: video-trái/info-phải; Kỳ 3: info-trái/video-phải; Kỳ 4: video-trái/info-phải).
- Nguồn video: dùng đúng 2 video đồ án thật của từng học kỳ đã có sẵn href ở mục 11 (không phải video giả định) — mỗi học kỳ có 2 video, Phase 2 chốt dùng 1 video đại diện/kỳ hoặc mini-slider 2 video trong cùng cột.
- Ảnh banner fallback (khi học kỳ chưa có link video hoặc link lỗi): `hk1_2025.jpg`, `hk2-2025.jpg`, `hk3_2025.jpg`, `hk4-2025.jpg` — hk1/hk2/hk4 **CÓ SẴN** (xác nhận qua find), hk3 **CẦN XÁC NHẬN** lại tên file chính xác (`hk3_2025.jpg` hay `hk3-2025.jpg`). Hiện tại cả 4 kỳ đều có video hợp lệ (xem mục 11) nên fallback chỉ kích hoạt nếu video lỗi khi QA, không phải trạng thái mặc định.

## 7. Công việc sau tốt nghiệp (10 icon)
- Ảnh: `Cong-viec-V3-1.png` … `Cong-viec-V3-10.png` — **CÓ SẴN** (đã thấy V3-1,2,4,7,8,10 qua find trực tiếp, còn lại xác nhận trong bước `ls` đầy đủ).

## 8. Học chuyển tiếp (trong nước + quốc tế)
- Trong nước: `landingpage-lien-thong-fptu-276x84-1.png`, `fpt-da-375x259.jpg`/`fpt-da.jpg`, `fpt-ho-chi-minh-569x259.jpg`, `fpt-da-nang-569x259.jpg`, `fpt-ha-noi-375x259.jpeg` — phần lớn **CÓ SẴN**, `fpt-da-nang-569x259.jpg` **CẦN XÁC NHẬN**.
- Quốc tế: `nn1-370x208.png`, `MiddlesexUniversity-189x74.jpg` (CÓ SẴN), `nn2-370x208.jpeg`, `LincolnUniversity-200x70.png`, `CampusofUCLanCyprus-scaled-370x208.jpg`, `UclanCampus-1-143x75.png` (CÓ SẴN) — `nn1`, `nn2`, `LincolnUniversity`, `CampusofUCLanCyprus` **CẦN XÁC NHẬN** qua `ls` đầy đủ (không thấy trong lần find trực tiếp bị cắt bớt, nhưng có ghi nhận trong `phase-01-content-asset-mapping.md` của plan trước).
- Link ngoài: mdx.ac.uk, lincoln.edu.my, uclan.ac.uk — giữ nguyên href gốc.

## 9. Đội ngũ giảng viên (6 người) + 5 kỹ năng cốt lõi
- Ảnh giảng viên: `gv-tran-phuoc-sinh.jpg`, `gv-nguyen-ha-vy.jpg`, `gv-hoang-duc-quang.jpg`, `gv1-1.jpg` (Nguyễn Tuân), `Co-Dang-Kim-Thi.jpg`, `Thay-Nguyen-Duy-Hoang-1-scaled-e1670926117555.jpg` — phần lớn **CÓ SẴN** theo `phase-01-content-asset-mapping.md` của plan trước.
- Ảnh 5 kỹ năng: `5K1-V1-2025.png` … `5K5-V1-2025.png` — **CÓ SẴN** (thấy 5K1,2,4 + bản 150x150 qua find trực tiếp).
- Text tiểu sử từng giảng viên: copy nguyên văn.

## 10. Thông tin tuyển sinh 2025
- Text thuần: đối tượng, hình thức tuyển sinh, hồ sơ đăng ký (3 mục). Không có ảnh riêng.

## 11. Đồ án sinh viên (8 thumbnail → link YouTube) — **nguồn video dùng cho mục 6, không tách section riêng**
- Ảnh: `do-an-sem-1-1.jpg` … `do-an-sem-4-2.jpg` (8 file) — **CẦN XÁC NHẬN** qua `ls` đầy đủ (không thấy trong find trực tiếp bị cắt, nhưng có ghi nhận trong plan trước là "có sẵn 8 ảnh đồ án").
- 8 link YouTube giữ nguyên href, map theo đúng học kỳ (đã xác nhận qua fetch):
  - Kỳ 1: `youtube.com/watch?v=vBx808h06LA`, `youtube.com/watch?v=PqBuTJJqLfg`
  - Kỳ 2: `youtube.com/watch?v=avKlisAnQ68`, `youtube.com/watch?v=qxy-2I7CUlQ`
  - Kỳ 3: `youtube.com/watch?v=ysO71qcJhko`, `youtube.com/watch?v=FIQUbh9BYAE`
  - Kỳ 4: `youtube.com/watch?v=zIFyF5UYHoQ`, `youtube.com/watch?v=s7R1t-0iie8`
- Theo quyết định #5, các video này chuyển vào cột video của mục 6 (mỗi học kỳ 1 row). Không giữ section 11 riêng để tránh lặp nội dung.

## 12. Câu chuyện sinh viên (6 người, quote + ảnh chân dung + video)
- Ảnh chân dung: `Pham-Tien-Dung.png` (CÓ SẴN), `Nguyen-Quynh-Thu.png`, `Nguyen-Dinh-Hieu.png`, `Ngo-Ngoc-Duc.png` (CÓ SẴN), `Nguyen-Sy-Tuan.png`, `Ung-Vuong-Mai-Tra.png` — 4/6 **CẦN XÁC NHẬN**.
- Ảnh thumbnail video: `cam-nhan-pham-tien-dung.jpg`, `cam-nhan-nguyen-quynh-thu.jpg`, `cam-nhan-nguyen-dinh-hieu.jpg`, `cam-nhan-ngo-ngoc-duc.jpg` (CÓ SẴN), `cam-nhan-nguyen-sy-tuan.jpg`, `cam-nhan-ung-vuong-mai-tra.jpg` (CÓ SẴN) — 2/6 **CẦN XÁC NHẬN**.
- Quote + 6 link bài viết nội bộ `aptech.fpt.edu.vn/...html` — copy nguyên văn, giữ href gốc (trỏ sang domain khác, xem câu hỏi mở #1).

## 13. Logo doanh nghiệp liên kết (18 logo)
- Ảnh: `logo-doanh-nghiep-01-150x150.jpg` … `logo-doanh-nghiep-18-150x150.jpg` — **CÓ SẴN** đầy đủ (đã thấy 01,02,03,04,05,06,07,08,09,10,11,13,14,15,16,17 qua find trực tiếp; 12,18 cần xác nhận trong `ls` đầy đủ).

## 14. CTA giữa trang
- Ảnh: `Website-FAT_12-nam-den-sach_NB_thuanhq-1000x523-1.png` — **CÓ SẴN** (thấy bản `-300x157` qua find, xác nhận file gốc trong `ls` đầy đủ). Lưu ý: plan `lap-trinh-aptech-redesign` trước từng nghi ngờ asset "12 năm" đã hết hạn — **fetch lần này xác nhận asset vẫn đang được dùng thật trên trang mẫu**, không phải campaign cũ.

## 15. Popup đăng ký (modal)
- Ảnh: `banner_popup_819x1024.jpg` — **CÓ SẴN** (thấy bản `-240x300` qua find).
- Cần xác nhận plugin popup đang dùng trên `academy.fpt.edu.vn` (câu hỏi mở #3).

## 16. Footer
- Text: đổi sang địa chỉ cơ sở + link mạng xã hội của **Academy** (quyết định #2), không dùng 3 địa chỉ Hà Nội/HCM/Thủ Đức của Aptech. Nếu theme Academy đã có footer site-wide hiển thị sẵn địa chỉ/social, không cần lặp lại trong nội dung section — chỉ thêm nếu footer mặc định chưa có.
- Không có ảnh riêng — dùng social icon có sẵn của Flatsome.

## Việc cần làm đầu Phase 1 khi bắt đầu build (không làm trong bước lập plan này)

1. Chạy `ls` đầy đủ 204 file trong `aptech_tuyensinh_assets/` để xác nhận chính xác từng tên file đánh dấu **CẦN XÁC NHẬN** ở trên (chủ yếu: hk3, fpt-da-nang, nn1/nn2, LincolnUniversity, CampusofUCLanCyprus, 8 ảnh do-an-sem, 4 ảnh chân dung + 2 thumbnail cựu sinh viên, logo doanh nghiệp 12 & 18).
2. Với file xác nhận thiếu thật sự → tải bổ sung từ URL gốc đã liệt kê ở trên (đã có đầy đủ URL qua fetch).
3. Copy toàn bộ ảnh cần dùng (không phải cả 204 file, chỉ phần thực dùng ở 16 section trên) sang `AcademyFPT/pages/chuong-trinh-dao-tao/aptech/aptech_assets/` để trang mới tự chứa.
4. Lấy lại full text nguyên văn từng section (section 3, 6, 9, 10, 12 có đoạn dài) bằng cách mở trực tiếp trang mẫu — bản tóm tắt trong file này chỉ đủ để lập plan, **không dùng để build** (tránh sai lệch do rút gọn qua fetch).
5. Lấy thông tin liên hệ thật của Academy (hotline, địa chỉ, social link hiện hành) từ trang chủ/footer `academy.fpt.edu.vn` để thay cho thông tin của Aptech ở mục 1/16 — không tự bịa số.
