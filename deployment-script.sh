# example deployment script, modify to suit your needs

heroku container:login
docker build -t routes-bg . --no-cache
docker tag routes-bg registry.heroku.com/routes-bg/web
docker push registry.heroku.com/routes-bg/web
heroku container:release web --app routes-bg
