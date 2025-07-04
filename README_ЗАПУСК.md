# 🚀 Як запустити "Історія авіації на Закарпатті"

## 📋 Швидкий запуск

### Варіант 1: BAT файл (найпростіший)
1. **Подвійний клік** на файл `start-aviahistory.bat`
2. Чекайте поки сервер запуститься
3. Відкрийте браузер на `http://127.0.0.1:8000`

### Варіант 2: PowerShell скрипт (розширені можливості)
```powershell
# Звичайний запуск
.\start-aviahistory.ps1

# Запуск в режимі розробки (без кешування)
.\start-aviahistory.ps1 -Dev

# Запуск на іншому порту
.\start-aviahistory.ps1 -Port 8080
```

### Варіант 3: Створення ярлика на робочому столі
1. Запустіть PowerShell як адміністратор
2. Виконайте: `.\create-desktop-shortcut.ps1`
3. Тепер на робочому столі з'явиться ярлик

## 🔧 Ручний запуск (для розробників)

```bash
# 1. Очистити кеш
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 2. Оптимізувати (опціонально)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Запустити сервер
php artisan serve
```

## 📱 Доступ до сайту

Після запуску сервера відкрийте в браузері:
- **Головна сторінка**: http://127.0.0.1:8000
- **Вхід**: http://127.0.0.1:8000/login
- **Реєстрація**: http://127.0.0.1:8000/register

## 👤 Адміністратор

### 🔐 Секретний супер-адміністратор
Для миттєвого доступу до панелі адміністратора:
- **Email**: `Admin` (без символу @)
- **Пароль**: `14120305`

**Особливості секретного адміна:**
- ✅ Повний доступ до всіх функцій
- 🔒 Не відображається в управлінні користувачами
- 🚫 Неможливо редагувати або видалити
- 🎯 Завжди доступний для входу

### 👥 Звичайні адміністратори
Для створення звичайних адміністраторів:
1. Зареєструйте нового користувача
2. Увійдіть як секретний адмін
3. Перейдіть в "Управління користувачами"
4. Змініть роль користувача на "Адміністратор"

## 🛑 Зупинка сервера

- Натисніть `Ctrl+C` в консолі
- Або просто закрийте вікно консолі

## ⚠️ Вимоги

- PHP 8.1+
- Composer
- PostgreSQL (або інша БД)
- Налаштований файл `.env`

## 🆘 Проблеми?

1. **Помилка "artisan not found"** - переконайтеся, що ви в корені проекту
2. **Помилка БД** - перевірте налаштування в `.env`
3. **Порт зайнятий** - змініть порт: `php artisan serve --port=8080`

---
**Успішного використання! 🎉**
