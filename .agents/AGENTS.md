# Agent Rules

These rules must NEVER be violated under any circumstances:

1. **Database Operations**: Do NOT add or delete records in the database without explicit prior permission from the user.
2. **Git/Version Control**: Do NOT automatically push changes to any branches unless explicitly instructed to do so by the user.
3. **Giao diện sự kiện**: Các mẫu sự kiện/trang sự kiện hiện tại và sau này sẽ luôn dùng chung 1 header và footer (kế thừa từ `layouts.frontend`) để có thể điều hướng (navigate) tốt hơn trong website.
4. **Layout giao diện trang chủ**:
   - Slider chính là sự kiện mới nhất mà đã được xuất bản và đã xảy ra (Tính khi được tạo ra).
   - Danh mục sự kiện.
   - Sự kiện sắp tới.
   - Sự kiện nổi bật nhất (Tính điểm: lượt yêu thích 3 điểm, lượt xem 1 điểm; xét trong 3 tháng được tạo ra, bao gồm cả sự kiện chưa bắt đầu).
   - Giới thiệu kho lưu trữ.
   - Album media.
5. **Trang thiết kế mẫu sự kiện**: Mỗi mẫu sự kiện sẽ có trang thiết kế riêng để phù hợp với layout từng mẫu khi thiết kế.
