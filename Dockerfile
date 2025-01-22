FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

# Instalar Apache e PHP
RUN apt-get update && apt-get install -y software-properties-common \
    && add-apt-repository ppa:ondrej/php -y \
    && apt-get update && apt-get install -y \
    apache2 \
    libapache2-mod-php8.2 \
    php8.2 \
    php8.2-mysql \
    php8.2-curl \
    php8.2-xml \
    php8.2-intl \
    php8.2-mbstring \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite headers ssl \
    && a2enmod php8.2

# Configurar Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

WORKDIR /var/www/html/public_html

# Copiar projeto
COPY . .

# Criar estrutura de diretórios e links simbólicos
RUN mkdir -p /var/www/html/public_html/storage/app/public \
    /var/www/html/public_html/storage/framework/sessions \
    /var/www/html/public_html/storage/framework/views \
    /var/www/html/public_html/storage/framework/cache \
    /var/www/html/public_html/bootstrap/cache \
    && rm -rf /var/www/html/public_html/public/storage \
    && ln -s /var/www/html/public_html/storage/app/public /var/www/html/public_html/public/storage

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 775 /var/www/html/public_html/storage && \
    chmod -R 775 /var/www/html/public_html/bootstrap/cache && \
    find /var/www/html -type d -exec chmod g+s {} \;

# Configurar Apache
RUN echo "export APACHE_RUN_USER=www-data" >> /etc/apache2/envvars \
    && echo "export APACHE_RUN_GROUP=www-data" >> /etc/apache2/envvars

EXPOSE 8000

RUN sed -i 's/Listen 80/Listen 8000/g' /etc/apache2/ports.conf && \
    sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8000>/g' /etc/apache2/sites-available/000-default.conf

# Criar .htaccess otimizado
RUN echo '<IfModule mod_rewrite.c>\n\
    RewriteEngine On\n\
    RewriteCond %{HTTPS} off\n\
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]\n\
    RewriteCond %{REQUEST_URI} ^/storage/(.*)$\n\
    RewriteRule ^storage/(.*)$ public/storage/$1 [L]\n\
    RewriteCond %{REQUEST_URI} !^/public/\n\
    RewriteRule ^(.*)$ public/$1 [L]\n\
</IfModule>' > /var/www/html/public_html/.htaccess

CMD ["apache2ctl", "-D", "FOREGROUND"]