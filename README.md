Сколонуйте репозиторій.<br> (git clone https://github.com/Nazarii1996/COI_TEST_LARAVEL.git)<br>
cd COI_TEST_LARAVEL<br>
cp .env.example .env<br>
Настройте .env файл.<br>
Запустіть наступні команди:<br>
composer install<br>
php artisan config:cache<br>
php artisan config:clear<br>
php artisan migrate<br>
php artisan key:generate<br>
php artisan serve<br>
