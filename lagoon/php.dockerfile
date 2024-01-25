ARG CLI_IMAGE
FROM ${CLI_IMAGE} as cli
FROM amazeeio/php:8.2-fpm

#######################################################
# Setup Laravel Directories needed 
#######################################################
RUN mkdir -p /app/storage/framework/sessions
RUN mkdir -p /app/storage/framework/views
RUN mkdir -p /app/storage/framework/cache
RUN mkdir -p /app/storage/app/public
RUN mkdir -p /app/storage/img/invoice_file
RUN mkdir -p /home/.config/psysh
RUN fix-permissions /home/.config/psysh

COPY lagoon/01-entry-point-setup-laravel.sh /lagoon/entrypoints/98-env-setup-laravel.sh

#######################################################
# Copy the prebuild laravel app to the Nginx container
#######################################################
COPY --from=cli /app /app

