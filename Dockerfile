FROM php:7.1-cli
RUN apt-get update && apt-get install -y git zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /usr/src/LoadBalancer
WORKDIR /usr/src/LoadBalancer
RUN composer install