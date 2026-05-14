<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>كود إعادة تعيين كلمة المرور</title>
</head>
<body style="font-family: Arial, sans-serif; direction: rtl; text-align: right;">
    <div style="max-width: 600px; margin: 0 auto; padding: 1rem; border: 1px solid #ddd; border-radius: 8px;">
        <h1 style="color: #0a192f;">كود إعادة تعيين كلمة المرور</h1>
        <p>مرحباً،</p>
        <p>استخدم الكود التالي لإعادة تعيين كلمة المرور الخاصة بك:</p>
        <div style="margin: 1rem 0; padding: 1rem; border-radius: 8px; background: #f8fafc; font-size: 1.5rem; letter-spacing: 0.1rem; text-align: center;">
            <strong>{{ $code }}</strong>
        </div>
        <p>ينتهي الكود خلال {{ $expiresIn }} دقيقة.</p>
        <p>إذا لم تطلب هذا الكود، يمكنك تجاهل هذه الرسالة.</p>
        <p>مع تحيات فريق دليل حضرموت.</p>
    </div>
</body>
</html>
