/*
Title: Serveur web ipv6 avec Nginx
Description: 
Author: Sébastien Lucas
Date: 2011/01/14
Robots: noindex,nofollow
Language: fr
Tags: nginx
*/
# Serveur web ipv6 avec Nginx

## Documentation officielle
La directive qui gère ce genre de chose est listen : http://wiki.nginx.org/NginxHttpCoreModule#listen

Et un petit lien ipv6 bien fait pour la route : http://irp.nain-t.net/doku.php/075ipv6:start

Une petit lien qui m'a inspiré pour la rédaction : http://kovyrin.net/2010/01/16/enabling-ipv6-support-in-nginx/

## Vérification que nginx supporte bien l'ipv6

La version de Debian Squeeze le supporte mais il faut mieux vérifier :
```
nginx -v | grep ipv6
```

## Fonctionnement sous Linux

Il faut savoir qu'en fonction d'un paramètre du noyau (net.ipv6.bindv6only) un bind sur une adresse ipv6 entraine le même bind en ipv4 (valeur à 0) ou uniquement ipv6 (valeur à 1). La valeur est à vérifier avec :
```
sysctl -a|grep net.ipv6.bindv6only
```

### net.ipv6.bindv6only = 0

 Sur ma Debian Squeeze ce paramètre est bien à 0 donc j'ai du modifier tous mes sites définis dans sites-enabled pour remplacer :
```
listen 80;
```
par
```
listen [::]:80;
```

Si lors d'un redémarrage de nginx vous avez ce genre de message c'est que vous avez oublié un site :
```
[emerg]: bind() to 0.0.0.0:80 failed (98: Address already in use)
```

### net.ipv6.bindv6only = 1

Si le paramètre net.ipv6.bindv6only=1 alors il faut deux lignes (pour faire deux bind) :
```
listen [::]:80 ipv6only=on;
listen 80;
```

## Vérification du bon fonctionnement

Après un redémarrage de nginx on peut vérifier le bon fonctionnement en utilisant netstat :
```
#netstat -nlp | grep nginx
tcp6       0      0 :::80                   :::*                    LISTEN      1147/nginx
```






