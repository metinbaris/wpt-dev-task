FROM php:8.2-fpm

WORKDIR "/var/www/html"

RUN apt-get update && \
    apt-get -y --no-install-recommends install \
        libpq-dev \
        libzip-dev \
        unzip && \
    docker-php-ext-install pdo_mysql zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install Xdebug
RUN if [ ! -e /usr/local/lib/php/extensions/no-debug-non-zts-*/xdebug.so ]; then \
        pecl install xdebug && \
        docker-php-ext-enable xdebug; \
    fi

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install Redis extension
RUN apt-get update && \
    apt-get -y --no-install-recommends install \
        libhiredis-dev && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*