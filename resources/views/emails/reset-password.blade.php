<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Скидання пароля</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .email-header {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .email-header .logo {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }
        
        .email-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .email-header p {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .email-body {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 1.2rem;
            font-weight: 600;
            color: #0d47a1;
            margin-bottom: 20px;
        }
        
        .message {
            font-size: 1rem;
            line-height: 1.7;
            color: #555;
            margin-bottom: 30px;
        }
        
        .reset-button {
            text-align: center;
            margin: 40px 0;
        }
        
        .reset-button a {
            display: inline-block;
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: white;
            text-decoration: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(13, 71, 161, 0.3);
        }
        
        .reset-button a:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 71, 161, 0.4);
        }
        
        .info-box {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #1976d2;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
        }
        
        .info-box .icon {
            color: #1976d2;
            font-size: 1.2rem;
            margin-right: 10px;
        }
        
        .warning-box {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            border-left: 4px solid #ff9800;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
        }
        
        .warning-box .icon {
            color: #ff9800;
            font-size: 1.2rem;
            margin-right: 10px;
        }
        
        .email-footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .email-footer .brand {
            font-weight: 600;
            color: #0d47a1;
            margin-bottom: 10px;
        }
        
        .email-footer .contact {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 20px;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #0d47a1;
            font-size: 1.5rem;
            text-decoration: none;
        }
        
        .copyright {
            font-size: 0.8rem;
            color: #999;
            margin-top: 20px;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
            
            .email-header, .email-body, .email-footer {
                padding: 20px;
            }
            
            .reset-button a {
                padding: 15px 30px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo">✈️</div>
            <h1>Скидання пароля</h1>
            <p>Історія авіації на Закарпатті</p>
        </div>
        
        <!-- Body -->
        <div class="email-body">
            <div class="greeting">
                Вітаємо, {{ $user->name }}!
            </div>
            
            <div class="message">
                Ви отримали цей лист, оскільки ми отримали запит на скидання пароля для вашого облікового запису на сайті "Історія авіації на Закарпатті".
            </div>
            
            <div class="reset-button">
                <a href="{{ $url }}">🔑 Скинути пароль</a>
            </div>
            
            <div class="info-box">
                <span class="icon">⏰</span>
                <strong>Важливо:</strong> Це посилання для скидання пароля дійсне протягом <strong>60 хвилин</strong> з моменту отримання цього листа.
            </div>
            
            <div class="warning-box">
                <span class="icon">⚠️</span>
                <strong>Безпека:</strong> Якщо ви не запитували скидання пароля, просто проігноруйте цей лист. Ваш пароль залишиться незмінним.
            </div>
            
            <div class="message">
                Якщо у вас виникли проблеми з натисканням кнопки "Скинути пароль", скопіюйте та вставте наступне посилання у ваш веб-браузер:
            </div>
            
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; word-break: break-all; font-family: monospace; font-size: 0.9rem; color: #666;">
                {{ $url }}
            </div>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <div class="brand">Історія авіації на Закарпатті</div>
            <div class="contact">
                Досліджуємо та зберігаємо багату авіаційну спадщину нашого регіону
            </div>
            
            <div class="social-links">
                <a href="#" title="Facebook">📘</a>
                <a href="#" title="Twitter">🐦</a>
                <a href="#" title="Instagram">📷</a>
                <a href="#" title="YouTube">📺</a>
            </div>
            
            <div class="copyright">
                © {{ date('Y') }} Історія авіації на Закарпатті. Всі права захищено.
            </div>
        </div>
    </div>
</body>
</html>
