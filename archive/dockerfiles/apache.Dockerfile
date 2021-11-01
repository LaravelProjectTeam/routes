FROM php:8-apache

#install all the system dependencies and enable PHP modules
RUN apt-get update -y && apt-get install -y \
  libicu-dev \
  libpq-dev \
  libmcrypt-dev \
  libzip-dev \
  libonig-dev \
  nano \
  apache2-bin \
  && rm -r /var/lib/apt/lists/* \
  && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
  && docker-php-ext-install \
  intl \
  mbstring \
  pcntl \
  pdo_mysql \
  zip \
  opcache \
  && pecl install mcrypt-1.0.4 \
  && docker-php-ext-enable mcrypt \
  && docker-php-ext-configure intl

#Install PHP extensions zip and intl (intl requires to be configured)
#RUN docker-php-ext-install zip && docker-php-ext-configure intl && docker-php-ext-install intl

# Add MySQL and Postgres/pgsql support
# RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install pdo
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

#set our application folder as an environment variable
ENV APP_HOME /var/www/html

#change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#change the web_root to laravel /var/www/html/public folder
RUN sed -i -e "s/html/html\/public/g" /etc/apache2/sites-enabled/000-default.conf

# enable apache module rewrite
RUN a2enmod rewrite

#copy source files and run composer
COPY ../.. $APP_HOME

# install all PHP dependencies
RUN composer install --no-interaction

#change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME

#CMD php artisan config:cache
CMD php artisan migrate:refresh --seed --force
#CMD php artisan db:seed --class=TypeSeeder

#CMD php artisan migrate:refresh
#CMD php artisan db:seed --class=TypeSeeder
#CMD php artisan serve --host=0.0.0.0 --port=$PORT
#CMD vendor/bin/heroku-php-apache2 public/

# make port 5000 available to the world outside this container
EXPOSE 5000

# update apache port at runtime for Heroku
ENTRYPOINT []

#COPY ./apache-config/ports.conf /etc/apache2/ports.conf
#COPY ./apache-config/000-default.conf /etc/apache2/sites-available/000-default.conf
#CMD docker-php-entrypoint apache2-foreground

CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground
#CMD sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
#RUN sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
