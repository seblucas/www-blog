---
title: "Le cache fastcgi et Nginx - Partie 2"
date: 2011-09-18
tags: [dokuwiki,nginx,php]
slug: nginx-fastcgi-cache-2
---
# Le cache fastcgi et Nginx - Partie 2

## Précédemment dans ...
Dans mon précédent billet (voir [Le cache fastcgi et Nginx et un peu de déception](/blog/nginx-fastcgi-cache)), j'étais resté sur une déception sur l'impossibilité de Nginx à utiliser le cache sur les pages venant de dokuwiki à cause des entêtes transmises.

J'ai repassé un peu de temps sur le problème et relu la documentation (cela aide toujours) et j'ai trouvé des solutions.

## Solution honteuse

En utilisant grep sur le code de dokuwiki j'ai appris que le Cache-Control n'était pas imposé par lui mais que c'était le fonctionnement par défaut de PHP si on ne lui proposait pas d'entêtes spécifiques. J'ai donc fait une modification crade du doku.php pour ajouter les lignes suivantes :

```php
header('Expires: '.gmdate("D, d M Y H:i:s", time()+3600).' GMT');
header('Cache-Control: public, proxy-revalidate, no-transform, max-age=3600');
header('Pragma: public');
```
Bilan le cache fonctionne par contre le client lui aussi va mettre la page en cache, donc on peut trouver mieux.

## La solution est dans la documentation

En relisant la documentation de Nginx j'ai trouvé LE paramètre pour lui permettre d'ignorer certaines entêtes (notamment celles qui me posaient problème) : ''fastcgi_ignore_headers''. et j'ai aussi décidé de n'appliquer le cache que pour ce qui passe par doku.php.

Cela donne la configuration de nginx suivante :

```
        location ~ doku\.php$ {
               fastcgi_cache mycache;
               fastcgi_cache_key $request_method$host$request_uri;
               fastcgi_cache_valid 1h;
               fastcgi_ignore_headers Expires Cache-Control;
               include /etc/nginx/fastcgi_params;
               fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
               fastcgi_pass    unix:/tmp/fcgi.sock;
        }
```

Ca marche il ne reste qu'à gérer proprement le cas ou l'utilisateur se connecte pour que le cache ne pose pas de problème.

En attendant la troisième partie.

