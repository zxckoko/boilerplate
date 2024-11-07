FROM php:8.3-fpm-alpine

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN sed -i "s/user = www-data/user = root/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = root/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

RUN apt update && apt upgrade

# Reference: https://github.com/mlocati/docker-php-extension-installer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd zip pdo pdo_mysql

RUN install-php-extensions opcache
COPY ./settings/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./settings/php.ini /usr/local/etc/php/conf.d/php.ini

RUN IPE_ICU_EN_ONLY=1 install-php-extensions intl # Resolves: artisan show:db and see
RUN #apt install bookworm/wkhtmltopdf

# RUN mkdir -p /usr/src/php/ext/redis \
#    && curl -L https://github.com/phpredis/phpredis/archive/5.3.4.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
#    && echo 'redis' >> /usr/src/php-available-exts \
#    && docker-php-ext-install redis

USER root

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
