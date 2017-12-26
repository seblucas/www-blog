---
title: "Le cache fastcgi et Nginx et un peu de déception"
date: 2011-07-17
tags: [dockstar,dokuwiki,nginx]
slug: nginx-fastcgi-cache
---
# Le cache fastcgi et Nginx et un peu de déception

## Le principe
Comme expliqué dans les tutoriels précédents ([Installation de nginx sous Debian](/blog/nginx-php-install)) Nginx fait appel au PHP via un fastcgi. donc pour schmatiser le php va renvoyer une page HTML à Nginx qui va se charger de l'envoyer au visiteur du site.

Le principe du cache est que Nginx ne va appeler le fastcgi que si il n'a pas encore la version HTML dans son cache.

## La mise en œuvre

### On regarde la documentation officielle
http://wiki.nginx.org/HttpFcgiModule

### Déclaration du cache

On modifie /etc/nginx/nginx.conf :

```
fastcgi_cache_path /tmp/nginx
                   levels=1:2
                   keys_zone=mycache:10m
                   inactive=1h
                   max_size=100m;
```

Une petite explication :

* Le nom du cache est mycache
* Les éléments du cache seront gardés en mémoire vive avec un maximum de 10Mo
* La taille totale du cache est de 100Mo
* Le chemin de stockage du cache est dans /tmp ce qui a l'avantage d'automatiser la purge en cas de reboot et de limiter le besoin de faire des chmod.

### Lier le cache et le site web

Modifier votre site web (typiquement dans /etc/nginx/sites-enabled) :

```
location ~ \.php$ {
                fastcgi_cache mycache; #################
                fastcgi_cache_key $request_method$host$request_uri; #################
                fastcgi_cache_valid any 1h; #################

                include /etc/nginx/fastcgi_params;
                fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                fastcgi_pass    unix:/tmp/fcgi.sock;
        }
```

Les lignes modifiées ont un #########.

Une petite explication :

* Le cache a utiliser est mycache.
* La clé du cache est l'URL complète + le type de requête (get post head) voir [ici](http://tonykwon.com/tag/fastcgi_cache/) pour valider l'intérêt.
* Les fichiers en cache resteront valide au maximum 1 heure (quelque soit la réponse du fastcgi).

Une fois les deux modifications effectuées relancer nginx :

```
/etc/init.d/nginx restart
```

### Comment vérifier que ça fonctionne

* Afficher dans un navigateur une page
* Regarder dans /tmp/nginx et vérifier que des fichiers sont bien créés
* Utiliser l'onglet réseau de firebug dans Firefox :
   * Afficher une page
   * Noter le temps lié à certains scripts
   * recharger la page (même avec un CTRL + F5)
   * Valider que le temps a baissé drastiquement (dans mon cas 400ms -> 12ms)

## La déception

Dans mon cas je voulais appliquer la modification du cache à ce site donc à Dokuwiki et cela n'est pas à la hauteur de mes espérances.

Dokuwiki utilise principalement 4 fichiers php pour chaque page :

* css.php : qui permet de récupérer une version minifiée des fichiers CSS.
* js.php : idem pour les javascrips.
* indexer.php : qui permet de mettre à jour les fichiers d'index de dokuwiki. il ne renvoie rien donc n'a aucun intérêt pour le cache.
* doku.php : qui génère les pages. C'est le fichier le plus couteux en temps.

mon but état de mettre en cache doku.php pour une durée courte (10 minutes) et cela n'est malheureusement pas possible vu que les pages générées ont des entêtes limitant le cache (Cache-Control	no-store, no-cache, must-revalidate, post-check=0, pre-check=0). Ces entêtes sont analysées par Nginx et la mise en cache est interdite.

Il ne me reste plus qu'à mettre à jour le site avec la dernière version en espérant que cela ait évolué et dans la cas contraire modifier le code pour ne mettre ces entêtes que si l'utilisateur est authentifié.







