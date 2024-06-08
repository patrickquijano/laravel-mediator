FROM mcr.microsoft.com/vscode/devcontainers/base:debian-11

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN apt-get update \
    && apt-get install -y gosu sqlite3 libpng-dev python3 software-properties-common iputils-ping

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
    && apt-get update \
    && apt-get install -y php8.3-cli php8.3-dev php8.3-pgsql php8.3-sqlite3 php8.3-gd php8.3-curl php8.3-imap php8.3-mysql php8.3-mbstring php8.3-xml php8.3-zip php8.3-bcmath php8.3-soap php8.3-intl php8.3-readline php8.3-ldap php8.3-msgpack php8.3-igbinary php8.3-redis php8.3-swoole php8.3-memcached php8.3-pcov php8.3-xdebug \
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN apt-get update \
    && apt-get install -y mariadb-client

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./.devcontainer/docker/php/php.ini /etc/php/8.3/cli/conf.d/99-custom.ini

EXPOSE 8000
