@extends('layouts.app')

@section('title', 'Редагування профілю')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i>Редагування профілю
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Основна інформація -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Основна інформація</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Ім'я</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Роль</label>
                                            <div class="form-control-plaintext">
                                                @if($user->isAdmin())
                                                    <span class="badge bg-danger fs-6">
                                                        <i class="fas fa-user-shield me-1"></i> Адміністратор
                                                    </span>
                                                @else
                                                    <span class="badge bg-primary fs-6">
                                                        <i class="fas fa-user me-1"></i> Користувач
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Дата реєстрації</label>
                                            <div class="form-control-plaintext">
                                                <i class="far fa-calendar-alt me-1"></i>
                                                {{ $user->created_at->format('d.m.Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Зміна пароля -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Зміна пароля</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Залиште поля пароля порожніми, якщо не хочете змінювати пароль.
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Поточний пароль</label>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                                   id="current_password" name="current_password">
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Новий пароль</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Підтвердження нового пароля</label>
                                            <input type="password" class="form-control"
                                                   id="password_confirmation" name="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Кнопки -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Назад
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Зберегти зміни
                            </button>
                        </div>
                    </form>

                    <!-- Видалення акаунта -->
                    @if(!auth()->user()->isSuperAdmin())
                        <div class="card mt-4 border-danger" id="delete">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Небезпечна зона</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <i class="fas fa-warning me-2"></i>
                                    <strong>Увага!</strong> Видалення акаунта є незворотною дією. Всі ваші дані будуть втрачені назавжди.
                                </div>

                                <p class="text-muted mb-3">
                                    Після видалення акаунта:
                                </p>
                                <ul class="text-muted mb-4">
                                    <li>Ваш профіль буде повністю видалений</li>
                                    <li>Всі особисті дані будуть втрачені</li>
                                    <li>Ви не зможете відновити доступ до акаунта</li>
                                    <li>Події, створені вами, залишаться в системі</li>
                                </ul>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                    <i class="fas fa-trash-alt me-2"></i>Видалити акаунт
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Модальне вікно для підтвердження видалення акаунта -->
@if(!auth()->user()->isSuperAdmin())
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Підтвердження видалення акаунта
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-warning me-2"></i>
                        <strong>Це незворотна дія!</strong> Ваш акаунт та всі пов'язані з ним дані будуть видалені назавжди.
                    </div>

                    <p>Щоб підтвердити видалення акаунта, введіть ваш поточний пароль:</p>

                    <div class="mb-3">
                        <label for="delete_password" class="form-label">Поточний пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="delete_password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="confirmDelete" required>
                        <label class="form-check-label" for="confirmDelete">
                            Я розумію, що ця дія незворотна і погоджуюся на видалення мого акаунта
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Скасувати
                    </button>
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                        <i class="fas fa-trash-alt me-2"></i>Видалити акаунт назавжди
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

@section('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.5rem;
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(13, 71, 161, 0.25);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .alert-info {
        background-color: #e3f2fd;
        border-color: #42a5f5;
        color: #0d47a1;
    }

    /* Анімація підсвічування для секції видалення */
    .highlight-section {
        animation: highlight 3s ease-in-out;
    }

    @keyframes highlight {
        0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
        50% { box-shadow: 0 0 20px 10px rgba(220, 53, 69, 0.3); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }

    /* Стилі для небезпечної зони */
    .border-danger {
        border-color: #dc3545 !important;
    }

    .bg-danger {
        background-color: #dc3545 !important;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Очищуємо поля пароля після успішного оновлення
        @if(session('success') && str_contains(session('success'), 'пароль'))
            document.getElementById('current_password').value = '';
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        @endif

        // Обробка чекбокса підтвердження видалення
        const confirmCheckbox = document.getElementById('confirmDelete');
        const deleteBtn = document.getElementById('confirmDeleteBtn');

        if (confirmCheckbox && deleteBtn) {
            confirmCheckbox.addEventListener('change', function() {
                deleteBtn.disabled = !this.checked;
            });
        }

        // Автоматично відкриваємо модальне вікно при помилках видалення
        @if($errors->has('password') && request()->isMethod('delete'))
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
            deleteModal.show();
        @endif

        // Додаткове підтвердження перед відправкою форми видалення
        const deleteForm = document.querySelector('#deleteAccountModal form');
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(e) {
                if (!confirm('Ви впевнені, що хочете видалити свій акаунт? Ця дія незворотна!')) {
                    e.preventDefault();
                }
            });
        }

        // Прокручування до секції видалення при переході з навігації
        if (window.location.hash === '#delete') {
            const deleteSection = document.getElementById('delete');
            if (deleteSection) {
                setTimeout(() => {
                    deleteSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    deleteSection.classList.add('highlight-section');
                    setTimeout(() => {
                        deleteSection.classList.remove('highlight-section');
                    }, 3000);
                }, 100);
            }
        }
    });
</script>
@endsection
