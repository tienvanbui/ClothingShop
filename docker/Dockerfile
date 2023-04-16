# ========================
# Runtime
# ========================
FROM php:8.2.27-fpm-alpine AS runtime

WORKDIR /var/www

COPY docker/start-container /usr/local/bin/

RUN set -eux; \
    chmod a+x /usr/local/bin/start-container; \
    apk add --update --no-cache curl su-exec;

ENTRYPOINT [ "/usr/local/bin/start-container" ]

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

FROM node:16-alpine AS fontend

RUN apk add --update --no-cache git build-base

WORKDIR /var/www

COPY package*.json ./
COPY --from=vendor /var/www/vendor ./vendor

RUN npm install

COPY webpack.mix.js ./
COPY public ./public
COPY resources ./resources

RUN npm run dev

# ========================
# Build app image
# ========================
FROM runtime AS app

COPY --chown=root:root docker/php.ini /usr/local/etc/php/conf.d/php.ini
COPY --chown=www-data:www-data ./  /var/www
COPY --from=vendor --chown=www-data:www-data /var/www/vendor /var/www/vendor
COPY --from=fontend --chown=www-data:www-data /var/www/public /var/www/public

RUN set -eux; \
    chown -R www-data:www-data /var/www; \
    su-exec www-data php /var/www/artisan storage:link; \
    su-exec www-data php /var/www/artisan package:discover; 

# ========================
# Build web image
# ========================

FROM nginx:stable-alpine AS web 

ENV PHP_FPM_ENDPOINT=localhost:9000

COPY docker/fpm.conf /etc/nginx/templates/default.conf.template
COPY --from=app /var/www/public /var/www/public


