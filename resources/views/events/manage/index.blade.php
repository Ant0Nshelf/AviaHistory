<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управління подіями - Історія авіації на Закарпатті</title>
    <link rel="icon" href="{{ asset('images/plane-icon.svg') }}" type="image/svg+xml">
    <link rel="shortcut icon" href="{{ asset('images/plane-icon.svg') }}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: var(--primary-color);
            color: var(--light-text);
            font-weight: 500;
            padding: 15px 20px;
            border-bottom: none;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            color: var(--dark-text);
            border-top: none;
            background-color: #f0f0f0;
        }

        .event-row {
            transition: all 0.3s;
            vertical-align: middle;
        }

        .event-row:hover {
            background-color: #f0f4ff;
            transform: scale(1.01);
        }

        .event-row td {
            padding: 15px 20px;
        }

        .btn-action {
            margin-right: 5px;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .btn-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }

        .btn-info {
            background-color: #03a9f4;
            border-color: #03a9f4;
            color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-danger {
            background-color: #f44336;
            border-color: #f44336;
        }

        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination .page-link {
            color: var(--primary-color);
        }

        .alert-success {
            background-color: #e8f5e9;
            border-color: #c8e6c9;
            color: #2e7d32;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .event-title {
            font-weight: 500;
            color: var(--primary-color);
        }

        .event-date {
            color: #666;
            font-size: 0.9rem;
        }

        .event-location {
            color: #666;
            font-size: 0.9rem;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .add-event-btn {
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .add-event-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(13, 71, 161, 0.3);
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .stats-card {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s;
            opacity: 0;
            transform: translateY(20px);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .stats-card-purple {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .stats-card-blue {
            background: linear-gradient(45deg, #2196f3, #0d47a1);
            color: white;
        }

        .stats-card-green {
            background: linear-gradient(45deg, #4caf50, #1b5e20);
            color: white;
        }

        .stats-card-orange {
            background: linear-gradient(45deg, #ff9800, #e65100);
            color: white;
        }

        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-title {
            font-size: 1rem;
            opacity: 0.8;
            margin-bottom: 0;
        }

        .stats-action {
            margin-top: 10px;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.9);
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 3px 10px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        a:hover .stats-action {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateX(5px);
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Зареєструватися</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('events.manage.index') }}">Управління подіями</a></li>
                                <li><a class="dropdown-item" href="{{ route('locations.manage.index') }}">Управління локаціями</a></li>
                                <li><a class="dropdown-item" href="{{ route('users.manage.index') }}">Управління користувачами</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Вийти</button>
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
                    <h1><i class="fas fa-tasks me-2"></i> Управління подіями</h1>
                    <p class="lead">Тут ви можете додавати, редагувати та видаляти події</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('events.manage.create') }}" class="btn btn-light add-event-btn">
                        <i class="fas fa-plus me-2"></i>Додати нову подію
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

        <!-- Статистика -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card stats-card-purple">
                    <div class="stats-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stats-number">{{ $events->total() }}</div>
                    <p class="stats-title">Загальна кількість подій</p>
                </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('locations.manage.index') }}" class="text-decoration-none">
                    <div class="stats-card stats-card-blue">
                        <div class="stats-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="stats-number">{{ \App\Models\Location::count() }}</div>
                        <p class="stats-title">Локації</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <div class="stats-card stats-card-green">
                    <div class="stats-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-number">{{ \App\Models\Event::whereDate('created_at', \Carbon\Carbon::today())->count() }}</div>
                    <p class="stats-title">Події створені сьогодні</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card stats-card-orange">
                    <div class="stats-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="stats-number">{{ \App\Models\User::count() }}</div>
                    <p class="stats-title">Кількість користувачів</p>
                </div>
            </div>
        </div>

        <!-- Фільтри та пошук -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Пошук подій..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="locationFilter">
                            <option value="">Всі локації</option>
                            @foreach(\App\Models\Location::all() as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Таблиця подій -->
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i> Список подій</h5>
                    <span class="badge bg-primary">{{ $events->total() }} подій</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="eventsTable">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <div class="d-flex align-items-center">
                                        <span>ID</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="40%">
                                    <div class="d-flex align-items-center">
                                        <span>Назва</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="15%">
                                    <div class="d-flex align-items-center">
                                        <span>Дата</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="20%">
                                    <div class="d-flex align-items-center">
                                        <span>Локація</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="20%" class="text-center">Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr class="event-row" data-location="{{ $event->location_id }}">
                                    <td>
                                        <span class="badge bg-secondary">{{ $event->id }}</span>
                                    </td>
                                    <td>
                                        <div class="event-title">{{ $event->title }}</div>
                                        <div class="small text-muted">{{ Str::limit($event->description, 50) }}</div>
                                    </td>
                                    <td>
                                        <div class="event-date">
                                            <i class="far fa-calendar-alt me-1"></i> {{ $event->event_date ? $event->event_date->format('d.m.Y') : 'Не вказано' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="event-location">
                                            @if($event->location)
                                                <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $event->location->name }}
                                                <div class="small text-muted">{{ $event->location->type }}</div>
                                            @else
                                                <span class="text-muted">Не вказано</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-action" title="Переглянути" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('events.edit.direct', $event->id) }}" class="btn btn-primary btn-action" title="Редагувати" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('events.manage.destroy', ['event' => $event->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-action" title="Видалити" data-bs-toggle="tooltip" onclick="return confirm('Ви впевнені, що хочете видалити цю подію?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3"></i>
                                            <p>Немає доступних подій</p>
                                            <a href="{{ route('events.manage.create') }}" class="btn btn-sm btn-primary">Створити першу подію</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">Показано {{ $events->count() }} з {{ $events->total() }} подій</div>
                    <div>{{ $events->links() }}</div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ініціалізація тултіпів
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Пошук по таблиці
            const searchInput = document.getElementById('searchInput');
            const locationFilter = document.getElementById('locationFilter');
            const table = document.getElementById('eventsTable');
            const rows = table.querySelectorAll('tbody tr.event-row');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const locationId = locationFilter.value;

                rows.forEach(row => {
                    const title = row.querySelector('.event-title').textContent.toLowerCase();
                    const description = row.querySelector('.small.text-muted').textContent.toLowerCase();
                    const rowLocationId = row.getAttribute('data-location');

                    const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                    const matchesLocation = locationId === '' || rowLocationId === locationId;

                    if (matchesSearch && matchesLocation) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Перевірка чи є видимі рядки
                const visibleRows = table.querySelectorAll('tbody tr.event-row[style=""]');
                const emptyMessage = table.querySelector('tbody tr:not(.event-row)');

                if (visibleRows.length === 0 && emptyMessage) {
                    emptyMessage.style.display = '';
                } else if (emptyMessage) {
                    emptyMessage.style.display = 'none';
                }
            }

            if (searchInput && locationFilter) {
                searchInput.addEventListener('input', filterTable);
                locationFilter.addEventListener('change', filterTable);
            }

            // Сортування таблиці
            const sortLinks = document.querySelectorAll('th a');

            sortLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const th = this.closest('th');
                    const index = Array.from(th.parentNode.children).indexOf(th);
                    const isAscending = this.classList.contains('asc');

                    // Видаляємо класи сортування з усіх посилань
                    sortLinks.forEach(link => {
                        link.classList.remove('asc', 'desc');
                        link.querySelector('i').className = 'fas fa-sort';
                    });

                    // Встановлюємо новий клас сортування
                    if (isAscending) {
                        this.classList.add('desc');
                        this.querySelector('i').className = 'fas fa-sort-down';
                    } else {
                        this.classList.add('asc');
                        this.querySelector('i').className = 'fas fa-sort-up';
                    }

                    // Сортуємо рядки
                    const rowsArray = Array.from(rows);
                    rowsArray.sort((a, b) => {
                        let aValue, bValue;

                        if (index === 0) { // ID
                            aValue = parseInt(a.querySelector('td:nth-child(1) .badge').textContent);
                            bValue = parseInt(b.querySelector('td:nth-child(1) .badge').textContent);
                        } else if (index === 1) { // Назва
                            aValue = a.querySelector('td:nth-child(2) .event-title').textContent.toLowerCase();
                            bValue = b.querySelector('td:nth-child(2) .event-title').textContent.toLowerCase();
                        } else if (index === 2) { // Дата
                            aValue = a.querySelector('td:nth-child(3) .event-date').textContent.toLowerCase();
                            bValue = b.querySelector('td:nth-child(3) .event-date').textContent.toLowerCase();
                        } else if (index === 3) { // Локація
                            aValue = a.querySelector('td:nth-child(4) .event-location').textContent.toLowerCase();
                            bValue = b.querySelector('td:nth-child(4) .event-location').textContent.toLowerCase();
                        }

                        if (isAscending) {
                            return aValue > bValue ? -1 : 1;
                        } else {
                            return aValue < bValue ? -1 : 1;
                        }
                    });

                    // Переміщуємо відсортовані рядки в таблицю
                    const tbody = table.querySelector('tbody');
                    rowsArray.forEach(row => {
                        tbody.appendChild(row);
                    });
                });
            });

            // Анімація для статистичних карток
            const statsCards = document.querySelectorAll('.stats-card');
            statsCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>
