# E-Kertas Kerja (eKK)

## Run Locally

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

1. Clone the repository

    ```bash
    git clone https://github.com/zyqhpz/eKK
    ```

2. Switch to the repo folder

    ```bash
    cd eKK
    ```

3. Install all the dependencies using composer

    ```bash
    composer install
    ```

4. Copy the example env file and make the required configuration changes in the .env file

    ```bash
    cp .env.example .env
    ```
    
5. Open and run Laragon

6. Create database using MySQL Workbench

7. Generate a new application key

    ```bash
    php artisan key:generate
    ```

8. Generate a new JWT authentication secret key

    ```bash
    php artisan jwt:generate
    ```

9. Run the database migrations with seeding pre-defined data (**Set the database connection in .env before migrating**)

    ```bash
    php artisan migrate:fresh --seed
    ```
    
10. You can now access the server at ekk.test

Alternatively you start the local development server

    php artisan serve
    
You can now access the server at http://localhost:8000

