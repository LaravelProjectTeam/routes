FROM php:8-apache

WORKDIR /var/www/html

# optional packages:
#        g++ \
#        git \
#        vim \
#        sudo \
#        libjpeg-dev \
#        libmcrypt-dev \
#        libreadline-dev \
#        libfreetype6-dev && \

RUN apt-get update -y && apt-get install -y \
        zip \
        npm \
        curl \
        nano \
        unzip \
        nodejs \
        libpq-dev \
        libicu-dev \
        libbz2-dev \
        libzip-dev \
        libpng-dev && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install \
        intl \
        zip \
        pdo \
        pgsql \
        mysqli \
        pdo_pgsql \
        pdo_mysql && \
    docker-php-ext-enable mysqli && \
    apt-get clean -y

# optional packages to install:
#bz2 \
#iconv \
#bcmath \
#opcache \
#calendar \
#libzip-dev && \

COPY /server/apache/vhost.conf /etc/apache2/sites-available/laravel.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite && \
    a2ensite laravel.conf && \
    a2dissite 000-default.conf && \
    apt-get clean -y

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www && \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    sed -i -e "s/expose_php = On/expose_php = Off/" "$PHP_INI_DIR/php.ini" && \
    cd /var/www/html && \
    npm install && \
    composer install --no-dev --no-ansi --optimize-autoloader && \
    php artisan storage:link && \
    apt-get clean -y

#RUN chown -R www-data:www-data /var/www/html
#RUN chgrp -R www-data storage bootstrap/cache
#RUN chmod -R ug+rwx storage bootstrap/cache

CMD ["/var/www/html/scripts/start-apache.sh"]
