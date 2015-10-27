FROM php:5.6

MAINTAINER Emiliano G. Molina <emiliano.g.molina@gmail.com>

# Install system packages
RUN apt-get update && apt-get install -y \
    curl \
    git \
    wget

# Install PHP composer 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create application workspace
RUN mkdir -p /var/www
WORKDIR /var/www

# Deploy application
COPY . /var/www

# Configuring application
COPY ./config/php.ini /usr/local/etc/php/php.ini

# Install application dependencies
RUN composer install --prefer-dist

ENTRYPOINT ["php", "-S"]
CMD ["0.0.0.0:80"]
