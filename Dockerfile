FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y nano zip unzip git libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN composer self-update

WORKDIR /var/www/html

COPY src/ /var/www/html/

RUN composer update  --no-progress --no-interaction

RUN chown -R www-data:www-data /var/www/html

COPY saproject.conf /etc/apache2/sites-available/
RUN a2ensite saproject.conf  \
    && a2enmod rewrite \
    && service apache2 reload || true

RUN cd /etc/apache2/sites-available \
    && a2dissite 000-default.conf \
    && service apache2 reload || true

EXPOSE 80
