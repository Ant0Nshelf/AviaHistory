<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Підтвердження email адреси</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        .header .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .content {
            padding: 40px 30px;
        }
        .content h2 {
            color: #0d47a1;
            margin-top: 0;
            font-size: 24px;
        }
        .content p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            margin: 20px 0;
            transition: all 0.3s;
        }
        .button:hover {
            background: linear-gradient(135deg, #1976d2, #42a5f5);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 71, 161, 0.3);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
            color: #6c757d;
        }
        .footer a {
            color: #0d47a1;
            text-decoration: none;
        }
        .security-note {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .security-note p {
            margin: 0;
            font-size: 14px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">✈️</div>
            <h1>Історія авіації на Закарпатті</h1>
        </div>
        
        <div class="content">
            <h2>Вітаємо, {{ $user->name }}!</h2>
            
            <p>Дякуємо за реєстрацію на нашому сайті, присвяченому історії авіації на Закарпатті!</p>
            
            <p>Для завершення реєстрації та активації вашого облікового запису, будь ласка, підтвердіть свою email адресу, натиснувши на кнопку нижче:</p>
            
            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="button">
                    Підтвердити email адресу
                </a>
            </div>
            
            <p>Після підтвердження ви зможете:</p>
            <ul>
                <li>Створювати та редагувати події з історії авіації</li>
                <li>Додавати нові локації</li>
                <li>Управляти контентом сайту</li>
                <li>Отримувати доступ до всіх функцій адміністрування</li>
            </ul>
            
            <div class="security-note">
                <p><strong>Важливо:</strong> Якщо ви не реєструвалися на нашому сайті, просто проігноруйте цей лист. Ваша email адреса не буде додана до нашої системи без підтвердження.</p>
            </div>
            
            <p>Якщо кнопка не працює, скопіюйте та вставте це посилання у ваш браузер:</p>
            <p style="word-break: break-all; color: #0d47a1; font-size: 14px;">{{ $verificationUrl }}</p>
        </div>
        
        <div class="footer">
            <p>Це автоматичний лист. Будь ласка, не відповідайте на нього.</p>
            <p>© {{ date('Y') }} Історія авіації на Закарпатті. Всі права захищено.</p>
        </div>
    </div>
</body>
</html>
