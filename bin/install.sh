#!/bin/bash

#
# Initialize all the project requirements
#

composer install
app/console do:da:cr
app/console doctrine:schema:update --force
app/console doctrine:fixtures:load -n
