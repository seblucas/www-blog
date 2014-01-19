/*
Title: Installation de nginx 1.1.0
Description: 
Author: Sébastien Lucas
Date: 2011/10/11
Robots: noindex,nofollow
Language: fr
*/
# Installation de nginx 1.1.0

## Pourquoi ?
Parce que la version de Squeeze est quand même super vieille et que j'ai toujours l'envie de finaliser ma gestion de cache fastcgi. J'ai vu sur [dotdeb](http://www.dotdeb.org/) que des paquets étaient disponible (malheureusement uniquement pour x86 et amd64) et finalement je me suis rendu compte que les paquets des [backports](http://backports-master.debian.org/) sont très récents.

## Installation

### Attention
Je vous conseille de lire l'ensemble de l'article avant de tenter la manipulation.
### Sauvegarde

Faites comme moi, un petit coup de clonezilla avant la mise à jour ça permet d'être serein.
### Ajout du dépôt des backports squeeze

on édite /etc/apt/sources.list pour ajouter :
```
deb http://www.backports.org/debian squeeze-backports main
```
### Paranoïa : 2ième

On fait une sauvegarde rapidement accessible de la configuration de nos sites :
```
cp /etc/nginx -R /root/nginx
```
### Mise à jour des paquets

```
apt-get update
apt-get -t squeeze-backport install nginx-light
```
J'ai choisi la version light de nginx, vous pouvez en savoir plus sur les autres version [ici](http://packages.debian.org/search?suite=squeeze-backports&searchon=names&keywords=nginx).
### Un coup de stress

Il faut savoir que la mise à jour de nginx va modifier les fichiers suivants :
```
Installation de la nouvelle version du fichier de configuration /etc/nginx/nginx.conf ...
Installation de la nouvelle version du fichier de configuration /etc/nginx/mime.types ...
Installation de la nouvelle version du fichier de configuration /etc/nginx/koi-win ...
Installation de la nouvelle version du fichier de configuration /etc/nginx/koi-utf ...
Installation de la nouvelle version du fichier de configuration /etc/nginx/fastcgi_params ...
Installation de la nouvelle version du fichier de configuration /etc/nginx/sites-available/default ...
```
Si comme moi vous avez modifié nginx.conf (pour ajouter la gestion du cache fastcgi + la compression gzip) et le site par défaut (pour activer l'IPV6), ça va merder. Donc avec le recul un conseil : enlever l'ensemble de vos sites du répertoire sites-enabled pour ne laisser que défaut qui sera mis à jour.

Pour en finir je m'en suis sorti en étant obligé de faire un reboot pour finaliser l'installation de nginx mais bon cela fonctionne.
