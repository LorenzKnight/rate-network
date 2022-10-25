FROM php:7.4-fpm

# Mysql
# RUN apt-get update && apt-get install -y git unzip msmtp tzdata

# RUN curl -Lo /usr/local/bin/install-php-extensions https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions \
#     && chmod +x /usr/local/bin/install-php-extensions \
#     && /usr/local/bin/install-php-extensions \
#         bcmath \
#         gd \
#         intl \
#         pdo_mysql \
#         redis \
#         soap \
#         xsl \
#         yaml \
#         pcntl \
#         exif \
#         imagick \
#         sockets \
#         mysqli \
#         zip
# ///////////////////////////////////////////////

# postgresql
# RUN docker-php-ext-install pdo_pgsql pgsql bcmath gd soap sockets
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && \
    apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libicu-dev \
    libxml2-dev \
    libmagickwand-dev \
    libpq-dev \
    libedit-dev \
    libgmp-dev \
    libssh2-1-dev \
    libbz2-dev \
    libzip-dev \
    zlib1g-dev \
    postgresql-client \
    graphviz \
    wget \
    gettext-base \
    bash-completion \
    nano \
    git \
    zip \
    procps \
    rsyslog \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# ///////////////////////////////////////////////

WORKDIR /var/www