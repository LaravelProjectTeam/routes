FROM php:8-apache

WORKDIR /var/www/html

# install the necessary packages
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

# copy the config file over
#COPY /server/apache/ports.conf /etc/apache2/ports.conf
COPY /server/apache/vhost.conf /etc/apache2/sites-available/laravel.conf

#COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
#COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# use custom configuration and disable built-in one
#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite
RUN a2ensite laravel.conf
RUN a2dissite 000-default.conf

# copy over the project files
COPY . /var/www/html

# change ownership of the files
RUN chown -R www-data:www-data /var/www

RUN cd /var/www/html && npm instal && composer install
RUN cd /var/www/html && php artisan migrate:fresh --seed

#RUN chown -R www-data:www-data /var/www/html
#RUN chgrp -R www-data storage bootstrap/cache
#RUN chmod -R ug+rwx storage bootstrap/cache

#RUN groupadd apache-www-volume -g 1000
#RUN useradd apache-www-volume -u 1000 -g 1000

# sudo chmod o+w ./storage/ -R
#RUN echo "Application Port is: " + "$PORT";

#CMD [ "/var/www/html/scripts/run-apache2.sh" ]
CMD ["/var/www/html/scripts/start-apache.sh"]
