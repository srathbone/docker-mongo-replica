FROM php:7.2-apache

RUN apt-get update
RUN apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN pear config-set http_proxy http://192.168.222.6:3128
RUN pecl install mongodb-1.5.3 \
    && pecl install xdebug-2.6.0 \
    && docker-php-ext-enable mongodb xdebug
RUN a2enmod rewrite
