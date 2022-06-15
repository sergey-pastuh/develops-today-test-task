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

There is also a Postman Collection with all available api routes.

Functional overview:

1. Auth
	So there are implemented basic registration/login/logout system. Not much to say about this, it was made with basic Laravel Auth, so don't expect much from it.
2. Posts
	At the Home page you can see a selection of latest post, sorted by creation date accordingly. You can also switch between sorting by amounts of Likes and Comments.
	You can also create a new posts, but you have to be logged in to use that feature.
	Also you can edit\delete your posts. Pretty basic stuff.
3. Upvotes
	Every posts have amount of likes displayed in the right bottom corner. Only logged users can upvote posts. Every 24 hours (at 00:01 if to be precisely) the amount of likes on posts gets reset.
4. Comments
	Every user (logged or guests) can leave comments under posts. If user wasn't logged in, then post author will be displayed as Anon. You can also edit\delete your comments, but you have to be logged in for that.