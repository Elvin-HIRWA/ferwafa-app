FROM ubuntu:latest

RUN apt-get update \
    && apt-get install -y curl unzip libonig-dev libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . /app

RUN composer install --no-interaction --no-scripts --no-dev --prefer-dist \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 80

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "80"]
