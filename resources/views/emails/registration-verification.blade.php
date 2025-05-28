<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Підтвердження реєстрації</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px 0;
        }

        .email-wrapper {
            max-width: 680px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%);
            padding: 50px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="plane" patternUnits="userSpaceOnUse" width="20" height="20"><path d="M10 2l8 6-8 2-2 8-6-8-2-8z" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23plane)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .plane-icon {
            font-size: 64px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
            animation: fly 3s ease-in-out infinite;
        }

        @keyframes fly {
            0%, 100% { transform: translateX(0px); }
            50% { transform: translateX(10px); }
        }

        .header h1 {
            color: white;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            font-weight: 300;
            position: relative;
            z-index: 2;
        }

        .content {
            padding: 60px 40px;
            background: #ffffff;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .welcome-section h2 {
            color: #1e3a8a;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .welcome-section p {
            color: #6b7280;
            font-size: 18px;
            line-height: 1.7;
        }

        .verification-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            margin: 40px 0;
            border: 1px solid #e2e8f0;
        }

        .verification-button {
            display: inline-block;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%);
            color: white;
            padding: 18px 40px;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 18px;
            margin: 20px 0;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .verification-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
            color: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin: 50px 0;
        }

        .feature-item {
            text-align: center;
            padding: 30px 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .feature-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #3b82f6;
        }

        .feature-item h3 {
            color: #1e3a8a;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .feature-item p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
        }

        .security-notice {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 1px solid #f59e0b;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            display: flex;
            align-items: center;
        }

        .security-notice .icon {
            font-size: 24px;
            color: #d97706;
            margin-right: 15px;
        }

        .security-notice p {
            margin: 0;
            color: #92400e;
            font-size: 14px;
            font-weight: 500;
        }

        .footer {
            background: #1f2937;
            color: #9ca3af;
            padding: 40px;
            text-align: center;
        }

        .footer-content {
            max-width: 500px;
            margin: 0 auto;
        }

        .footer h3 {
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .footer a {
            color: #60a5fa;
            text-decoration: none;
        }

        .footer a:hover {
            color: #93c5fd;
        }

        .social-links {
            margin-top: 30px;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #6b7280;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #3b82f6;
        }

        @media (max-width: 600px) {
            .email-wrapper {
                margin: 0 10px;
                border-radius: 15px;
            }

            .header, .content, .footer {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .welcome-section h2 {
                font-size: 22px;
            }

            .verification-card {
                padding: 25px;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header Section -->
        <div class="header">
            <div class="plane-icon">✈️</div>
            <h1>Історія авіації на Закарпатті</h1>
            <p>Ласкаво просимо до нашої спільноти!</p>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2>Ласкаво просимо, {{ $pendingRegistration->name }}!</h2>
                <p>Для завершення реєстрації, будь ласка, підтвердіть свою email адресу:</p>
            </div>

            <!-- Verification Card -->
            <div class="verification-card">
                <a href="{{ $verificationUrl }}" class="verification-button">
                    Підтвердити реєстрацію
                </a>

                <p style="color: #9ca3af; font-size: 14px; margin-top: 20px;">
                    Посилання дійсне протягом 24 годин
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-content">
                <p>© {{ date('Y') }} Історія авіації на Закарпатті</p>
            </div>
        </div>
    </div>
</body>
</html>
