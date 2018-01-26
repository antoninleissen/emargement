FROM php:7.1-fpm

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libicu-dev \
        libxml2-dev \
        vim \
        wget \
        unzip \
        subversion \
	git \
	librabbitmq-dev \
        automake \
        libtool \
	libmemcached-dev \
	pkg-config \
	libssl-dev

# Install Extensions
RUN docker-php-ext-install pdo pdo_mysql mcrypt opcache zip

#Install Xdebug
RUN pecl install xdebug
ADD 20-xdebug.ini /usr/local/etc/php/conf.d

# Install COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/bin
RUN php -r "unlink('composer-setup.php');"
