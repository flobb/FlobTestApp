FlobTestApp
===========

Symfony application with :
- [Docker](https://www.docker.com) which provide all the project requirements
- [Blackfire](https://blackfire.io) because sometime we need to analyse / optmize the spaghetti soup
- articles, movies and persons entities with fixtures
- a basic backend

# Setup

* Clone the project
* go to your Blackfire [credentials page](https://blackfire.io/account/credentials)
* you need to add the credentials to your environment variables, add to your .bashrc :

```bash
export BLACKFIRE_SERVER_ID=XXXX
export BLACKFIRE_SERVER_TOKEN=XXXX

export BLACKFIRE_CLIENT_ID=XXXX
export BLACKFIRE_CLIENT_TOKEN=XXXX
```

* bin/docker.sh sh
* (in the container :) bin/install.sh
* (in the container :) exit

You're ready

[optionnal]

* add the [Blackfire Companion](https://chrome.google.com/webstore/detail/blackfire-companion/miefikpgahefdbcgoiicnmpbeeomffld) to your Chrome extensions

# Commands

To have the app running on ```http://localhost:8080``` :
```bash
bin/docker.sh start
```

Quick access to the console ("app/console" managed by docker) :
```bash
bin/console.sh arguments
```

Have a bash :
```bash
bin/docker.sh sh
```
