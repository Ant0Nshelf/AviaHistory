<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Історія авіації на Закарпатті</title>
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

        /* Геройська секція */
        .hero-section {
            background-image: url('https://fs02.vseosvita.ua/02001xt5-9614.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 150px 0;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(13, 71, 161, 0.8), rgba(25, 118, 210, 0.7));
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 1s;
        }

        .hero-section .lead {
            font-size: 1.5rem;
            margin-bottom: 30px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s;
        }

        /* Декоративні елементи */
        .cloud {
            position: absolute;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        .cloud-1 {
            width: 100px;
            height: 60px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .cloud-2 {
            width: 140px;
            height: 80px;
            top: 15%;
            right: 15%;
            animation-delay: 5s;
        }

        .cloud-3 {
            width: 80px;
            height: 50px;
            bottom: 25%;
            left: 20%;
            animation-delay: 2s;
        }

        .plane-icon {
            position: absolute;
            color: white;
            font-size: 2rem;
            animation: flyPlane 20s infinite linear;
            opacity: 0.7;
            z-index: 2;
        }

        .plane-icon-1 {
            top: 30%;
            left: -50px;
            animation-duration: 15s;
        }

        .plane-icon-2 {
            top: 60%;
            left: -50px;
            animation-duration: 25s;
            animation-delay: 5s;
        }

        /* Картки подій */
        .event-card {
            transition: all 0.3s ease;
            margin-bottom: 30px;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .event-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .event-card .card-body {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .event-card .card-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .event-card .card-text {
            color: #666;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .event-date {
            font-size: 0.9rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .event-date i {
            margin-right: 5px;
            color: var(--accent-color);
        }

        .location-badge {
            background-color: var(--light-color);
            color: var(--primary-color);
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            margin-left: 0.5rem;
            display: inline-flex;
            align-items: center;
        }

        .location-badge i {
            margin-right: 5px;
        }

        .btn-more {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s;
            align-self: flex-start;
            margin-top: auto;
        }

        .btn-more:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(25, 118, 210, 0.3);
        }

        /* Фільтри */
        .filters {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .filter-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .filter-btn {
            background-color: white;
            color: var(--text-dark);
            border: 1px solid #ddd;
            border-radius: 30px;
            padding: 8px 15px;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .filter-btn:hover, .filter-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Анімації */
        @keyframes float {
            0% {
                transform: translateX(0) translateY(0);
            }
            25% {
                transform: translateX(10px) translateY(-10px);
            }
            50% {
                transform: translateX(20px) translateY(0);
            }
            75% {
                transform: translateX(10px) translateY(10px);
            }
            100% {
                transform: translateX(0) translateY(0);
            }
        }

        @keyframes flyPlane {
            0% {
                transform: translateX(0) rotate(-45deg);
            }
            100% {
                transform: translateX(calc(100vw + 100px)) rotate(-45deg);
            }
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

        /* Контейнер без подій */
        .container:empty {
            min-height: 0;
            padding: 0;
            margin: 0;
        }

        /* Прибираємо зайві відступи */
        .container:has(.no-events) {
            padding-top: 0;
            padding-bottom: 0;
        }

        /* Респонсивність */
        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 0;
            }

            .hero-section h1 {
                font-size: 2.5rem;
            }

            .hero-section .lead {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
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
                                @if(!auth()->user()->isSuperAdmin())
                                    <li><h6 class="dropdown-header">Мій профіль</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Редагувати профіль</a></li>
                                    <li><a class="dropdown-item text-danger" href="{{ route('profile.edit') }}#delete"><i class="fas fa-trash-alt me-2"></i>Видалити акаунт</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
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

    <header class="hero-section">
        <!-- Декоративні елементи -->
        <div class="cloud cloud-1"></div>
        <div class="cloud cloud-2"></div>
        <div class="cloud cloud-3"></div>
        <i class="fas fa-plane plane-icon plane-icon-1"></i>
        <i class="fas fa-plane plane-icon plane-icon-2"></i>

        <div class="hero-content">
            <div class="container text-center">
                <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Історія авіації на Закарпатті</h1>
                <p class="lead animate__animated animate__fadeInUp">Дослідіть історію розвитку авіації в нашому мальовничому краї</p>
                <div class="mt-4 animate__animated animate__fadeInUp animate__delay-1s">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-user-plus me-2"></i>Зареєструватися
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Увійти
                        </a>
                    @else
                        <a href="#events" class="btn btn-primary btn-lg">
                            <i class="fas fa-plane me-2"></i>Переглянути події
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    @if($events->count() > 0 || session('success') || session('error'))
        <div class="container">
            <!-- Повідомлення -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($events->count() > 0)
            <!-- Заголовок розділу -->
            <div class="section-header animate__animated animate__fadeIn" id="events">
                <div class="row align-items-center mb-4">
                    <div class="col-12 text-center">
                        <h2 class="filter-title">
                            <i class="fas fa-plane-departure me-2"></i>Історичні події авіації на Закарпатті
                        </h2>
                        <p class="text-muted">Дослідіть важливі моменти в історії розвитку авіації нашого краю</p>
                    </div>
                </div>
            </div>

            <!-- Події -->
            <div class="row">
                @foreach($events as $event)
                    <div class="col-md-4 mb-4 animate__animated animate__fadeInUp">
                        <div class="card event-card">
                            @if($event->image_url)
                                <img src="{{ $event->image_url }}" class="card-img-top" alt="{{ $event->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1532989029401-439615f3d4b4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1548&q=80" class="card-img-top" alt="Зображення авіації">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="event-date">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $event->event_date ? $event->event_date->format('d.m.Y') : 'Дата невідома' }}
                                </p>
                                @if($event->location)
                                    <p class="mb-3">
                                        <span class="location-badge">
                                            <i class="fas fa-map-marker-alt"></i> {{ $event->location->name }}
                                        </span>
                                    </p>
                                @endif
                                <p class="card-text">{{ Str::limit($event->description, 120) }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-more">
                                    <i class="fas fa-info-circle me-1"></i> Детальніше
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Пагінація -->
            @if($events->hasPages())
                <div class="d-flex justify-content-center mt-4 mb-5">
                    {{ $events->links() }}
                </div>
            @endif
            @endif
        </div>
    @endif

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
                        @foreach($locations as $location)
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
