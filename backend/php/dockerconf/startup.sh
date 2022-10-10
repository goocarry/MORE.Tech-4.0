chmod -R 777 /app/frontend/web/images
chmod -R 777 /app/frontend/web/uploads

composer update

php init --env=Development --overwrite=All
php yii migrate --interactive=0
php-fpm