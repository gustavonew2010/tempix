FROM ubuntu:22.04

# Evitar prompts interativos durante a instalação
ENV DEBIAN_FRONTEND=noninteractive

# Instalar Apache e PHP com extensões necessárias
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
    && a2enmod rewrite headers \
    && a2enmod php8.2

# Configurar Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# Configurar diretório
WORKDIR /var/www/html/public_html

# Copiar todo o projeto para public_html (simulando Hostinger)
COPY . . 

# Criar diretórios necessários (se não existirem)
RUN mkdir -p /var/www/html/public_html/storage /var/www/html/public_html/bootstrap/cache

# Liberar TODAS as permissões para TODOS os usuários e grupos
RUN chmod -R 777 /var/www/html && \
    chown -R nobody:nogroup /var/www/html && \
    chmod -R o+w /var/www/html

# Ajustar variáveis de ambiente do Apache para usar nobody
RUN echo "export APACHE_RUN_USER=nobody" >> /etc/apache2/envvars \
    && echo "export APACHE_RUN_GROUP=nogroup" >> /etc/apache2/envvars

EXPOSE 80

# Iniciar o Apache em primeiro plano
CMD ["apache2ctl", "-D", "FOREGROUND"]
