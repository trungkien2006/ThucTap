# TÀI LIỆU CẤU TRÚC VÀ LỊCH SỬ THAY ĐỔI CƠ SỞ DỮ LIỆU (DATABASE)

Tài liệu này mô tả chi tiết về cấu trúc cơ sở dữ liệu của dự án Quản lý Sự kiện (Thực Tập), luồng hoạt động chính, và lịch sử các thay đổi quan trọng về mặt thiết kế hệ thống.

---

## 1. CẤU TRÚC CƠ SỞ DỮ LIỆU (DATABASE SCHEMA)

Cơ sở dữ liệu được thiết kế theo mô hình quan hệ (RDBMS), với bảng `events` đóng vai trò là trung tâm. Dưới đây là các bảng chính và ý nghĩa của chúng:

### 1.1. Các bảng thực thể chính
- **`users`**: Quản lý tài khoản hệ thống (chủ yếu là Admin để truy cập trang quản trị).
- **`categories`**: Quản lý danh mục sự kiện (ví dụ: Hội thảo, Workshop, Cuộc thi...). Một sự kiện thuộc về một danh mục.
- **`events`**: Bảng quan trọng nhất, lưu trữ toàn bộ thông tin nội dung của một sự kiện:
  - Thông tin cơ bản: `title` (Tiêu đề), `slug` (Đường dẫn tĩnh), `event_date` (Ngày tổ chức), `location` (Địa điểm), `description` (Mô tả).
  - Trạng thái & Thống kê: `status` (Bản nháp/Đã xuất bản), `views_count`, `likes_count`.
  - Cấu hình hiển thị: `page_template` (Lưu trữ mẫu giao diện sẽ được sử dụng cho sự kiện này).

### 1.2. Các bảng liên kết & Thành phần con của Sự kiện
- **`speakers`**: Lưu trữ thông tin diễn giả (Tên, chức vụ, tiểu sử, ảnh đại diện, loại diễn giả).
- **`event_speakers`**: Bảng trung gian (Pivot table) thể hiện mối quan hệ Nhiều - Nhiều (N-N) giữa `events` và `speakers`. Một sự kiện có thể có nhiều diễn giả và ngược lại.
- **`event_schedule`**: Lưu trữ lịch trình chi tiết của sự kiện. Mỗi bản ghi chứa thông tin về khung giờ (`start_time`, `end_time`) và hoạt động tương ứng của một sự kiện cụ thể.
- **`event_departments`**: Quản lý các phòng ban tham gia hoặc phụ trách tổ chức sự kiện.

### 1.3. Quản lý Đa phương tiện (Media)
Hệ thống tách biệt việc quản lý file phương tiện thành các bảng riêng nhằm tối ưu hóa không gian lưu trữ và dễ dàng query:
- **`event_images`**: Lưu trữ hình ảnh liên quan đến sự kiện (Gallery, Banner, Hình ảnh mô tả...).
- **`event_videos`**: Lưu trữ video của sự kiện.
- **`event_documents`**: Lưu trữ các tài liệu đính kèm (PDF, Word) cho khách tham dự tải về.
- **`event_medias`**: Bảng tổng hợp media linh hoạt hơn được sử dụng ở một số tính năng mở rộng.

---

## 2. LUỒNG HOẠT ĐỘNG (WORKFLOW)

1. **Quản trị (Admin Panel)**:
   - Admin tạo `categories`, thêm `speakers`.
   - Admin tạo mới `events`. Trong quá trình tạo, Admin sẽ nhập các thông tin thuần túy (chữ, ngày tháng, địa điểm).
   - Admin upload hình ảnh (banner), tài liệu, và tạo lịch trình (`event_schedule`), gán diễn giả (`event_speakers`) cho sự kiện.
   - **Đặc biệt**: Thay vì tự phối màu hay chỉnh font chữ, Admin sẽ chọn một **Giao diện mẫu (Template)** từ kho Template có sẵn (ví dụ: Template 1 đến 21). Lựa chọn này được lưu vào cột `page_template`.

2. **Người dùng cuối (Client Front-end)**:
   - Khi người dùng truy cập trang chủ hoặc trang danh sách, hệ thống sẽ truy vấn bảng `events` kèm theo các relationship (`category`, hình ảnh banner) để hiển thị thẻ sự kiện (Event Cards).
   - Khi người dùng click vào một sự kiện cụ thể, Controller sẽ kiểm tra cột `page_template` của sự kiện đó.
   - Dựa vào giá trị `page_template`, hệ thống sẽ trả về (render) một file Blade View tương ứng (ví dụ: `show-template1.blade.php`, `show-template2.blade.php`), giúp mỗi sự kiện có một thiết kế Landing Page hoàn toàn độc đáo nhưng vẫn tuân thủ quy chuẩn mã nguồn.

---

## 3. LỊCH SỬ THAY ĐỔI & QUYẾT ĐỊNH KỸ THUẬT (CHANGELOG)

### Phiên bản đầu tiên (Trước ngày 18/06)
- **Thiết kế**: Bảng `events` chỉ lưu trữ dữ liệu nội dung thuần túy (Text, Date).
- **Hạn chế**: Tất cả các sự kiện khi hiển thị ra bên ngoài đều dùng chung một layout duy nhất, thiếu sự linh hoạt và tính thẩm mỹ cho các sự kiện đặc thù cần làm Landing Page riêng.

### Phiên bản "Tùy biến tự do" (Ngày 18/06 - Bản thử nghiệm)
- **Thay đổi**: Bảng `events` được bổ sung hàng loạt cột cấu hình UI trực tiếp như: `title_font_size`, `title_color`, `title_outline_color`, `desc_color`, `title_font_family`, `desc_font_family`...
- **Mục đích**: Muốn biến mỗi sự kiện thành một Landing Page có khả năng tùy biến màu sắc, phông chữ linh hoạt mà không cần phải can thiệp vào code HTML/CSS.

### Phiên bản Hiện tại (Rollback & Cấu trúc lại bằng Template)
- **Quyết định**: **Gỡ bỏ TOÀN BỘ chức năng tùy chỉnh giao diện (màu sắc, font chữ) lưu trong Database**. Các thay đổi từ bản an/tuan liên quan đến việc nhồi nhét CSS vào Database đã được HỦY BỎ.
- **Hành động**: Migration `2026_06_30_080210_drop_design_columns_from_events_table` đã được thực thi để xóa các cột `title_font_size`, `title_color`, v.v khỏi CSDL.
- **Lý do**: 
  1. Việc lưu trữ thuộc tính CSS (màu sắc, kích thước) vào Database phá vỡ nguyên tắc tách biệt giữa Dữ liệu (Data) và Giao diện (Presentation).
  2. Gây khó khăn lớn cho việc bảo trì, tối ưu hóa giao diện và Responsive trên mobile.
  3. Quá trình nhập liệu trở nên phức tạp, dễ dẫn đến các thiết kế "xấu" hoặc không nhất quán với bộ nhận diện thương hiệu chung.
- **Giải pháp thay thế**: Sử dụng cơ chế **Template-based**. Bảng `events` chỉ còn cho phép ghi và sửa "chữ" (Data). Các tùy chỉnh về UI được lập trình cứng thành các Mẫu giao diện (Templates) chuẩn thiết kế, đẹp mắt và tối ưu hóa. CSDL chỉ cần lưu 1 cột `page_template` để biết sự kiện sẽ dùng Mẫu nào. Điều này vừa mang lại giao diện phong phú (như Landing Page) vừa giữ cho hệ thống trong sạch và cực kỳ dễ bảo trì.
