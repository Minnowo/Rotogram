FROM php:7.3-apache
COPY src/ /var/www/html/

# ensure mysqli is installed
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN echo "extension = mysqli" >> /usr/local/etc/php/conf.d/mysqli-ext.ini

