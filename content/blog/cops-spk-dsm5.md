---
title: "COPS sur un NAS Synology avec le DSM 5"
date: 2014-04-14
tags: [calibre,opds,synology]
slug: cops-spk-dsm5
---
# COPS sur un NAS Synology avec le DSM 5

Depuis quelques semaines maintenant, Synology a commencé à déployer la nouvelle version de son Diskstation (DSM 5). Pour être honnête c'est peut être une bonne nouvelle pour beaucoup d'utilisateurs, mais c'est catastrophique pour COPS !

Beaucoup d'utilisateurs de COPS utilisent des NAS et ma boite mail déborde de messages d'utilisateurs perturbés par la mise à jour.

J'ai fait le choix de ne pas mettre à jour mon NAS donc je ne peux rien confirmer, je ne peux que croire sur parole ce que je lis sur le Net et ce qu'on m'envoie par mail.

## Support de SQLite

Le support de SQLite est obligatoire pour COPS (la base de donnée de Calibre est une base SQLite).

Ce point devrait être simple à résoudre vu qu'il suffit de cocher la case à cocher `mssql` qui logiquement active le support MySql dans la liste des extensions.

C'est louche mais cela semble marcher.

## Gestion des droits sur le répertoire Calibre

Certains utilisateurs m'ont aussi indiqués que le répertoire contenant les données Calibre (`/volume1/calibre` par exemple) devait avoir des droits spécifiques.

Il faudrait donc attribuer le groupe `http` au répertoire `/volume1/calibre` soit via l'interface graphique soit via la ligne de commande :

```bash
chown -R :http /volume1/calibre
```

## Support des .htaccess

Avec l'arrivée du DSM 5, plusieurs fonctionnalités qui était gérées via le fichier `.htaccess` ne fonctionnent plus du tout. Pour certaines il existe un palliatif pour d'autres c'est plus compliqué.

### Protection par mot de passe

Pour corriger cela il faut forcement accéder au NAS via la ligne de commande (SSH ou Telnet) et modifier le fichier `/etc/httpd/conf/httpd.conf-user` en ajoutant en début de ce fichier :

```
LoadModule authn_file_module modules/mod_authn_file.so
LoadModule authn_dbm_module modules/mod_authn_dbm.so
LoadModule authn_anon_module modules/mod_authn_anon.so
LoadModule authn_dbd_module modules/mod_authn_dbd.so
LoadModule authz_groupfile_module modules/mod_authz_groupfile.so
LoadModule authz_user_module modules/mod_authz_user.so
LoadModule authz_dbm_module modules/mod_authz_dbm.so
LoadModule authz_owner_module modules/mod_authz_owner.so
LoadModule auth_digest_module modules/mod_auth_digest.so
```

il faut ensuite redémarrer le serveur Web :

```
/usr/syno/sbin/synoservicecfg --restart httpd-user
```

Une fois les modifications effectuées l'authentification fonctionne en HTTP par contre l'HTTPS ne marche toujours pas.

ATTENTION : Je ne fais que recopier ce que j'ai pu trouver sur Internet. Je n'ai rien testé.

### Gestion du X-SendFile

La première question à se poser est : en avez vous vraiment besoin ? Dans la plupart des cas non, il vous suffit donc d'enlever de votre fichier `config_local.php` toute mention de ces deux clés de paramétrage :

```
    /*
     * SPECIFIC TO NGINX
     * The internal directory set in nginx config file
     * Leave empty if you don't know what you're doing
     */
    $config['calibre_internal_directory'] = '';

    /*
     * Wich header to use when downloading books outside the web directory
     * Possible values are :
     *   X-Accel-Redirect   : For Nginx
     *   X-Sendfile         : For Lightttpd or Apache (with mod_xsendfile)
     *   No value (default) : Let PHP handle the download
     */
    $config['cops_x_accel_redirect'] = "";
```

### Gestion de la réécriture d'URL

De la même manière la réécriture d'URL n'est pas utile pour tout le monde (seul les utilisateurs de liseuses Kobo en ont absolument besoin). Si elle ne vous sert à rien il suffit d'enlever de votre `config_local.php` la clé suivante :

```
    /*
     * use URL rewriting for downloading of ebook in HTML catalog
     * See Github wiki for more information
     *  1 : enable
     *  0 : disable
     */
    $config['cops_use_url_rewriting'] = "0";
```

Pour le moment je n'ai pas trouvé de palliatif fiable sur ce sujet pour le moment, si vous trouvez quelque chose indiquez le dans les commentaires je modifierai l'article.

EDIT 04/05/2014 : En fait la réécriture d'URL ne pose pas de problèmes avec DSM5.

## Des commentaires

Je n'ai pas l'intention d'installer le DSM 5 avant le mois de juin. Donc si vous avez plus d'informations, les commentaires sont à vous.

## Sources et plus d'informations

 * [Apache / Webserver limitations in 5.0](http://forum.synology.com/enu/viewtopic.php?f=232&t=79801)
 * [3rd Party Applications absichern](http://www.synology-wiki.de/index.php/3rd_Party_Applications_absichern)
 * [BicBucStriim Upgrading Synology DSM 4 to 5](https://github.com/rvolz/BicBucStriim/wiki/UpgradeSynology)
 * [My Readings – Configuration avec un NAS Synology sous DSM version 5](http://sbdomo.esy.es/2014/04/my-readings-configuration-dsm5/)