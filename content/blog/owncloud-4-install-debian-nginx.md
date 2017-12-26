---
title: "Installation de Owncloud 4.0.2 avec Debian et Nginx"
date: 2012-06-17
tags: [cloud,debian,nginx]
slug: owncloud-4-install-debian-nginx
---
# Installation de Owncloud 4.0.2 avec Debian et Nginx

Pour faire suite à mon billet précédent je suis passé à l'action et j'ai installé Owncloud sur mon VPS. pour l'instant le bilan est satisfaisant, je détaillerai un peu plus en fin d'article dans le bilan.

## Dépendances

J'ai bêtement repris les dépendances indiquées sur le site en ignorant les paquets non disponibles (certainement pour Ubuntu) :

```bash
apt-get install php5-json php-xml php-mbstring php5-zip php5-gd php5-sqlite curl libcurl3 libcurl3-dev php5-curl php-pdo
```

Vous pouvez aussi installer MySQL / Postgres si vous voulez stocker plus de fichiers (par défaut la base est sqlite).

## Modification du php.ini

L'intérêt de ce genre de logiciel est de pouvoir charger (upload) des fichiers sur le serveur, il faut donc augmenter certains paramètres pour que les gros fichiers passent (dans mon cas je me suis limité à 64Mo).

```bash
vi /etc/php5/cgi/php.ini
```
Les paramètres à changer sont :

* post_max_size = 64M
* upload_max_filesize = 64M
* date.timezone = "Europe/Paris"

Si votre PHP est en fastcgi ou FPM, n'oubliez de redémarrer le processus pour que les paramètres soient pris en compte.

## Installation proprement dite

Simple : 

```bash
cd /var/www
wget http://download.owncloud.org/releases/owncloud-4.0.2.tar.bz2
tar xvjf owncloud-4.0.2.tar.bz2
chown -R :www-data owncloud/
chmod -R g+w owncloud/
```

## Paramétrage de Nginx

La paramétrage est assez complexe mais il semble fonctionner pour le moment. A noter que celui que je donne est en HTTP, je vous conseille la passage en HTTPS.

```
server {

        listen [::]:80;

        server_name owncloud.mondomaine.fr;

        access_log  /var/log/nginx/owncloud.access.log;
        error_log /var/log/nginx/owncloud.error.log;
        root   /var/www/owncloud;
        index index.php;
        client_max_body_size 64M;

  # deny direct access
  location ~ ^/(data|config|\.ht|db_structure\.xml|README) {
    deny all;
  }
  # default try order
  location / {
    try_files $uri $uri/ @webdav;
  }
  # owncloud WebDAV
  location @webdav {
    fastcgi_split_path_info ^(.+\.php)(/.*)$;
    fastcgi_pass unix:/tmp/fcgi.sock;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
  }
  # enable php
  location ~ \.php$ {
    fastcgi_pass unix:/tmp/fcgi.sock;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
  }
}

```

## Correction de bugs

Lors de mes tests j'ai du appliquer des patches pour que cela fonctionne, je ne sais plus trop quels étaient les problèmes mais cela a aidé :

```
--- owncloud/remote.php 2012-06-11 12:18:38.000000000 +0200
+++ /var/www/owncloud/remote.php        2012-06-15 14:00:12.000000000 +0200
@@ -7,6 +7,13 @@
 }else{
        $path_info = substr($_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'], basename(__FILE__)) + strlen(basename(__FILE__)));
 }
+
+// begin modification
+if (empty($path_info)){
+$path_info = str_replace($_SERVER['SCRIPT_NAME'],"",$_SERVER['REQUEST_URI']);
+}
+// end modification
+
 if (!$pos = strpos($path_info, '/', 1)) {
        $pos = strlen($path_info);
 }
```

```
--- owncloud/lib/filestorage/local.php  2012-06-11 12:18:37.000000000 +0200
+++ /var/www/owncloud/lib/filestorage/local.php 2012-06-15 14:12:32.000000000 +0200
@@ -65,6 +65,8 @@
                // sets the modification time of the file to the given value.
                // If mtime is nil the current time is set.
                // note that the access time of the file always changes to the current time.
+               if(!is_numeric($mtime))
+                       $mtime = strtotime($mtime);
                if(!is_null($mtime)){
                        $result=touch( $this->datadir.$path, $mtime );
                }else{
```

## Bilan à chaud

Je ne l'ai installé que vendredi, donc mon opinion n'est pas encore faire. Toutefois j'ai déjà repéré du bon et du moins bon.

Bons points :

* L'installation est simple.
* Il existe des outils de synchronisation pour pas mal d'OS (voir http://owncloud.org/sync-clients/).
* L'outil de synchronisation Windows fonctionne.
* La lecture de musique dans le site est sympathique.

Mauvais points :

* Je n'ai pas réussi à faire fonctionner l'accès Webdav (répertoire distant) sur Windows Seven (malgré la lecture de la [documentation](http://owncloud.org/support/webdav/)). Je vais essayer sous Linux prochainement.
* J'ai eu un sentiment de lourdeur à l'utilisation de l'interface Web.
* L'outil de synchronisation Windows n'est clairement pas à la hauteur de celui de Dropbox par exemple : il est lent, il n'indique pas les tâches en cours, ...
* La société derrière ce projet a des impératif commerciaux et donc livre malheureusement des nouvelles versions assez buggées.

## Sources pour l'écriture de cet article

* http://owncloud.org/support/install/
* http://www.howtoforge.com/your-cloud-your-data-your-way-owncloud-4.0-nginx-postgresql-on-centos-6.2
* http://bugs.owncloud.org/thebuggenie/owncloud/issues/oc-902
* http://bugs.owncloud.org/thebuggenie/owncloud/issues/oc-148
