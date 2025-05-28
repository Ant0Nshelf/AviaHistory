<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - Історія авіації на Закарпатті</title>
    <link rel="icon" href="{{ asset('images/plane-icon.svg') }}" type="image/svg+xml">
    <link rel="shortcut icon" href="{{ asset('images/plane-icon.svg') }}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="anonymous" />
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

        /* Заголовок події */
        .event-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-light);
            padding: 60px 0;
            margin-bottom: 40px;
            position: relative;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .event-header::before {
            content: '\f072';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            font-size: 15rem;
            opacity: 0.05;
            right: -50px;
            top: -50px;
            transform: rotate(-45deg);
        }

        .event-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--light-color));
        }

        .event-header h1 {
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .event-header .lead {
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Зображення події */
        .event-image-container {
            position: relative;
            margin-bottom: 30px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .event-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .event-image:hover {
            transform: scale(1.03);
        }

        .event-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(0,0,0,0.7) 100%);
            display: flex;
            align-items: flex-end;
            padding: 20px;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .event-image-container:hover .event-image-overlay {
            opacity: 1;
        }

        /* Метадані події */
        .event-meta {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            color: var(--text-dark);
            margin-right: 20px;
        }

        .meta-item i {
            color: var(--primary-color);
            margin-right: 8px;
            font-size: 1.2rem;
        }

        /* Опис події */
        .event-description {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .event-description p {
            margin-bottom: 20px;
        }

        /* Карта */
        .map-container {
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        /* Пов'язані події */
        .related-events {
            margin-top: 50px;
        }

        .related-events h3 {
            margin-bottom: 20px;
            font-weight: 600;
            color: var(--primary-color);
            border-left: 4px solid var(--accent-color);
            padding-left: 15px;
        }

        .related-event-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .related-event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .related-event-card img {
            height: 180px;
            object-fit: cover;
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

        /* Анімації */
        .animate-fade-up {
            animation: fadeInUp 1s;
        }

        .animate-fade-down {
            animation: fadeInDown 1s;
        }

        .animate-fade-left {
            animation: fadeInLeft 1s;
        }

        .animate-fade-right {
            animation: fadeInRight 1s;
        }

        /* Респонсивність */
        @media (max-width: 768px) {
            .event-header {
                padding: 40px 0;
            }

            .event-image {
                height: 300px;
            }

            .map-container {
                height: 300px;
            }
        }
        .event-description h3 {
            color: #007bff;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 0.5rem;
        }
        .location-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-left: 4px solid #007bff;
        }
        .navigation-links {
            display: flex;
            justify-content: space-between;
            margin: 40px 0;
        }
        .related-events {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #dee2e6;
        }
        .related-event-card {
            transition: transform 0.3s;
            height: 100%;
            border-left: 3px solid #007bff;
        }
        .related-event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .map-container {
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .social-share {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .interesting-facts .list-group-item {
            transition: background-color 0.3s;
        }
        .interesting-facts .list-group-item:hover {
            background-color: #f8f9fa;
        }
        .historical-significance {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            border-left: 4px solid #28a745;
        }
        .sources-info {
            border-left: 4px solid #17a2b8;
        }
        .sources-info h3 {
            color: #17a2b8;
            margin-bottom: 1rem;
        }
        .sources-info .list-group-item {
            transition: background-color 0.3s;
        }
        .sources-info .list-group-item:hover {
            background-color: #f1f8ff;
        }
        .sources-info a {
            color: #0056b3;
            text-decoration: none;
        }
        .sources-info a:hover {
            text-decoration: underline;
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

    <div class="event-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8 animate__animated animate__fadeInLeft">
                    <h1>{{ $event->title }}</h1>
                    <p class="lead">{{ Str::limit(strip_tags($event->description), 150) }}</p>
                </div>
                <div class="col-md-4 text-md-end animate__animated animate__fadeInRight">
                    <a href="{{ route('home') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Повернутися до списку
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Метадані події -->
                <div class="event-meta animate__animated animate__fadeInUp">
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $event->event_date ? $event->event_date->format('d.m.Y') : 'Дата невідома' }}</span>
                    </div>
                    @if($event->location)
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $event->location->name }}</span>
                        </div>
                        @if($event->location->type)
                            <div class="meta-item">
                                <i class="fas fa-tag"></i>
                                <span>{{ $event->location->type }}</span>
                            </div>
                        @endif
                    @endif
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>Додано: {{ $event->created_at->format('d.m.Y') }}</span>
                    </div>
                </div>

                <!-- Головне зображення -->
                <div class="event-image-container animate__animated animate__fadeInUp animate__delay-1s">
                    @if($event->image_url)
                        <img src="{{ $event->image_url }}" class="event-image" alt="{{ $event->title }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1532989029401-439615f3d4b4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1548&q=80" class="event-image" alt="Зображення авіації">
                    @endif
                    <div class="event-image-overlay">
                        <h3>{{ $event->title }}</h3>
                    </div>
                </div>

                <!-- Кнопки для поширення в соціальних мережах -->
                <div class="card mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="card-body">
                        <h5 class="mb-3"><i class="fas fa-share-alt me-2"></i> Поділитися інформацією</h5>
                        <div class="d-flex flex-wrap">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-primary me-2 mb-2">
                                <i class="fab fa-facebook-f me-1"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($event->title) }}" target="_blank" class="btn btn-info me-2 mb-2">
                                <i class="fab fa-twitter me-1"></i> Twitter
                            </a>
                            <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($event->title) }}" target="_blank" class="btn btn-primary me-2 mb-2">
                                <i class="fab fa-telegram-plane me-1"></i> Telegram
                            </a>
                            <a href="mailto:?subject={{ urlencode($event->title) }}&body={{ urlencode(request()->url()) }}" class="btn btn-secondary mb-2">
                                <i class="fas fa-envelope me-1"></i> Email
                            </a>
                        </div>
                    </div>
                </div>



                <!-- Опис події -->
                <div class="event-description animate__animated animate__fadeInUp animate__delay-3s">
                    {!! $event->description !!}
                </div>

                <!-- Карта -->
                @if($event->location && $event->location->latitude && $event->location->longitude)
                    <div class="map-container animate__animated animate__fadeInUp animate__delay-4s">
                        <div id="map" style="height: 100%;"></div>
                    </div>
                @endif

                    <!-- Історичне значення -->
                    <div class="historical-significance mt-4">
                        <h3>Історичне значення</h3>
                        <p>Ця подія мала велике значення для розвитку авіації не лише на Закарпатті, але й в усій Україні. Вона сприяла розвитку інфраструктури, створенню нових робочих місць та покращенню зв'язків з іншими регіонами та країнами.</p>
                        <p>Завдяки цій події було закладено основу для майбутнього розвитку авіації в регіоні, що продовжує впливати на життя Закарпаття і сьогодні.</p>
                    </div>
                </div>

                <!-- Джерела інформації -->
                <div class="sources-info mt-4 mb-4 p-3 bg-light rounded border">
                    <h3>Джерела інформації</h3>
                    <ul class="list-group">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-book text-primary me-2"></i>
                            <a href="https://zakarpattya.net.ua/Special/Istoriia-aviatsii-Zakarpattia" target="_blank">Закарпаття онлайн - Історія авіації Закарпаття</a>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-university text-primary me-2"></i>
                            <a href="https://uzhgorod.net.ua/museum/aviation" target="_blank">Музей авіації Закарпаття</a>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-newspaper text-primary me-2"></i>
                            <a href="https://ukrinform.ua/tag-aviacii" target="_blank">Укрінформ - Матеріали про авіацію</a>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-archive text-primary me-2"></i>
                            <a href="https://dazv.gov.ua/istorychni-dokumenty" target="_blank">Державний архів Закарпатської області</a>
                        </li>
                    </ul>
                    <p class="mt-2 small text-muted">Примітка: Деякі дані можуть бути неповними або потребувати уточнення. Якщо ви маєте додаткову інформацію або знайшли помилку, будь ласка, зв'яжіться з нами.</p>
                </div>

                <div class="navigation-links">
                    @if($previousEvent)
                        <a href="{{ route('events.show', $previousEvent->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Попередня подія
                        </a>
                    @else
                        <span></span>
                    @endif

                    @if($nextEvent)
                        <a href="{{ route('events.show', $nextEvent->id) }}" class="btn btn-outline-primary">
                            Наступна подія<i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    @else
                        <span></span>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                @if($event->location)
                    <div class="location-info">
                        <h4>Інформація про локацію</h4>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt fs-1 text-danger me-3"></i>
                            <h5 class="mb-0">{{ $event->location->name }}</h5>
                        </div>

                        <div class="location-details mb-3">
                            <p>{{ $event->location->description }}</p>
                            <div class="d-flex flex-wrap mb-3">
                                <span class="badge bg-primary me-2 mb-2"><i class="fas fa-tag me-1"></i> {{ $event->location->type }}</span>
                                @if($event->location->latitude && $event->location->longitude)
                                    <span class="badge bg-success me-2 mb-2">
                                        <i class="fas fa-map-pin me-1"></i> Координати: {{ $event->location->latitude }}, {{ $event->location->longitude }}
                                    </span>
                                @endif
                            </div>

                            @if($event->location->latitude && $event->location->longitude)
                                <div class="location-map mb-3">
                                    <h6><i class="fas fa-map-marked-alt me-2"></i>Розташування на карті</h6>
                                    <div id="locationMap" style="height: 250px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                </div>
                            @endif
                        </div>




                    </div>
                @endif

                @if($relatedEvents->count() > 0)
                    <div class="related-events">
                        <h4>Пов'язані події</h4>
                        @foreach($relatedEvents as $relatedEvent)
                            <div class="card related-event-card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $relatedEvent->title }}</h5>
                                    <p class="card-text small">{{ $relatedEvent->event_date ? $relatedEvent->event_date->format('d.m.Y') : 'Дата невідома' }}</p>
                                    <a href="{{ route('events.show', $relatedEvent->id) }}" class="btn btn-sm btn-outline-primary">Детальніше</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
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

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="anonymous"></script>


    @if($event->location && $event->location->latitude && $event->location->longitude)
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Створюємо карту в секції інформації про локацію
                const locationMap = L.map('locationMap').setView([{{ $event->location->latitude }}, {{ $event->location->longitude }}], 15);

                // Додаємо шар OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19
                }).addTo(locationMap);

                // Створюємо кастомну іконку
                const customIcon = L.divIcon({
                    html: `<div style="background: #dc3545; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3);"><i class="fas fa-map-marker-alt"></i></div>`,
                    className: 'custom-location-marker',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                });

                // Додаємо маркер на карту
                const marker = L.marker([{{ $event->location->latitude }}, {{ $event->location->longitude }}], {
                    icon: customIcon,
                    title: "{{ $event->location->name }}"
                }).addTo(locationMap);

                // Додаємо popup з інформацією
                marker.bindPopup(`
                    <div style="padding: 5px;">
                        <h6 style="margin: 0 0 5px 0; color: #dc3545;"><strong>{{ $event->location->name }}</strong></h6>
                        <p style="margin: 0; font-size: 14px;">
                            <i class="fas fa-tag me-1"></i> {{ $event->location->type }}<br>
                            <i class="fas fa-map-pin me-1"></i> {{ $event->location->latitude }}, {{ $event->location->longitude }}
                        </p>
                    </div>
                `).openPopup();
            });
        </script>
    @endif
</body>
</html>
