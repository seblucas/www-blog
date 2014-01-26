/*
Title: Paramétrage de la compression avec nginx
Description: 
Author: Sébastien Lucas
Date: 2011/01/20
Robots: noindex,nofollow
Language: fr
Tags: dokuwiki,nginx
*/
# Paramétrage de la compression avec nginx

## Pourquoi ?
J'ai appris avec horreur hier soir en utilisant [ce site de test](http://www.webpagetest.org) que j'avais un peu de boulot pour mieux optimiser la vitesse d'affichage du site. Le gros point noir venait de la non compression des fichiers css et javascript (qui représente une part non négligeable du site). Par contre le html était lui bien compressé.
## Comme améliorer ça

Après une petite recherche sur le wiki de nginx j'ai vite trouvé l'explication le seul type mime compressé par défaut est text/html. J'ai donc modifié mon /etc/nginx/nginx.conf (pour que cela agisse sur tout mes sites) pour ajouter la ligne suivante : 
```
gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript;
```
## Changement de la date d'expiration des images

En plus de changer la compression j'ai aussi changé la mise en cache des images pour qu'elle restent en cache (sur le navigateur du visiteur du site) plus longtemps :
```
location ~ ^/lib.*\.(gif|png|ico|jpg)$ {
    expires 31d;
}
```
Comme j'ai très peu d'images cela devrait suffire, au pire il reste la solution d'héberger les images sur un compte free.
## Paramétrage de dokuwiki

Un paramètre important de dokuwiki est la compression (ou minification) des fichiers css et javascript : http://www.dokuwiki.org/config:compress. Il devrait être activé par défaut.

## Autres sites utiles

*	http://www.woorank.com
*	http://gtmetrix.com/



