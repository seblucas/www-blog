---
title: "Nginx et PHP avec Archlinux : pas si facile"
date: 2012-06-24
tags: [archlinux,dockstar,nginx,php]
slug: archlinux-php-fpm-nginx
disqus_identifier: /blog/archlinux-php-fpm-nginx
---
# Nginx et PHP avec Archlinux : pas si facile

## Introduction
Il y a quelques mois, j'ai remis en route mon Dockstar avec Archlinux et cela fait maintenant quelques semaines que j'essaie de reconfigurer Nginx et PHP. Je dois avouer que j'ai bien ramé.

## Etat des lieux

Archlinux est en rolling release : c'est à dire qu'il n'y a pas de version stable / testing (comme sur debian) mais une seule version avec les paquets qui se remplacent au fur et à mesure. L'énorme avantage est que les paquets sont super récents :

* Nginx est déjà en 1.2.1 (sortie le 5 juin).
* PHP est en 5.4
  
Le désavantage est que les paquets sont globalement moins largement testés notamment au niveau des interactions entre eux.

## Essai 1 : les paquets officiels

### Installation
Simple :

```shell
pacman -S nginx php-fpm php-sqlite php-gd
```
Par défaut, PHP-FPM est configuré pour utiliser un socket unix donc je n'ai rien modifié de ce côté là, j'ai juste démarré le service : 

```shell
rc.d start php-fpm
```
J'ai ensuite adapté la configuration de Nginx pour que mes pages web soient dans /var/www (je n'aime pas le chemin par défaut de Arch) et j'ai quelque chose de simple :

```nginx
server {

        listen [::]:80;

        server_name dockstar;

        access_log  /var/log/nginx/test.access.log;
        error_log /var/log/nginx/test.error.log;
        root   /var/www/default;
        index index.php;

        location ~ \.php$ {
          fastcgi_pass   unix:/var/run/php-fpm/php-fpm.sock;
          fastcgi_index  index.php;
          include        fastcgi.conf;
        }

}
```
Attention au lien vers PHP-FPM (unix:/var/run/php-fpm/php-fpm.sock) selon les versions de PHP-FPM il est peut être différent vérifiez donc la propriété listen de /etc/php/php-fpm.conf.

### Premier test

Bilan : cela ne fonctionne pas. Après quelques recherches, il se trouve que je suis obligé de déclarer dans le php.ini tous les endroits où des scripts peuvent exister :

```
open_basedir = /srv/http/:/home/:/tmp/:/usr/share/pear/:/var/www
```

### Deuxième test

Cela fonctionne ... de temps en temps. J'ai aussi les erreurs suivantes dans les logs :

```
2012/06/03 22:23:27 [notice] 31802#0: start worker process 31803
2012/06/03 22:23:32 [notice] 31802#0: signal 17 (SIGCHLD) received
2012/06/03 22:23:32 [alert] 31802#0: worker process 31803 exited on signal 11
2012/06/03 22:23:32 [notice] 31802#0: start worker process 31804
2012/06/03 22:24:14 [notice] 31802#0: signal 17 (SIGCHLD) received
2012/06/03 22:24:14 [alert] 31802#0: worker process 31804 exited on signal 11
```

Après de nombreuses recherches, j'ai trouvé [un post sur Archlinuxarm](http://archlinuxarm.org/forum/viewtopic.php?f=9&t=1914) à ce sujet.

Il y a plusieurs solutions :

* Ne plus utiliser PHP-FPM
* Compiler Nginx à partir des sources
  
J'ai choisi la deuxième solution.

## Essai 2 : Compilation de Nginx

### Dépendances
Pour compiler il faut installer le nécessaire (make, gcc, ...), l’équivalent de build-essential est :

```shell
pacman -S base-devel
```

### Compilation

En premier lieu, je me suis inspiré du PKGBUILD officiel de Nginx pour que ma compilation colle au mieux à celle de Archlinux. J'ai fini par écrire un script de compilation :

```
./configure \
        --prefix=/etc/nginx \
        --conf-path=/etc/nginx/nginx.conf \
        --sbin-path=/usr/sbin/nginx \
        --pid-path=/var/run/nginx.pid \
        --lock-path=/var/lock/nginx.lock \
        --user=http --group=http \
        --http-log-path=/var/log/nginx/access.log \
        --error-log-path=/var/log/nginx/error.log \
        --http-client-body-temp-path=/var/tmp/nginx/client-body \
        --http-proxy-temp-path=/var/tmp/nginx/proxy \
        --http-fastcgi-temp-path=/var/tmp/nginx/fastcgi \
        --http-scgi-temp-path=/var/tmp/nginx/scgi \
        --http-uwsgi-temp-path=/var/tmp/nginx/uwsgi \
        --with-imap --with-imap_ssl_module \
        --with-ipv6 --with-pcre-jit \
        --with-file-aio \
        --with-http_dav_module \
        --with-http_gzip_static_module \
        --with-http_realip_module \
        --with-http_ssl_module \
        --with-http_stub_status_module \
        #--add-module=/usr/lib/passenger/ext/nginx \
        #--with-http_mp4_module \
        #--with-http_realip_module \
        #--with-http_addition_module \
        #--with-http_xslt_module \
        #--with-http_image_filter_module \
        #--with-http_geoip_module \
        #--with-http_sub_module \
        #--with-http_flv_module \
        #--with-http_random_index_module \
        #--with-http_secure_link_module \
        #--with-http_degradation_module \
        #--with-http_perl_module \

make -f objs/Makefile
```

Ensuite c'est simple :

```shell
wget http://nginx.org/download/nginx-1.2.1.tar.gz
tar xvzf nginx-1.2.1.tar.gz
cp build.sh nginx-1.2.1
cd nginx-1.2.1
./build.sh
```

C'est étonnamment rapide.

### Installation

* En premier, on sauvegarde la configuration par défaut de Archlinux

```bash
cd /root
cp -R /etc/nginx/ .
cp /etc/rc.d/nginx nginx-rc.d
cp /etc/logrotate.d/nginx nginx-logrotate
```

* On désinstalle le paquet officiel

```bash
rc.d stop nginx
pacman -Rs nginx
rm -Rf /etc/nginx/
```

* On installe le nouveau

```bash
cd /root/nginx-1.2.1
make install
```

* On reprend notre paramétrage

```bash
cp -R /root/nginx/sites-available/ .
mkdir sites-enabled
cd sites-enabled/
ln -s /etc/nginx/sites-available/default default
cp nginx-logrotate /etc/logrotate.d/nginx
cp nginx-rc.d /etc/rc.d/nginx
mkdir /var/tmp/nginx    
```

* J'ai ensuite dû modifier le fichier rc.d pour adapter le changement de chemin (/etc/nginx/conf vers /etc/nginx) :

```bash
#!/bin/bash

# general config

NGINX_CONFIG="/etc/nginx/nginx.conf" ################################

#. /etc/conf.d/nginx ###############################
. /etc/rc.conf
. /etc/rc.d/functions

function check_config {
  stat_busy "Checking configuration"
  /usr/sbin/nginx -t -q -c "$NGINX_CONFIG"
  if [ $? -ne 0 ]; then
    stat_die
  else
    stat_done
  fi
}

case "$1" in
  start)
    check_config
    $0 careless_start
    ;;
  careless_start)
    stat_busy "Starting Nginx"
    if [ -s /var/run/nginx.pid ]; then
      stat_fail
      # probably ;)
      stat_busy "Nginx is already running"
      stat_die
     fi
    /usr/sbin/nginx -c "$NGINX_CONFIG" &>/dev/null
    if [ $? -ne 0 ]; then
      stat_fail
    else
      add_daemon nginx
      stat_done
    fi
    ;;
  stop)
    stat_busy "Stopping Nginx"
    NGINX_PID=`cat /var/run/nginx.pid 2>/dev/null`
    kill -QUIT $NGINX_PID &>/dev/null
    if [ $? -ne 0 ]; then
      stat_fail
    else
      for i in `seq 1 10`; do
        [ -d /proc/$NGINX_PID ] || { stat_done; rm_daemon nginx; exit 0; }
        sleep 1
      done
      stat_fail
    fi
    ;;
  restart)
    check_config
    $0 stop
    sleep 1
    $0 careless_start
    ;;
  reload)
    check_config
    if [ -s /var/run/nginx.pid ]; then
      status "Reloading Nginx Configuration" kill -HUP `cat /var/run/nginx.pid`
    fi
    ;;
  check)
    check_config
    ;;
  *)
    echo "usage: $0 {start|stop|restart|reload|check|careless_start}"
esac
```

* On peut démarrer le serveur :

```shell
rc.d start nginx
```

### Bilan

Ca marche !

## Installation du cache opcode PHP

Auparavant, j'avais pris l'habitude d'utiliser xcache. Comme Archlinux utilise PHP5.4, j'ai été obligé d'utiliser APC et cela n'a pas été très compliqué.

* Installation

```shell
pacman -S php-apc
vi /etc/php/conf.d/apc.ini
cp /usr/share/php-apc/apc.php /var/www
```

* Paramétrage (création du fichier /etc/php/conf.d/apc.ini avec le contenu suivant)

```
extension=apc.so
apc.shm_size=16M
#apc.stat=0
```

* Redémarrage de php-fpm

```bash
rc.d stop php-fpm
rc.d start php-fpm
```

Cela marche bien avec la configuration que j'ai donné. Par contre, dès que j'active la ligne apc.stat=0 plus rien ne fonctionne ... C'est vraiment étrange (alors que tout fonctionne sur une autre machine en PHP 5.3).

## Récupération des logs d'erreur PHP

Un point très important, avec le Fastcgi classique les erreurs PHP se retrouvent dans le log d'erreur de Nginx. Ce n'est plus vrai avec la version de PHP-FPM installé par Arch pour avoir accès au log j'ai du activer le paramètre suivant dans /etc/php/php-fpm.conf (à la fin du fichier) :

```
catch_workers_output = yes
```

Les erreurs se retrouvent maintenant dans /var/log/php-fpm.log.
