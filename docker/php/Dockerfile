FROM php:5.6-apache

# Install : vim
# Activate more PHP extension : opcache mcrypt mbstring intl pdo_mysql zip gd
# Activate PHP extension through PECL : apcu memcached xdebug
RUN buildDeps=" \
        build-essential \
        libmcrypt-dev \
        libgcrypt11-dev \
        libpng12-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libicu-dev \
        zlib1g-dev \
        libmemcached-dev \
    " \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        $buildDeps \
        vim \
        libicu52 \
        libmcrypt4 \
        libjpeg62-turbo \
        libfreetype6 \
        libmemcachedutil2 \
    && docker-php-ext-install opcache mcrypt mbstring intl pdo_mysql zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && pecl install -f apcu memcached xdebug \
    && echo 'extension = apcu.so' > $PHP_INI_DIR/conf.d/apcu.ini \
    && echo 'extension = memcached.so' > $PHP_INI_DIR/conf.d/memcached.ini \
    && echo 'zend_extension = xdebug.so' > $PHP_INI_DIR/conf.d/xdebug.ini \
    && mkdir /app \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false -o APT::AutoRemove::SuggestsImportant=false $buildDeps \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Add blackfire
RUN export VERSION=`php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;"` \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/linux/amd64/${VERSION} \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
    && mv /tmp/blackfire-*.so `php -r "echo ini_get('extension_dir');"`/blackfire.so \
    && echo "extension=blackfire.so\nblackfire.agent_socket=\${BLACKFIRE_PORT}" > $PHP_INI_DIR/conf.d/blackfire.ini

# Some conf
COPY docker.ini /usr/local/etc/php/conf.d/docker.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY docker.conf /etc/apache2/sites-available/docker.conf
RUN a2ensite docker
RUN a2enmod rewrite

# Tweak user www-data
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

# Application sources
VOLUME ["/app"]
WORKDIR /app

# Expose standard ports
EXPOSE 80 443

# Default command
CMD ["apache2-foreground"]
