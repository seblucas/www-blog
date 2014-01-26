/*
Title: HTTPS disponible avec Nginx ... vraiment
Description: 
Author: Sébastien Lucas
Date: 2011/12/16
Robots: noindex,nofollow
Language: fr
Tags: dockstar,dokuwiki,nginx
*/
# HTTPS disponible avec Nginx ... vraiment

## La rançon du succès ?
Depuis mon article indiquant l'intégration de l'accès HTTPS (voir [HTTPS disponible grâce à StartSSL](/blog/https-ready)), j'ai voulu intégrer des publicités sur le site. 

Ma volonté pour les publicités était de déplacer le serveur sur un VPS quelconque pour pouvoir ouvrir plus de services et améliorer la bande passante limitée de mon ADSL. En effet j'ai eu le plaisir de voir beaucoup d'accès à ce blog (300 à 400 visiteurs uniques et quelques milliers de pages vues par jour) ce qui a montré les limites du Dockstar et de ma ligne ADSL. Je vais continuer le test encore un mois pour estimer si la location d'un VPS est couverte.

Tout cela pour dire que les publicités sont en HTTP donc cela rendait l'accès au blog en HTTPS non sécurisé (alerte au niveau du navigateur). J'ai donc l'obligation de bloquer les publicités pour les visites sécurisées.

## La configuration Nginx

### Principe
Nginx gère l'accès à PHP via un fastcgi donc le paramètre PHP $_SERVER['HTTPS'] n'est pas positionné par défaut sauf si il est forcé dans le fichier de paramétrage Nginx. Ma précédente méthode, dans le cas du HTTPS, était d'utiliser un reverse proxy ce qui ne me permet pas de déterminer de façon fiable si l'origine de la connexion est sécurisée ou pas.

### Solution dans Nginx

J'ai mélangé la configuration HTTP et HTTPS dans le même fichier (étant donné que je n'ai pas de différence) ce qui me donne le fichier suivant pour l'entête :
```
        listen [::]:80;
        listen  [::]:443 ssl;

        server_name blog.slucas.fr blog-ipv6.slucas.fr;

        if ($server_port = 443) { set $https on; }
        if ($server_port = 80) { set $https off; }

        ssl_certificate      /etc/nginx/ssl-blog.crt;
        ssl_certificate_key  /etc/nginx/slucas.fr.key;

```
Notez :
*	que je positionne une variable $https avec la valeur on ou off selon l'accès.
*	que j'écoute sur le port 80 et 443.

Ensuite pour l'appel de mes fichiers php, j'ai modifié les éléments suivants :
```
fastcgi_cache_key $https$request_method$host$request_uri;
fastcgi_param HTTPS $https;
```
En effet, je dois avoir des clés de cache différentes entre le mode ssl et le mode normale vu que le HTML sera différent. Et enfin je passe le paramètre HTTPS au fastcgi PHP.

### Modification des scripts PHP

Il ne reste plus qu'à modifier les scripts PHP pour ajouter des contrôles de ce style :
```php
if (!(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"))
{
// Code uniquement HTTP
}
```
