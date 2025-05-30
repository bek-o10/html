# Используем официальный образ PHP с Apache
FROM php:8.2-apache

# Устанавливаем необходимые расширения
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Копируем проект в контейнер
COPY . /var/www/html/

# Включаем mod_rewrite (если нужно для ЧПУ)
RUN a2enmod rewrite

# Устанавливаем права доступа
RUN chown -R www-data:www-data /var/www/html