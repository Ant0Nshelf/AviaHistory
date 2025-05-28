<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація - Історія авіації на Закарпатті</title>
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        /* Форма реєстрації */
        .register-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.5s;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #6c757d;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 20px;
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

        .register-footer {
            text-align: center;
            margin-top: 20px;
        }

        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-footer a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        /* Футер */
        footer {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            color: white;
            padding: 40px 0 20px;
            margin-top: auto;
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Історія авіації на Закарпатті</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Вхід</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <h2><i class="fas fa-user-plus me-2"></i>Реєстрація</h2>
                <p>Створіть обліковий запис для доступу до всіх функцій сайту</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Ім'я</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Введіть ваше ім'я">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Введіть пароль">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Підтвердження пароля</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Повторіть пароль">
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Зареєструватися
                    </button>
                </div>
            </form>

            <div class="register-footer">
                <p>Вже маєте обліковий запис? <a href="{{ route('login') }}">Увійти</a></p>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-plane me-2"></i> Про проект</h5>
                    <p>Цей сайт присвячений історії авіації на Закарпатті. Тут ви знайдете інформацію про важливі події, видатних людей та цікаві місця, пов'язані з авіацією в нашому регіоні.</p>
                </div>
                <div class="col-md-4">
                    <h5><i class="fas fa-map-marked-alt me-2"></i> Локації</h5>
                    <ul class="list-unstyled">
                        @foreach(\App\Models\Location::take(5)->get() as $location)
                            <li class="mb-2">
                                <a href="{{ route('filter.location', ['location_id' => $location->id]) }}" class="text-decoration-none">
                                    <i class="fas fa-angle-right me-1"></i> {{ $location->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5><i class="fas fa-history me-2"></i> Історія авіації</h5>
                    <p>Авіація на Закарпатті має багату історію, яка починається з перших польотів на початку XX століття. Завдяки унікальному географічному розташуванню, цей регіон завжди був важливим транзитним пунктом.</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Історія авіації на Закарпатті. Всі права захищено.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
