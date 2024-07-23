FROM php:8.2.19RC1-zts-alpine3.19
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli pdo_pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN adduser -D victor
USER victor
WORKDIR /var/www/html
