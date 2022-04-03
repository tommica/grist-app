FROM node:lts as frontbuild
RUN apt-get update -y && apt-get install -y openssl zip unzip git
WORKDIR /app
COPY . /app
RUN yarn
RUN yarn prod
RUN rm -rf node_modules

FROM php:8.1-apache

EXPOSE 80

RUN apt-get update && apt-get install -y  \
    libfreetype6-dev \
    openssl zip unzip git \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    --no-install-recommends \
    && docker-php-ext-enable opcache \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql -j$(nproc) gd \
    && apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Update apache conf to point to application public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Update uploads config
RUN echo "file_uploads = On\n" \
         "memory_limit = 1024M\n" \
         "upload_max_filesize = 512M\n" \
         "post_max_size = 512M\n" \
         "max_execution_time = 1200\n" \
         > /usr/local/etc/php/conf.d/uploads.ini

# Enable headers module
RUN a2enmod rewrite headers

# Setup app
ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /var/www
COPY --from=frontbuild /app /var/www
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
COPY .env.docker .env
RUN chown -R www-data:www-data /var/www
RUN php artisan key:generate