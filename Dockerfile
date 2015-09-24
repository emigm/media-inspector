FROM alpine:latest

MAINTAINER Emiliano G. Molina <emiliano.g.molina@gmail.com>

# Install system packages
RUN apk --update add \
    wget \
    curl \
    git \
    php \
    php-curl \
    php-openssl \
    php-json \
    php-phar \
    php-dom

# Install PHP composer 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create application workspace
RUN mkdir -p /var/www
WORKDIR /var/www

# Deploy application
COPY . /var/www

# Create mount point
VOLUME /var/www

ENTRYPOINT ["/bin/sh", "-c"]
CMD ["echo"]
