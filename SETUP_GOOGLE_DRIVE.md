# Hướng dẫn Cài đặt Kết nối Google Drive (UniEvent)

Hệ thống UniEvent sử dụng Google Drive làm kho lưu trữ chính cho các tệp truyền thông (Media, Banners, Gallery). Tuy nhiên, để tối ưu hóa hiệu năng và tăng tốc độ tải trang lên mức tối đa, kiến trúc lưu trữ hiện tại đã được nâng cấp:
- **Tải lần đầu:** Ảnh từ Google Drive sẽ được kéo về thông qua API.
- **Lưu bộ nhớ đệm (Caching):** Ảnh sau khi lấy về sẽ được lưu tự động vào thư mục nội bộ `storage/app/public` của máy chủ.
- **Truy xuất trực tiếp:** Các lần tải trang sau, hệ thống trả về link tĩnh trực tiếp bỏ qua PHP, giúp ảnh load nhanh trong chớp mắt.

Dưới đây là các bước thiết lập bắt buộc để hệ thống của bạn hoạt động bình thường ở môi trường Local.

---

## Bước 1: Chuẩn bị thông tin API Google Drive

> [!IMPORTANT]
> **Dùng chung một Google Drive:** Để tất cả các thành viên trong nhóm nhìn thấy cùng một hình ảnh và sự kiện, **tất cả mọi người phải dùng chung cấu hình API của Trưởng nhóm**. Nếu bạn dùng Drive cá nhân riêng, ảnh bạn tải lên người khác sẽ không thấy được và ngược lại.

Bạn cần xin Trưởng nhóm (người đã setup Drive gốc) cung cấp các thông tin sau qua tin nhắn riêng tư (bảo mật):
1. `GOOGLE_DRIVE_CLIENT_ID`
2. `GOOGLE_DRIVE_CLIENT_SECRET`
3. `GOOGLE_DRIVE_REFRESH_TOKEN`
4. `GOOGLE_DRIVE_FOLDER` (ID của thư mục dùng chung chứa ảnh trên Drive)

## Bước 2: Cấu hình tệp `.env`

Mở tệp `.env` ở thư mục gốc của dự án và đảm bảo bạn có các dòng sau:

```env
FILESYSTEM_DISK=google

GOOGLE_DRIVE_CLIENT_ID=your_client_id_here
GOOGLE_DRIVE_CLIENT_SECRET=your_client_secret_here
GOOGLE_DRIVE_REFRESH_TOKEN=your_refresh_token_here
GOOGLE_DRIVE_FOLDER=your_folder_id_here
```

*(Hãy thay thế các giá trị `your_...` bằng chuỗi ký tự được Trưởng nhóm cấp).*

## Bước 3: Liên kết thư mục Storage (Bắt buộc)

Do kiến trúc mới sử dụng bộ đệm (cache) cục bộ, trình duyệt cần quyền truy cập trực tiếp vào thư mục public storage. Bạn **bắt buộc** phải chạy lệnh sau trong Terminal (tại thư mục gốc của dự án):

```bash
php artisan storage:link
```

Lệnh này sẽ tạo một shortcut (symlink) từ `public/storage` trỏ tới `storage/app/public`. Nếu không chạy lệnh này, hình ảnh dù đã được tải từ Drive về máy nhưng vẫn sẽ bị lỗi 404 trên trình duyệt!

## Bước 4: Kiểm tra hoạt động

1. Chạy server bằng lệnh `php artisan serve`.
2. Truy cập vào trang chủ. Lúc này trang có thể mất 3-5 giây để tải ở lần đầu tiên do hệ thống đang kéo ảnh từ Drive xuống ổ cứng cục bộ.
3. Nhấn F5 (Tải lại trang) lần thứ hai. Bạn sẽ thấy ảnh load lập tức tức thì do đã được trích xuất từ bộ nhớ đệm nội bộ!

## Mẹo khắc phục sự cố (Troubleshooting)

- **Lỗi 404 cho hình ảnh:** Kiểm tra xem bạn đã chạy lệnh `php artisan storage:link` chưa. Xóa thư mục `public/storage` (nếu có lỗi symlink) và chạy lại lệnh.
- **Ảnh bị thay đổi trên Google Drive nhưng web không cập nhật:** Do web đang dùng ảnh lưu trong bộ nhớ đệm. Bạn chỉ cần vào thư mục `storage/app/public` và xóa ảnh cũ, hệ thống sẽ tự động lên Drive lấy lại bản mới nhất.
- **Lỗi Unauthorized / Invalid Token:** Kiểm tra lại `GOOGLE_DRIVE_REFRESH_TOKEN`. Token có thể đã hết hạn hoặc bị thu hồi.
