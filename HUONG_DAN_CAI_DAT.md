# Hướng Dẫn Cài Đặt và Chạy Website Sự Kiện

Tài liệu này hướng dẫn bạn cách thiết lập và chạy mã nguồn trang web sau khi đã tải file ZIP từ GitHub về máy tính.

---

## 1. Yêu Cầu Hệ Thống và Cài Đặt

Trước khi chạy dự án, máy tính của bạn cần cài đặt các phần mềm nền tảng sau:

### 1.1. Cài đặt PHP qua Laragon

- Tải và cài đặt **Laragon phiên bản 6.0.0 (Full)** tại trang GitHub Releases:
   * Truy cập danh sách các phiên bản tại [https://github.com/leokhoa/laragon/releases](https://github.com/leokhoa/laragon/releases) và chọn bản `6.0.0` ở trang 2.
- Laragon đã tích hợp sẵn PHP, Terminal và quản lý môi trường rất dễ dàng. Cài đặt theo các bước mặc định (cứ bấm Next).

### 1.2. Cài đặt Composer (Quản lý thư viện PHP)

- Truy cập trang chủ [https://getcomposer.org/download/](https://getcomposer.org/download/) và tải file **Composer-Setup.exe**.
- Chạy file cài đặt. Khi được hỏi đường dẫn tới file `php.exe`, hãy chọn đường dẫn trong thư mục Laragon (ví dụ: `C:\laragon\bin\php\php-8.x.x\php.exe`).

### 1.3. Cài đặt Node.js và npm (Dành cho giao diện)

- Truy cập [https://nodejs.org/](https://nodejs.org/) và tải phiên bản **LTS (Long Term Support)**.
- Chạy file cài đặt, bấm "Next" theo mặc định để hoàn tất.

*(Mẹo: Sau khi cài đặt xong các phần mềm này, hãy khởi động lại máy tính để hệ thống nhận diện đầy đủ các câu lệnh mới).*

---

## 2. Các Bước Cài Đặt (Installation)

Sau khi giải nén file ZIP tải về từ GitHub, bạn hãy mở thư mục `ThucTap-main` vừa được giải nén. Nếu bên trong thư mục này có chứa thêm một thư mục `ThucTap-main` nữa, hãy mở tiếp vào trong để thấy các file mã nguồn (như `package.json`, `.env.example`).

Tại thư mục mã nguồn này, click chuột phải vào vùng trống và chọn **Open in Terminal** (hoặc mở Command Prompt / PowerShell và dùng lệnh `cd` trỏ tới đường dẫn thư mục này).

Sau đó, thực hiện lần lượt các bước cài đặt dưới đây tại cửa sổ Terminal:

**Bước 1: Cài đặt các thư viện PHP**

Chạy lệnh sau để tải về các gói thư viện cần thiết cho framework Laravel:

```bash
composer install
```

**Bước 2: Cài đặt các thư viện Frontend (Giao diện)**

Tiếp tục chạy lệnh cài đặt các gói thư viện Node.js:

```bash
npm install
```

**Bước 3: Tạo file cấu hình môi trường (.env)**

Chạy lệnh sau để nhân bản file mẫu thành file cấu hình chính thức:

```cmd
copy .env.example .env
```

**Bước 4: Khởi tạo khóa bảo mật cho ứng dụng (Application Key)**

Chạy lệnh sau để tạo mã hóa bảo mật cho phiên làm việc của người dùng:

```bash
php artisan key:generate
```

**Bước 5: Khởi tạo Cơ sở dữ liệu (Database)**

Dự án sử dụng SQLite làm mặc định nên bạn không cần cài đặt thêm phần mềm quản lý CSDL nào khác. Chạy lệnh sau để tạo các bảng và thêm dữ liệu mẫu:

```bash
php artisan migrate --seed
```

*(Lưu ý: Khi màn hình hiện dòng chữ hỏi bạn có muốn tạo file database `database.sqlite` không, hãy gõ `yes` và nhấn Enter).*

**Bước 6: Tạo liên kết thư mục chứa hình ảnh (Storage Link)**

Chạy lệnh này để ảnh tải lên được hiển thị công khai trên web:

```bash
php artisan storage:link
```

**Bước 7: Build giao diện CSS/JS**

Biên dịch các file giao diện mới nhất bằng lệnh:

```bash
npm run build
```

---

## 3. Khởi Chạy Website

Sau khi đã hoàn tất các bước cài đặt trên, khởi động server nội bộ bằng lệnh:

```bash
php artisan serve
```

Màn hình sẽ hiển thị đường link `http://127.0.0.1:8000`. Hãy copy đường link này và dán vào trình duyệt web của bạn để xem trang chủ.

---

## 4. Hướng Dẫn Kiểm Tra (Testing)

Để đảm bảo website hoạt động hoàn hảo, hãy thực hiện bài kiểm tra nhỏ sau:

### Kiểm tra chức năng Quản Trị (Admin)

1. Truy cập vào trang đăng nhập: `http://127.0.0.1:8000/login`.
2. Đăng nhập bằng tài khoản quản trị mẫu:
   - **Email:** `admin@school.edu`
   - **Mật khẩu:** `password`
3. Sau khi đăng nhập thành công, điều hướng vào phần **Quản lý sự kiện (Events)** trong Dashboard.
4. Nhấn nút **Thêm sự kiện mới**. Điền đầy đủ thông tin cơ bản và tải lên 1 bức ảnh Banner từ máy bạn. Chọn trạng thái xuất bản là "Published".
5. Nhấn Lưu/Tạo sự kiện.

### Kiểm tra kết quả ngoài trang chủ

1. Trở lại màn hình trang chủ (`http://127.0.0.1:8000`).
2. Kiểm tra xem sự kiện bạn vừa tạo đã xuất hiện trên trang chủ chưa.
3. Bấm vào xem chi tiết sự kiện đó và đảm bảo:
   - Ảnh banner hiển thị đúng.
   - Nội dung mô tả hiện ra đầy đủ.

Chúc bạn có trải nghiệm tuyệt vời với ứng dụng!
