#!/bin/bash

#
# Invoke the containers
#

case "$1" in
    start)
        echo "Starting all containers..."
        docker-compose up -d
        echo "Done."
        ;;
    sh)
        docker-compose run flobtool /bin/bash
        ;;
    stop)
        echo "Stopping all containers..."
        docker-compose stop
        echo "Done."
        ;;
    *)
        echo "Usage: bin/docker.sh start|sh|stop"
        exit 1
        ;;
    esac
