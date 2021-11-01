#!/usr/bin/env bash

echo "run-apache2.sh >>> $PORT"

sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf
apache2-foreground "$@"
