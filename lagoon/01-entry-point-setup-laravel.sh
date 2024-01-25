#!/bin/sh

echo "$ Autogenerated by Laravel4Lagoon"

# Loading environment variables from .env and friends
source /lagoon/entrypoints/50-dotenv.sh

# Generate some additional enviornment variables
source /lagoon/entrypoints/55-generate-env.sh

if [ -z "$APP_URL" ]; then
      echo "Settng APP_URL to $LAGOON_ROUTE"
      export APP_URL=$LAGOON_ROUTE
	
      if [ -f "/app/.env" ]; then
        APP_URL_EXISTS=`grep APP_URL .env || echo`
      fi

      if [ -z "$APP_URL_EXISTS" ]; then
        echo "APP_URL=$LAGOON_ROUTE" >> /app/.env
      fi
fi

if [ "$APP_ENV" == "local" ]; then
      echo "Settng local APP_ENV to $LAGOON_ENVIRONMENT"
      export APP_ENV=$LAGOON_ENVIRONMENT

      if [ -f "/app/.env" ]; then
        APP_ENV_EXISTS=`grep APP_ENV .env || echo`
      fi

      if [ -z "$APP_ENV_EXISTS" ]; then
      	echo "APP_ENV=$LAGOON_ENVIRONMENT" >> /app/.env
      fi
fi

if [ -z $APP_ENVA ]; then
      echo "Settng empty APP_ENV to $LAGOON_ENVIRONMENT"
      export APP_ENV=$LAGOON_ENVIRONMENT

      if [ -f "/app/.env" ]; then
        APP_ENV_EXISTS=`grep APP_ENV .env || echo` 
      fi

      if [ -z "$APP_ENV_EXISTS" ]; then
      	echo "APP_ENV=$LAGOON_ENVIRONMENT" >> /app/.env
      fi
fi

mkdir -p /app/storage/framework/sessions
mkdir -p /app/storage/framework/views
mkdir -p /app/storage/framework/cache
mkdir -p /app/storage/framework/cache/data
mkdir -p /app/storage/app/public
mkdir -p /app/storage/img/invoice_file
mkdir -p /app/storage/logs
mkdir -p /app/storage/debugbar

fix-permissions /app/storage/framework
fix-permissions /app/storage/app
fix-permissions /app/storage/logs
fix-permissions /app/storage/debugbar
fix-permissions /app/storage/img
fix-permissions /app/storage/img/invoice_file

cd /app

export

if [ -f "artisan" ] && [ "$LAGOON_ENVIRONMENT" != "local" ] ; then
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
  php artisan event:clear
  php artisan optimize:clear
fi 

if [ "$LAGOON_ENVIRONMENT_TYPE" == "production" ]; then
  if [ -f "artisan" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    php artisan optimize
  fi
elif [ "$LAGOON_LARAVEL_SEED_DB" == "true" ] && [ "$LAGOON_ENVIRONMENT_TYPE" == "development" ] && [ "$SERVICE_NAME" == "cli" ]; then
  if [ -f "artisan" ]; then
    TABLES=`echo "show tables" | mysql -h$DB_HOST -u$DB_USERNAME -p$DB_PASSWORD $DB_DATABASE`

    if [ -z "$TABLES" ]; then
      echo "Loading up a new database"
      php artisan db:seed
    else
      echo "There is already a database loaded up"
    fi
  else
    echo "Skipping DB loading check - Laravel is not installed"
  fi
fi

if [ "$LAGOON_ENVIRONMENT" == "local" ] && [ "$SERVICE_NAME" == "cli" ]; then
  if [ -f "composer.json" ]; then
    if [ ! -f "/app/vendor/autoload.php" ]; then
      COMPOSER_MEMORY_LIMIT=-1 composer install --no-interaction --prefer-dist --optimize-autoloader
      npm install
      npm ci
      npm run build
    fi
  else
    /app/lagoon/laravel-install.sh
  fi
fi

