FROM php:7.2-fpm

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        libicu-dev \
        libxml2-dev \
        vim \
        wget \
        automake \
        libtool \
        zip \
        unzip \
        zlib1g-dev \
    libmemcached-dev \
    pkg-config \
    libssl-dev

# Install Extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring bcmath opcache zip

# Install COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/bin
RUN php -r "unlink('composer-setup.php');"

