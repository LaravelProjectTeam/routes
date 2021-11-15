#!/usr/bin/env sh
set -eu

echo "docker-entrypoint.sh >>> $PORT"

envsubst '${PORT}' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf

exec "$@"

