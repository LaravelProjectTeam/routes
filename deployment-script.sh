# example deployment script, modify to suit your needs

heroku container:login
docker build -t routes-bg . --no-cache
# docker build -t routes-bg .
docker tag routes-bg registry.heroku.com/routes-bg/web
docker push registry.heroku.com/routes-bg/web
heroku container:release web --app routes-bg

#heroku run php artisan migrate:refresh --app routes-bg --force
#heroku run php artisan db:seed --class=TypeSeeder --app routes-bg --force
