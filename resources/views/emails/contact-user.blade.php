<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đã nhận tin nhắn liên hệ</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f0; margin: 0; padding: 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; padding: 20px; border: 1px solid #ddd; }
        .header { background-color: #07A0C3; color: #ffffff; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; line-height: 1.6; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #1C1410; }
        .value { color: #555; }
        .message-box { background-color: #f9f9f9; border-left: 4px solid #07A0C3; padding: 15px; margin-top: 10px; }
        .footer { text-align: center; font-size: 12px; color: #888; margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h2>UniEvent - Xác Nhận Tin Nhắn</h2>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $senderName }}</strong>,</p>
            <p>Cảm ơn bạn đã liên hệ với UniEvent. Chúng tôi đã nhận được thông điệp của bạn với các thông tin sau:</p>
            
            <div class="field">
                <span class="label">Chủ đề:</span>
                <span class="value">{{ $subjectText }}</span>
            </div>
            <div class="field">
                <span class="label">Nội dung tin nhắn:</span>
                <div class="message-box">
                    {{ $messageBody }}
                </div>
            </div>
            
            <p>Đội ngũ của chúng tôi sẽ xem xét nội dung và phản hồi lại bạn qua địa chỉ email này trong thời gian sớm nhất có thể.</p>
            <p>Trân trọng,<br>Ban quản trị UniEvent</p>
        </div>
        <div class="footer">
            <p>Email này được gửi tự động từ hệ thống UniEvent. Vui lòng không trả lời trực tiếp email này.</p>
        </div>
    </div>
</body>
</html>
