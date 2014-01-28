/*
Title: Nginx PHP Fastcgi avec socket Unix
Description: 
Author: Sébastien Lucas
Date: 2011/01/24
Robots: noindex,nofollow
Language: fr
Tags: nginx,php
*/
# Nginx PHP Fastcgi avec socket Unix

## Socket Unix / HTTP
Quand j'ai installé pour la premiere fois nginx + php (voir [Installation de nginx sous Debian](/blog/nginx-php-install)), j'avais vu une autre manière soit disant plus rapide utilisant des sockets unix.

## Changement du script de fastcgi

Les changements sont suivis de #.

```bash
#!/bin/sh

### BEGIN INIT INFO
# Provides:       php5-fcgi
# Required-Start: $remote_fs $syslog
# Required-Stop:  $remote_fs $syslog
# Default-Start:  2 3 4 5
# Default-Stop:   0 1 6
# Short-Description: PHP5 FastCgi Spawned processes
### END INIT INFO

COMMAND=/usr/bin/spawn-fcgi
ADDRESS=127.0.0.1
PORT=9000
SOCKET=/tmp/fcgi.sock ##############################
USER=www-data
GROUP=www-data
PHPCGI=/usr/bin/php5-cgi
PIDFILE=/var/run/fastcgi-php.pid
RETVAL=0

PHP_FCGI_MAX_REQUESTS=500
PHP_FCGI_CHILDREN=4

start() {
    export PHP_FCGI_MAX_REQUESTS PHP_FCGI_CHILDREN
    $COMMAND -s $SOCKET -u $USER -g $GROUP -f $PHPCGI -P $PIDFILE ###############################
#    $COMMAND -a $ADDRESS -p $PORT -u $USER -g $GROUP -f $PHPCGI -P $PIDFILE
}

stop() {
    /usr/bin/killall -9 php5-cgi
}

case "$1" in
    start)
      start
      RETVAL=$?
  ;;
    stop)
      stop
      RETVAL=$?
  ;;
    restart|reload)
      stop
      start
      RETVAL=$?
  ;;
    *)
      echo "Usage: fastcgi {start|stop|restart}"
      exit 1
  ;;
esac
exit $RETVAL
```

## Changement des sites nginx

```
location ~ \.php$ {
                include /etc/nginx/fastcgi_params;
                fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
#               fastcgi_pass    127.0.0.1:9000;
                fastcgi_pass    unix:/tmp/fcgi.sock; #####################################
        }
```

## Bilan

Comment dire ce n'est pas flagrant, cela semble un peu plus rapide (en testant avec apache bench) mais cela ne change pas grand chose.





