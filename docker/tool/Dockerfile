FROM docker_flobphp

# Add composer
RUN curl -k -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Tweak user www-data
RUN mkdir /var/www/.ssh \
    && chown -R www-data:www-data /var/www
USER www-data

# Application sources
VOLUME ["/app"]
WORKDIR /app

# Default command
CMD ["/bin/bash"]
