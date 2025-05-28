# Історія авіації на Закарпатті - PowerShell запуск
param(
    [switch]$Dev,
    [int]$Port = 8000
)

# Встановлюємо кольори
$Host.UI.RawUI.BackgroundColor = "Black"
$Host.UI.RawUI.ForegroundColor = "Green"
Clear-Host

Write-Host "===============================================" -ForegroundColor Cyan
Write-Host "    ІСТОРІЯ АВІАЦІЇ НА ЗАКАРПАТТІ" -ForegroundColor Yellow
Write-Host "===============================================" -ForegroundColor Cyan
Write-Host ""

# Перевіряємо, чи знаходимося в правильній директорії
if (-not (Test-Path "artisan")) {
    Write-Host "❌ Помилка: Файл artisan не знайдено!" -ForegroundColor Red
    Write-Host "Переконайтеся, що ви знаходитеся в корені проекту Laravel." -ForegroundColor Red
    pause
    exit 1
}

Write-Host "🚀 Запуск веб-сервера..." -ForegroundColor Green
Write-Host ""

# Перевіряємо залежності
if (-not (Test-Path "vendor")) {
    Write-Host "📦 Встановлення залежностей Composer..." -ForegroundColor Yellow
    composer install --no-dev --optimize-autoloader
}

Write-Host "🧹 Очищення кешу..." -ForegroundColor Yellow
php artisan cache:clear | Out-Null
php artisan config:clear | Out-Null
php artisan route:clear | Out-Null
php artisan view:clear | Out-Null

if (-not $Dev) {
    Write-Host "⚡ Оптимізація для продакшену..." -ForegroundColor Yellow
    php artisan config:cache | Out-Null
    php artisan route:cache | Out-Null
    php artisan view:cache | Out-Null
}

Write-Host ""
Write-Host "===============================================" -ForegroundColor Cyan
Write-Host "  🌐 Сервер запущено на: http://127.0.0.1:$Port" -ForegroundColor Green
Write-Host "===============================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "💡 Натисніть Ctrl+C для зупинки сервера" -ForegroundColor Yellow
Write-Host ""

# Запускаємо сервер
php artisan serve --host=127.0.0.1 --port=$Port
