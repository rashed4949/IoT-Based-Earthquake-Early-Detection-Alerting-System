FROM php:7.4-apache
COPY project/ /var/www/html/
RUN docker-php-ext-install pdo pdo_mysql
EXPOSE 80