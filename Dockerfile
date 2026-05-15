FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y \
    unzip git libzip-dev curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# =========================
# 🔥 ADD NODE FOR VITE
# =========================
RUN apt-get install -y nodejs npm

RUN npm install
RUN npm run build

# =========================

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=$PORT