FROM php:7-apache
MAINTAINER Christopher Little <christopher@littlehq.uk>
COPY php.ini /usr/local/etc/php/
VOLUME /var/www
RUN a2enmod rewrite

# RUN  apt-get update && apt-get -y install apache2 php libapache2-mod-php php-mcrypt php-mysql
# 
# 
EXPOSE 80
# 
# 
