# Kurir API - Setup & Testing Guide

## How to Run
Don't forget to do these steps before running the application:

1. **Make `.env` file**  
   Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
Set up database

Open the .env file and configure your database credentials (e.g., DB_DATABASE=kurir_db, DB_USERNAME=root, etc.). Make sure the database is already created in your MySQL/DBMS.

Generate App Key

Bash
php artisan key:generate
Run Migrations

Create the tables in your database:

Bash
php artisan migrate
How to Test the CRUD
This project uses isolated tests to simulate a real CRUD lifecycle. Run them in this exact order:

Test Create

Bash
php artisan test --filter test_tambah
Note: After running this, check your database client (phpMyAdmin/DBeaver) to verify that the new data is successfully added.

Test Update

Bash
php artisan test --filter test_update
Note: After running this, check your database again to verify that the data you just added has been successfully updated.

Test Delete

Bash
php artisan test --filter test_hapus
Note: After running this, check your database one last time to verify that the data is completely deleted.

How to Test Search Indexing & Filtering
To test the API endpoints for searching and filtering, you need to populate the database with dummy data first.

Seed the database

Generate random dummy data:

Bash
php artisan db:seed
Start the server

Bash
php artisan serve
View all data

Go to your browser or Postman and open:

http://127.0.0.1:8000/kurirs

Test Search by Name

Determine one name from the results, then try searching for it using the ?search parameter:

http://127.0.0.1:8000/kurirs?search=budi (replace 'budi' with the actual name)

Test Filter by Level

Try to fetch only the couriers that have a specific level by using the ?level parameter:

http://127.0.0.1:8000/kurirs?level=1
