FROM php:7.4-fpm-alpine

# Install php-docker extensions
RUN docker-php-ext-install pdo pdo_mysql

RUN apk add --no-cache openssl && \
    apk add --no-cache --virtual .ext-deps \
        autoconf \
        g++ \
        make \
        openssl-dev

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer