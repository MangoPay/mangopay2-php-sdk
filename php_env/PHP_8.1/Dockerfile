FROM php:8.1-cli

# Update and import specific required librairies

RUN apt-get update && apt-get install -y apt-utils
RUN apt-get install -y \
	unzip \
	libicu-dev \
    libonig-dev \
	gcc \
	wget \
	zlib1g-dev \
    libzip-dev

# Parametrize PHP

RUN docker-php-ext-install mbstring
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install pcntl
RUN docker-php-source delete

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
