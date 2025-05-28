<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Створення нової локації - Історія авіації на Закарпатті</title>
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

        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-light);
            padding: 40px 0;
            margin-bottom: 30px;
            position: relative;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--light-color));
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 30px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-light);
            font-weight: 500;
            padding: 15px 20px;
            border-bottom: none;
        }

        /* Форми */
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }

        .form-text {
            color: #6c757d;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.25);
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 20px;
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

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 5px;
            color: #dc3545;
        }

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
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Увійти</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('events.manage.index') }}">
                                <i class="fas fa-calendar-alt me-1"></i>Події
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('locations.manage.index') }}">
                                <i class="fas fa-map-marker-alt me-1"></i>Локації
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.manage.index') }}">
                                <i class="fas fa-users me-1"></i>Користувачі
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('events.manage.index') }}">Управління подіями</a></li>
                                <li><a class="dropdown-item" href="{{ route('locations.manage.index') }}">Управління локаціями</a></li>
                                <li><a class="dropdown-item" href="{{ route('users.manage.index') }}">Управління користувачами</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-1"></i>Вийти
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <header class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-plus-circle me-2"></i>Створення нової локації</h1>
                    <p class="lead">Додайте нову локацію для подій з історії авіації на Закарпатті</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('locations.manage.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Повернутися до списку
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Інформація про локацію</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('locations.manage.store') }}" method="POST" id="createLocationForm">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label"><i class="fas fa-map-pin me-1"></i> Назва локації</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="Введіть назву локації">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="type" class="form-label"><i class="fas fa-tag me-1"></i> Тип локації</label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="" disabled selected>Виберіть тип локації</option>
                                    <option value="Аеропорт" {{ old('type') == 'Аеропорт' ? 'selected' : '' }}>Аеропорт</option>
                                    <option value="Аеродром" {{ old('type') == 'Аеродром' ? 'selected' : '' }}>Аеродром</option>
                                    <option value="Музей" {{ old('type') == 'Музей' ? 'selected' : '' }}>Музей</option>
                                    <option value="Пам’ятник" {{ old('type') == 'Пам’ятник' ? 'selected' : '' }}>Пам’ятник</option>
                                    <option value="Інше" {{ old('type') == 'Інше' ? 'selected' : '' }}>Інше</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label"><i class="fas fa-align-left me-1"></i> Опис локації</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Опис локації (необов'язково)">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-map-marked-alt me-1"></i> Розташування на карті</label>
                                <div class="card">
                                    <div class="card-body">
                                        <div id="map" style="height: 400px; border-radius: 8px;"></div>
                                        <div class="mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="latitude" class="form-label">Широта</label>
                                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}" readonly>
                                                    @error('latitude')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="longitude" class="form-label">Довгота</label>
                                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude') }}" readonly>
                                                    @error('longitude')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <small class="text-muted mt-2 d-block">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Натисніть на карту, щоб вибрати розташування локації. Координати оновляться автоматично.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Дії</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <button type="submit" form="createLocationForm" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Зберегти локацію
                            </button>
                            <a href="{{ route('locations.manage.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Скасувати
                            </a>
                        </div>
                    </div>
                </div>
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
                        @foreach(\App\Models\Location::take(5)->get() as $loc)
                            <li class="mb-2">
                                <a href="{{ route('filter.location', ['location_id' => $loc->id]) }}" class="text-decoration-none">
                                    <i class="fas fa-angle-right me-1"></i> {{ $loc->name }}
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

    <!-- Leaflet Maps (безкоштовна альтернатива Google Maps) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let map;
        let marker;

        document.addEventListener('DOMContentLoaded', function() {
            initMap();

            // Додаємо кнопку пошуку
            const nameInput = document.getElementById('name');
            if (nameInput) {
                const searchButton = document.createElement('button');
                searchButton.type = 'button';
                searchButton.className = 'btn btn-outline-primary btn-sm mt-2';
                searchButton.innerHTML = '<i class="fas fa-search me-1"></i>Знайти на карті';
                searchButton.onclick = searchLocation;

                nameInput.parentNode.appendChild(searchButton);
            }
        });

        function initMap() {
            // Центр карти - Ужгород (Закарпаття)
            const defaultLocation = [48.6208, 22.2879];

            // Створюємо карту з Leaflet
            map = L.map('map').setView(defaultLocation, 10);

            // Додаємо тайли OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            // Додаємо слухач кліків на карту
            map.on('click', function(e) {
                placeMarker(e.latlng);
            });

            // Якщо є збережені координати, показуємо їх
            const savedLat = document.getElementById('latitude').value;
            const savedLng = document.getElementById('longitude').value;

            if (savedLat && savedLng) {
                const savedLocation = [parseFloat(savedLat), parseFloat(savedLng)];
                placeMarker({lat: savedLocation[0], lng: savedLocation[1]});
                map.setView(savedLocation, 15);
            }
        }

        function placeMarker(location) {
            // Видаляємо попередній маркер
            if (marker) {
                map.removeLayer(marker);
            }

            // Створюємо кастомну іконку
            const customIcon = L.divIcon({
                html: `<div style="background: #0d47a1; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3);"><i class="fas fa-map-marker-alt"></i></div>`,
                className: 'custom-marker',
                iconSize: [30, 30],
                iconAnchor: [15, 15]
            });

            // Створюємо новий маркер
            marker = L.marker([location.lat, location.lng], {
                icon: customIcon,
                title: "Розташування локації"
            }).addTo(map);

            // Оновлюємо поля з координатами
            document.getElementById('latitude').value = location.lat.toFixed(6);
            document.getElementById('longitude').value = location.lng.toFixed(6);

            // Додаємо popup
            marker.bindPopup(`
                <div style="padding: 5px;">
                    <h6 style="margin: 0 0 5px 0; color: #0d47a1;">Вибрана локація</h6>
                    <p style="margin: 0; font-size: 14px;">
                        <strong>Широта:</strong> ${location.lat.toFixed(6)}<br>
                        <strong>Довгота:</strong> ${location.lng.toFixed(6)}
                    </p>
                </div>
            `).openPopup();
        }

        // Функція для пошуку місця за назвою (використовуємо Nominatim API)
        async function searchLocation() {
            const locationName = document.getElementById('name').value;
            if (!locationName) {
                alert('Спочатку введіть назву локації');
                return;
            }

            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(locationName + ', Закарпатська область, Україна')}&limit=1`);
                const data = await response.json();

                if (data && data.length > 0) {
                    const location = {
                        lat: parseFloat(data[0].lat),
                        lng: parseFloat(data[0].lon)
                    };
                    map.setView([location.lat, location.lng], 15);
                    placeMarker(location);
                } else {
                    alert('Не вдалося знайти локацію. Спробуйте натиснути на карту вручну.');
                }
            } catch (error) {
                console.error('Помилка пошуку:', error);
                alert('Помилка пошуку. Спробуйте натиснути на карту вручну.');
            }
        }
    </script>
</body>
</html>
