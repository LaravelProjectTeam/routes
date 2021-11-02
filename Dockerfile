FROM php:8-apache

WORKDIR /var/www/html

RUN apt-get update -y && apt-get install -y \
    curl \
    nano \
    npm \
    g++ \
    git \
    zip \
    vim \
    sudo \
    unzip \
    nodejs \
    libpq-dev \
    libicu-dev \
    libbz2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install mysqli pdo_mysql \
    && docker-php-ext-enable mysqli

RUN docker-php-ext-install \
    zip \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar

COPY server/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN a2enmod rewrite

COPY . /var/www/html
RUN cd /var/www/html && npm instal && composer install
#RUN cd /var/www/html && php artisan migrate:fresh --seed

RUN chown -R www-data:www-data /var/www

#RUN echo "Application Port is: " + "$PORT";
CMD [ "/var/www/html/scripts/run-apache2.sh" ]
