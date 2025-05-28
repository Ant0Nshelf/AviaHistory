<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування події - Історія авіації на Закарпатті</title>
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
                            <a class="nav-link active" href="{{ route('events.manage.index') }}">
                                <i class="fas fa-calendar-alt me-1"></i>Події
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('locations.manage.index') }}">
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
                    <h1><i class="fas fa-edit me-2"></i>Редагування події</h1>
                    <p class="lead">{{ $event->title }}</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('events.manage.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Повернутися до списку
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Інформація про подію</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('events.update.direct', $event->id) }}" method="POST" id="editEventForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="title" class="form-label"><i class="fas fa-heading me-1"></i> Назва події</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $event->title) }}" required placeholder="Введіть назву події">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label"><i class="fas fa-align-left me-1"></i> Опис події</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required placeholder="Опис події">{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="event_date" class="form-label"><i class="fas fa-calendar-alt me-1"></i> Дата події</label>
                                <input type="date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : '') }}" required>
                                @error('event_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="location_id" class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Локація</label>
                                <select class="form-select @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                                    <option value="" disabled>Виберіть локацію</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id', $event->location_id) == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }} ({{ $location->type }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-image me-1"></i> Зображення події</label>

                                <ul class="nav nav-tabs mb-3" id="imageTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload-content" type="button" role="tab" aria-controls="upload-content" aria-selected="true">
                                            <i class="fas fa-upload me-1"></i> Завантажити файл
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="url-tab" data-bs-toggle="tab" data-bs-target="#url-content" type="button" role="tab" aria-controls="url-content" aria-selected="false">
                                            <i class="fas fa-link me-1"></i> Вказати URL
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="imageTabsContent">
                                    <div class="tab-pane fade show active" id="upload-content" role="tabpanel" aria-labelledby="upload-tab">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                                                <input type="file" class="form-control @error('image_file') is-invalid @enderror" id="image_file" name="image_file" accept="image/*">
                                            </div>
                                            <div class="form-text">Завантажте зображення з вашого пристрою (JPG, PNG, GIF, макс. 2MB)</div>
                                            @error('image_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="url-content" role="tabpanel" aria-labelledby="url-tab">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                                <input type="text" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url', $event->image_url) }}" placeholder="Введіть URL зображення">
                                            </div>
                                            <div class="form-text">Введіть повний URL зображення (наприклад, https://example.com/image.jpg)</div>
                                            @error('image_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($event->image_url)
                                <div class="mb-4">
                                    <label class="form-label"><i class="fas fa-image me-1"></i> Поточне зображення</label>
                                    <div>
                                        <img src="{{ asset($event->image_url) }}" alt="{{ $event->title }}" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                </div>
                            @endif
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
                            <button type="submit" form="editEventForm" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Зберегти зміни
                            </button>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-info" target="_blank">
                                <i class="fas fa-eye me-2"></i>Переглянути на сайті
                            </a>
                            <a href="{{ route('events.manage.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Скасувати
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Інформація</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-clock me-2"></i>Створено:</span>
                                <span>{{ $event->created_at->format('d.m.Y H:i') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-edit me-2"></i>Оновлено:</span>
                                <span>{{ $event->updated_at->format('d.m.Y H:i') }}</span>
                            </li>
                        </ul>
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
</body>
</html>
