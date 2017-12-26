---
title: "Configurer SSL avec Apache"
date: 2010-09-29
tags: [apache]
slug: apache-https
---
# Configurer SSL avec Apache

## Génération des clés

### Installer openssl

```
aptitude install openssl
```

### Génération de la clé

```
openssl req -x509 -nodes -days 2000 -newkey rsa:1024 -out server.crt -keyout server.key
```
Attention : la durée de mon certificat est de 2000 jours, ce n'est pas forcement top en terme de sécurité.

Les deux fichiers générés sont à mettre dans /etc/apache2/ssl.

Pour plus de renseignements sur les questions posées ensuite voir : http://doc.ubuntu-fr.org/tutoriel/securiser_apache2_avec_ssl#creation_du_certificat

## Configuration d'Apache

Modifier le site pour ajouter les lignes suivantes :

```
SSLCertificateFile    /etc/apache2/ssl/server.crt
SSLCertificateKeyFile /etc/apache2/ssl/server.key
```





