# ===============================
# Stage 1: Build dependencies
# ===============================
FROM php:8.2-fpm-alpine AS builder

# نصب پکیج‌های مورد نیاز PHP و Laravel
RUN apk add --no-cache \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    zip \
    unzip \
    git

# نصب composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# مسیر کاری داخل کانتینر
WORKDIR /app

# کپی سورس Laravel
COPY backend/api .

# نصب dependencyها (بدون dev برای production)
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader


# ===============================
# Stage 2: Production image
# ===============================
FROM php:8.2-fpm-alpine

# نصب اکستنشن‌های ضروری runtime
RUN docker-php-ext-install \
    pdo_mysql \
    bcmath \
    opcache

RUN apk add --no-cache \
    libpng \
    libzip

# مسیر نهایی اجرای Laravel
WORKDIR /var/www/html

# کپی فقط خروجی مرحله build
COPY --from=builder /app .

# تنظیم دسترسی‌ها (خیلی مهم برای Laravel)
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
