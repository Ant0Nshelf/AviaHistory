<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управління користувачами - Історія авіації на Закарпатті</title>
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

        /* Статистичні картки */
        .stats-card {
            border-radius: 15px;
            padding: 20px;
            color: white;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .stats-card-purple {
            background: linear-gradient(135deg, #6f42c1, #6610f2);
        }

        .stats-card-blue {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
        }

        .stats-card-green {
            background: linear-gradient(135deg, #2e7d32, #43a047);
        }

        .stats-card-orange {
            background: linear-gradient(135deg, #e65100, #f57c00);
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

        /* Кнопка додавання */
        .add-event-btn {
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .add-event-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.2);
        }

        /* Стилі для таблиці */
        .user-row {
            transition: all 0.2s;
        }

        .user-row:hover {
            background-color: rgba(13, 71, 161, 0.05);
            transform: translateY(-2px);
        }

        .user-role {
            display: inline-block;
            font-size: 0.85rem;
            color: var(--primary-color);
        }

        /* Стилі для сортування */
        th a {
            color: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        th a:hover {
            color: var(--primary-color);
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
                            <a class="nav-link" href="{{ route('locations.manage.index') }}">
                                <i class="fas fa-map-marker-alt me-1"></i>Локації
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('users.manage.index') }}">
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
                    <h1><i class="fas fa-users me-2"></i>Управління користувачами</h1>
                    <p class="lead">Редагуйте та видаляйте користувачів системи</p>
                </div>
                <div class="col-md-4 text-md-end">
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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Статистика -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card stats-card-orange">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-number">{{ $users->total() }}</div>
                    <p class="stats-title">Загальна кількість користувачів</p>
                </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('events.manage.index') }}" class="text-decoration-none">
                    <div class="stats-card stats-card-purple">
                        <div class="stats-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stats-number">{{ \App\Models\Event::count() }}</div>
                        <p class="stats-title">Події</p>
                    </div>
                </a>
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
                    <div class="stats-number">{{ \App\Models\User::whereDate('created_at', \Carbon\Carbon::today())->count() }}</div>
                    <p class="stats-title">Користувачі створені сьогодні</p>
                </div>
            </div>
        </div>

        <!-- Фільтри та пошук -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Пошук користувачів..." id="searchInput">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Таблиця користувачів -->
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Список користувачів</h5>
                    <span class="badge bg-primary">{{ $users->total() }} користувачів</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="usersTable">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <div class="d-flex align-items-center">
                                        <span>ID</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="20%">
                                    <div class="d-flex align-items-center">
                                        <span>Ім'я</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="25%">
                                    <div class="d-flex align-items-center">
                                        <span>Email</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="15%">
                                    <div class="d-flex align-items-center">
                                        <span>Дата реєстрації</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="15%">
                                    <div class="d-flex align-items-center">
                                        <span>Події</span>
                                        <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                    </div>
                                </th>
                                <th width="20%" class="text-center">Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="user-row">
                                    <td>
                                        <span class="badge bg-secondary">{{ $user->id }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        <div class="small text-muted">
                                            <i class="fas fa-user-shield me-1"></i> Адміністратор
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-email">
                                            <i class="fas fa-envelope me-1"></i> {{ $user->email }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-date">
                                            <i class="far fa-calendar-alt me-1"></i> {{ $user->created_at->format('d.m.Y') }}
                                            <div class="small text-muted">{{ $user->created_at->format('H:i') }}</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info rounded-pill">
                                            <i class="fas fa-calendar-alt me-1"></i> {{ $user->events_count }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('users.manage.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-primary" title="Редагувати">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($user->events_count == 0 && \App\Models\User::count() > 1)
                                                <button type="button" class="btn btn-sm btn-danger" title="Видалити" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-secondary" title="Неможливо видалити (є пов'язані події або це останній користувач)" disabled>
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="alert alert-info mb-0">
                                            <i class="fas fa-info-circle me-2"></i>Користувачі не знайдені
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>

        <!-- Модальні вікна для підтвердження видалення -->
        @foreach($users as $user)
            @if($user->events_count == 0 && \App\Models\User::count() > 1)
                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Підтвердження видалення</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p>Ви впевнені, що хочете видалити користувача <strong>{{ $user->name }}</strong>?</p>
                                <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Ця дія незворотна.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Скасувати</button>
                                <form action="{{ route('users.manage.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Видалити</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
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
            // Пошук користувачів
            const searchInput = document.getElementById('searchInput');
            const usersTable = document.getElementById('usersTable');
            const userRows = document.querySelectorAll('.user-row');

            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();

                userRows.forEach(row => {
                    const userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const userEmail = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                    const matchesSearch = userName.includes(searchTerm) || userEmail.includes(searchTerm);

                    if (matchesSearch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Оновлюємо кількість відфільтрованих користувачів
                const visibleRows = document.querySelectorAll('.user-row[style=""]').length;
                document.querySelector('.badge.bg-primary').textContent = visibleRows + ' користувачів';
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterUsers);
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
                        link.innerHTML = '<i class="fas fa-sort"></i>';
                    });

                    // Додаємо клас сортування до поточного посилання
                    if (isAscending) {
                        this.classList.add('desc');
                        this.innerHTML = '<i class="fas fa-sort-down"></i>';
                    } else {
                        this.classList.add('asc');
                        this.innerHTML = '<i class="fas fa-sort-up"></i>';
                    }

                    // Сортуємо рядки
                    const tbody = usersTable.querySelector('tbody');
                    const rows = Array.from(tbody.querySelectorAll('tr.user-row'));

                    rows.sort((a, b) => {
                        let aValue, bValue;

                        // Визначаємо значення для сортування в залежності від стовпця
                        switch(index) {
                            case 0: // ID
                                aValue = parseInt(a.querySelector('td:nth-child(1) .badge').textContent);
                                bValue = parseInt(b.querySelector('td:nth-child(1) .badge').textContent);
                                break;
                            case 1: // Ім'я
                                aValue = a.querySelector('td:nth-child(2) .fw-bold').textContent.toLowerCase();
                                bValue = b.querySelector('td:nth-child(2) .fw-bold').textContent.toLowerCase();
                                break;
                            case 2: // Email
                                aValue = a.querySelector('td:nth-child(3)').textContent.toLowerCase();
                                bValue = b.querySelector('td:nth-child(3)').textContent.toLowerCase();
                                break;
                            case 3: // Дата реєстрації
                                aValue = a.querySelector('td:nth-child(4)').textContent.toLowerCase();
                                bValue = b.querySelector('td:nth-child(4)').textContent.toLowerCase();
                                break;
                            case 4: // Кількість подій
                                aValue = parseInt(a.querySelector('td:nth-child(5) .badge').textContent);
                                bValue = parseInt(b.querySelector('td:nth-child(5) .badge').textContent);
                                break;
                            default:
                                return 0;
                        }

                        // Сортуємо за зростанням або спаданням
                        if (isAscending) {
                            return aValue > bValue ? -1 : 1;
                        } else {
                            return aValue < bValue ? -1 : 1;
                        }
                    });

                    // Оновлюємо таблицю
                    rows.forEach(row => tbody.appendChild(row));
                });
            });
        });
    </script>
</body>
</html>
