FROM php:7.3-apache

RUN apt-get update && apt-get install -y \
    git \
    zip \
    libicu-dev

RUN docker-php-ext-install pdo pdo_mysql

COPY app.ini /usr/local/etc/php/conf.d/

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini

COPY app.conf /etc/apache2/sites-available/000-default.conf

# Example for HTTPS
# COPY ssl/cert.key /etc/ssl/certs/cert.key
# COPY ssl/cert.pem /etc/ssl/certs/cert.pem
# RUN echo '' > /etc/apache2/ports.conf

# RUN a2enmod rewrite \
#     && a2enmod ssl

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# Should be fixed nowadays ?
RUN mkdir -p /var/lib/php/sessions && chown -R www-data /var/lib/php && chmod -R 775 /var/lib/php/sessions

CMD ["apache2-foreground"]
ENTRYPOINT ["docker-php-entrypoint"]
