# Dockerfile for running tests in php-vies-soap
FROM php:8.5-rc-cli

# Install system dependencies
RUN apt-get update \
    && apt-get install -y git unzip zip libxml2-dev \
    && docker-php-ext-install soap

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . /app

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --no-progress

# Set the default command to run tests
CMD ["composer", "run-script", "test"]
