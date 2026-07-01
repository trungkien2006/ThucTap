# UniEvent — Nền tảng quản lý sự kiện học trường

UniEvent là một hệ thống toàn diện dành cho việc quản lý, quảng bá và lưu trữ các sự kiện nội bộ của trường đại học/câu lạc bộ. Dự án cung cấp cả giao diện người dùng (Frontend) đẹp mắt, mượt mà và bảng điều khiển (Admin Dashboard) mạnh mẽ giúp ban tổ chức dễ dàng tạo và quản lý sự kiện, diễn giả, cũng như hình ảnh truyền thông.

---

## 🚀 Tính năng nổi bật

- **Quản lý sự kiện toàn diện:** Trạng thái sự kiện, thông tin địa điểm, diễn giả, phòng ban tổ chức.
- **Tối ưu hóa hiệu năng cực cao:** Sử dụng cơ chế Caching (Bộ đệm) thông minh, tự động xóa bộ đệm khi thay đổi dữ liệu, giảm thiểu truy vấn DB xuống mức 0 cho các trang Public.
- **Trình Studio Thiết kế Sự kiện:** Công cụ tùy biến kéo thả và thay đổi giao diện riêng cho từng trang sự kiện trực quan.
- **Lưu trữ Cloud siêu tốc:** Hỗ trợ lưu trữ file và ảnh lên Google Drive, đồng thời có cơ chế Cache Local Proxy giúp ảnh tải nhanh dưới 0.1 giây ở Front-end.

---

## 🛠 Yêu cầu hệ thống

Để chạy dự án ở môi trường phát triển (Local), máy tính của bạn cần cài đặt sẵn:
- **PHP** >= 8.2
- **Composer** (để quản lý thư viện PHP)
- **Node.js** & **npm** (để quản lý và build thư viện Frontend)
- **MySQL** (hoặc MariaDB / PostgreSQL)
- (Tùy chọn) Git để quản lý source code.

---

## 💻 Hướng dẫn Cài đặt & Khởi chạy (Cho thành viên nhóm)

Vui lòng làm theo từng bước dưới đây theo đúng thứ tự để đảm bảo hệ thống hoạt động hoàn hảo mà không gặp lỗi.

### Bước 1: Sao chép dự án và cài đặt Dependencies
Mở Terminal / Command Prompt tại thư mục muốn cài đặt và chạy:

```bash
# 1. Clone source code từ nhánh main (Nếu bạn dùng Git)
# git clone <URL-của-repo>
# cd ThucTap-main

# 2. Cài đặt các gói thư viện PHP
composer install

# 3. Cài đặt các gói thư viện Frontend (Tailwind, AlpineJS,...)
npm install
```

### Bước 2: Thiết lập Biến môi trường (.env)
Dự án cần một tệp `.env` để cấu hình kết nối Database và các dịch vụ bên ngoài.

```bash
# 1. Copy tệp .env mẫu
cp .env.example .env

# 2. Tạo khóa bảo mật cho ứng dụng (Application Key)
php artisan key:generate
```

Mở tệp `.env` vừa tạo, tìm và sửa các dòng sau cho khớp với thông tin MySQL trên máy của bạn:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thuctap      # (Thay bằng tên database bạn vừa tạo trong MySQL)
DB_USERNAME=root         # (User của MySQL)
DB_PASSWORD=             # (Mật khẩu MySQL của bạn)
```

*(Lưu ý: Bạn cần mở phpMyAdmin hoặc MySQL Workbench để tạo sẵn một cơ sở dữ liệu có tên là `thuctap` trước khi sang bước 3).*

### Bước 3: Di chuyển cấu trúc dữ liệu (Migrations) và Dữ liệu mẫu
Chạy lệnh sau để tạo các bảng trong Database:

```bash
php artisan migrate
```

*(Nếu hệ thống có seed data mẫu, bạn có thể chạy `php artisan migrate --seed` tùy theo cấu hình của team).*

### Bước 4: Thiết lập Storage & Google Drive (QUAN TRỌNG)
Hệ thống sử dụng cơ chế lưu ảnh lai (Hybrid) giữa Local và Google Drive để tăng tốc độ. 

1. Đọc và làm theo hướng dẫn chi tiết tại tệp: **[SETUP_GOOGLE_DRIVE.md](SETUP_GOOGLE_DRIVE.md)** để cấu hình API Key.
2. Bạn **bắt buộc** phải chạy lệnh sau để liên kết thư mục ảnh:
```bash
php artisan storage:link
```

### Bước 5: Khởi chạy dự án

Bạn cần mở **2 cửa sổ Terminal** cùng lúc để chạy cả Backend và Frontend:

**Terminal 1 (Chạy server PHP):**
```bash
php artisan serve
```

**Terminal 2 (Chạy trình biên dịch CSS/JS):**
```bash
npm run dev
```

Truy cập vào trang chủ: `http://localhost:8000` và trải nghiệm thành quả!

---

## 🤖 Cài đặt Tự động bằng AI Agent (Dành cho đồng đội dùng AI)

Nếu bạn đang sử dụng một AI Agent (như Cursor, GitHub Copilot Workspace, Cline, hoặc Antigravity), bạn có thể copy toàn bộ câu lệnh (Prompt) dưới đây và dán vào Agent để nó tự động thiết lập dự án thay cho bạn:

```text
Please set up the UniEvent project for me on this local machine. Follow these exact steps:
1. Run `composer install` and `npm install`.
2. Copy `.env.example` to `.env` if it doesn't exist.
3. Run `php artisan key:generate`.
4. Ask me for the MySQL database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD) and update the `.env` file accordingly.
5. Once I provide the credentials, run `php artisan migrate`.
6. Ask me for the Google Drive API credentials (GOOGLE_DRIVE_CLIENT_ID, GOOGLE_DRIVE_CLIENT_SECRET, GOOGLE_DRIVE_REFRESH_TOKEN, GOOGLE_DRIVE_FOLDER) and update the `.env` file.
7. Run `php artisan storage:link`.
8. Start the development servers using `php artisan serve` and `npm run dev`.
```

Agent của bạn sẽ tự động thực thi các tập lệnh Terminal và chỉnh sửa file môi trường dựa trên cấu hình máy của bạn!

---

## 🔧 Xóa Cache (Dành cho Dev)
Trong quá trình phát triển, nếu bạn thấy thay đổi dữ liệu hoặc code mà web chưa cập nhật, hãy chạy lệnh xóa bộ đệm:
```bash
php artisan optimize:clear
```
