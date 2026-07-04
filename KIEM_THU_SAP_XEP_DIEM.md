# BÁO CÁO KIỂM THỬ & GIẢI THÍCH THỨ TỰ SẮP XẾP SỰ KIỆN NỔI BẬT

## 1. Trả lời câu hỏi: "Lúc đầu hệ thống đã có công thức này chưa?"
**Câu trả lời là: CHƯA!**
- **Lúc đầu (Trong phiên bản code gốc cũ - Commit `13cd183`):** 
  Hệ thống **CHƯA CÓ** công thức nhân 3. Lúc đó, đoạn code sắp xếp sự kiện chỉ là:
  `orderByRaw('views_count + likes_count DESC')`
  *(Tức là: Điểm số = Lượt xem + Lượt thích. Mỗi lượt thích chỉ có giá trị ngang bằng 1 lượt xem).*
- **Hiện tại (Sau khi nâng cấp/sửa đổi theo đúng yêu cầu):** 
  Hệ thống đã được nâng cấp lên công thức chuẩn xác:
  `orderByRaw('(likes_count * 3) + views_count DESC')`
  *(Tức là: Mỗi lượt thích được định giá cao gấp 3 lần lượt xem, vì hành động "Thích" thể hiện sự quan tâm sâu sắc và chất lượng hơn rất nhiều so với chỉ "Xem" lướt qua).*

---

## 2. Công thức tính điểm hiện tại (Scoring Formula)
Hệ thống xác định độ "Nổi bật" (Featured Events) hiển thị trên Trang chủ thông qua công thức tính điểm tương tác mới nhất:

$$\text{Điểm số} = (\text{Số lượt Thích} \times 3) + \text{Số lượt Xem}$$

> [!IMPORTANT]
> **Quy tắc sắp xếp (Sorting Rule):**
> Hệ thống sắp xếp theo thứ tự **Giảm dần (Descending - DESC)**. 
> Sự kiện nào có tổng điểm lớn hơn (`>`) sẽ được ưu tiên **đứng trước**.
> 
> **Ví dụ minh họa theo yêu cầu:**
> Nếu Sự kiện X có **56 điểm** và Sự kiện Y có **35 điểm**:
> Vì `56 > 35` (Điểm X > Điểm Y) nên **Sự kiện X chắc chắn phải đứng trước Sự kiện Y** theo đúng công thức. 
> *(Ngược lại, nếu sự kiện 35 điểm mà lại đứng trước sự kiện 56 điểm thì hệ thống bị lỗi sắp xếp).*

---

## 3. Kiểm chứng mã nguồn (Codebase Verification)
Khi rà soát file xử lý logic giao diện người dùng [FrontendController.php](file:///c:/Users/Admin/Downloads/ThucTap-main/ThucTap-main/app/Http/Controllers/FrontendController.php#L80), câu lệnh SQL truy vấn danh sách sự kiện nổi bật hiện tại đã được viết chuẩn xác theo đúng công thức nhân 3:

```php
$dbFeatured = Event::with(['bannerImage', 'category'])
    ->published()
    ->where('created_at', '>=', now()->subMonths(3))
    ->orderByRaw('(likes_count * 3) + views_count DESC') // <-- CÔNG THỨC SẮP XẾP GIẢM DẦN (HIỆN TẠI)
    ->take(4)
    ->get();
```
- **`(likes_count * 3) + views_count`**: Lấy số lượt thích nhân 3, cộng với số lượt xem.
- **`DESC` (Descending)**: Từ khóa chỉ định sắp xếp từ lớn đến bé (Điểm cao đứng trước, điểm thấp đứng sau).

---

## 4. Kiểm chứng trên Dữ liệu thực tế của hệ thống (Actual Database Test)
Dưới đây là dữ liệu thực tế được trích xuất từ cơ sở dữ liệu hiện tại trong máy của bạn để kiểm chứng xem thứ tự có đúng công thức không:

| Thứ tự hiển thị | Tên sự kiện | Lượt thích (Likes) | Lượt xem (Views) | Công thức tính | Tổng điểm | Đánh giá thứ tự |
|:---:|:---|:---:|:---:|:---:|:---:|:---|
| **#1** | **Sứa cute** | 3 | 1 | $(3 \times 3) + 1$ | **10 điểm** | 🟢 **Đứng thứ 1** (Điểm cao nhất) |
| **#2** | **Hội thảo Thể thao & Sức khỏe Học đường 2026** | 1 | 2 | $(1 \times 3) + 2$ | **5 điểm** | 🟢 **Đứng thứ 2** vì `5 < 10` |
| **#3** | **mèo béo tu tien** | 1 | 1 | $(1 \times 3) + 1$ | **4 điểm** | 🟢 **Đứng thứ 3** vì `4 < 5` |

### Nhận xét kiểm thử:
- Điểm số thực tế: `10 điểm > 5 điểm > 4 điểm`.
- Thứ tự hiển thị ngoài trang chủ (Frontend) hoàn toàn tuân thủ quy tắc: Sự kiện điểm lớn hơn (`>`) đứng trước sự kiện điểm bé hơn (`<`).
- **Kết luận:** Chức năng sắp xếp sự kiện nổi bật theo công thức điểm **[PASSED] - Hoạt động chuẩn xác 100%**.
