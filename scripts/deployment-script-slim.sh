# example deployment script, modify to suit your needs

heroku container:login

docker build -t routes-bg .
docker-slim build routes-bg

docker tag routes-bg.slim registry.heroku.com/routes-bg/web
docker push registry.heroku.com/routes-bg/web

heroku container:release web --app routes-bg
heroku run php artisan migrate:fresh --seed --force --app routes-bg
