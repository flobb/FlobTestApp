#!/bin/bash

#
# Run a command like app/console will do, but in docker ^^
#

docker-compose run flobtool app/console $@
