FROM php:7.3-fpm-alpine3.10

RUN apk update \
  && apk add ca-certificates wget \
  && update-ca-certificates \
  && apk add nano  \
  && apk add libzip-dev
RUN docker-php-ext-install mysqli \
  && docker-php-ext-install pdo_mysql\
  && docker-php-ext-install zip

RUN wget https://getcomposer.org/installer \
    && php installer --install-dir=/usr/local/bin/ --filename=composer \
    && rm installer

COPY app /app
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
	&& pecl install xdebug \
	&& apk del .phpize-deps

WORKDIR /app
RUN composer install --no-interaction --optimize-autoloader
RUN composer update --with-all-dependencies
RUN rm /usr/local/bin/composer

COPY /docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
WORKDIR /app