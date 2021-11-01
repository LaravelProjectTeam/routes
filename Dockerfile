FROM php:8-apache

#install all the system dependencies and enable PHP modules
RUN apt-get update -y && apt-get install -y \
    g++ \
    git \
    zip \
    curl \
    nano \
    vim \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Add MySQL and Postgres/pgsql support
# RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
#RUN docker-php-ext-install pdo
#RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

#set our application folder as an environment variable
#ENV APP_HOME /var/www/html

# 2. apache configs + document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. start with base php config, then add extensions
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    zip

#mbstring \
#pdo_mysql \

#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# permission stuff
#ARG uid
#RUN useradd -G www-data,root -u $uid -d /home/devuser devuser
#RUN mkdir -p /home/devuser/.composer && \
#    chown -R devuser:devuser /home/devuser

COPY . /var/www/html
RUN cd /var/www/html && composer install && php artisan key:generate

RUN echo "Heroku Port is: " + "$PORT";

#COPY run-apache2.sh /var/www/html/run-apache2.sh
#RUN chmod +x /var/www/html/run-apache2.sh
CMD [ "/var/www/html/run-apache2.sh" ]

#ENTRYPOINT []
#CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground
#CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground
#RUN sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf

#CMD php artisan config:cache
#CMD php artisan migrate:refresh --seed --force
#CMD php artisan db:seed --class=TypeSeeder

#CMD php artisan migrate:refresh
#CMD php artisan db:seed --class=TypeSeeder
#CMD php artisan serve --host=0.0.0.0 --port=$PORT
#CMD vendor/bin/heroku-php-apache2 public/

# make port 5000 available to the world outside this container
#EXPOSE 5000

# update apache port at runtime for Heroku
#ENTRYPOINT []

#COPY ./apache-config/ports.conf /etc/apache2/ports.conf
#COPY ./apache-config/000-default.conf /etc/apache2/sites-available/000-default.conf
#CMD docker-php-entrypoint apache2-foreground

#CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground
#CMD sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
#RUN sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
