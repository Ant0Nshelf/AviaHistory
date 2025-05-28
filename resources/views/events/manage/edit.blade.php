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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.25);
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

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }

        .form-text {
            color: #6c757d;
        }

        .preview-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .description-editor {
            min-height: 200px;
            border-radius: 8px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .flatpickr-calendar {
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
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
                    <h1>Редагування події</h1>
                    <p class="lead">Внесіть зміни до інформації про подію</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('events.manage.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Повернутися до списку
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Редагування події</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('events.manage.update', $event->id) }}" method="POST" id="editEventForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label"><i class="fas fa-heading me-1"></i> Назва події</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required placeholder="Введіть назву події">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="event_date" class="form-label"><i class="fas fa-calendar-alt me-1"></i> Дата події</label>
                                        <input type="text" class="form-control datepicker" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : '') }}" required placeholder="Виберіть дату">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Локація</label>

                                <ul class="nav nav-tabs mb-3" id="locationTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="existing-tab" data-bs-toggle="tab" data-bs-target="#existing-content" type="button" role="tab" aria-controls="existing-content" aria-selected="true">
                                            <i class="fas fa-list me-1"></i> Вибрати існуючу
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new-tab" data-bs-toggle="tab" data-bs-target="#new-content" type="button" role="tab" aria-controls="new-content" aria-selected="false">
                                            <i class="fas fa-plus me-1"></i> Створити нову
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="locationTabsContent">
                                    <div class="tab-pane fade show active" id="existing-content" role="tabpanel" aria-labelledby="existing-tab">
                                        <div class="mb-3">
                                            <select class="form-select" id="location_id" name="location_id">
                                                <option value="">Виберіть локацію</option>
                                                @foreach($locations as $location)
                                                    <option value="{{ $location->id }}" {{ old('location_id', $event->location_id) == $location->id ? 'selected' : '' }}>
                                                        {{ $location->name }} ({{ $location->type }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="form-text">Виберіть локацію зі списку або створіть нову</div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="new-content" role="tabpanel" aria-labelledby="new-tab">
                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label for="new_location" class="form-label">Назва локації</label>
                                                <input type="text" class="form-control" id="new_location" name="new_location" value="{{ old('new_location') }}" placeholder="Введіть назву нової локації">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="location_type" class="form-label">Тип локації</label>
                                                <select class="form-select" id="location_type" name="location_type">
                                                    <option value="Аеропорт">Аеропорт</option>
                                                    <option value="Аеродром">Аеродром</option>
                                                    <option value="Музей">Музей</option>
                                                    <option value="Пам'ятник">Пам'ятник</option>
                                                    <option value="Інше">Інше</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-text">Вкажіть назву та тип нової локації</div>
                                    </div>
                                </div>
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
                                                <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                                            </div>
                                            <div class="form-text">Завантажте зображення з вашого пристрою (JPG, PNG, GIF, макс. 2MB)</div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="url-content" role="tabpanel" aria-labelledby="url-tab">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                                <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $event->image_url) }}" placeholder="https://example.com/image.jpg">
                                            </div>
                                            <div class="form-text">Введіть URL-адресу зображення для ілюстрації події</div>
                                        </div>
                                    </div>
                                </div>

                                @if($event->image_url)
                                    <div class="mt-3 text-center">
                                        <p class="mb-2"><strong>Поточне зображення:</strong></p>
                                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="preview-image" style="max-height: 200px;">
                                        <input type="hidden" name="current_image" value="{{ $event->image_url }}">
                                    </div>
                                @endif

                                <div id="image-preview-container" class="mt-3 text-center" style="display: none;">
                                    <p class="mb-2"><strong>Попередній перегляд:</strong></p>
                                    <img id="image-preview" src="#" alt="Попередній перегляд" class="preview-image" style="max-height: 200px;">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label"><i class="fas fa-align-left me-1"></i> Опис події</label>
                                <textarea class="form-control description-editor" id="description" name="description" rows="10" required placeholder="Детальний опис події...">{{ old('description', $event->description) }}</textarea>
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
                            <button type="button" class="btn btn-primary btn-lg" id="saveButton">
                                <i class="fas fa-save me-2"></i>Зберегти зміни
                            </button>

                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-info" target="_blank">
                                <i class="fas fa-eye me-2"></i>Переглянути на сайті
                            </a>

                            <a href="{{ route('events.manage.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Повернутися до списку
                            </a>

                            <form action="{{ route('events.manage.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цю подію?')" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash-alt me-2"></i>Видалити подію
                                </button>
                            </form>
                        </div>

                        <hr>

                        <div class="event-info mt-4">
                            <h6 class="text-muted mb-3">Інформація про подію</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span>ID:</span>
                                    <span class="badge bg-secondary">{{ $event->id }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span>Створено:</span>
                                    <span>{{ $event->created_at->format('d.m.Y H:i') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span>Оновлено:</span>
                                    <span>{{ $event->updated_at->format('d.m.Y H:i') }}</span>
                                </li>
                            </ul>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/uk.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ініціалізація вибору дати
            flatpickr(".datepicker", {
                locale: "uk",
                dateFormat: "Y-m-d",
                allowInput: true,
                altInput: true,
                altFormat: "d.m.Y",
                monthSelectorType: "static",
                yearSelectorType: "static",
                animate: true
            });

            // Попередній перегляд зображення з URL
            const imageUrlInput = document.getElementById('image_url');
            const previewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('image-preview');

            if (imageUrlInput && previewContainer && previewImage) {
                imageUrlInput.addEventListener('input', function() {
                    if (this.value) {
                        previewImage.src = this.value;
                        previewContainer.style.display = 'block';

                        // Перевірка на помилки завантаження зображення
                        previewImage.onerror = function() {
                            this.src = 'https://via.placeholder.com/400x200?text=Помилка+завантаження';
                        };
                    } else {
                        previewContainer.style.display = 'none';
                    }
                });
            }

            // Попередній перегляд завантаженого файлу
            const imageFileInput = document.getElementById('image_file');

            if (imageFileInput && previewContainer && previewImage) {
                imageFileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewContainer.style.display = 'block';
                        };

                        reader.readAsDataURL(this.files[0]);
                    } else {
                        previewContainer.style.display = 'none';
                    }
                });
            }

            // Перемикання між вкладками зображень
            const uploadTab = document.getElementById('upload-tab');
            const urlTab = document.getElementById('url-tab');

            if (uploadTab && urlTab) {
                uploadTab.addEventListener('click', function() {
                    // При перемиканні на вкладку завантаження, очищаємо URL
                    if (imageUrlInput) {
                        imageUrlInput.value = '';
                    }
                });

                urlTab.addEventListener('click', function() {
                    // При перемиканні на вкладку URL, очищаємо файл
                    if (imageFileInput) {
                        imageFileInput.value = '';
                    }

                    // Скидаємо попередній перегляд
                    if (previewContainer) {
                        previewContainer.style.display = 'none';
                    }
                });
            }

            // Перемикання між вкладками локацій
            const existingTab = document.getElementById('existing-tab');
            const newTab = document.getElementById('new-tab');
            const locationIdSelect = document.getElementById('location_id');
            const newLocationInput = document.getElementById('new_location');

            if (existingTab && newTab && locationIdSelect && newLocationInput) {
                existingTab.addEventListener('click', function() {
                    // При перемиканні на вкладку існуючих локацій, очищаємо поле нової локації
                    newLocationInput.value = '';
                });

                newTab.addEventListener('click', function() {
                    // При перемиканні на вкладку нової локації, скидаємо вибір існуючої локації
                    locationIdSelect.value = '';
                });
            }

            // Покращення текстового редактора
            const textarea = document.getElementById('description');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });

                // Запускаємо подію input для початкового розміру
                const event = new Event('input');
                textarea.dispatchEvent(event);
            }

            // Відстеження відправки форми
            const editForm = document.getElementById('editEventForm');
            const saveButton = document.getElementById('saveButton');

            if (editForm && saveButton) {
                saveButton.addEventListener('click', function(e) {
                    console.log('Save button clicked');

                    // Перевіряємо, чи вибрано файл для завантаження
                    const imageFileInput = document.getElementById('image_file');
                    if (imageFileInput && imageFileInput.files && imageFileInput.files.length > 0) {
                        console.log('File selected:', imageFileInput.files[0].name);
                    } else {
                        console.log('No file selected');
                    }

                    // Перевіряємо, чи форма валідна
                    if (editForm.checkValidity()) {
                        console.log('Form is valid, submitting...');

                        // Створюємо FormData об'єкт для відправки форми з файлами
                        const formData = new FormData(editForm);

                        // Відправляємо форму за допомогою AJAX
                        fetch(editForm.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                console.log('Form submitted successfully');
                                window.location.reload();
                            } else {
                                console.error('Form submission failed');
                                alert('Помилка при збереженні змін. Спробуйте ще раз.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Помилка при збереженні змін. Спробуйте ще раз.');
                        });
                    } else {
                        console.log('Form is invalid');
                        // Додаємо клас was-validated для відображення помилок
                        editForm.classList.add('was-validated');
                    }
                });

                editForm.addEventListener('submit', function(e) {
                    // Запобігаємо стандартній відправці форми
                    e.preventDefault();
                    console.log('Form submit prevented, using AJAX instead');
                });
            }
        });
    </script>
</body>
</html>
