FROM php:8.3-fpm-bookworm

# Set Environment Variables
ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER_ALLOW_SUPERUSER=1

# Install System Dependencies and Build Libraries
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    libfcgi-bin \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_sqlite \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copy Custom PHP, OPcache, and FPM Pool Configurations
COPY docker/php/php.ini $PHP_INI_DIR/conf.d/99-custom.ini
COPY docker/php/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY docker/php/fpm-pool.conf /usr/local/etc/php-fpm.d/zz-custom.conf

# Copy Latest Composer Binary
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set Working Directory
WORKDIR /var/www/html

# Ensure proper permissions for storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html

# Expose PHP-FPM Port
EXPOSE 9000

# Healthcheck to verify PHP-FPM process
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD SCRIPT_NAME=/ping SCRIPT_FILENAME=/ping REQUEST_METHOD=GET cgi-fcgi -bind -connect 127.0.0.1:9000 || exit 1

# Start PHP-FPM
CMD ["php-fpm", "-F"]
