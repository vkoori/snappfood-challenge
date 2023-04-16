FROM php:8.1-fpm

ARG WORKDIR
WORKDIR $WORKDIR

RUN printf "deb http://mirror.aminidc.com/debian/ bullseye main\ndeb-src http://mirror.aminidc.com/debian/ bullseye main\ndeb http://mirror.aminidc.com/debian/ bullseye-updates main\ndeb-src http://mirror.aminidc.com/debian/ bullseye-updates main" > /etc/apt/sources.list.d/backports.list

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    libmcrypt-dev \
    libonig-dev \
    libxml2-dev \
    zlib1g-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    libjpeg-dev \
    vim \
    unzip \
    graphviz \
    curl \
    supervisor 

# install redis
RUN mkdir -p /usr/src/php/ext/redis; \
    curl -fsSL --ipv4 https://github.com/phpredis/phpredis/archive/5.3.7.tar.gz | tar xvz -C "/usr/src/php/ext/redis" --strip 1;

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql exif pcntl mbstring bcmath redis

# Get Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"
COPY --from=composer:2.5.5 /usr/bin/composer /usr/bin/composer

# Permissions for Laravel
RUN chown -R www-data:www-data ./
RUN chmod -R 755 ./

# Install dependencies
COPY . .
RUN composer install --no-dev

# Expose port 9000 and start php-fpm server
EXPOSE 9000
# CMD ["php-fpm"]
ENV WORKDIR=$WORKDIR
COPY ./.docker/start.sh /usr/local/bin/start
RUN chmod u+x /usr/local/bin/start
CMD ["/usr/local/bin/start"]
