# Laravel Docker Project

## Requirements

- Docker
- Docker Compose

## Steps to Set up

1. Clone this repository
    ```sh
    git clone https://github.com/gstv57/discord-sample-command .
    cd discord-sample-command
    ```

2. Install all dependencies:
    ```sh
    composer install
    ```

3. Setup file `.env`:
    - Copie o arquivo `.env.example` para `.env`
    - Atualize as variáveis de ambiente conforme necessário

4. Start docker containers:
    ```sh
    docker-compose up -d
    ```

## Useful Commands

- Stop the containers:
    ```sh
    docker-compose down
    ```

- Check container logs:
    ```sh
    docker-compose logs -f
    ```

- Access the application container:
    ```sh
    docker exec -it laravel-app bash
    ```

## Feature Descriptions

- Implement scraping of job listings from seek.com based on a keyword.
- Retrieve job listings.
- Fetch job listings that have never been sent to me.
- Get job listings by company name.
