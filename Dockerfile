# ============================================
# Laravel + React (Inertia) Dockerfile for Render
# PHP 8.2 + Nginx + Vite
# ============================================

# Stage 1: PHP Dependencies
FROM composer:2.7 AS php-deps

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ============================================

# Stage 2: Node Dependencies & Build
FROM node:20-alpine AS node-deps

WORKDIR /app

# Copy package files
COPY package.json package-lock.json ./

# Install dependencies
RUN npm ci --no-audit --no-fund

# Copy remaining source files
COPY . .

# Build production assets
RUN npm run build

# ============================================

# Stage 3: Production Image
FROM php:8.2-fpm-alpine AS production

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    curl \
    unzip \
    zip \
    libzip-dev \
    mysql-client \
    postgresql-client \
    sqlite \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pdo_sqlite \
    mbstring \
    bcmath \
    gd \
    zip \
    intl \
    && apk add --no-cache nodejs npm

# Configure Nginx
RUN mkdir -p /var/www/html/public \
    && echo 'server { \
        listen 80; \
        server_name _; \
        root /var/www/html/public; \
        index index.php index.html; \
        \
        location / { \
            try_files $$uri $$uri/ /index.php?$$query_string; \
        } \
        \
        location ~ \.php$ { \
            fastcgi_pass 127.0.0.1:9000; \
            fastcgi_index index.php; \
            fastcgi_param SCRIPT_FILENAME $$document_root$$fastcgi_script_name; \
            include fastcgi_params; \
        } \
        \
        location ~ /\.(?!well-known).* { \
            deny all; \
        } \
    }' > /etc/nginx/conf.d/default.conf

# Copy nginx config for production
COPY --from=php-deps /app /var/www/html

# Copy built assets from node stage
COPY --from=node-deps /app/public/build /var/www/html/public/build

# Set working directory
WORKDIR /var/www/html

# Copy PHP dependencies
COPY --from=php-deps /app/vendor /var/www/html/vendor

# Install PHP dependencies
RUN composer dump-autoload --optimize

# Create storage directories
RUN mkdir -p storage/framework/{sessions,views,cache} \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 10000

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:80/ || exit 1

# Start command
CMD php-fpm && nginx -g "daemon off;"

