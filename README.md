# How to install and run the project

## Installation
1. Clone the repository
2. Install the dependencies Laravel requires
    ```bash
    composer install
    ```
3. Create a `.env` file
    ```bash
    cp .env.example .env
    ```
4. Set the Discord token in the `.env` file
5. Generate the application key
    ```bash
    php artisan key:generate
    ```
6. Create a database and set the database credentials in the `.env` file
7. Run the migrations
    ```bash
    php artisan migrate
    ```

## Running the project
    ```bash
    php artisan discord:start
    ```
