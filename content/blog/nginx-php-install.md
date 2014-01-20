/*
Title: Installation de nginx sous Debian
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
Language: fr
Tags: debian,nginx,php
*/
# Installation de nginx sous Debian

## Pourquoi nginx
Mon objectif était de transformer un Dockstar en serveur Web, vu les capacités de la bête ([Hardware Seagate Dockstar](/blog/dockstar-install-squeeze)), j'ai voulu un serveur Web super léger. Après pas mal de lecture je suis tombé sur les alternatives suivantes :

*	[Lighttpd](http://www.lighttpd.net/)
    * Avantage : Outil reconnu, beaucoup de documentation.
    * Défaut : Il a pas mal de dépendances.

*	[Cherokee](http://www.cherokee-project.com/) 
    * Avantage : Vraiment très rapide, paramétrage PHP simplifié.
    * Défaut : L'installation sous Debian entraine énormément de dépendances y compris cron que je ne voulais pas installer.

*	[nginx](http://nginx.org/)
    * Avantage : Pas de dépendances, pas mal de documentation sur le Web.

##  Installation de nginx

```
aptitude install nginx
```
## Installation de PHP en fastcgi

Pour la suite je me suis inspiré de : http://neokraft.net/2010/serveur-web-nginx-php-mysql
### Installation

Attention ne pas installer le paquet php car celui entraine l'installation d'apache et ce n'est pas vraiment le but.
```
aptitude install php5-cgi spawn-fcgi
```
### Demon

Ce démon est à créer dans /etc/init.d
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
USER=www-data
GROUP=www-data
PHPCGI=/usr/bin/php5-cgi
PIDFILE=/var/run/fastcgi-php.pid
RETVAL=0

PHP_FCGI_MAX_REQUESTS=500
PHP_FCGI_CHILDREN=2

start() {
    export PHP_FCGI_MAX_REQUESTS PHP_FCGI_CHILDREN
    $COMMAND -a $ADDRESS -p $PORT -u $USER -g $GROUP -f $PHPCGI -P $PIDFILE
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
Il reste ensuite à le paramétrer pour qu'il démarre automatiquement :
```
cd /etc/init.d
chmod +x php5-fcgi
update-rc.d php5-fcgi defaults
```

## Utilisation du PHP dans nginx

Mon fichier de configuration de nginx (/etc/nginx/sites-enabled) :
```
server {
        listen   80; ## listen for ipv4

        server_name blog.slucas.fr;

        access_log  /var/log/nginx/xxx.log;
        root   /xxx;
        index doku.php;

        location ~ \.php$ {
                include /etc/nginx/fastcgi_params;
                fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                fastcgi_pass    127.0.0.1:9000;
        }
}
```
Dans le cas de dokuwiki tout passe par le php donc je n'ai même pas mis de /.

