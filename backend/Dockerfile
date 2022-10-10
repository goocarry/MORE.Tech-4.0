FROM certbot/certbot AS certbot
COPY ./config/nginx-web/certbot/conf /etc/letsencrypt


FROM nginx AS nginx-web
COPY ./config/nginx-web/sites/prod.conf /etc/nginx/conf.d/default.conf
COPY ./config/nginx-web/local.default.conf /etc/nginx/local.default.conf
COPY ./config/nginx-web/certbot/conf /etc/letsencrypt
COPY ./php/environments/prod/frontend/web/index.php /app/frontend/web/index.php
COPY ./php/environments/prod/backend/web/index.php /app/backend/web/index.php
COPY ./php/frontend/web/theme /app/frontend/web/theme


# PHP Docker image for Yii 2.0 Framework runtime
# ==============================================
FROM php:7.3-fpm-alpine AS php
# Install system packages & PHP extensions required for Yii 2.0 Framework
RUN apk --update --virtual build-deps add \
        autoconf \
        make \
        gcc \
        g++ \
        libtool \
        icu-dev \
        curl-dev \
        freetype-dev \
        imagemagick-dev \
        pcre-dev \
        imap-dev \
        openssl-dev \
        libjpeg-turbo-dev \
        c-client \
        libpng-dev \
        libxml2-dev \
        libzip-dev && \
    apk add \
        git \
        curl \
        bash \
        bash-completion \
        icu \
        imagemagick \
        pcre \
        freetype \
        libintl \
        libjpeg-turbo \
        libpng \
        libltdl \
        libxml2 \
        libzip \
        unzip \
        mysql-client \
        openssh \
        ffmpeg \
        gst-libav && \
    docker-php-ext-configure gd \
        --with-gd \
        --with-freetype-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-configure bcmath && \
    docker-php-ext-configure imap \
        --with-imap \
        --with-imap-ssl && \
    docker-php-ext-install \
        soap \
        curl \
        bcmath \
        exif \
        gd \
        mbstring \
        # iconv \
        intl \
        opcache \
        imap \
        pdo_mysql && \
    pecl install \
        imagick && \
    apk del \
        build-deps
RUN docker-php-ext-enable \
        imap
# Configure version constraints
ENV PHP_ENABLE_XDEBUG=0 \
    PATH=/app:/app/vendor/bin:/root/.composer/vendor/bin:$PATH \
    TERM=linux \
    VERSION_PRESTISSIMO_PLUGIN=^0.3.7
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer
# Install github personal token
RUN git config --global url."https://{GITHUB_API_TOKEN}:@github.com/".insteadOf "https://github.com/"
# Add configuration files
COPY ./php/dockerconf/alpineconf/ /
COPY ./php /app
WORKDIR /app
RUN composer install --no-dev
ARG MAIN_LOCAL_PHP
RUN echo $MAIN_LOCAL_PHP > /app/environments/prod/common/config/main-local.php
RUN php init --env=Production --overwrite=All
ENTRYPOINT ["docker-php-entrypoint"]
CMD ["/bin/bash", "./dockerconf/startup-prod.sh"]