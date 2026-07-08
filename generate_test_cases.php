<?php
// Script tạo file Excel kiểm thử dưới dạng HTML/XLS tương thích Microsoft Excel

$filename = "Danh_Sach_Kiem_Thu_UniEvent.xls";

$html = '
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
  table { border-collapse: collapse; width: 100%; }
  th, td { border: 0.5pt solid #a0a0a0; padding: 6px; font-family: "Segoe UI", Arial, sans-serif; font-size: 10pt; vertical-align: top; }
  th { background-color: #1F4E79; color: #ffffff; font-weight: bold; text-align: center; font-size: 11pt; }
  .title { font-size: 16pt; font-weight: bold; color: #1F4E79; text-align: center; padding: 15px; }
  .meta-table { border: none; margin-bottom: 15px; }
  .meta-table td { border: none; font-size: 9.5pt; color: #555555; padding: 2px; }
  .pass { color: #2E7D32; font-weight: bold; text-align: center; }
  .fail { color: #C62828; font-weight: bold; text-align: center; }
  .pending { color: #EF6C00; font-weight: bold; text-align: center; }
  .odd { background-color: #F8F9FA; }
  .even { background-color: #FFFFFF; }
  .module-header { background-color: #D9E1F2; font-weight: bold; font-size: 11pt; color: #1F4E79; }
</style>
</head>
<body>

<table>
  <tr>
    <td colspan="9" class="title">BẢNG KỊCH BẢN KIỂM THỬ (TEST CASES) - DỰ ÁN UNIEVENT</td>
  </tr>
  <tr>
    <td colspan="9" style="border:none; padding-bottom: 10px;">
      <table class="meta-table">
        <tr><td><strong>Dự án:</strong> Hệ thống quản lý và giới thiệu Sự kiện UniEvent</td><td><strong>Tài liệu:</strong> kịch bản kiểm thử (Test Cases)</td></tr>
        <tr><td><strong>Người thực hiện:</strong> Antigravity AI Assistant</td><td><strong>Ngày tạo:</strong> ' . date('d/m/Y') . '</td></tr>
        <tr><td><strong>Môi trường:</strong> Local Desktop (PHP 8.4, SQLite, Web Server)</td><td><strong>Trạng thái chung:</strong> Sẵn sàng kiểm thử</td></tr>
      </table>
    </td>
  </tr>
  <thead>
    <tr>
      <th style="width: 40px;">STT</th>
      <th style="width: 90px;">Mã Test Case</th>
      <th style="width: 150px;">Phân Hệ / Chức Năng</th>
      <th style="width: 250px;">Tên / Mô Tả Test Case</th>
      <th style="width: 200px;">Điều Kiện Tiên Quyết</th>
      <th style="width: 350px;">Các Bước Thực Hiện (Steps)</th>
      <th style="width: 350px;">Kết Quả Mong Đợi (Expected Result)</th>
      <th style="width: 90px;">Trạng Thái</th>
      <th style="width: 150px;">Ghi Chú</th>
    </tr>
  </thead>
  <tbody>
    <!-- PHÂN HỆ 1: TRANG CHỦ -->
    <tr class="module-header">
      <td colspan="9">PHÂN HỆ 1: TRANG CHỦ & ĐIỀU HƯỚNG CHUNG (FRONTEND HOMEPAGE)</td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">1</td>
      <td>TC_FP_001</td>
      <td>Giao diện trang chủ</td>
      <td>Kiểm tra hiển thị đầy đủ các thành phần chính trên Trang chủ</td>
      <td>Không có</td>
      <td>1. Truy cập địa chỉ http://127.0.0.1:8000<br>2. Quan sát Header, Footer, Banner, và các khu vực nội dung chính.</td>
      <td>Trang chủ hiển thị đầy đủ:<br>- Thanh menu điều hướng (Trang chủ, Sự kiện, Lưu trữ, Liên hệ).<br>- Slider sự kiện mới nhất.<br>- Danh mục sự kiện.<br>- Sự kiện nổi bật nhất.<br>- Sự kiện sắp tới.<br>- Giới thiệu kho lưu trữ.<br>- Album media.<br>- Chân trang (Footer) chứa thông tin bản quyền và liên kết.</td>
      <td class="pending">Chưa test</td>
      <td>Kế thừa giao diện chung từ layouts.frontend</td>
    </tr>
    <tr class="even">
      <td style="text-align: center;">2</td>
      <td>TC_FP_002</td>
      <td>Slider sự kiện mới nhất</td>
      <td>Kiểm tra Slider hiển thị đúng sự kiện mới nhất đã xuất bản</td>
      <td>Có ít nhất 1 sự kiện ở trạng thái "Published" trong CSDL</td>
      <td>1. Truy cập Trang chủ.<br>2. Kiểm tra thông tin sự kiện hiển thị trên Slider chính.</td>
      <td>Slider hiển thị sự kiện mới nhất dựa trên thời gian tạo và đã được xuất bản (Published). Hiển thị đầy đủ Banner, Tiêu đề, Ngày diễn ra và Nút xem chi tiết.</td>
      <td class="pending">Chưa test</td>
      <td>Theo quy tắc thiết kế trong AGENTS.md</td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">3</td>
      <td>TC_FP_003</td>
      <td>Sự kiện nổi bật nhất</td>
      <td>Kiểm tra thuật toán tính điểm hiển thị sự kiện nổi bật nhất</td>
      <td>Có các sự kiện được tạo trong vòng 3 tháng qua với các lượt xem và yêu thích khác nhau</td>
      <td>1. Xem mục "Sự kiện nổi bật nhất" trên Trang chủ.<br>2. Kiểm tra thứ tự sắp xếp của các sự kiện nổi bật.</td>
      <td>Các sự kiện hiển thị theo thứ tự điểm số giảm dần (Điểm = Lượt yêu thích * 3 + Lượt xem) và chỉ xét các sự kiện được tạo trong vòng 3 tháng trở lại đây.</td>
      <td class="pending">Chưa test</td>
      <td>Công thức: (likes_count * 3) + views_count DESC</td>
    </tr>
    <tr class="even">
      <td style="text-align: center;">4</td>
      <td>TC_FP_004</td>
      <td>Danh mục sự kiện</td>
      <td>Kiểm tra click vào danh mục sự kiện chuyển hướng đúng</td>
      <td>Có danh mục sự kiện được tạo sẵn</td>
      <td>1. Click vào một danh mục sự kiện (ví dụ: Conference) trên Trang chủ.</td>
      <td>Hệ thống chuyển hướng sang trang danh sách sự kiện lọc theo danh mục đã chọn (ví dụ: /events?category=conference).</td>
      <td class="pending">Chưa test</td>
      <td></td>
    </tr>

    <!-- PHÂN HỆ 2: QUẢN LÝ SỰ KIỆN (ADMIN) -->
    <tr class="module-header">
      <td colspan="9">PHÂN HỆ 2: ĐĂNG NHẬP & QUẢN TRỊ VIÊN (ADMIN DASHBOARD)</td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">5</td>
      <td>TC_AD_001</td>
      <td>Đăng nhập hệ thống</td>
      <td>Kiểm tra chức năng Đăng nhập với tài khoản Admin mẫu</td>
      <td>CSDL đã seed tài khoản admin@school.edu / password</td>
      <td>1. Truy cập http://127.0.0.1:8000/login<br>2. Nhập Email: admin@school.edu<br>3. Nhập Password: password<br>4. Nhấn nút Đăng nhập (Log in).</td>
      <td>Đăng nhập thành công. Hệ thống chuyển hướng người dùng vào trang Admin Dashboard (/admin hoặc /dashboard). Hiển thị đầy đủ menu quản trị.</td>
      <td class="pending">Chưa test</td>
      <td></td>
    </tr>
    <tr class="even">
      <td style="text-align: center;">6</td>
      <td>TC_AD_002</td>
      <td>Đăng nhập thất bại</td>
      <td>Kiểm tra thông báo lỗi khi nhập sai tài khoản hoặc mật khẩu</td>
      <td>Không có</td>
      <td>1. Truy cập http://127.0.0.1:8000/login<br>2. Nhập email không tồn tại hoặc sai mật khẩu.<br>3. Nhấn nút Đăng nhập.</td>
      <td>Đăng nhập thất bại. Hệ thống giữ nguyên ở trang login, hiển thị thông báo lỗi bằng tiếng Việt hoặc tiếng Anh (ví dụ: Thông tin đăng nhập không chính xác).</td>
      <td class="pending">Chưa test</td>
      <td></td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">7</td>
      <td>TC_AD_003</td>
      <td>Quản lý Sự kiện - Thêm mới</td>
      <td>Kiểm tra thêm mới sự kiện thành công với ảnh Banner tải lên</td>
      <td>Đã đăng nhập tài khoản Admin</td>
      <td>1. Vào menu Quản lý Sự kiện (Events) -> Nhấn nút Thêm mới (Create).<br>2. Nhập các thông tin bắt buộc (Tiêu đề, Mô tả, Ngày bắt đầu, Địa điểm).<br>3. Tải lên 1 ảnh Banner từ máy tính.<br>4. Chọn trạng thái xuất bản là "Published" (Xuất bản).<br>5. Nhấn nút Tạo/Lưu sự kiện.</td>
      <td>Sự kiện được tạo thành công, có thông báo thành công hiển thị. Hệ thống tự động đẩy ảnh banner lên Google Drive và đồng thời lưu cache về public storage nội bộ. Sự kiện mới xuất hiện ở danh sách sự kiện trong Admin.</td>
      <td class="pending">Chưa test</td>
      <td>Đồng bộ Google Drive và Cache cục bộ</td>
    </tr>
    <tr class="even">
      <td style="text-align: center;">8</td>
      <td>TC_AD_004</td>
      <td>Quản lý Sự kiện - Chỉnh sửa</td>
      <td>Kiểm tra chỉnh sửa thông tin sự kiện đã tồn tại</td>
      <td>Có ít nhất 1 sự kiện trong hệ thống</td>
      <td>1. Tại danh sách sự kiện, click nút Sửa (Edit) của một sự kiện.<br>2. Thay đổi Tiêu đề và nội dung mô tả.<br>3. Nhấn Lưu thay đổi.</td>
      <td>Thông tin sự kiện được cập nhật thành công trong cơ sở dữ liệu. Trang danh sách và trang chi tiết hiển thị nội dung mới chỉnh sửa.</td>
      <td class="pending">Chưa test</td>
      <td></td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">9</td>
      <td>TC_AD_005</td>
      <td>Quản lý Sự kiện - Xóa</td>
      <td>Kiểm tra xóa sự kiện khỏi hệ thống</td>
      <td>Có ít nhất 1 sự kiện trong hệ thống</td>
      <td>1. Tại danh sách sự kiện, click nút Xóa (Delete) của một sự kiện.<br>2. Xác nhận xóa ở hộp thoại (nếu có).</td>
      <td>Sự kiện bị xóa thành công khỏi danh sách và cơ sở dữ liệu. Không còn hiển thị ngoài Frontend.</td>
      <td class="pending">Chưa test</td>
      <td>Cần xác minh xem tệp banner đính kèm trên Google Drive có được giữ lại hoặc xóa tương ứng tùy cấu hình.</td>
    </tr>

    <!-- PHÂN HỆ 3: ĐỒNG BỘ GOOGLE DRIVE & CACHE -->
    <tr class="module-header">
      <td colspan="9">PHÂN HỆ 3: ĐỒNG BỘ LƯU TRỮ GOOGLE DRIVE & BỘ NHỚ ĐỆM (GOOGLE DRIVE SYNC & CACHING)</td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">10</td>
      <td>TC_GD_001</td>
      <td>Kết nối Google Drive API</td>
      <td>Kiểm tra kết nối và tính hợp lệ của Token Google Drive</td>
      <td>Đã cấu hình các thông số GOOGLE_DRIVE_... trong tệp .env</td>
      <td>1. Chạy mã kiểm tra kết nối Google Drive (hoặc thực hiện tải ảnh từ admin).<br>2. Quan sát xem ảnh có được tải lên Drive thành công không.</td>
      <td>Kết nối thành công. Google Drive API trả về ID của file đã tải lên, không phát sinh lỗi 401 (Unauthorized) hay lỗi cấu hình.</td>
      <td class="pending">Chưa test</td>
      <td>Xem hướng dẫn xử lý token hết hạn trong SETUP_GOOGLE_DRIVE.md</td>
    </tr>
    <tr class="even">
      <td style="text-align: center;">11</td>
      <td>TC_GD_002</td>
      <td>Cơ chế Cache hình ảnh cục bộ</td>
      <td>Kiểm tra ảnh từ Google Drive tự động tải về thư mục cache cục bộ khi truy cập lần đầu</td>
      <td>Có sự kiện chứa ảnh trên Google Drive, thư mục storage/app/public rỗng</td>
      <td>1. Truy cập trang chi tiết sự kiện lần đầu tiên.<br>2. Mở thư mục local `storage/app/public/` kiểm tra xem file ảnh có tự động xuất hiện hay không.</td>
      <td>- Lần tải đầu tiên: Trang web tải hơi chậm (3-5 giây) do đang tải ảnh từ Drive về máy chủ local.<br>- Ảnh được tự động lưu vào thư mục `storage/app/public/`.</td>
      <td class="pending">Chưa test</td>
      <td>Đây là cơ chế tối ưu hóa tốc độ tải trang</td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">12</td>
      <td>TC_GD_003</td>
      <td>Truy xuất ảnh từ Cache cục bộ</td>
      <td>Kiểm tra tốc độ tải ảnh ở lần truy cập thứ hai (đã có cache)</td>
      <td>Ảnh sự kiện đã được lưu cache cục bộ ở bước trước</td>
      <td>1. Nhấn F5 tải lại trang chi tiết sự kiện lần thứ hai.<br>2. Quan sát tốc độ hiển thị hình ảnh và kiểm tra mã phản hồi HTTP của ảnh.</td>
      <td>Ảnh hiển thị lập tức (load nhanh dưới 100ms) do được truy xuất trực tiếp từ thư mục `public/storage` bỏ qua kết nối API Google Drive. Ảnh không bị lỗi 404.</td>
      <td class="pending">Chưa test</td>
      <td>Yêu cầu đã chạy lệnh `php artisan storage:link`</td>
    </tr>

    <!-- PHÂN HỆ 4: TRANG CHI TIẾT SỰ KIỆN & LIÊN HỆ -->
    <tr class="module-header">
      <td colspan="9">PHÂN HỆ 4: CHI TIẾT SỰ KIỆN & LIÊN HỆ (DETAILS & CONTACT)</td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">13</td>
      <td>TC_DT_001</td>
      <td>Xem chi tiết sự kiện</td>
      <td>Kiểm tra hiển thị đầy đủ thông tin chi tiết của một sự kiện</td>
      <td>Có sự kiện đã xuất bản</td>
      <td>1. Tại Trang chủ hoặc trang Danh sách sự kiện, click vào tiêu đề hoặc ảnh của sự kiện.</td>
      <td>Hệ thống chuyển hướng sang trang chi tiết sự kiện hiển thị đúng các thông tin:<br>- Ảnh Banner lớn.<br>- Tiêu đề sự kiện.<br>- Thời gian diễn ra, Địa điểm.<br>- Nội dung mô tả chi tiết đầy đủ định dạng.<br>- Danh sách diễn giả (nếu có).<br>- Tài liệu đính kèm (nếu có).</td>
      <td class="pending">Chưa test</td>
      <td></td>
    </tr>
    <tr class="even">
      <td style="text-align: center;">14</td>
      <td>TC_DT_002</td>
      <td>Tải tài liệu đính kèm</td>
      <td>Kiểm tra tải xuống tài liệu sự kiện thành công</td>
      <td>Sự kiện có file đính kèm đính trên Google Drive</td>
      <td>1. Vào trang chi tiết sự kiện.<br>2. Tìm phần Tài liệu đính kèm và click vào link tài liệu.</td>
      <td>Trình duyệt thực hiện tải xuống tài liệu hoặc mở trực tiếp tài liệu trong tab mới mà không gặp lỗi liên kết hay quyền truy cập.</td>
      <td class="pending">Chưa test</td>
      <td></td>
    </tr>
    <tr class="odd">
      <td style="text-align: center;">15</td>
      <td>TC_CT_001</td>
      <td>Form liên hệ gửi tin nhắn thành công</td>
      <td>Kiểm tra gửi form liên hệ với dữ liệu hợp lệ</td>
      <td>Không có</td>
      <td>1. Truy cập trang Liên hệ (/contact).<br>2. Điền đầy đủ: Họ tên, Email, Tiêu đề, Nội dung tin nhắn hợp lệ.<br>3. Nhấn nút Gửi tin nhắn.</td>
      <td>Hệ thống hiển thị thông báo gửi tin nhắn thành công bằng tiếng Việt. Email được gửi đi thành công (hoặc ghi nhận log tùy theo cấu hình `MAIL_MAILER` trong file `.env`).</td>
      <td class="pending">Chưa test</td>
      <td>Cấu hình mailer hiện tại đang là smtp hoặc log</td>
    </tr>
  </tbody>
</table>

</body>
</html>
';

file_put_contents($filename, $html);
echo "Da tao xong file excel kiem thu: $filename\n";
?>
