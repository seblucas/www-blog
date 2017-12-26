/*
Title: Mettre en place la protection par mot de passe sur COPS (Apache)
Description: 
Author: Sébastien Lucas
Date: 2014/04/05
Robots: noindex,nofollow
Language: fr
Tags: calibre,ereader,nginx,opds,php
*/
# Mettre en place la protection par mot de passe sur COPS (Apache)

Suite à de nombreuses demandes d'assistance par mail, je vais essayer de vous expliquer comment paramétrer [COPS](//blog.slucas.fr/fr/oss/calibre-opds-php-server) pour qu'il soit protégé par mot de passe.

Ce tutoriel ne s'adresse qu'aux utilisateurs d'Apache et ne va donc couvrir que le paramétrage du fichier .htaccess.

A noter que cet article est en construction depuis de nombreux mois mais je n'en étais pas complètement satisfait. Mes nouvelles résolutions sont de publier le plus tôt possible et d'améliorer au fur et à mesure. Vous pouvez utiliser les commentaires pour m'aiguiller dans mes améliorations !

## Installer COPS et le tester

Je ne vais pas détailler l'installation de COPS (soit en manuel soir via la package Synology) cela a déjà été fait précédemment mais il faut retenir qu'il faut bien valider que COPS fonctionne correctement sans protection par mot de passe avant de passer à la suite.

## Préparer le fichier de mot de passe

L'objectif est de créer un fichier `accesCops.htpasswd` qui contiendra les utilisateurs et mots de passe associés. Le plus simple est de passer par un service en ligne comme [celui-ci](http://www.htaccesstools.com/htpasswd-generator/).

J'ai ajouté le compte `toto` avec comme mot de passe `truc` et cela me donne ce texte qu'il faut mettre dans notre fichier `accesCops.htpasswd` :

```
toto:$apr1$qb5.ZTX5$mkzj7FUTT7OZPAbGB0NHo/
```

Si vous voulez créer plusieurs comptes alors vous pouvez réutiliser le générateur et avoir plusieurs lignes dans votre fichier (attention à ne pas avoir d'espaces en début et fin de ligne) :

```
toto:$apr1$qb5.ZTX5$mkzj7FUTT7OZPAbGB0NHo/
titi:$apr1$kNyI93X2$W2nRIftuAxiZhDUCnLbsx0
```

## Où stocker le fichier `accesCops.htpasswd` ?

Où vous voulez !

Pour être plus précis et pour être en sécurité, le seul endroit qu'il faut exclure est un endroit accessible via un navigateur internet :
 * Si vous êtes sur un Synology, il ne faut pas le stocker dans le partage `web` (donc pas dans `/volume1/web/`).
 * Si vous êtes sur une Debian , il ne faut pas le stocker dans `/var/www`
 * etc

## Paramétrer COPS

Le plus simple reste à faire (pour l'exemple le chemin complet de mon fichier de mot de passe sera `/volume1/partage1/accesCops.htpasswd`), il faut modifier le fichier `.htaccess` fournit avec COPS pour remplacer :

```
###########################################
# Uncomment if you wish to protect access with a password
###########################################
# If your covers and books are not available as soon as you protect it
# You can try replacing the FilesMatch directive by this one
# <FilesMatch "(index|feed)\.php">
# If helps for Sony PRS-TX and Aldiko, beware fetch.php can be accessed
# with authentication (see $config ['cops_fetch_protect'] for a workaround).
###########################################
#<FilesMatch "\.php$">
#AuthUserFile /path/to/file
#AuthGroupFile /dev/null
#AuthName "Acces securise"
#AuthType Basic
#Require valid-user
#</FilesMatch>
```

par :

```
###########################################
# Uncomment if you wish to protect access with a password
###########################################
# If your covers and books are not available as soon as you protect it
# You can try replacing the FilesMatch directive by this one
# <FilesMatch "(index|feed)\.php">
# If helps for Sony PRS-TX and Aldiko, beware fetch.php can be accessed
# with authentication (see $config ['cops_fetch_protect'] for a workaround).
###########################################
<FilesMatch "\.php$">
AuthUserFile /volume1/partage1/accesCops.htpasswd
AuthGroupFile /dev/null
AuthName "Acces securise"
AuthType Basic
Require valid-user
</FilesMatch>
```

Et voila !

Comme indiqué dans le bloc, si vous utilisez Aldiko ou une liseuse Sony, vous pouvez changer la directive `FilesMatch`.

J'espère que cela vous aidera à protéger correctement votre bibliothèque.