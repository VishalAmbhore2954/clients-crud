# Client List with Search & Filter (Laravel)

## Setup Steps

1. Clone the repository : <br>
git clone https://github.com/VishalAmbhore2954/clients-crud.git

2. Navigate into project : <br>
cd clients-crud

2.1 Open this in any code editor eg. Vs Code

4. Install dependencies : <br>
composer install

5. Create .env file : <br>
cp .env.example .env

4.1 create database first with : <br> 
"create database your_database_name" : <br>
& declare in .env file

5. Configure database in .env : <br>
DB_DATABASE=your_database_name <br>
DB_USERNAME=your_username  <br>
DB_PASSWORD=your_password <br>

6. Run migrations : <br>
php artisan migrate

7. Run seeders : <br>
php artisan db:seed

8. Start development server : <br>
php artisan serve

9. Visit site using : <br>
http://127.0.0.1:8000/clients
