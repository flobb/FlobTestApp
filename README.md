# FlobTestApp

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/286c721e-caf4-4041-bc92-b78bab79f494/mini.png)](https://insight.sensiolabs.com/projects/286c721e-caf4-4041-bc92-b78bab79f494)

This project is a Symfony application with :
- [Docker](https://www.docker.com) which provide all the project requirements
- [Blackfire](https://blackfire.io) because sometime we need to analyse / optmize the spaghetti soup
- articles, movies and persons entities with fixtures
- a basic backend

## Requirements

* Docker (https://docs.docker.com/installation/#installation)[https://docs.docker.com/installation/#installation]
* Docker-Compose (https://docs.docker.com/compose/install/)[https://docs.docker.com/compose/install/]

This project rely on thoses containers :
- flobphp: run php and apache to serve the application
- flobmysql: run mysql for the database
- flobmail: provide mailcatcher which gather the mail sended and provide a webui
- flobtool: provide all what needed to execute commands, build and deploy
- flobvolumes: shared files of the project
- blackfire: provide all logic to run tests with blackfire

## Setup

### Blackfire (optionnal)

* go to your Blackfire [credentials page](https://blackfire.io/account/credentials)
* you need to add the credentials to your environment variables, add to your ```.bashrc```:

```bash
export BLACKFIRE_SERVER_ID=XXXX
export BLACKFIRE_SERVER_TOKEN=XXXX

export BLACKFIRE_CLIENT_ID=XXXX
export BLACKFIRE_CLIENT_TOKEN=XXXX
```

* add the [Blackfire Companion](https://chrome.google.com/webstore/detail/blackfire-companion/miefikpgahefdbcgoiicnmpbeeomffld) to your Chrome extensions

Now your credentials will be added at runtime to the right container.

### Project for developement

* Clone the project
* bin/docker.sh sh
* (in the container:) bin/install.sh
* (in the container:) exit

You're ready

## Every day work

To work start the ecosystem:
```bash
bin/docker.sh start
```

Quick access to the console ("app/console" managed by docker):
```bash
bin/console.sh arguments
```

Have a bash:
```bash
bin/docker.sh sh
```

On which url the project is available?
The url is: [http://flobphp.docker](http://flobphp.docker).

## It doesn't work?!

- check the host IP seen from the containers:

* log into a container: docker-compose run flobphp /bin/bash
* run: ```/sbin/ip route|awk '/default/ { print $3 }'```
* the result should be: 172.17.42.1

If not, update ```docker/php/xdebug.ini``` and set the ```xdebug.remote_host``` to the ip you have obtained.
After that, you have to delete the images and rebuild them.

- when you rebuild the mysql container, if you have a permission denied error:

* delete all the content of the ```docker/mysql/data```
* run: ```chmod 777 docker/mysql/data```
