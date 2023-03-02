<h1 align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="224px"/><br/>
  Pesantren
</h1>

Note: User Role is <b>Super Administrator, Admin, Wali Murid</b>

### ⚙️ Requirements
- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### ⚡️ Installation
1. Clone GitHub repo for this project locally
```bash
git clone https://github.com/muhammadyunuss/ta-pesantren-web.git
```
2. Change directory in project which already clone
```bash
cd ta-pesantren-web
```
3. Install Composer dependencies
```bash
composer install or extract here vendor dan env.zip
```
4. Install NPM dependencies
```bash
npm install
```
5. Create a copy of your .env file or extract here vendor dan env.zip
```bash
cp .env.example .env
```
6. Generate an app encryption key
```bash
php artisan key:generate
```
7. Create an empty database for our application

8. In the .env file, add database information to allow Laravel to connect to the database
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={database-name}
DB_USERNAME={username-database}
DB_PASSWORD={password-database}
```
9. Migrate the database or import db_ponpes1.sql
```bash
php artisan migrate
```
10. Create a symbolic link from public/storage to storage/app/public
```bash
php artisan storage:link
```
12. Seed the database
```bash
php artisan db:seed
```
12. Running project
```bash
php artisan serve or npm run dev
```

### User Credentials in Seeder
| #        | Super Administrator    | Admin            | Wali Murid              |
| -------- | ---------------- | ------------------- | ------------------- |
| Email    | superadmin@superadmin.com | admin@admin.com | walimurid@walimurid.com |
| Password | admin123         | 123123123            | 123123123            |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
