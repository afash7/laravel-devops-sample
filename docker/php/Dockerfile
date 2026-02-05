# ===============================
# Stage 1: Build
# ===============================
FROM php:8.2-fpm-alpine AS builder

RUN apk add --no-cache \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    zip \
    unzip \
    git \
    $PHPIZE_DEPS

# Redis extension (روش درست)
RUN pecl install redis \
    && docker-php-ext-enable redis

RUN docker-php-ext-install \
    pdo_mysql \
    bcmath \
    opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /src
COPY backend/api .

RUN composer install \
    --no-dev \
    --no-interaction \
    --optimize-autoloader


# ===============================
# Stage 2: Runtime
# ===============================
FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    libpng \
    libzip

RUN docker-php-ext-install \
    pdo_mysql \
    bcmath \
    opcache

WORKDIR /var/www/html

COPY --from=builder /src .

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
