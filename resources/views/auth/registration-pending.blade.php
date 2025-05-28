<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Очікування підтвердження - Історія авіації на Закарпатті</title>
    <link rel="icon" href="{{ asset('images/plane-icon.svg') }}" type="image/svg+xml">
    <link rel="shortcut icon" href="{{ asset('images/plane-icon.svg') }}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #0d47a1;
            --secondary-color: #1976d2;
            --accent-color: #42a5f5;
            --light-color: #e3f2fd;
            --dark-color: #0a2351;
            --text-light: #ffffff;
            --text-dark: #333333;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: var(--text-dark);
        }

        /* Навігаційна панель */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }

        .navbar-brand:before {
            content: '\f072';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            margin-right: 10px;
            transform: rotate(-45deg);
            display: inline-block;
        }

        /* Основний контент */
        .main-content {
            min-height: calc(100vh - 200px);
            padding: 60px 0;
        }

        .pending-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 40px;
            text-align: center;
        }

        .card-header i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.9;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .card-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .card-body {
            padding: 40px;
            text-align: center;
        }

        .welcome-title {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .welcome-text {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .email-highlight {
            background-color: var(--light-color);
            color: var(--primary-color);
            padding: 15px 25px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            margin: 20px 0;
            border: 2px solid var(--accent-color);
        }

        .info-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
            margin: 30px 0;
        }

        .info-section h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 15px;
        }

        .info-section p {
            color: #6c757d;
            margin-bottom: 10px;
        }

        .navigation-buttons {
            margin-top: 40px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 71, 161, 0.3);
        }

        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            transform: translateY(-2px);
        }

        /* Футер */
        footer {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }

        footer h5 {
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 10px;
            display: inline-block;
        }

        footer a {
            color: var(--light-color);
            transition: color 0.3s;
        }

        footer a:hover {
            color: white;
            text-decoration: none;
        }

        /* Респонсивність */
        @media (max-width: 768px) {
            .card-header {
                padding: 30px 20px;
            }

            .card-body {
                padding: 30px 20px;
            }

            .welcome-title {
                font-size: 1.5rem;
            }

            .navigation-buttons .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Навігаційна панель -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Історія авіації на Закарпатті</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                </ul>
            </div>
        </div>
    </nav>

    <!-- Основний контент -->
    <div class="main-content">
        <div class="container">
            <div class="pending-card animate__animated animate__fadeInUp">
                <!-- Заголовок -->
                <div class="card-header">
                    <i class="fas fa-envelope-open"></i>
                    <h1>Очікування підтвердження</h1>
                    <p>Історія авіації на Закарпатті</p>
                </div>

                <!-- Контент -->
                <div class="card-body">
                    <h2 class="welcome-title">Ласкаво просимо!</h2>
                    <p class="welcome-text">Ми надіслали лист підтвердження на адресу:</p>

                    <div class="email-highlight">
                        <i class="fas fa-envelope me-2"></i>{{ session('email') }}
                    </div>

                    <div class="info-section">
                        <h5><i class="fas fa-info-circle me-2"></i>Що далі?</h5>
                        <p><i class="fas fa-check me-2 text-success"></i>Перевірте свою поштову скриньку</p>
                        <p><i class="fas fa-check me-2 text-success"></i>Знайдіть лист від "Історія авіації на Закарпатті"</p>
                        <p><i class="fas fa-check me-2 text-success"></i>Натисніть кнопку "Підтвердити реєстрацію" в листі</p>
                        <p><i class="fas fa-check me-2 text-success"></i>Ваш обліковий запис буде активовано автоматично</p>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-clock me-2"></i>
                        <strong>Важливо:</strong> Посилання для підтвердження дійсне протягом 24 годин.
                    </div>

                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Не отримали лист?</strong> Перевірте папку "Спам" або "Небажана пошта".
                    </div>

                    <!-- Навігація -->
                    <div class="navigation-buttons">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-home me-2"></i>На головну
                        </a>

                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-redo me-2"></i>Спробувати знову
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Футер -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Історія авіації на Закарпатті</h5>
                    <p>Досліджуємо та зберігаємо багату авіаційну спадщину нашого регіону.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; {{ date('Y') }} Історія авіації на Закарпатті. Всі права захищено.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
