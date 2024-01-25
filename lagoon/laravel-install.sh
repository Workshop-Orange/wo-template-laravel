#!/bin/sh

echo "Laravel install starting"
if [ ! -f "/app/_tmp-laravel/composer.json" ]; then
  composer create-project laravel/laravel _tmp-laravel
fi

cd _tmp-laravel

echo "Syncing new Laravel"
rsync -a \
  --exclude ".git" \
  --exclude ".gitignore" \
  --exclude ".env*" \
  --exclude "README.md" \
  . /app
#  --dry-run \

echo "Laravel synced to the app directory"
echo "Laravel install complete"
