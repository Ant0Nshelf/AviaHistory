@echo off
title Історія авіації - Режим розробки
color 0E

echo.
echo ===============================================
echo    РЕЖИМ РОЗРОБКИ
echo ===============================================
echo.

cd /d "%~dp0"

echo 🧹 Очищення кешу...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo 🔧 Встановлення режиму розробки...
php artisan config:cache

echo.
echo ===============================================
echo  🚀 Сервер розробки запущено!
echo  🌐 http://127.0.0.1:8000
echo ===============================================
echo.
echo 💡 В режимі розробки:
echo    - Кеш відключено
echo    - Помилки показуються
echo    - Автоперезавантаження
echo.

php artisan serve --host=127.0.0.1 --port=8000

pause
