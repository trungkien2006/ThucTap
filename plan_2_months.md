# Kế hoạch công việc Thực tập sinh (Báo cáo cá nhân)
**Vai trò đảm nhận trong nhóm 4 người:** Lập trình Hệ thống quản trị (Admin) và Xử lý dữ liệu (Backend).

Dưới đây là bảng tiến độ công việc chi tiết hàng ngày trong **2 tháng (8 tuần, 48 ngày làm việc)** ghi nhận lại những đầu mục công việc do **cá nhân tôi** trực tiếp thực hiện và phối hợp cùng nhóm. Các từ ngữ chuyên ngành đã được diễn đạt đơn giản để đưa vào báo cáo thực tập.

---

## 🎯 GIAI ĐOẠN 1: PHÂN TÍCH VÀ THIẾT KẾ HỆ THỐNG (TUẦN 1 & 2)

### Tuần 1: Phân tích hệ thống và Sơ đồ dữ liệu
- **Ngày 1:** Cùng nhóm phân tích yêu cầu dự án. Nhận nhiệm vụ phụ trách chính khu vực Quản trị và Xử lý dữ liệu hệ thống.
- **Ngày 2:** Liệt kê chi tiết các thông tin cần lưu trữ cho các phần: Sự kiện, Danh mục, Người thuyết trình.
- **Ngày 3:** Thiết kế sơ đồ Cơ sở dữ liệu (Database) nháp trên giấy dựa vào các thông tin đã liệt kê.
- **Ngày 4:** Chỉnh sửa và vẽ lại sơ đồ Cơ sở dữ liệu hoàn chỉnh, rõ ràng trên phần mềm.
- **Ngày 5:** Vẽ sơ đồ luồng hoạt động của Quản trị viên (từ lúc đăng nhập -> thêm sự kiện -> tải ảnh -> quản lý danh sách).
- **Ngày 6:** Họp nhóm tổng duyệt các sơ đồ. Thống nhất cấu trúc dữ liệu với các bạn làm giao diện để tránh lệch thông tin.

### Tuần 2: Thiết kế giao diện nháp (Wireframe) khu vực Quản trị
- **Ngày 7:** Vẽ phác thảo khung màn hình trang Danh sách sự kiện và bộ lọc tìm kiếm.
- **Ngày 8:** Vẽ phác thảo khung màn hình Thêm mới sự kiện (bố trí khu vực điền tên, chọn ngày giờ).
- **Ngày 9:** Vẽ phác thảo khung màn hình khu vực gán Người thuyết trình và tạo Lịch trình sự kiện.
- **Ngày 10:** Vẽ phác thảo khung màn hình Quản lý hình ảnh và Kho lưu trữ sự kiện cũ.
- **Ngày 11:** Cài đặt các công cụ lập trình, thiết lập môi trường máy chủ ảo trên máy tính cá nhân.
- **Ngày 12:** Phân chia cấu trúc thư mục mã nguồn chung cho cả nhóm. Khởi tạo mã nguồn ban đầu.

---

## 🚀 GIAI ĐOẠN 2: LẬP TRÌNH CÁC CHỨC NĂNG CƠ BẢN (TUẦN 3 & 4)

### Tuần 3: Xây dựng nền tảng dữ liệu và tính năng danh mục
- **Ngày 13:** Viết mã lệnh tạo các bảng lưu trữ dữ liệu (Bảng Sự kiện, Người dùng, Danh mục...) vào hệ thống.
- **Ngày 14:** Lập trình chức năng Đăng nhập, Đăng xuất và Bảo mật để chặn người lạ truy cập khu vực quản trị.
- **Ngày 15:** Lập trình trang Quản lý Danh mục sự kiện (các chức năng: Thêm, sửa, xóa, hiển thị danh sách).
- **Ngày 16:** Lập trình trang Quản lý Đơn vị tổ chức.
- **Ngày 17:** Lập trình trang Quản lý Người thuyết trình (xử lý việc nhận và lưu ảnh đại diện lên máy chủ).
- **Ngày 18:** Kiểm tra lại toàn bộ các trang vừa làm, đảm bảo dữ liệu thêm vào không bị lỗi hoặc trùng lặp.

### Tuần 4: Lập trình tính năng Quản lý Sự kiện (Phần 1)
- **Ngày 19:** Dựng trang Danh sách sự kiện. Viết lệnh xử lý tính năng tìm kiếm bằng chữ và lọc sự kiện theo thời gian.
- **Ngày 20:** Lập trình trang Thêm mới sự kiện (Chỉ làm phần điền thông tin chữ cơ bản và tải ảnh bìa).
- **Ngày 21:** Lập trình phần xử lý lưu thời gian (ngày, giờ bắt đầu/kết thúc) và địa điểm tổ chức sự kiện.
- **Ngày 22:** Lập trình chức năng chọn và lưu danh sách Người thuyết trình tham gia vào sự kiện đó.
- **Ngày 23:** Lập trình tính năng tạo Lịch trình chi tiết (tạo ra bảng gồm nhiều mốc thời gian diễn ra trong sự kiện).
- **Ngày 24:** Ghép nối tất cả các phần trên (thông tin, thời gian, người thuyết trình, lịch trình) thành một quy trình Lưu sự kiện hoàn chỉnh.

---

## 🌟 GIAI ĐOẠN 3: HOÀN THIỆN SỰ KIỆN VÀ GHÉP NỐI NHÓM (TUẦN 5 & 6)

### Tuần 5: Lập trình tính năng Quản lý Sự kiện (Phần 2)
- **Ngày 25:** Lập trình phần tải lên và quản lý thư viện hình ảnh (Album) cho sự kiện.
- **Ngày 26:** Làm chức năng Xóa sự kiện. Thiết kế hộp thoại yêu cầu gõ chữ "Đồng ý xóa" để đảm bảo an toàn.
- **Ngày 27:** Chuyển giao dữ liệu đã làm xong và hướng dẫn các bạn trong nhóm cách kéo dữ liệu ra giao diện người xem.
- **Ngày 28:** Lập trình tính năng tự động đếm và cộng dồn số lượt xem mỗi khi có người ấn vào sự kiện.
- **Ngày 29:** Xử lý chức năng chia trang (phân trang) để danh sách sự kiện không bị dài vô tận trên một màn hình.
- **Ngày 30:** Họp nhóm, kiểm tra chéo dữ liệu giữa khu vực quản trị của tôi và khu vực hiển thị bên ngoài xem đã khớp nhau chưa.

### Tuần 6: Tích hợp chọn Mẫu giao diện (Template)
- **Ngày 31:** Lập trình chức năng cho phép Quản trị viên chọn Mẫu giao diện (Template 1, 2, 3...) khi đăng bài.
- **Ngày 32:** Phối hợp với bạn thiết kế giao diện để nhúng 7 mẫu hiển thị khác nhau vào hệ thống một cách mượt mà.
- **Ngày 33:** Lập trình chức năng "Xem trước" (Preview) để quản trị viên kiểm tra bài viết trước khi ấn công khai.
- **Ngày 34:** Xử lý các lỗi liên quan đến việc tải ảnh (ảnh dung lượng quá lớn, ảnh bị ngược hoặc bị vỡ khung).
- **Ngày 35:** Lập trình phần Cài đặt hệ thống (tạo khu vực quản lý tài khoản để đổi tên hiển thị, đổi mật khẩu).
- **Ngày 36:** Sửa các lỗi nhập liệu do nhóm phát hiện (ví dụ: chặn không cho nhập chữ vào ô số điện thoại, chặn nhập ngày kết thúc trước ngày bắt đầu).

---

## 🔥 GIAI ĐOẠN 4: DỊCH VỤ NÂNG CAO, SỬA LỖI VÀ ĐƯA LÊN MẠNG (TUẦN 7 & 8)

### Tuần 7: Tích hợp Google Drive và Bảng thống kê
- **Ngày 37:** Nghiên cứu tài liệu và kết nối thành công hệ thống trang web với dịch vụ lưu trữ Google Drive.
- **Ngày 38:** Lập trình tính năng tự động tải toàn bộ hình ảnh, video từ một đường dẫn thư mục Google Drive về web.
- **Ngày 39:** Lập trình cơ chế dọn dẹp: Tự động xóa sạch ảnh cũ trên máy chủ nếu quản trị viên đổi sang đường dẫn Google Drive khác.
- **Ngày 40:** Lập trình trang "Kho lưu trữ sự kiện" (Chỉ hiển thị những sự kiện đã diễn ra xong và đã có hình ảnh tổng kết).
- **Ngày 41:** Viết công thức tính toán tổng số sự kiện, đếm tổng lượt xem để hiển thị lên Bảng điều khiển (Dashboard) đầu tiên.
- **Ngày 42:** Lập trình tính năng Lịch sử hoạt động (Tự động ghi nhận lại hệ thống tài khoản nào vừa xóa hoặc sửa sự kiện gì, lúc mấy giờ).

### Tuần 8: Sửa lỗi, Đưa lên mạng và Hoàn thiện Báo cáo
- **Ngày 43:** Tự kiểm tra tổng thể toàn bộ các chức năng mình đã làm. Cố tình nhập sai các loại dữ liệu để thử độ bền của web.
- **Ngày 44:** Sửa các lỗi mất kết nối dữ liệu, đồng thời rà soát lại các dòng lệnh thừa để trang web xử lý nhanh hơn.
- **Ngày 45:** Hỗ trợ trưởng nhóm tìm và mua địa chỉ tên miền (website), thuê máy chủ (Server).
- **Ngày 46:** Trực tiếp cấu hình máy chủ, đưa toàn bộ mã nguồn của cả nhóm lên máy chủ thực tế trên mạng.
- **Ngày 47:** Kiểm tra trang web chạy thực tế trên điện thoại di động (thử sức chịu tải khi đăng bài viết có nhiều ảnh nặng).
- **Ngày 48:** Chụp ảnh màn hình các chức năng tôi đã làm. Hoàn thiện tài liệu Báo cáo thực tập cá nhân để nộp. Nộp mã nguồn hoàn chỉnh.
