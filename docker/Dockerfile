# ========================
# Runtime
# ========================
FROM oanhnn/php:8.2-fpm-alpine AS runtime

# RUN apk add --update --no-cache faac bash

WORKDIR /var/www

COPY docker/php/start-container /usr/local/bin/

RUN set -eux; \
    chmod a+x /usr/local/bin/start-container ; \
    apk --update --no-cache add \
        curl \
        su-exec \
    ;

ENTRYPOINT ["/usr/local/bin/start-container"]
CMD ["php-fpm"]

# ========================
# Get backend vendors
# ========================
FROM composer AS vendor

WORKDIR /var/www

COPY composer.* ./
COPY database ./database
RUN composer install  \
    --ignore-platform-reqs \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist

# ========================
# Build frontend assets
# ========================
FROM node:16-alpine AS assets

RUN apk add --update --no-cache git build-base

WORKDIR /var/www

COPY package*.json ./

RUN npm ci --quiet

COPY postcss.config.js vite.config.js ./
COPY resources      ./resources
COPY public         ./public

RUN npm run build

# ========================
# Build app image
# ========================
FROM runtime AS app

COPY --chown=root:root docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

COPY                 --chown=www-data:www-data   .                /var/www
COPY --from=vendor   --chown=www-data:www-data   /var/www/vendor  /var/www/vendor
COPY --from=assets   --chown=www-data:www-data   /var/www/public  /var/www/public

RUN set -eux; \
    chown -R www-data:www-data /var/www; \
    su-exec www-data php /var/www/artisan package:discover; \
    su-exec www-data php /var/www/artisan storage:link;

# ========================
# Build web image
# ========================
FROM nginx:stable-alpine as web

ENV PHP_FPM_ENDPOINT=localhost:9000

COPY docker/nginx/fpm.conf /etc/nginx/templates/default.conf.template
COPY docker/.htpasswd /etc/nginx/.htpasswd
COPY --from=app /var/www/public /var/www/public

# ========================
# Build app image from Gitlab CI
# ========================
FROM runtime AS app-ci

COPY --chown=root:root           docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY --chown=www-data:www-data   .                  /var/www

RUN set -eux; \
    chown -R www-data:www-data /var/www; \
    su-exec www-data php /var/www/artisan package:discover; \
    su-exec www-data php /var/www/artisan storage:link;

# ========================
# Build web image from Gitlab CI
# ========================
FROM nginx:stable-alpine AS web-ci

ENV PHP_FPM_ENDPOINT=localhost:9000

COPY docker/nginx/fpm.conf /etc/nginx/templates/default.conf.template
COPY --from=app-ci /var/www/public /var/www/public
