# KỊCH BẢN KIỂM THỬ (TESTING GUIDE) - UniEvent

Dưới đây là danh sách các hạng mục (Test Cases) quan trọng nhất để bạn có thể tự kiểm thử hệ thống từ A đến Z, đảm bảo mọi tính năng chúng ta đã làm hoạt động trơn tru trước khi nghiệm thu hoặc nộp bài.

---

## 1. Kiểm thử Phân quyền (Super Admin vs Sub Admin)

**Mục tiêu:** Đảm bảo chỉ tài khoản gốc mới có quyền tạo/xóa các Admin khác, các Admin phụ (Sub Admin) có thể quản lý sự kiện nhưng không thể quản lý nhân sự.

*   [ ] **Test 1.1:** Đăng nhập bằng tài khoản gốc (`admin@school.edu` / `password`).
*   [ ] **Test 1.2:** Kiểm tra thanh menu bên trái, đảm bảo có nút **"Quản lý Admin"** và avatar góc phải trên cùng có menu **"Tạo tài khoản"**.
*   [ ] **Test 1.3:** Truy cập "Quản lý Admin", tạo thử một tài khoản Sub Admin mới (ví dụ: `test@gmail.com` / `12345678`). Kiểm tra xem hệ thống có báo thành công không.
*   [ ] **Test 1.4:** Cố tình tạo thêm một tài khoản dùng lại email `test@gmail.com`. Hệ thống phải báo lỗi trùng email.
*   [ ] **Test 1.5:** Đăng xuất khỏi tài khoản gốc.
*   [ ] **Test 1.6:** Đăng nhập lại bằng tài khoản Sub Admin vừa tạo (`test@gmail.com`).
*   [ ] **Test 1.7:** Kiểm tra menu bên trái: Phải **KHÔNG CÓ** nút "Quản lý Admin". Avatar góc trên phải cũng **KHÔNG CÓ** nút "Tạo tài khoản".
*   [ ] **Test 1.8:** Cố tình nhập thẳng đường dẫn `http://127.0.0.1:8000/admin/users` trên thanh địa chỉ. Hệ thống phải chặn lại và báo lỗi `403 FORBIDDEN` (Không có quyền truy cập).

---

## 2. Kiểm thử Kho lưu trữ (Archive) & Lọc dữ liệu

**Mục tiêu:** Đảm bảo trang `/archive` chỉ hiển thị các sự kiện đã kết thúc và tính năng lọc (Filter) bằng Javascript hoạt động chuẩn xác (không bị lỗi tháng `07` vs `7`).

*   [ ] **Test 2.1:** Đăng nhập Admin, vào phần Quản lý Sự kiện -> "Tạo mới".
*   [ ] **Test 2.2:** Tạo một sự kiện A với "Thời gian bắt đầu" (Event Date) là một ngày **TRONG TƯƠNG LAI** (VD: Tuần sau). Trạng thái: "Đã xuất bản".
*   [ ] **Test 2.3:** Tạo một sự kiện B với "Thời gian bắt đầu" là một ngày **TRONG QUÁ KHỨ** (VD: Tuần trước). Trạng thái: "Đã xuất bản".
*   [ ] **Test 2.4:** Ra ngoài giao diện người dùng (Frontend), truy cập trang **Kho lưu trữ** (`/archive`).
*   [ ] **Test 2.5:** Đảm bảo sự kiện B CÓ XUẤT HIỆN, còn sự kiện A KHÔNG XUẤT HIỆN (vì A chưa diễn ra nên chưa được vào kho).
*   [ ] **Test 2.6:** Sử dụng bộ lọc (Filter) trên trang Archive:
    *   Chọn "Năm" trùng với năm của sự kiện B.
    *   Chọn "Tháng" trùng với tháng của sự kiện B (nếu tháng 7 thì chọn Tháng 7).
    *   Hệ thống phải hiển thị chính xác sự kiện B mà không báo tìm thấy 0 sự kiện.
*   [ ] **Test 2.7:** Thử bấm vào xem chi tiết sự kiện B, test các Tab "Ảnh & Video", "Tài liệu học thuật", "Diễn giả" xem có chuyển qua lại mượt mà không.

---

## 3. Kiểm thử Upload File / Google Drive

**Mục tiêu:** Đảm bảo hệ thống tải lên được hình ảnh, tài liệu đính kèm (sử dụng Disk Google Drive mà ta đã cấu hình).

*   [ ] **Test 3.1:** Ở giao diện Admin tạo/sửa Sự kiện, thử upload một Ảnh bìa (Banner) từ máy tính.
*   [ ] **Test 3.2:** Thử upload 1 file PDF vào phần "Tài liệu đính kèm".
*   [ ] **Test 3.3:** Bấm Lưu sự kiện. 
    > *Lưu ý: Quá trình lưu có thể mất 3-5 giây vì nó đang đẩy file qua Google Drive thật.*
*   [ ] **Test 3.4:** Ra ngoài trang chi tiết sự kiện (Frontend), kiểm tra xem Ảnh bìa có hiển thị đúng không (ấn F12 kiểm tra link ảnh xem có đúng cấu trúc link Drive hay cấu trúc Storage không).
*   [ ] **Test 3.5:** Bấm vào tab tài liệu và thử bấm "Xem" hoặc "Tải xuống" file PDF vừa up.

---

## 4. Kiểm thử Đổi Mẫu Thiết Kế (Templates)

**Mục tiêu:** Đảm bảo hệ thống có đủ 7 mẫu sự kiện và quản trị viên có thể đổi giao diện thoải mái.

*   [ ] **Test 4.1:** Vào Admin -> Sự kiện -> Bấm nút **Thiết kế** (Màu xanh dương) ở một sự kiện bất kỳ.
*   [ ] **Test 4.2:** Đảm bảo danh sách liệt kê hiển thị đủ **7 Mẫu giao diện** (từ Mẫu 1 đến Mẫu 7).
*   [ ] **Test 4.3:** Chọn thử "Mẫu 3", hệ thống báo "Cập nhật mẫu hiển thị thành công".
*   [ ] **Test 4.4:** Bấm nút **"Xem trang"** (View) sự kiện đó ở Frontend để xác nhận giao diện đã được thay đổi sang bố cục của Mẫu 3.
*   [ ] **Test 4.5:** Lặp lại với các mẫu khác (Mẫu 5, Mẫu 7) để đảm bảo không bị lỗi trắng trang (View not found).

---

## 5. Kiểm thử Lỗi Dashboard (Cache 500)

**Mục tiêu:** Đảm bảo lỗi truy cập Dashboard không bao giờ bị sập nữa.

*   [ ] **Test 5.1:** Truy cập trang Tổng quan (`/admin`).
*   [ ] **Test 5.2:** Trang phải load thành công, hiện đầy đủ biểu đồ, Thống kê "Sự kiện được xem nhiều nhất".
*   [ ] **Test 5.3:** Mở 1 tab ẩn danh, click xem 1 sự kiện vài lần (để tăng lượt view).
*   [ ] **Test 5.4:** Quay lại trang `/admin` và F5 (Refresh) liên tục 3-5 lần. Đảm bảo lỗi `Attempt to read property "title" on string` KHÔNG CÒN XUẤT HIỆN.

---

**💡 TIP CHO BẠN:** Hãy tick (✔️) vào từng ô hoặc in file này ra trong quá trình Review/Kiểm thử. Nếu tất cả các bước trên đều chạy "ngon lành" thì đồ án của bạn đã sẵn sàng 100% rồi đó! Chúc bạn test thành công!
