/*
Title: HTTPS disponible grâce à StartSSL
Description: 
Author: Sébastien Lucas
Date: 2011/10/19
Robots: noindex,nofollow
Language: fr
Tags: dockstar,dokuwiki,nginx
*/
# HTTPS disponible grâce à StartSSL

## Enfin
Quelques mois après avoir fait le nécessaire au boulot j'ai enfin pris le temps de mettre en place le HTTPS sur mon Dockstar préféré. Vous pouvez donc essayer :

https://blog.slucas.fr

## Détail de la mise en place

### Source
*	http://technique.arscenic.org/ssl-securisation-des/article/startssl-utiliser-un-certificat
*	http://technique.arscenic.org/ssl-securisation-des/article/creation-d-un-certificate-signing

### Création d'un compte chez StartSSL

Je vous laisse créer le compte et utiliser le Validation Wizard pour valider que vous êtes bien propriétaire de votre site.

### Création de la clé et du CSR (Certificate Signing Request)

```
openssl genrsa -out slucas.fr.key 2048
openssl req -new -key slucas.fr.key -out slucas.fr.csr
```
Dans mon cas je n'ai pas mis de mot de passe sur le csr

### Transmission du CSR à StartSSL

Il faut ensuite aller dans le Certificate Wizard de StartSSL pour demander un Web Server SSL/TLS Certificate. On peut passer la première étape vu que nous avons déjà le CSR.
Au final nous allons récupérer 3 fichiers :
*	blog-startssl.crt : le certificat proprement dit qui s'applique à blog.slucas.fr
*	sub.class1.server.ca.pem
*	ca.pem

### Mise en place dans Nginx

```
cat blog-startssl.crt sub.class1.server.ca.pem ca.pem > /etc/nginx/ssl-blog.crt
cp slucas.fr.key /etc/nginx/
```
il ne reste plus qu'à créer un nouveau site dans nginx et redémarrer Nginx :

```
server {
        listen   [::]:443;
        ssl on;
        ssl_certificate      /etc/nginx/ssl-blog.crt;
        ssl_certificate_key  /etc/nginx/slucas.fr.key;
        server_name  blog.slucas.fr;

        access_log  /var/log/nginx/localhost_ssl.access.log;

        location / {
                proxy_pass http://blog.slucas.fr;
        }
}
```

### Premier test : non concluant

Le premier test n'a pas été concluant, Firefox m'a annoncé que la connexion était partiellement sécurisée. Après recherche cela était du à AddThis (pour la barre de droite) auquel j'accédais en HTTP, je l'ai passé en HTTPS et plus de problème.
