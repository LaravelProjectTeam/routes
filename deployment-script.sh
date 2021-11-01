# example deployment script, modify to suit your needs

heroku container:login
#docker build -t routes-bg . --no-cache
docker build -t routes-bg .
docker tag routes-bg registry.heroku.com/routes-bg/web
docker push registry.heroku.com/routes-bg/web
heroku container:release web --app routes-bg

# sudo heroku run docker run -d -p 5000:5000 -e PORT=$PORT --app routes-bg

#heroku run bash -a routes-bg
#docker run -d -p 5000:5000 -e PORT=$PORT

#heroku run bash -a routes-bg
#php artisan migrate:refresh --force
#php artisan db:seed --class=TypeSeeder --force
#exit

#heroku run php artisan migrate:refresh --app routes-bg --force
#heroku run php artisan db:seed --class=TypeSeeder --app routes-bg --force
