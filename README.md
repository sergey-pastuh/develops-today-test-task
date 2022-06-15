Test task for DevelopsToday.

Deploy instructions:
1. Clone this repository (git clone https://github.com/sergey-pastuh/develops-today-test-task)
2. Move to the root folder.
3. Execute the "make up" command to build && start all containers.
4. Execute "sh serve.sh" to make all necessary preparations (composer install, artisan migrate etc.)
5. Add next Cron Job for artisan scheduler:
* * * * * docker exec -it test_task_php-fpm php artisan schedule:run
Done! Now you can access aplication at http://localhost:8080.
Other links:
Adminer - http://localhost:6080
Redis Commander - http://localhost:6081/