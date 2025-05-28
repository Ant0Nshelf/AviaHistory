@extends('layouts.admin')

@section('title', 'Управління локаціями')

@section('header-title')
    <i class="fas fa-map-marker-alt me-2"></i>Управління локаціями
@endsection

@section('header-subtitle')
    Створюйте, редагуйте та видаляйте локації для подій
@endsection

@section('header-actions')
    <a href="{{ route('locations.manage.create') }}" class="btn btn-light add-event-btn">
        <i class="fas fa-plus me-2"></i>Додати нову локацію
    </a>
@endsection

@section('content')
    <!-- Статистика -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card stats-card-blue">
                <div class="stats-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stats-number">{{ $locations->total() }}</div>
                <p class="stats-title">Загальна кількість локацій</p>
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
            <div class="stats-card stats-card-green">
                <div class="stats-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-number">{{ \App\Models\Location::whereDate('created_at', \Carbon\Carbon::today())->count() }}</div>
                <p class="stats-title">Локації створені сьогодні</p>
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
                        <input type="text" class="form-control" placeholder="Пошук локацій..." id="searchInput">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="typeFilter">
                        <option value="">Всі типи</option>
                        <option value="Аеропорт">Аеропорт</option>
                        <option value="Аеродром">Аеродром</option>
                        <option value="Музей">Музей</option>
                        <option value="Пам'ятник">Пам'ятник</option>
                        <option value="Інше">Інше</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Таблиця локацій -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Список локацій</h5>
                <span class="badge bg-primary">{{ $locations->total() }} локацій</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="locationsTable">
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
                                    <span>Тип</span>
                                    <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                </div>
                            </th>
                            <th width="15%">
                                <div class="d-flex align-items-center">
                                    <span>Події</span>
                                    <a href="#" class="ms-1 text-dark"><i class="fas fa-sort"></i></a>
                                </div>
                            </th>
                            <th width="25%">Опис</th>
                            <th width="15%" class="text-center">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                            <tr class="location-row" data-type="{{ $location->type }}">
                                <td>
                                    <span class="badge bg-secondary">{{ $location->id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $location->name }}</div>
                                    <div class="small text-muted">{{ Str::limit($location->description, 50) }}</div>
                                </td>
                                <td>
                                    <div class="location-type">
                                        <i class="fas fa-tag me-1"></i> {{ $location->type }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info rounded-pill">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $location->events_count }}
                                    </span>
                                </td>
                                <td>
                                    @if($location->latitude && $location->longitude)
                                        <div class="small">
                                            <i class="fas fa-map-pin me-1 text-danger"></i> Координати: {{ $location->latitude }}, {{ $location->longitude }}
                                        </div>
                                    @else
                                        <div class="small text-muted">Координати не вказані</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('filter.location', ['location_id' => $location->id]) }}" class="btn btn-sm btn-info" title="Переглянути події">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('locations.manage.edit', ['location' => $location->id]) }}" class="btn btn-sm btn-primary" title="Редагувати">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($location->events_count == 0)
                                            <button type="button" class="btn btn-sm btn-danger" title="Видалити" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $location->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-secondary" title="Неможливо видалити (є пов'язані події)" disabled>
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
                                        <i class="fas fa-info-circle me-2"></i>Локації не знайдені
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
        {{ $locations->links() }}
    </div>
    
    <!-- Модальні вікна для підтвердження видалення -->
    @foreach($locations as $location)
        @if($location->events_count == 0)
            <div class="modal fade" id="deleteModal{{ $location->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $location->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $location->id }}">Підтвердження видалення</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <p>Ви впевнені, що хочете видалити локацію <strong>{{ $location->name }}</strong>?</p>
                            <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Ця дія незворотна.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Скасувати</button>
                            <form action="{{ route('locations.manage.destroy', $location->id) }}" method="POST" class="d-inline">
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
        // Пошук локацій
        const searchInput = document.getElementById('searchInput');
        const typeFilter = document.getElementById('typeFilter');
        const locationsTable = document.getElementById('locationsTable');
        const locationRows = document.querySelectorAll('.location-row');
        
        function filterLocations() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedType = typeFilter.value;
            
            locationRows.forEach(row => {
                const locationName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const locationType = row.getAttribute('data-type');
                
                const matchesSearch = locationName.includes(searchTerm);
                const matchesType = selectedType === '' || locationType === selectedType;
                
                if (matchesSearch && matchesType) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Оновлюємо кількість відфільтрованих локацій
            const visibleRows = document.querySelectorAll('.location-row[style=""]').length;
            document.querySelector('.badge.bg-primary').textContent = visibleRows + ' локацій';
        }
        
        if (searchInput && typeFilter) {
            searchInput.addEventListener('input', filterLocations);
            typeFilter.addEventListener('change', filterLocations);
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
                const tbody = locationsTable.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr.location-row'));
                
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
                        case 2: // Тип
                            aValue = a.querySelector('td:nth-child(3)').textContent.toLowerCase();
                            bValue = b.querySelector('td:nth-child(3)').textContent.toLowerCase();
                            break;
                        case 3: // Кількість подій
                            aValue = parseInt(a.querySelector('td:nth-child(4) .badge').textContent);
                            bValue = parseInt(b.querySelector('td:nth-child(4) .badge').textContent);
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
