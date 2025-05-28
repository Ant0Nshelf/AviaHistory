@extends('layouts.admin')

@section('title', 'Управління користувачами')

@section('header-title')
    <i class="fas fa-users me-2"></i>Управління користувачами
@endsection

@section('header-subtitle')
    Редагуйте та видаляйте користувачів системи
@endsection

@section('header-actions')
@endsection

@section('content')
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
                            <th width="10%">
                                <div class="d-flex align-items-center">
                                    <span>Роль</span>
                                    <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                </div>
                            </th>
                            <th width="10%">
                                <div class="d-flex align-items-center">
                                    <span>Події</span>
                                    <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                </div>
                            </th>
                            <th width="25%" class="text-center">Дії</th>
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
                                    @if($user->isAdmin())
                                        <span class="badge bg-danger">
                                            <i class="fas fa-user-shield me-1"></i> Адмін
                                        </span>
                                    @else
                                        <span class="badge bg-primary">
                                            <i class="fas fa-user me-1"></i> Користувач
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info rounded-pill">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $user->events_count }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if($user->id !== auth()->id())
                                            @if($user->isAdmin())
                                                <form action="{{ route('users.make-user', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Зробити користувачем" onclick="return confirm('Зробити {{ $user->name }} звичайним користувачем?')">
                                                        <i class="fas fa-user-minus"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('users.make-admin', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Зробити адміністратором" onclick="return confirm('Зробити {{ $user->name }} адміністратором?')">
                                                        <i class="fas fa-user-plus"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            @if($user->events_count == 0 && \App\Models\User::count() > 1)
                                                <button type="button" class="btn btn-sm btn-danger" title="Видалити" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-secondary" title="Неможливо видалити (є пов'язані події або це останній користувач)" disabled>
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        @else
                                            @if(!auth()->user()->isSuperAdmin())
                                                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary" title="Редагувати свій профіль">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                            @else
                                                <span class="btn btn-sm btn-secondary" title="Секретний адмін не може редагувати профіль">
                                                    <i class="fas fa-shield-alt"></i>
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
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
@endsection

@section('scripts')
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
@endsection
