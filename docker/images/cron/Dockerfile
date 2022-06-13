FROM php:8.0

ADD laravel /etc/cron.d/laravel

COPY ./php.ini /usr/local/etc/php/

RUN apt-get -o Acquire::Check-Valid-Until=false update \
    && apt-get update && apt-get install -y --no-install-recommends \
    software-properties-common \
    cron \
    apt-utils \
    build-essential \
    wget \
    locales \
    locales-all \
    libc-client-dev \
    libxml2-dev \
    libkrb5-dev \
    libssl-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev\
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    zip \
    unzip \
    zlib1g-dev \
    libfreetype6-dev \
    jpegoptim optipng pngquant gifsicle \
    libpq-dev \
    libicu-dev g++ \
    gnupg2 \
    curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

ENV LC_ALL en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8

RUN PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install pdo_pgsql zip exif pcntl gd bcmath soap gettext intl \
    && docker-php-ext-configure intl

EXPOSE 9000

WORKDIR /var/www

RUN chmod 0644 /etc/cron.d/laravel
RUN touch /var/log/cron.log
RUN crontab /etc/cron.d/laravel

CMD [ "cron", "-f" ]
