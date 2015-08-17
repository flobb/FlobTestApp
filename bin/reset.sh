#!/bin/bash

#
# Reset & Update the env
#

cd ./docker
docker-compose run flobtool composer install
docker-compose run flobtool app/console doctrine:database:drop --force
docker-compose run flobtool app/console doctrine:database:create
docker-compose run flobtool app/console doctrine:migrations:migrate -n
docker-compose run flobtool app/console doctrine:fixtures:load -n
cd ../