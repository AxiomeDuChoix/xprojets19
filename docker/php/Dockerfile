FROM php:7.2-fpm

RUN apt-get update

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
    apt-get install -y \
    zlib1g-dev unzip

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && mv composer /usr/local/bin/composer


WORKDIR /usr/src/app

COPY ./ /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin

RUN composer install
RUN chmod -R 777 src/Migrations

#RUN php bin/console doctrine:database:create
#RUN php bin/console doctrine:migrations:diff
#RUN php bin/console doctrine:migrations:migrate
