FROM mcr.microsoft.com/vscode/devcontainers/base:debian-12

ARG PHP_VERSION

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=UTC

RUN apt-get update \
    && apt-get install -y gosu sqlite3 libpng-dev python3 software-properties-common iputils-ping

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
    && apt-get update \
    && apt-get install -y php${PHP_VERSION}-cli php${PHP_VERSION}-dev php${PHP_VERSION}-pgsql php${PHP_VERSION}-sqlite3 php${PHP_VERSION}-gd php${PHP_VERSION}-curl php${PHP_VERSION}-imap php${PHP_VERSION}-mysql php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-zip php${PHP_VERSION}-bcmath php${PHP_VERSION}-soap php${PHP_VERSION}-intl php${PHP_VERSION}-readline php${PHP_VERSION}-ldap php${PHP_VERSION}-msgpack php${PHP_VERSION}-igbinary php${PHP_VERSION}-redis php${PHP_VERSION}-swoole php${PHP_VERSION}-memcached php${PHP_VERSION}-pcov php${PHP_VERSION}-xdebug \
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./docker/devcontainer/php/php.ini /etc/php/${PHP_VERSION}/cli/conf.d/99-custom.ini

EXPOSE 8000
