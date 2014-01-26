/*
Title: Dokuwiki et nginx
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: dokuwiki,nginx
*/
# Dokuwiki et nginx

## Fichier complet
```
server {

        listen [::]:80;

        server_name blog.slucas.fr blog-ipv6.slucas.fr;

        access_log  /var/log/nginx/slucas.access.log;
        error_log /var/log/nginx/slucas.error.log;
        root   /var/www/slucas-wiki;
        index doku.php;

        location ~ ^/(data|conf|bin|inc) {
                return 404;
        }

        location ~ ^/lib.*\.(gif|png|ico|jpg)$ {
                expires 31d;
        }

        location /tips {
                rewrite ^(.*)$ http://blog.slucas.fr/en$1 permanent;
        }

        location / {
                try_files $uri $uri/ @dokuwiki;
        }

        location @dokuwiki {
                rewrite ^/_media/(.*) /lib/exe/fetch.php?media=$1 last;
                rewrite ^/_detail/(.*) /lib/exe/detail.php?media=$1 last;
                rewrite ^/_export/([^/]+)/(.*) /doku.php?do=export_$1&id=$2 last;
                rewrite ^/tag/(.*) /doku.php?id=tag:$1&do=showtag&tag=tag:$1 last;
                rewrite ^/(.*) /doku.php?id=$1&$args last;
        }

        location ~ \.php$ {
                include /etc/nginx/fastcgi_params;
                fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                fastcgi_pass    unix:/tmp/fcgi.sock;
        }
}
```

## Explications

```
        location ~ ^/(data|conf|bin|inc) {
                return 404;
        }
```
Voir [Mise à jour Dokuwiki Anteater et Nginx](/blog/anteater-system-security-nginx).

```
        location ~ ^/lib.*\.(gif|png|ico|jpg)$ {
                expires 31d;
        }
```
Voir [Paramétrage de la compression avec nginx](/blog/nginx-gzip-css-js)

```
        location /tips {
                rewrite ^(.*)$ http://blog.slucas.fr/en$1 permanent;
        }
```
C'est juste pour rattraper une erreur de namespace, je redirige http://blog.slucas.fr/tips/* vers http://blog.slucas.fr/en/tips/*.

```
        location / {
                try_files $uri $uri/ @dokuwiki;
        }

        location @dokuwiki {
                rewrite ^/_media/(.*) /lib/exe/fetch.php?media=$1 last;
                rewrite ^/_detail/(.*) /lib/exe/detail.php?media=$1 last;
                rewrite ^/_export/([^/]+)/(.*) /doku.php?do=export_$1&id=$2 last;
                rewrite ^/tag/(.*) /doku.php?id=tag:$1&do=showtag&tag=tag:$1 last;
                rewrite ^/(.*) /doku.php?id=$1&$args last;
        }

```
Ici on gère l'url rewriting pour avoir des urls propres (sans ? et :). Voir [URL propres avec Dokuwiki](/blog/dokuwiki-rewrite-tag).

```
        location ~ \.php$ {
                include /etc/nginx/fastcgi_params;
                fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                fastcgi_pass    unix:/tmp/fcgi.sock;
        }
```
On gère l'appel au fastcgi php. Voir [Installation de nginx sous Debian](/blog/nginx-php-install) et [Nginx PHP Fastcgi avec socket Unix](/blog/nginx-php-unix-socket).

