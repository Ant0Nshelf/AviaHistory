@echo off
title Історія авіації на Закарпатті - Автозапуск
color 0A

echo.
echo ===============================================
echo    ІСТОРІЯ АВІАЦІЇ НА ЗАКАРПАТТІ
echo ===============================================
echo.
echo Автоматичний запуск з відкриттям браузера...
echo.

cd /d "%~dp0"

echo Підготовка сервера...
php artisan cache:clear >nul 2>&1
php artisan config:clear >nul 2>&1
php artisan route:clear >nul 2>&1
php artisan view:clear >nul 2>&1

echo Оптимізація...
php artisan config:cache >nul 2>&1
php artisan route:cache >nul 2>&1
php artisan view:cache >nul 2>&1

echo.
echo Запуск сервера...
start /B php artisan serve --host=127.0.0.1 --port=8000

echo Очікування запуску сервера...
timeout /t 3 /nobreak >nul

echo.
echo ===============================================
echo  🌐 Відкриваю браузер...
echo ===============================================
echo.

start http://127.0.0.1:8000

echo.
echo ✅ Сайт відкрито в браузері!
echo 🌐 Адреса: http://127.0.0.1:8000
echo.
echo ⚠️  НЕ ЗАКРИВАЙТЕ це вікно - сервер працює!
echo 🛑 Для зупинки натисніть Ctrl+C
echo.

php artisan serve --host=127.0.0.1 --port=8000
