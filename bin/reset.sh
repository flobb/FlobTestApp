#!/bin/bash

#
# Reset & Update the project
#

composer install
app/console doctrine:database:drop --force
app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console doctrine:fixtures:load -n
