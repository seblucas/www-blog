/*
Title: HTTPS plus sécurisé
Description: 
Author: Sébastien Lucas
Date: 2015/02/06
Robots: noindex,nofollow
Language: fr
Tags: nginx
*/
# HTTPS plus sécurisé

## Pourquoi ?

Suite à la lecture d'un article sur [LinuxFR](http://linuxfr.org/news/nsa-a-propos-de-bullrun), je me suis attelé à tester la qualité du HTTPS du blog avec ce [site](https://www.ssllabs.com/) et après avoir obtenu la note F ... j'ai corrigé.

## Le problème

J'ai un peu suivi les dernières attaques Heartbleed et Poodle, mais je pensais qu'en faisant mes mises à jour Debian régulièrement j'étais en sécurité. En fait non.

## Modification de Nginx

Le cœur du problème est d'éviter les algorithmes non fiables ou de qualité trop faible. J'ai donc modifié mon `/etc/nginx/nginx.conf` pour que mon bloc SSL ressemble à ça :

```
        ssl_session_cache    shared:SSL:1m;
        ssl_session_timeout  10m;
        ssl_ciphers ALL:!aNULL:!eNULL:!LOW:!EXP:!RC4:!3DES:+HIGH:+MEDIUM;
        ssl_prefer_server_ciphers on;
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
```

Comme vous pouvez le voir les protocoles ont été limités, de même pour les algorithmes de chiffrement (cyphers).

## Reste à faire

Ma clé SSL n'est pas chiffrée en SHA2. Pour ma prochaine génération de clé StartSSL, il faudra que je change ma ligne de commande :

```
openssl req -new -sha256 -key your-private.key -out your-domain.csr
```

## Bilan

J'ai gagné un peu plus de sécurité (même si le site est accessible en HTTP donc l'intérêt est limité). J'ai perdu le fait d'être accessible par IE6 sur Windows XP.

Au final c'est mieux.

## Sources

 * https://www.jeveuxhttps.fr/%C3%89tape_1_Installer_HTTPS_sur_le_serveur,_pour_informaticien
 * http://www.nginxtips.com/hardening-nginx-ssl-tsl-configuration/
 * https://shaaaaaaaaaaaaa.com/
