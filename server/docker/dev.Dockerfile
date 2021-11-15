FROM php:8

#RUN apt-get update -y && apt-get install -y openssl zip unzip git libpq-dev
RUN apt-get update
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Install zip+icu dev libs + pgsql dev support
RUN apt-get install libzip-dev zip libicu-dev libpq-dev -y

#Install PHP extensions zip and intl (intl requires to be configured)
RUN docker-php-ext-install zip && docker-php-ext-configure intl && docker-php-ext-install intl

# Add MySQL and Postgres/pgsql support
# RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

WORKDIR /app
COPY ../.. /app

RUN composer install

CMD php artisan config:cache
#CMD php artisan migrate:refresh
#CMD php artisan db:seed --class=RoadTypeSeeder

CMD php artisan serve --host=0.0.0.0 --port=$PORT
