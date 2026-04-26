# Client List with Search & Filter (Laravel)

## Setup Steps

1. Clone the repository <br>
git clone https://github.com/VishalAmbhore2954/clients-crud.git

2. Navigate into project
cd clients-crud

3. Install dependencies
composer install

4. Create .env file
cp .env.example .env

4.1 create database first with "create database your_database_name" & declare in .env file

5. Configure database in .env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

6. Run migrations
php artisan migrate

7. Run seeders
php artisan db:seed

8. Start development server
php artisan serve

9. Visit site using
http://127.0.0.1:8000/clients
