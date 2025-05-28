<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Історія авіації на Закарпатті</title>
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

        /* Кнопки */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 71, 161, 0.3);
        }

        /* Карточки */
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        /* Респонсивність */
        @media (max-width: 768px) {
            .main-content {
                padding: 30px 0;
            }
        }
    </style>
    @yield('styles')
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
                <div class="d-flex">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Увійти</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Зареєструватися</a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                                @if(Auth::user()->isAdmin())
                                    <span class="badge bg-warning text-dark ms-1">Адмін</span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                @if(Auth::user()->isAdmin())
                                    <li><h6 class="dropdown-header">Панель адміністратора</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('events.manage.index') }}"><i class="fas fa-calendar-alt me-2"></i>Управління подіями</a></li>
                                    <li><a class="dropdown-item" href="{{ route('locations.manage.index') }}"><i class="fas fa-map-marker-alt me-2"></i>Управління локаціями</a></li>
                                    <li><a class="dropdown-item" href="{{ route('users.manage.index') }}"><i class="fas fa-users me-2"></i>Управління користувачами</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li><h6 class="dropdown-header">Мій профіль</h6></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Редагувати профіль</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Вийти</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Основний контент -->
    <div class="main-content">
        @yield('content')
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
    @yield('scripts')
</body>
</html>
