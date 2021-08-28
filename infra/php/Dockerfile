FROM php:8.0-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install npm git unzip libzip-dev libicu-dev libonig-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath
# laravel/ui(bootstrap)を使用するためnodejs,npmのインストールが必要
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash -
RUN npm install \
  npm run dev

COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /work