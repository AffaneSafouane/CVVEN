FROM php:8.4.2-apache

# Activer ServerName pour Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Installer les dépendances nécessaires et extensions PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++ \
    && docker-php-ext-install \
        bz2 \
        intl \
        bcmath \
        opcache \
        calendar \
        pdo_mysql \
        mysqli \
    && apt-get purge -y --auto-remove g++ \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set up document root for apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# Start with base php config, then add extensions
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer \
    && composer self-update \
    && rm -rf /tmp/* /var/tmp/*

# Copier le script d'entrée
COPY ./docker/apache/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

COPY src/ /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html

# Changer les permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exposer le port 80 et démarrer Apache
EXPOSE 80

# Démarrage du script d'entrée
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]