### How to Install
1. Clone the project `git clone https://github.com/achtarudin/assignment-microservice.git`
2. Enter to project directory
3. Make Sure you are install docker 
4. Run this command to bring up the containers `docker-compose up -d app_workspace server_auth server_blog mysql_app phpmyadmin` and wait until containers is ready
5. After containers were ready. Run this command to install dependencie project
- `docker exec -it  app-workspace bash`
- enter to app-auth directory `cd app-auth && composer install` and wait until finnished
- enter to app-blog directory `cd app-blog && composer install` and wait until finnished
- inside app-blog directory run `php artisan migrate` to run the database migration
- inside app-blog directory run `php artisan migrate:fresh --seed` to seed data to database

1. 