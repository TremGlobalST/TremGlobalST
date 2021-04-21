FROM php:7.4-fpm

RUN apt-get update \
  && apt-get install --yes --no-install-recommends libpq-dev libicu-dev \
  libzip-dev \
  zip \
  git \
  && docker-php-ext-configure intl \
  && docker-php-ext-install pdo_pgsql pdo_mysql mysqli intl \
  && docker-php-ext-configure zip \
  && docker-php-ext-install zip \
  && curl -s https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer
