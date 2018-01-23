# Vanhack Accelerator Program

This project be part of program for available my skills. It is a blog made in Laravel 5.4.

## Requirements

- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

## Installation

```
git clone https://github.com/lucascavalcante/vanhack-blog.git
cd vanhack-blog
composer install
cp .env.example .env
php artisan key:generate
```
Create a database in your MySQL client.

Edit `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name_of_your_database_created_on_previous_step
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
Now, run this commands.
```
php artisan migrate
php artisan db:seed
```
After this, will generate a admin user with this credentials:
```
Login: admin@vanhackblog.com
Pass: 123456
```

If you want test data, then run this command.
```
php artisan db:seed --class=DummyDataSeeder
```

## Author

- [Lucas Cavalcante](http://lucascavalcante.com.br)
