# Hướng Dẫn Cài Đặt và Chạy Website Sự Kiện (Event Page Maker)

Tài liệu này hướng dẫn bạn cách thiết lập và chạy mã nguồn trang web sau khi đã tải file ZIP về máy tính.

---

## 1. Yêu Cầu Hệ Thống và Cài Đặt (Prerequisites)

Trước khi chạy dự án, máy tính của bạn cần cài đặt các phần mềm nền tảng sau. Nếu đã có sẵn, bạn có thể bỏ qua và chuyển sang Phần 2.


### 1.1. Cài đặt PHP

- **Dùng Laragon (Rất khuyên dùng, đặc biệt cho team nội bộ):** 

  - Tải và cài đặt **Laragon Full** tại [https://laragon.org/download/](https://laragon.org/download/). Laragon đã tích hợp sẵn PHP (thường là bản 8.1+), Terminal, và quản lý môi trường rất dễ dàng.

- **Hoặc dùng XAMPP / Cài đặt thủ công:** 

  - Tải XAMPP (phiên bản PHP 8.1 trở lên) tại [https://www.apachefriends.org/](https://www.apachefriends.org/). 
  
  - **Lưu ý:** Nếu cài thủ công, bạn cần phải tự thêm thư mục chứa `php.exe` vào biến môi trường (Environment Variables) của Windows.


### 1.2. Cài đặt Composer (Quản lý thư viện PHP)

- Truy cập trang chủ [https://getcomposer.org/download/](https://getcomposer.org/download/) và tải file **Composer-Setup.exe**.

- Chạy file cài đặt. Quá trình cài sẽ yêu cầu bạn trỏ đường dẫn tới file `php.exe` của máy tính (ví dụ trong thư mục `C:\laragon\bin\php\php-8.x.x\php.exe` nếu dùng Laragon).


### 1.3. Cài đặt Node.js và npm (Dành cho giao diện)

- Truy cập [https://nodejs.org/](https://nodejs.org/) và tải phiên bản **LTS (Long Term Support)**.

- Chạy file cài đặt, bấm "Next" theo mặc định. Npm sẽ tự động được cài kèm theo Node.js.

- Mở Terminal (CMD/PowerShell) và gõ `node -v` và `npm -v` để kiểm tra xem đã cài thành công chưa.

*(Mẹo: Sau khi cài đặt xong các phần mềm này, bạn hãy đóng và mở lại Terminal để hệ thống cập nhật các câu lệnh mới).*

---

## 2. Các Bước Cài Đặt (Installation)

Sau khi giải nén file ZIP, bạn hãy mở **Terminal** (hoặc Command Prompt / PowerShell) và điều hướng (`cd`) vào thư mục chứa mã nguồn (thư mục `event-page-maker`). Sau đó thực hiện lần lượt các bước sau:


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

Mã nguồn cung cấp sẵn một file mẫu là `.env.example`. Bạn cần nhân bản file này ra và đổi tên thành `.env`.

*Trên Windows:*
```cmd
copy .env.example .env
```

*Trên Mac/Linux:*
```bash
cp .env.example .env
```


**Bước 4: Khởi tạo khóa bảo mật cho ứng dụng (Application Key)**

Chạy lệnh sau để tạo mã hóa bảo mật cho phiên làm việc của người dùng:

```bash
php artisan key:generate
```


**Bước 5: Cấu hình và Khởi tạo Cơ sở dữ liệu (Database)**

*Trường hợp 1: Dùng SQLite (Dành cho người dùng Laragon hoặc máy cá nhân mặc định)*

Dự án được cấu hình mặc định sử dụng **SQLite** nên bạn không cần cài đặt các hệ quản trị CSDL phức tạp.
Chỉ cần chạy lệnh sau để tạo các bảng và thêm dữ liệu mẫu (như tài khoản Admin):

```bash
php artisan migrate --seed
```

*(Lưu ý: Nếu màn hình hiện dòng chữ hỏi bạn có muốn tạo file database `database.sqlite` không, hãy gõ `yes` và nhấn Enter).*


*Trường hợp 2: Dùng SQL Server (Dành cho các thành viên sử dụng SQL Server Management Studio 20)*

1. Mở **SSMS 20** và tạo một cơ sở dữ liệu mới (ví dụ tên là: `event_page_maker`).

2. Mở file `.env` (vừa tạo ở Bước 3), tìm các dòng cấu hình `DB_` (khoảng dòng 23) và sửa đổi như sau:

   ```env
   DB_CONNECTION=sqlsrv
   DB_HOST=127.0.0.1
   DB_PORT=1433
   DB_DATABASE=event_page_maker
   DB_USERNAME=sa
   DB_PASSWORD=Mật_khẩu_SQL_Server_của_bạn
   ```

   *(Lưu ý: Đảm bảo PHP của bạn đã được bật extension `pdo_sqlsrv` và `sqlsrv` để kết nối được với SQL Server).*

3. Sau khi lưu file `.env`, quay lại Terminal và chạy lệnh để tạo bảng cùng dữ liệu mẫu:

   ```bash
   php artisan migrate --seed
   ```


**Bước 6: Tạo liên kết thư mục chứa hình ảnh (Storage Link)**

Vì dự án có chức năng upload ảnh banner sự kiện, bạn cần chạy lệnh này để ảnh được hiển thị công khai trên web:

```bash
php artisan storage:link
```


**Bước 7: Build giao diện CSS/JS**

Để mã nguồn biên dịch các file giao diện mới nhất (Tailwind CSS, Javascript):

```bash
npm run build
```

---

## 3. Khởi Chạy Website

Sau khi đã hoàn tất các bước cài đặt trên, bạn có thể khởi động server nội bộ bằng lệnh:

```bash
php artisan serve
```

Màn hình sẽ hiển thị một đường link, thông thường là: `http://localhost:8000` hoặc `http://127.0.0.1:8000`. Hãy copy đường link này và dán vào trình duyệt web của bạn.

---

## 4. Hướng Dẫn Kiểm Tra (Testing)

Để đảm bảo website hoạt động hoàn hảo và bạn đã cài đặt đúng cách, hãy thực hiện bài kiểm tra nhỏ sau:


### Kiểm tra hiển thị cơ bản

1. Mở trang chủ (`http://localhost:8000`) để xem giao diện dành cho người dùng bình thường.

2. Đảm bảo giao diện không bị vỡ bố cục và các sự kiện mẫu (nếu có) được liệt kê ra đầy đủ.


### Kiểm tra chức năng Quản Trị (Admin)

1. Truy cập vào trang đăng nhập: `http://localhost:8000/login`.

2. Sử dụng tài khoản quản trị mẫu đã được tạo sẵn để đăng nhập:
   - **Email:** `admin@school.edu`
   - **Mật khẩu:** `password`

3. Sau khi đăng nhập thành công, hãy điều hướng vào phần **Quản lý sự kiện (Events)** trong Dashboard.

4. Nhấn nút **Thêm sự kiện mới**. Điền đầy đủ thông tin cơ bản (Tiêu đề, loại sự kiện, ngày giờ, mô tả...) và **đặc biệt là tải lên 1 bức ảnh Banner từ máy bạn**. Đừng quên chọn trạng thái xuất bản là "Published".

5. Nhấn Lưu/Tạo sự kiện.


### Kiểm tra kết quả ngoài trang chủ

1. Trở lại màn hình trang chủ (bạn có thể mở ở một tab ẩn danh).

2. Kiểm tra xem sự kiện bạn vừa tạo đã xuất hiện trên trang chủ chưa.

3. Bấm vào xem chi tiết sự kiện đó và kiểm tra các điểm sau:
   - **Ảnh banner:** Có hiển thị đúng hình bạn vừa tải lên không? *(Nếu ảnh bị lỗi không hiển thị, hãy chắc chắn bạn đã chạy lệnh `php artisan storage:link` ở Bước 6).*
   - **Đường dẫn (URL):** Link ở trên thanh trình duyệt có đẹp và chứa thông tin sự kiện không (sử dụng slug), hay báo lỗi 404?
   - **Nội dung:** Các thông tin mô tả có hiện đầy đủ như lúc bạn nhập không.


Chúc bạn có trải nghiệm tuyệt vời với ứng dụng!
