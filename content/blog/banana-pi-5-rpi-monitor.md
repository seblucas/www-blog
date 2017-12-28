---
title: "Banana Pi - Mise en place de RPI-Monitor"
date: 2014-11-02
tags: [bpi]
slug: banana-pi-5-rpi-monitor
disqus_identifier: /blog/banana-pi-5-rpi-monitor
---
# Banana Pi - Mise en place de RPI-Monitor

## A quoi ça sert ?

[RPI-Monitor](http://rpi-experiences.blogspot.fr/p/rpi-monitor.html) ... à rien ! Cela me permet juste d'avoir une supervision minimaliste de mon Banana Pi. J'ai vu [un post](http://forum.lemaker.org/thread-8137-1-1-.html) sur le forum de LeMaker et j'ai voulu tester.

## L'installation

Je n'ai rien à ajouter à la méthode d'installation proposée par [tkaiser](http://forum.lemaker.org/thread-8137-1-1-.html) auquel il faut ajouter l'installation de [RPI-Monitor](http://rpi-experiences.blogspot.fr/p/rpi-monitor-installation.html). Elle a fonctionné parfaitement et les adaptations pour la Banana Pi marchent.

J'aime notamment le principe de son script `temp_daemon.sh` qui permet de gérer finement la fréquence d'actualisation sans bidouiller RPI-Monitor

## Accès via Nginx

Les ports 80 et 443 de mon Banana Pi sont exportés sur ma Freebox , je veux donc avoir accès à RPI-Monitor de partout. J'ai donc préparé un certificat SSL avec [StartSLL](https-ready), un fichier de mot de passe et cela m'a donné le fichier de configuration nginx suivant :

```nginx
server {
        listen   [::]:443;
        ssl on;
        ssl_certificate      /etc/nginx/XXX.crt;
        ssl_certificate_key  /etc/nginx/XXX.key;
        server_name  MY_DOMAIN;

        access_log  off;
        error_log off;

        location /rpimonitor/ {
                proxy_pass http://localhost:8888;
                auth_basic            "Access Restricted";
                auth_basic_user_file  "/etc/nginx/myPasswordFile";
        }

}

```

J'ai fait le choix de ne servir les pages qu'en HTTPS sans faire de redirection automatique car je vais être le principal utilisateur de cette page donc ce n'est pas la peine.

Ça marche très bien et je suis pleinement satisfait.

## Bilan

L'interface est vraiment jolie. Cela permet d'avoir pas mal d'informations en un coup d’œil. Cela m'a aussi permis de pouvoir vérifier une théorie sur la meilleure position du Banana Pi pour une meilleure efficacité pour la dissipation thermique.