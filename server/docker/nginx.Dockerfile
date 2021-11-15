FROM php:8.0.0-fpm

#ARG PORT

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/
#COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    nginx \
    nano \
    gettext-base

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
# RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/

# temp disabled
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install pdo, pgsql
RUN docker-php-ext-install pdo
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
#COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www
RUN chown -R www-data:www-data /var/www

#RUN useradd -m www && echo "www:www" | chpasswd && adduser www sudo
#RUN adduser www sudo

# Change current user to www
#USER www

#ENV PORT=$PORT
#EXPOSE PORT
#EXPOSE 9000

# Entrypoint
COPY nginx/conf.d/app.template /etc/nginx/conf.d/default.conf.template
COPY docker-entrypoint.sh /var/www/docker-entrypoint.sh

RUN chmod +x /var/www/docker-entrypoint.sh
#ENTRYPOINT ["/var/www/docker-entrypoint.sh"]
#CMD ["nginx", "-g", "daemon off;"]

ENV PORT=$PORT
RUN /var/www/docker-entrypoint.sh
RUN nginx -g 'daemon off;' -c /etc/nginx/conf.d/default.conf

# 1
#COPY nginx/conf.d/app.conf /etc/nginx/conf.d/default.conf
#CMD sed -i -e 's/$PORT/'"$PORT"'/g' /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'

# 2
#EXPOSE 9000
#CMD ["php-fpm"]

# 4
#COPY nginx/conf.d/app.conf /etc/nginx/sites-enabled/default
#COPY entrypoint.sh /etc/entrypoint.sh

#RUN chmod +x /etc/entrypoint.sh

#COPY --chown=www-data:www-data . /var/www
#WORKDIR /var/www

#EXPOSE 80 443 9000

#ENTRYPOINT ["/etc/entrypoint.sh"]
#ENTRYPOINT ["sh", "/etc/entrypoint.sh"]

#5
#CMD /bin/bash -c "envsubst '\$PORT' < /etc/nginx/conf.d/default.conf > /etc/nginx/conf.d/default.conf" && nginx -g 'daemon off;'
