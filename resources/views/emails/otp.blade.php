<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #6a1b9a; text-align: center;">RoomDekho Verification</h2>
        <p>Hello,</p>
        <p>Your verification code for RoomDekho registration is:</p>
        <div style="text-align: center; margin: 30px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; background: #f3e5f5; padding: 10px 20px; border-radius: 5px; color: #4a148c;">
                {{ $otp }}
            </span>
        </div>
        <p>This code will expire in 10 minutes.</p>
        <p>If you did not request this code, please ignore this email.</p>
        <p>Best regards,<br>The RoomDekho Team</p>
    </div>
</body>
</html>
