
FROM php:8.3.4-fpm


RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip pdo_mysql

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho como o diretório do Laravel
WORKDIR /var/www/html

# Copie os arquivos do Laravel para o contêiner
COPY . .

# Instale as dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Defina as permissões adequadas para os diretórios do Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Exponha o volume para o Nginx
VOLUME /var/www/html

# Inicie o PHP-FPM
CMD ["php-fpm"]
