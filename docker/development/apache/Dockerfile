FROM php:8.3-apache

ENV DEPS \
    git \
    zip \
    unzip \
    ssh \
    libc-client-dev \
    libkrb5-dev \
    libmcrypt-dev \
    libmemcached-dev \
    libzip-dev \
    zlib1g-dev

RUN apt-get update && \
    apt-get install -y --no-install-recommends $DEPS && \
    apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

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

RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
