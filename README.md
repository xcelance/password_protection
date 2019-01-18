# password_protection

Here are the basic commands to be run 

1.  composer update ( if not installed then composer install)
2.  php artisan config:clear
3.  sudo chmod -R 777 storage
4.  composer dump-autoload

Changes in the files

1.    .env

APP_URL=http://localhost  (add domain name)
DB_DATABASE=abc  (add database name)
DB_USERNAME=abc  (add database username)
DB_PASSWORD=abc  (add database password)

_____add mail details

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

1.    config/database.php

'mysql' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'abc'),  // (add database name)
    'username' => env('DB_USERNAME', 'abc'), // (add database username)
    'password' => env('DB_PASSWORD', 'abc'), // (add database password)
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
],
