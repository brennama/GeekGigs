FROM php:8.3-apache

#RUN apt-get update && \
#    apt-get upgrade -y --no-install-recommends && \
#    apt-get -y autoremove && \
#    apt-get clean && \
#    rm -rf /var/lib/apt/lists/*

RUN mkdir -p /var/www/html/geekgigs/public

# Apache configuration
COPY conf/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY conf/docker-php.conf /etc/apache2/conf-available/docker-php.conf
RUN a2enmod rewrite

# PHP configuration
COPY conf/php.ini /usr/local/etc/php/

RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql

# Composer installation
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 48 www-data
RUN groupmod -g 48 www-data
