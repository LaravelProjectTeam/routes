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
       libonig-dev \
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
       intl \
       mbstring \
       pcntl \
       opcache \
       && pecl install mcrypt-1.0.4 \
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

#COPY server/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# 1
#ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
#RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 2
#COPY /server/apache/ports.conf /etc/apache2/ports.conf
#COPY /server/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# 3
#COPY ./apache-config/000-default.conf /etc/apache2/sites-available/000-default.conf

# 4
# change the web_root to laravel /var/www/html/public folder
#RUN sed -i -e "s/html/html\/public/g" /etc/apache2/sites-enabled/000-default.conf

# 5
COPY /server/apache/ports.conf /etc/apache2/ports.conf
#COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
#COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

COPY /server/apache/vhost.conf /etc/apache2/sites-available/laravel.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite
RUN a2ensite laravel.conf
RUN a2dissite 000-default.conf

COPY . /var/www/html
RUN chown -R www-data:www-data /var/www

RUN cd /var/www/html && npm instal && composer install
#RUN cd /var/www/html && php artisan migrate:fresh --seed

#RUN chown -R www-data:www-data /var/www/html
#RUN chgrp -R www-data storage bootstrap/cache
#RUN chmod -R ug+rwx storage bootstrap/cache

RUN groupadd apache-www-volume -g 1000
RUN useradd apache-www-volume -u 1000 -g 1000

#RUN echo "Application Port is: " + "$PORT";

CMD ["/var/www/html/scripts/start-apache.sh"]
#CMD [ "/var/www/html/scripts/run-apache2.sh" ]
