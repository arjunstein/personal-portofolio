FROM php:8.3-fpm-bookworm

# Set Environment Variables
ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER_ALLOW_SUPERUSER=1 \
    NODE_ENV=development

# Install System Packages, Nginx, Supervisor, and Build Libraries
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    supervisor \
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

# Copy Node.js 20 & NPM from official image
COPY --from=node:20-bookworm-slim /usr/local /usr/local

# Copy Composer 2 binary
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Custom PHP & OPcache Configurations
COPY docker/php/php.ini $PHP_INI_DIR/conf.d/99-custom.ini
COPY docker/php/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY docker/php/fpm-pool.conf /usr/local/etc/php-fpm.d/zz-custom.conf

# Copy Nginx Configuration and remove default site
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
RUN rm -f /etc/nginx/sites-enabled/default

# Copy Supervisord Configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create necessary directories for supervisor and nginx
RUN mkdir -p /var/log/supervisor /var/run /run /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Set Working Directory
WORKDIR /var/www/html

# Expose HTTP (80) and Vite (5173) Ports
EXPOSE 80 5173

# Container Healthcheck (HTTP probe)
HEALTHCHECK --interval=20s --timeout=5s --start-period=10s --retries=3 \
    CMD curl -f http://127.0.0.1:80/ || exit 1

# Start Supervisor to run both PHP-FPM and Nginx concurrently
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
