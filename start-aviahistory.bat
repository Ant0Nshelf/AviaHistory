@echo off
title Історія авіації на Закарпатті - Запуск сервера
color 0A

echo.
echo ===============================================
echo    ІСТОРІЯ АВІАЦІЇ НА ЗАКАРПАТТІ
echo ===============================================
echo.
echo Запуск веб-сервера...
echo.

cd /d "%~dp0"

echo Перевірка залежностей...
if not exist "vendor" (
    echo Встановлення залежностей Composer...
    composer install --no-dev --optimize-autoloader
)

echo.
echo Очищення кешу...
php artisan cache:clear >nul 2>&1
php artisan config:clear >nul 2>&1
php artisan route:clear >nul 2>&1
php artisan view:clear >nul 2>&1

echo.
echo Оптимізація для продакшену...
php artisan config:cache >nul 2>&1
php artisan route:cache >nul 2>&1
php artisan view:cache >nul 2>&1

echo.
echo ===============================================
echo  Сервер запущено на: http://127.0.0.1:8000
echo ===============================================
echo.
echo Натисніть Ctrl+C для зупинки сервера
echo.

php artisan serve --host=127.0.0.1 --port=8000

pause
