# Routes Project

Project, which by given two endpoints, A and B, returns the shortest path between them (composed of multiple direct roads), the minutes needed to travel that road, and the information about the filling stations, fuels along the way.

See the Laravel Readme in /docs/README.md

## Requirements
- XAMPP or PHP version 8, MariaDB - 10.4.x, Apache - 2.4.x, composer 2.1.x

## Docker
Quickly run the application using Docker.

Make sure that the ```DB_HOST``` environment variable is equal to ```db``` in the ```.env``` configuration file.

Build the services, start them up and log the output:

```bash
docker-compose build && docker-compose up -d && docker-compose logs -f 
```

The application should be available at http://0.0.0.0:8000/ or http://localhost:8000/.

Get access to the container:
```bash
docker exec -it laravel-app bash -c "sudo -u root /bin/bash"
```

Generate application key:
```bash
php artisan key:generate
```

Install dependencies:
```bash
composer install
npm install
```

Migrate the database:
```bash
php artisan migrate
```

...or migrate with the refresh option and then seed... 

```bash
php artisan migrate:refresh --force

php artisan db:seed --force
```

## SendGrid
The application has email sending functionality (in the Contact Us page - `/contacts/create`).

To use it, you should create a Single Sender, then obtain an API Key from https://sendgrid.com and then save it in the ```.env``` configuration file, alongside other needed information.

```dotenv
# example SendGrid configuration
SENDGRID_EMAIL=<your.email@example.com>
SENDGRID_NAME=<your.name>
SENDGRID_API_KEY=<your.sendgrid.api.key>
```

## Gmail Setup
Besides SendGrid, we use Gmail to send the tokens for password resetting.

You will need to configure the following `.env` variables and enable less secure applications (https://myaccount.google.com/security) for that functionality to work.

Feel free to use your own mail provider and its specific settings.

```dotenv
MAIL_MAILER=<smtp||your.setting.here>
MAIL_HOST=<smtp.gmail.com||your.setting.here>
MAIL_PORT=<465||your.setting.here>
MAIL_USERNAME=<your.sender_username>
MAIL_PASSWORD=<your.sender_password>
MAIL_ENCRYPTION=<ssl||your.setting.here>
MAIL_FROM_ADDRESS=<your.sender_email>
MAIL_FROM_NAME="${APP_NAME}"
```

## Acknowledgements

The resources, frameworks and platforms used for creating/distributing/testing the application

- PHP - https://php.net/
- Laravel - https://laravel.com/
- Bulma - https://bulma.io/
- Docker - https://docker.com/
- Heroku - https://heroku.com/
- GitHub - https://github.com/
- SendGrid - https://sendgrid.com/
- Gmail - https://mail.google.com/
- MySQL/MariaDB - https://mariadb.org/ - in local development environment
- PostgreSQL - https://www.postgresql.org/ - in production environment
- Apache HTTP Server - https://httpd.apache.org/
- Taniko/Dijkstra - https://github.com/taniko/dijkstra/
- See `composer.json` and `package.json` for full list of dependencies

##### Art
- Splash Screen - https://www.reddit.com/r/mapmaking/comments/dbwlsi/region_map_oc_free_high_res_generic_region_map/

#####  Blog Posts

https://dev.to/veevidify/docker-compose-up-your-entire-laravel-apache-mysql-development-environment-45ea

https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose

https://www.cloudsigma.com/deploying-laravel-nginx-and-mysql-with-docker-compose/

https://maruan.medium.com/how-to-install-and-set-up-laravel-8-with-docker-compose-on-ubuntu-20-04-58149fed3e2e

https://shouts.dev/dockerize-a-laravel-app-with-apache-mariadb

https://webomnizz.com/containerize-your-laravel-application-with-docker-compose/

https://stackoverflow.com/questions/18584598/how-to-persist-a-graph-data-structure-in-a-relational-database/20304574

... and many others
