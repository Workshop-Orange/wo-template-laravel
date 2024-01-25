#!/bin/sh

if [ ! -f "/app/_tmp-laravel/composer.json" ]; then
  composer create-project laravel/laravel _tmp-laravel
fi

cd _tmp-laravel

rsync -va \
  --exclude ".git" \
  --exclude ".gitignore" \
  --exclude ".env*" \
  --exclude "README.md" \
  . /app
#  --dry-run \
