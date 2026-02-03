# Stage 1: Build Stage
FROM php:8.2-fpm-alpine as builder

RUN apk add --no-cache libpng-dev libzip-dev oniguruma-dev zip unzip git

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /src
COPY ./backend/api .
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Stage 2: Production Stage
FROM php:8.2-fpm-alpine

# نصب اکستنشن‌های ضروری برای اجرای لاراول و ردیس
RUN docker-php-ext-install pdo_mysql bcmath opcache
RUN apk add --no-cache libpng libzip

WORKDIR /var/www/html

# کپی فقط فایل‌های لازم از مرحله قبل
COPY --from=builder /src .

# تنظیم دسترسی‌ها برای امنیت و پایداری
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]