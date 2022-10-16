### How to Install
1. Clone the project `git clone https://github.com/achtarudin/assignment-microservice.git`.
2. Enter to project directory.
3. Make Sure you are install docker. 
4. Run this command to bring up the containers `docker-compose up -d app_workspace server_auth server_blog mysql_app phpmyadmin` and wait until containers is ready.
5. After containers were ready. Run this command to install dependencie project.
- `docker exec -it  app-workspace bash`
- enter to app-auth directory `cd app-auth && composer install` and wait until finnished
- enter to app-blog directory `cd app-blog && composer install` and wait until finnished
- inside app-blog directory run `cp .env.example .env && php artisan migrate` to run the database migration
- inside app-blog directory run `php artisan migrate:fresh --seed` to seed data to database

6. Blog Url `http://localhost:8080/blogs`
7. Auth Url `http://localhost:8000`
8. Collection Auth API file inside project folder
- Registration 
  - Method `post` 
  - URL `http://localhost:8000/registration`
  - body `{name, email, password}`

- Login 
  - Method `post` 
  - URL `http://localhost:8000/login`
  - body `{ email, password}`

- Check Token  
  - Method `post` 
  - URL `http://localhost:8000/token-check`
  - header  `{ Barrer token}`
  
#### Task list
- [x] Auth API service
- [x] CRUD Blog & Blog service
- [ ] CRUD Tags, Categories
- [ ] Payment service

#### Your Question 
1. Favorit Laravel Package, max 10 package ?
2. IDE you are using ? why

#### The Answer
1. 
   - Laravel Debugbar, for debuging
   - Laravel Dump server, for log the requests or debuging to
   - Faker for seed the fake database
   - Vuejs for frontend
   - there are a tons package for laravel, I just use packages base on the project requirements
2.  VS Code, Poppular and large community

> I guess it is enough, Enjoy
