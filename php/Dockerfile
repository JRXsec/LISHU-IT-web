FROM php:8.3-fpm-alpine

# Carpeta donde PHP guarda los mensajes del formulario de contacto
RUN mkdir -p /var/www/data && chown -R www-data:www-data /var/www/data

# Configuración PHP básica y algo más segura
RUN { \
      echo "expose_php = Off"; \
      echo "display_errors = Off"; \
      echo "log_errors = On"; \
      echo "date.timezone = Europe/Madrid"; \
    } > /usr/local/etc/php/conf.d/lishu.ini

WORKDIR /var/www/html
