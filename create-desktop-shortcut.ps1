# Створення ярлика на робочому столі
$WshShell = New-Object -comObject WScript.Shell
$Shortcut = $WshShell.CreateShortcut("$([Environment]::GetFolderPath('Desktop'))\Історія авіації на Закарпатті.lnk")
$Shortcut.TargetPath = "$PWD\start-aviahistory.bat"
$Shortcut.WorkingDirectory = $PWD
$Shortcut.Description = "Запуск веб-сайту 'Історія авіації на Закарпатті'"
$Shortcut.IconLocation = "shell32.dll,13"
$Shortcut.Save()

Write-Host "✅ Ярлик створено на робочому столі!" -ForegroundColor Green
Write-Host "🖱️ Тепер ви можете запускати програму подвійним кліком!" -ForegroundColor Yellow

pause
