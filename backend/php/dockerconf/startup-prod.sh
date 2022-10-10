chmod -R 777 /app/frontend/web/images
chmod -R 777 /app/frontend/web/uploads

php yii migrate --interactive=0
php-fpm