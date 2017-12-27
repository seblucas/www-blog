/*
Title: Dokuwiki and nginx
Date: 2012/11/10
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: dokuwiki,nginx
*/
# Dokuwiki and nginx

## Full file

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

For security reasons ([http://www.dokuwiki.org/security](http://www.dokuwiki.org/security)) some directory should not accessible from outside.

```
        location ~ ^/lib.*\.(gif|png|ico|jpg)$ {
                expires 31d;
        }
```

Here I force a far away expiration date on the images of dokuwiki and templates.

```
        location /tips {
                rewrite ^(.*)$ http://blog.slucas.fr/en$1 permanent;
        }
```

I just made a wrong namespace choice for some page so I added a permanent redirection of http://blog.slucas.fr/tips/* to http://blog.slucas.fr/en/tips/*.

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

Here we handle the url rewriting to have clean urls (http://www.dokuwiki.org/rewrite). Note that the tag and cloud plugins have been patched to make it work (see here for the patches http://blog.slucas.fr/blog/dokuwiki-rewrite-tag or http://www.freelists.org/post/dokuwiki/PATCH-Clean-URLs-for-tags-and-blogarchive for the original idea)

```
        location ~ \.php$ {
                include /etc/nginx/fastcgi_params;
                fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                fastcgi_pass    unix:/tmp/fcgi.sock;
        }
```

Here is the fastcgi php call. Note that I use unix sockets.

