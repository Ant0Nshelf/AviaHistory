@extends('layouts.admin')

@section('title', 'Управління подіями')

@section('header-title')
    <i class="fas fa-calendar-alt me-2"></i>Управління подіями
@endsection

@section('header-subtitle')
    Створюйте, редагуйте та видаляйте події з історії авіації на Закарпатті
@endsection

@section('header-actions')
    <a href="{{ route('events.manage.create') }}" class="btn btn-light add-event-btn">
        <i class="fas fa-plus me-2"></i>Додати нову подію
    </a>
@endsection

@section('content')
    <!-- Статистика -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card stats-card-blue">
                <div class="stats-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stats-number">{{ $events->total() }}</div>
                <p class="stats-title">Загальна кількість подій</p>
            </div>
        </div>
        <div class="col-md-3">
            <a href="{{ route('locations.manage.index') }}" class="text-decoration-none">
                <div class="stats-card stats-card-purple">
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
            <a href="{{ route('users.manage.index') }}" class="text-decoration-none">
                <div class="stats-card stats-card-orange">
                    <div class="stats-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="stats-number">{{ \App\Models\User::count() }}</div>
                    <p class="stats-title">Кількість користувачів</p>
                </div>
            </a>
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
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Список подій</h5>
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
                            <th width="25%">
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
                            <th width="15%">
                                <div class="d-flex align-items-center">
                                    <span>Локація</span>
                                    <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                </div>
                            </th>
                            <th width="25%">Опис</th>
                            <th width="15%" class="text-center">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr class="event-row" data-location="{{ $event->location_id }}">
                                <td>
                                    <span class="badge bg-secondary">{{ $event->id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $event->title }}</div>
                                    <div class="small text-muted">
                                        <i class="fas fa-user me-1"></i> {{ $event->user ? $event->user->name : 'Невідомо' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="event-date">
                                        <i class="far fa-calendar-alt me-1"></i> {{ $event->event_date ? $event->event_date->format('d.m.Y') : 'Не вказано' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="event-location">
                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location ? $event->location->name : 'Не вказано' }}
                                    </div>
                                </td>
                                <td>
                                    {{ Str::limit($event->description, 100) }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-action" title="Переглянути" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('events.manage.edit', $event->id) }}" class="btn btn-primary btn-action" title="Редагувати" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('events.manage.destroy', ['event' => $event->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-action" title="Видалити" data-bs-toggle="tooltip" onclick="return confirm('Ви впевнені, що хочете видалити цю подію?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle me-2"></i>Події не знайдені
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
        {{ $events->links() }}
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Пошук подій
        const searchInput = document.getElementById('searchInput');
        const locationFilter = document.getElementById('locationFilter');
        const eventsTable = document.getElementById('eventsTable');
        const eventRows = document.querySelectorAll('.event-row');

        function filterEvents() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedLocation = locationFilter.value;

            eventRows.forEach(row => {
                const eventTitle = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const eventLocation = row.getAttribute('data-location');

                const matchesSearch = eventTitle.includes(searchTerm);
                const matchesLocation = selectedLocation === '' || eventLocation === selectedLocation;

                if (matchesSearch && matchesLocation) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Оновлюємо кількість відфільтрованих подій
            const visibleRows = document.querySelectorAll('.event-row[style=""]').length;
            document.querySelector('.badge.bg-primary').textContent = visibleRows + ' подій';
        }

        if (searchInput && locationFilter) {
            searchInput.addEventListener('input', filterEvents);
            locationFilter.addEventListener('change', filterEvents);
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
                const tbody = eventsTable.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr.event-row'));

                rows.sort((a, b) => {
                    let aValue, bValue;

                    // Визначаємо значення для сортування в залежності від стовпця
                    switch(index) {
                        case 0: // ID
                            aValue = parseInt(a.querySelector('td:nth-child(1) .badge').textContent);
                            bValue = parseInt(b.querySelector('td:nth-child(1) .badge').textContent);
                            break;
                        case 1: // Назва
                            aValue = a.querySelector('td:nth-child(2) .fw-bold').textContent.toLowerCase();
                            bValue = b.querySelector('td:nth-child(2) .fw-bold').textContent.toLowerCase();
                            break;
                        case 2: // Дата
                            aValue = a.querySelector('td:nth-child(3)').textContent.toLowerCase();
                            bValue = b.querySelector('td:nth-child(3)').textContent.toLowerCase();
                            break;
                        case 3: // Локація
                            aValue = a.querySelector('td:nth-child(4)').textContent.toLowerCase();
                            bValue = b.querySelector('td:nth-child(4)').textContent.toLowerCase();
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

        // Ініціалізація підказок
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection
