# QUY TRÌNH REVIEW & HƯỚNG DẪN CẬP NHẬT TRANG ĐÀO TẠO LẬP TRÌNH VIÊN QUỐC TẾ FPT APTECH

> **Tài liệu hướng dẫn chuẩn SOP (Standard Operating Procedure)**
> * **URL mục tiêu:** `https://academy.fpt.edu.vn/chuong-trinh-dao-tao/lap-trinh-aptech`
> * **Nền tảng:** WordPress 6.x / Flatsome Theme & UX Builder / Contact Form 7 / Rank Math SEO
> * **Đối tượng áp dụng:** Content Creator, Web Designer, Web Admin, IT Support

---

## MỤC LỤC
1. [Phần 1: Review & Đánh giá hiện trạng trang Live](#phan-1-review--danh-gia-hien-trang-trang-live)
2. [Phần 2: Quy trình 5 bước triển khai chuẩn Enterprise](#phan-2-quy-trinh-5-buoc-trien-khai-chuan-enterprise)
   - [Bước 1: Quy trình Sao lưu dữ liệu an toàn (3 lớp bảo hiểm)](#buoc-1-quy-trinh-sao-luu-du-lieu-an-toan-3-lop-bao-hiem)
   - [Bước 2: Xây dựng trang mới với các Session hiện đại](#buoc-2-xay-dung-trang-moi-voi-cac-session-hien-dai)
   - [Bước 3: Quy trình gửi Review & Phê duyệt nội bộ](#buoc-3-quy-trinh-gui-review--phe-duyet-noi-bo)
   - [Bước 4: Xuất bản phiên bản mới (Go-Live không gián đoạn)](#buoc-4-xuat-ban-phien-ban-moi-go-live-khong-gian-doan)
   - [Bước 5: Kịch bản Phục hồi khẩn cấp (Rollback trong 60 giây)](#buoc-5-kich-ban-phuc-hoi-khan-cap-rollback-trong-60-giay)
3. [Phần 3: Checklist kiểm tra chất lượng (QA Checklist)](#phan-3-checklist-kiem-tra-chat-luong-qa-checklist)

---

## PHẦN 1: REVIEW & ĐÁNH GIÁ HIỆN TRẠNG TRANG LIVE

### 1.1. Thông tin trang hiện tại
* **Page ID:** `5606`
* **Slug URL:** `/chuong-trinh-dao-tao/lap-trinh-aptech/`
* **Tiêu đề H1:** *LẬP TRÌNH VIÊN QUỐC TẾ FPT APTECH*
* **Công cụ xây dựng:** Flatsome UX Builder (sử dụng các shortcode `[section]`, `[row]`, `[col]`, `[ux_banner]`, `[accordion]`, `[ux_slider]`).

### 1.2. Phân tích 11 Session hiện hữu
1. **Hero Section (`section_1441148969`):** Banner tiêu đề H1, mô tả ngắn, hình ảnh minh họa lập trình viên và form đăng ký tư vấn nhanh.
2. **Đối tượng đào tạo (`Ai nên tham gia khóa học lập trình tại FPT Aptech`):** 3 cột phân loại đối tượng (Học sinh THPT, Sinh viên CNTT / Trái ngành, Người đi làm).
3. **Ưu điểm chương trình (`section_24263194`):** Đặc điểm nổi bật về phương pháp đào tạo, thời lượng thực hành và cơ hội việc làm.
4. **Công nghệ cốt lõi:** Danh sách icon công nghệ (Java, .NET, Python, Flutter, Node.js, C#, PHP, MongoDB...).
5. **Tổng quan chương trình đào tạo (`section_648196682`):** Chi tiết 4 học kỳ gồm môn học, kỹ năng đạt được, vị trí nghề nghiệp và chuẩn đầu ra.
6. **Lead Generation Form (`Đăng ký tư vấn theo nhu cầu`):** Khối form Contact Form 7 tiếp nhận thông tin học viên.
7. **Câu hỏi thường gặp (`FAQ`):** Khối Accordion giải đáp các băn khoăn về học phí, thời gian và bằng cấp.
8. **Đội ngũ giảng viên (`section_1100591513`):** Slider giới thiệu thông tin và kinh nghiệm chuyên môn của giảng viên.
9. **Câu chuyện sinh viên (`section_725716613`):** Cảm nghĩ, hình ảnh và thành tích của cựu sinh viên tiêu biểu.
10. **Đồ án tiêu biểu (`section_624936618`):** Danh sách 10 đồ án thực tế của sinh viên qua các học kỳ (LegalEase, SmartWallet, HealthLink, TinyMart...).
11. **Khám phá thêm & Footer (`section_646112223`):** Đề xuất các chương trình đào tạo liên quan khác trong hệ thống Viện Đào Tạo Quốc Tế FPT.

### 1.3. Nhận định điểm mạnh & Cơ hội cải tiến

| Tiêu chí | Đánh giá hiện trạng | Đề xuất nâng cấp cho phiên bản mới |
| :--- | :--- | :--- |
| **Bố cục & Thị giác (Visual)** | Layout chuẩn UX Builder, nhiều khối text tĩnh liên tiếp | Áp dụng xu hướng EdTech hiện đại: Glassmorphism, Micro-animations, Badge highlight, sơ đồ trực quan |
| **Trải nghiệm xem lộ trình học** | Danh sách 4 học kỳ hiển thị cuộn dài, khó so sánh tổng thể | Sử dụng **Interactive Tabs Component (Kỳ 1 → Kỳ 4)** giúp người xem tra cứu nhanh môn học & công nghệ |
| **Yếu tố AI & Công nghệ mới** | Nội dung đã đề cập AI nhưng chưa làm bật lợi thế công nghệ | Thiết kế riêng 1 Module: **"Học Lập trình cùng Trợ lý AI (GenAI, Copilot, Cursor AI)"** |
| **Social Proof & Doanh nghiệp** | Đã có đồ án và giảng viên nhưng thiếu logo đối tác tuyển dụng | Thêm dải logo đối tác liên kết tuyển dụng (FPT Software, NashTech, TMA, VNG, Viettel...) |
| **Tối ưu chuyển đổi (CRO)** | Form đăng ký phân bổ ở đầu và giữa trang | Thêm **Sticky CTA Bar** (Mobile & Desktop) giúp tăng 25-40% tỷ lệ để lại số điện thoại |

---

## PHẦN 2: QUY TRÌNH 5 BƯỚC TRIỂN KHAI CHUẨN ENTERPRISE

```
┌─────────────────┐     ┌──────────────────┐     ┌─────────────────────┐     ┌────────────────┐
│ BƯỚC 1: BACKUP  │ ──> │  BƯỚC 2: BUILD   │ ──> │   BƯỚC 3: REVIEW    │ ──> │ BƯỚC 4: GOLIVE │
│ 3 Lớp an toàn   │     │  Tạo trang Draft │     │ Public Preview Link │     │ Swap Shortcode │
└─────────────────┘     └──────────────────┘     └─────────────────────┘     └────────────────┘
                                                                                     │ (Khi có lỗi)
                                                                                     ▼
                                                                             ┌────────────────┐
                                                                             │ BƯỚC 5: RECOVER│
                                                                             │ Khôi phục <60s │
                                                                             └────────────────┘
```

---

### BƯỚC 1: QUY TRÌNH SAO LƯU DỮ LIỆU AN TOÀN (3 LỚP BẢO HIỂM)

> [!IMPORTANT]
> **Quy tắc vàng:** Tuyệt đối không chỉnh sửa trực tiếp trên trang đang công khai (Live). Luôn hoàn thành cả 3 lớp backup trước khi bắt đầu.

#### Lớp 1: Sao lưu Raw Shortcode ra file Text
1. Đăng nhập WP-Admin -> Vào **Trang (Pages)** -> **Tất cả các trang**.
2. Tìm trang `Lập trình viên quốc tế fpt aptech` (ID `5606`) -> Chọn **Chỉnh sửa (Edit)**.
3. Chuyển trình soạn thảo sang tab **Text / Văn bản** (hoặc mở UX Builder -> Settings -> Copy Shortcodes).
4. Sao chép (Ctrl+A / Cmd+A -> Ctrl+C) toàn bộ nội dung shortcode.
5. Tạo file cục bộ trên máy tính: `backup_aptech_page_YYYYMMDD.txt` và dán toàn bộ nội dung vào để lưu trữ.

#### Lớp 2: Lưu Template trong UX Builder
1. Trong màn hình UX Builder của trang, nhấp vào menu trên cùng -> Chọn **Templates**.
2. Nhấp **Save as Template** -> Đặt tên: `Backup_Aptech_Old_Version_[Date]`.
3. Template này cho phép tái tạo lại trang chỉ bằng 1 cú nhấp chuột trong tương lai.

#### Lớp 3: Tạo bản sao trang bằng Duplicate / Clone
1. Sử dụng plugin nhân bản (ví dụ: *Yoast Duplicate Post* hoặc *Duplicate Page*).
2. Di chuột vào trang `Lập trình viên quốc tế fpt aptech` -> Bấm **Clone / Nhân bản**.
3. Bản sao mới được tạo ở trạng thái **Bản nháp (Draft)** -> Đổi tên thành `[BACKUP] Lập trình viên quốc tế FPT Aptech` để lưu trữ trong database.
4. Sao lưu CSS tùy biến liên quan trong `style.css` hoặc `Additional CSS` ra file `backup_css_YYYYMMDD.css`.

---

### BƯỚC 2: XÂY DỰNG TRANG MỚI VỚI CÁC SESSION HIỆN ĐẠI

Tạo một trang hoàn toàn độc lập: Vào **Trang -> Thêm trang mới**, đặt tên `[DRAFT 2026] Lập trình viên Aptech V2` (Slug nháp: `/lap-trinh-aptech-v2-draft`).

#### Khung cấu trúc các Session mới khuyến nghị

```
[Session 1] Hero Banner AI-Ready + Quick Registration Form
     │
[Session 2] Trust Bar: 4 Con số bảo chứng & Logo Doanh nghiệp tuyển dụng
     │
[Session 3] Trọng tâm công nghệ: Tích hợp AI Engineering & Modern Stack
     │
[Session 4] Lộ trình đào tạo 4 Học kỳ (Interactive Tabs Kỳ 1 -> Kỳ 4)
     │
[Session 5] Ma trận đối tượng học viên & Giải pháp lộ trình cá nhân hóa
     │
[Session 6] Showcase Đồ án tiêu biểu (Interactive Project Slider + Live Demo)
     │
[Session 7] Đội ngũ Giảng viên & Chuyên gia công nghệ FPT
     │
[Session 8] Bằng cấp Quốc tế Aptech & Lộ trình Chuyển tiếp Đại học
     │
[Session 9] Câu hỏi thường gặp (Interactive FAQ Accordion)
     │
[Session 10] Form Đăng ký nhận Học bổng & Sticky CTA Bar
```

#### Chi tiết thiết kế từng Session:

1. **Session 1: Hero Banner AI-Ready**
   * *Nội dung:* Tiêu đề H1 chuẩn SEO: *Chương trình Đào tạo Lập trình viên Quốc tế FPT Aptech (Phiên bản AI-Ready 2026)*.
   * *Visual:* Background gradient công nghệ kết hợp hiệu ứng badge nổi bật: *"Chương trình tích hợp AI đầu tiên tại Việt Nam"*.
   * *CTA:* Quick Form 4 trường (Họ tên, SĐT, Email, Cơ sở học) với nút bấm hiệu ứng Glow nổi bật.

2. **Session 2: Trust Bar & Đối tác tuyển dụng**
   * Dải số liệu uy tín: `25+ Năm phát triển`, `98% Tỷ lệ có việc làm`, `100.000+ Cựu sinh viên`, `Hỗ trợ thực tập từ Kỳ 2`.
   * Logo ticker chuyển động liên tục của các tập đoàn IT đối tác (FPT Software, VNG, VNPT, NashTech, TMA, Bosch...).

3. **Session 3: Module Đột phá AI Engineering**
   * Trình bày điểm khác biệt: Sinh viên không chỉ học code truyền thống mà được trang bị bộ kỹ năng **AI Pair Programming** (GitHub Copilot, Cursor AI, Claude/GPT API, AI Automated Testing).

4. **Session 4: Lộ trình 4 Học kỳ (Dạng Tabs tương tác)**
   * Dùng Shortcode `[tabgroup]` của Flatsome:
     * **Tab Kỳ 1:** Lập trình Web Fullstack & Cơ sở dữ liệu hiện đại với AI Assistant.
     * **Tab Kỳ 2:** Phân tích Dữ liệu, Ứng dụng AI & Machine Learning với Python.
     * **Tab Kỳ 3:** Ứng dụng Doanh nghiệp với Java Spring Boot & Ứng dụng Di động Flutter.
     * **Tab Kỳ 4:** Điện toán đám mây (Cloud), Microservices .NET & Công nghệ Blockchain.
   * Mỗi Tab thể hiện rõ: *Môn học trọng tâm, Đồ án kỳ thực tế, Chuẩn đầu ra chức danh nghề nghiệp*.

5. **Session 5: Ma trận đối tượng học viên**
   * Thiết kế 3 Box card trực quan:
     * *Học sinh THPT:* Định hướng sớm, lấy bằng ADSE quốc tế, tiết kiệm thời gian.
     * *Người chuyển ngành:* Lộ trình bắt đầu từ số 0, cam kết hỗ trợ việc làm.
     * *Sinh viên / Lập trình viên:* Bổ trợ kiến thức hệ thống, công nghệ mới và bằng quốc tế.

6. **Session 6: Showcase Đồ án tiêu biểu (Portfolio Slider)**
   * Sử dụng slider ảnh/video thực tế các dự án sinh viên FPT Aptech đã làm, kèm liên kết Github và phản hồi từ doanh nghiệp.

7. **Session 7: Đội ngũ Giảng viên & Chuyên gia FPT**
   * Hiển thị Card thông tin giảng viên có avatar bo tròn, vị trí công tác (Tech Lead, Senior Architect tại FPT Software) cùng chứng chỉ quốc tế.

8. **Session 8: Giá trị Bằng cấp & Chuyển tiếp Quốc tế**
   * Minh họa Bằng **Advanced Diploma in Software Engineering (ADSE)** do Tập đoàn Aptech cấp (có giá trị toàn cầu).
   * Sơ đồ lộ trình chuyển tiếp lấy bằng Cử nhân Quốc tế tại các trường đối tác (Middlesex University, Swinburne University...).

9. **Session 9: FAQ Accordion tương tác**
   * Giải đáp rõ ràng: *Học phí và chính sách trả góp 0%, Yêu cầu đầu vào có cần biết trước lập trình không, Cam kết hỗ trợ việc làm như thế nào*.

10. **Session 10: Form Đăng ký nhận học bổng & Sticky CTA Bar**
    * Form chính thức nhận ưu đãi tuyển sinh và thanh Sticky bar cố định dưới chân màn hình trên điện thoại.

---

### BƯỚC 3: QUY TRÌNH GỬI REVIEW & PHÊ DUYỆT NỘI BỘ

Để gửi cấp trên hoặc các phòng ban duyệt bản nháp mà **không cần cấp tài khoản quản trị WordPress**:

1. **Cài đặt & Kích hoạt Plugin:** *Public Post Preview*.
2. **Lấy link xem trước công khai:**
   * Mở trang nháp `[DRAFT 2026] Lập trình viên Aptech V2`.
   * Ở cột cài đặt bên phải (Page Settings), đánh dấu tích vào ô **"Enable public preview"**.
   * Copy đường link xem trước được tạo tự động (ví dụ: `https://academy.fpt.edu.vn/?page_id=XXXX&preview=true&_ppp=abcdef123`).
   * *Ghi chú:* Link này có hạn sử dụng 48 giờ, người nhận có thể mở xem trực tiếp trên mọi thiết bị mà không cần đăng nhập.

---

### BƯỚC 4: XUẤT BẢN PHIÊN BẢN MỚI (GO-LIVE KHÔNG GIÁN ĐOẠN)

> [!CAUTION]
> Phải đảm bảo **giữ nguyên URL gốc** `https://academy.fpt.edu.vn/chuong-trinh-dao-tao/lap-trinh-aptech` và ID trang `5606` để giữ toàn bộ thứ hạng SEO Google và các liên kết quảng cáo đang chạy.

#### Quy trình Swap Shortcode (Thời gian thao tác: 1-2 phút)
1. Mở trang Draft đã được phê duyệt -> Mở chế độ **Text Editor** (hoặc mở UX Builder -> Settings) -> **Copy toàn bộ Shortcode**.
2. Mở trang chính thức `Lập trình viên quốc tế fpt aptech` (ID `5606`).
3. Dán toàn bộ Shortcode mới đè lên nội dung cũ.
4. Nếu có bổ sung class CSS mới, cập nhật vào file `style.css` của theme con (*Flatsome Child*).
5. Bấm **Cập nhật (Update)**.
6. **Xóa bộ nhớ đệm (Clear Cache):**
   * Xóa cache trên plugin tối ưu (WP Rocket / LiteSpeed Cache / W3 Total Cache).
   * Xóa cache trên Cloudflare CDN (nếu có sử dụng).
7. Mở trình duyệt ẩn danh (Incognito) trên cả máy tính và điện thoại để kiểm tra trang thực tế.

---

### BƯỚC 5: KỊCH BẢN PHỤC HỒI KHẨN CẤP (ROLLBACK TRONG 60 GIÂY)

Nếu sau khi xuất bản phát hiện lỗi nghiêm trọng (vỡ giao diện, form không hoạt động, xung đột script), áp dụng ngay một trong các phương án sau:

#### Phương án 1: Khôi phục bằng WordPress Revisions (30 giây - Khuyên dùng)
1. Mở trang `Lập trình viên quốc tế fpt aptech` trong WP-Admin.
2. Tại cột bên phải, tìm mục **Bản sửa đổi (Revisions)**.
3. Kéo thanh trượt về bản ghi trước thời điểm cập nhật mới.
4. Bấm **Khôi phục bản sửa đổi này (Restore This Revision)** -> Bấm **Update**.

#### Phương án 2: Dán lại Raw Shortcode đã sao lưu (45 giây)
1. Mở file text `backup_aptech_page_YYYYMMDD.txt` đã lưu ở Bước 1.
2. Sao chép toàn bộ nội dung.
3. Dán đè vào trang chính trong tab Text và bấm **Update** -> Xóa cache website.

#### Phương án 3: Áp dụng Template UX Builder đã lưu (60 giây)
1. Mở trang trong **UX Builder**.
2. Nhấp vào **Templates** -> Tìm template `Backup_Aptech_Old_Version_[Date]`.
3. Bấm **Apply / Chèn** -> Bấm **Update**.

---

## PHẦN 3: CHECKLIST KIỂM TRA CHẤT LƯỢNG (QA CHECKLIST)

Trước và sau khi bấm Go-Live, thực hiện kiểm tra đầy đủ các tiêu chí:

### 1. Hiển thị & Giao diện (UI/UX)
- [ ] Bố cục hiển thị chuẩn xác trên Desktop (1920px, 1440px, 1280px).
- [ ] Bố cục hiển thị cân đối trên Tablet (iPad ngang & dọc).
- [ ] Bố cục hiển thị thân thiện trên Mobile (iPhone, Samsung) - không bị tràn viền, chữ không bị gãy dòng đột ngột.
- [ ] Đúng bộ mã màu nhận diện thương hiệu FPT (`#EF7125`, `#F56F21`, `#2B2B2B`).
- [ ] Font chữ thống nhất (Inter / Roboto), không bị lỗi font tiếng Việt.

### 2. Chức năng & Tương tác (Functionality)
- [ ] Các Tabs lộ trình 4 học kỳ chuyển đổi mượt mà.
- [ ] Slider đồ án và slider giảng viên vuốt chạm tốt trên điện thoại.
- [ ] Các mục FAQ đóng/mở chuẩn xác.
- [ ] Điền thử Form Contact Form 7 và kiểm tra:
  - [ ] Thông báo gửi thành công hiển thị rõ ràng.
  - [ ] Dữ liệu được gửi về email quản trị viên.
  - [ ] Dữ liệu được lưu vào CRM / Google Sheet / Contact Form DB.

### 3. Hiệu năng & SEO
- [ ] Toàn bộ hình ảnh đã được nén tối ưu (định dạng `.webp`, dung lượng < 200KB/ảnh).
- [ ] Cấu hình đầy đủ thẻ Rank Math SEO: Title, Meta Description, Thẻ Canonical.
- [ ] Ảnh đại diện chia sẻ mạng xã hội (Open Graph Image) hiển thị đúng tỉ lệ 1200x630px.
- [ ] Có duy nhất 1 thẻ `<h1>` trên toàn trang.
