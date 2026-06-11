<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background: #103A71; color: #fff; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .button { display: inline-block; padding: 12px 24px; background-color: #F26F21; color: #fff; text-decoration: none; font-weight: bold; border-radius: 4px; margin-top: 20px; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>FPT Polytechnic - Xác nhận đăng ký sự kiện</h2>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $registration->full_name }}</strong>,</p>
            <p>Cảm ơn bạn đã đăng ký tham gia sự kiện <strong>{{ $registration->event->title }}</strong>.</p>
            
            <p><strong>Thông tin sự kiện:</strong></p>
            <ul>
                <li><strong>Thời gian:</strong> {{ $registration->event->event_date->format('H:i d/m/Y') }}</li>
                <li><strong>Địa điểm:</strong> {{ $registration->event->location }}</li>
            </ul>

            <p>Vui lòng click vào nút bên dưới để xác nhận email của bạn và nhận Mã QR Check-in tham gia sự kiện:</p>
            
            <div style="text-align: center;">
                <a href="{{ route('register.confirm', $registration->confirmation_token) }}" class="button">XÁC NHẬN & NHẬN MÃ QR</a>
            </div>
            
            <p style="margin-top: 20px;"><em>Lưu ý: Bạn bắt buộc phải xác nhận email và xuất trình mã QR tại cửa soát vé để tham gia sự kiện.</em></p>
        </div>
        <div class="footer">
            <p>Hệ thống Event Page Maker - FPT Polytechnic</p>
        </div>
    </div>
</body>
</html>
