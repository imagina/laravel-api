FROM php:8.2-fpm

# Install PHP extensions, Node.js, Composer, Swoole, and Imagick
RUN apt-get update \
 && apt-get install -y \
    curl gnupg git zip unzip libonig-dev libxml2-dev libzip-dev libssl-dev pkg-config libbrotli-dev \
    libmagickwand-dev --no-install-recommends \
 && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs \
 && docker-php-ext-install pdo pdo_mysql zip pcntl \
 && pecl install swoole \
 && docker-php-ext-enable swoole \
 && pecl install redis \
 && docker-php-ext-enable redis \
 && pecl install imagick \
 && docker-php-ext-enable imagick \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
