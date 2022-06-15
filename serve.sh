#!/bin/bash

cd src && composer install

docker exec -it test_task_php-fpm php artisan migrate

docker exec -it test_task_php-fpm php artisan db:seed

docker exec -it test_task_php-fpm php artisan cache:clear

chmod -R 777 storage

echo '----------------------------------------------'
echo '--      [92mDOCKER UP AND RUNNING[0m               --'
echo '----------------------------------------------'
echo '-  APP URL: http://localhost:8080            -'
echo '-  ADMINER: http://localhost:6080            -'
echo '-  REDIS UI: http://localhost:6081           -'
echo '-  MailHog: http://localhost:6082            -'
echo '----------------------------------------------'
echo '- Run [93mdocker-compose stop[0m to stop containers -'
echo '----------------------------------------------'
