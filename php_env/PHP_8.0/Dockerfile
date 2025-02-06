FROM php:8.0.3-cli

# Update and import specific required librairies

RUN apt-get update \
    && apt-get install -y \
        apt-utils \
        unzip \
        libicu-dev \
        libonig-dev \
        gcc \
        wget \
        zlib1g-dev \
        libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Parametrize PHP

RUN docker-php-ext-install \
      mbstring \
      intl \
      zip \
      pcntl \
    && docker-php-source delete

# Install composer
COPY composer.sh /
RUN chmod +x composer.sh \
    && /composer.sh \
    && mv composer.phar /usr/local/bin/composer \
    && mkdir /.composer && chmod o+rwx /.composer
