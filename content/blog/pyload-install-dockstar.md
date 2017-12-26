---
title: "Installation de pyLoad sur un Seagate Dockstar / Debian Squeeze"
date: 2011-09-11
tags: [debian,dockstar,iptables,nginx,python]
slug: pyload-install-dockstar
---
# Installation de pyLoad sur un Seagate Dockstar / Debian Squeeze

## Quoi ?
On parle de [pyLoad](http://pyload.org/).

## Installation

### Dépendances

```bash
apt-get install python-crypto python-pycurl tesseract-ocr spidermonkey-bin python-imaging
```

### Création d'un utilisateur spécifique

```bash
adduser pyload
```

### Installation de pyLoad

On va se connecter sous l'utilisateur pyload que nous venons de créer :

```bash
su - pyload
```
et on installe :

```bash
wget http://get.pyload.org/get/src/
mv index.html pyload-src-v0.4.7.zip
unzip pyload-src-v0.4.7.zip
cd pyload
./pyLoadCore.py -s
```
Au niveau de la configuration j'ai tout laissé par défaut (sauf pour la langue en fr) y compris l'accès pour toutes les IPs (0.0.0.0).

### Ajout des règles iptables

```bash
iptables -A INPUT -p tcp -s 192.168.0.0/24 --dport 8000 -j ACCEPT
```

### Premier lancement et test

Je vous conseille de lancer pyLoad en mode debug afin de tester que tout fonctionne bien.

```bash
./pyLoadCore.py -d
```
et vous pouvez lancer votre navigateur préféré sur l'adresse http://AdresseDeVotreDockstar:8000.

### Démarrage manuel

Si vous voulez lancer manuellement pyload en mode démon :

```bash
./pyLoadCore.py --daemon
```
et pour l'arrêter :

```bash
./pyLoadCore.py --quit
```

## Démarrage automatique

J'ai créé un script simple à mettre dans /etc/init.d/pyload :

```bash
#!/bin/sh
### BEGIN INIT INFO
# Provides: pyload
# Required-Start: $all
# Required-Stop:
# Default-Start: 2 3 4 5
# Default-Stop: 0 1 6
# Short-Description: start pyLoad
# Description: start pyLoad
### END INIT INFO

case "$1" in
start)
  echo "Starting pyLoad."
  su -c "/home/pyload/pyload/pyLoadCore.py --configdir=/home/pyload/.pyload --daemon" pyload
;;
stop)
  echo "Shutting down pyLoad."
   su -c "/home/pyload/pyload/pyLoadCore.py --quit" pyload
;;
*)
  echo "Usage: $0 {start|stop}"
  exit 1
esac

exit 0
```

Il ne reste plus qu'à rendre le script exécutable et la planifier dans les scripts de démarrage/arrêt.

```
chmod +x /etc/init.d/pyload
update-rc.d pyload defaults
```

## Reverse proxy avec nginx

j'ai ajouté un nouveau sous domaine pour que pyLoad soit accessible de partout :

```
server {
        listen [::]:80;

        server_name YOURDOMAIN;

        access_log  /var/log/nginx/pyload.access.log;
        error_log  /var/log/nginx/pyload.error.log;

        location / {
                proxy_pass http://127.0.0.1:8000/;
                proxy_set_header    Host YOURDOMAIN;
                proxy_redirect http://YOURDOMAIN:8000 /;
                proxy_redirect http://localhost:8000 /;
                proxy_redirect http://127.0.0.1:8000 /;

        }

}
```






