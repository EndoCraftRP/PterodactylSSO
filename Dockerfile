FROM ghcr.io/pterodactyl/panel:latest AS base
WORKDIR /app
COPY ./ ./

FROM node:22-alpine AS build
WORKDIR /app
COPY --from=base /app ./
RUN yarn install --frozen-lockfile
RUN yarn build:production

FROM ghcr.io/pterodactyl/panel:latest
WORKDIR /app
COPY ./ ./
COPY --from=build /app/public/assets ./public/assets
RUN composer require laravel/socialite
RUN composer require socialiteproviders/authentik
RUN chmod 777 -R bootstrap storage
RUN composer install --no-dev --optimize-autoloader
RUN rm -rf .env bootstrap/cache/*.php
RUN chown -R nginx:nginx .
