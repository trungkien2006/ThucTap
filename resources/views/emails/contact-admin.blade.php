<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin nhắn mới từ form liên hệ</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f0; margin: 0; padding: 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; padding: 20px; border: 1px solid #ddd; }
        .header { background-color: #1C1410; color: #FFE381; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; line-height: 1.6; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #1C1410; }
        .value { color: #555; }
        .message-box { background-color: #f9f9f9; border-left: 4px solid #FFE381; padding: 15px; margin-top: 10px; font-style: italic; }
        .footer { text-align: center; font-size: 12px; color: #888; margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h2>UniEvent - Tin Nhắn Mới</h2>
        </div>
        <div class="content">
            <p>Bạn nhận được một tin nhắn liên hệ mới từ trang web.</p>
            <div class="field">
                <span class="label">Họ tên:</span>
                <span class="value">{{ $senderName }}</span>
            </div>
            <div class="field">
                <span class="label">Email:</span>
                <span class="value">{{ $senderEmail }}</span>
            </div>
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
            <p>Bạn có thể trả lời trực tiếp cho người gửi bằng cách gửi email tới: <a href="mailto:{{ $senderEmail }}">{{ $senderEmail }}</a></p>
        </div>
        <div class="footer">
            <p>Hệ thống thông báo tự động UniEvent</p>
        </div>
    </div>
</body>
</html>
