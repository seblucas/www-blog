---
title: "Freebox et UPnP"
date: 2010-09-26
tags: [freebox,iptables,upnp]
slug: freebox-upnp
---
# Freebox et UPnP

Depuis mi mai la Freebox HD peut se connecter à des serveurs [UPnP](http://fr.wikipedia.org/wiki/Special:Search?search=UPnP). Cela fonctionne quasiment nativement sous Windows XP / Vista grâce au serveur intégré à Windows Media Player 11. Par contre sous Linux c'est un peu plus compliqué si on veut éviter les usines à gaz.

## L'offre

Il existe plusieurs solutions sous Linux :

* [XBMC](http://www.xbmc.org) : il est très bien mais si le but est uniquement d'avoir un serveur UPnP c'est la grosse artillerie d'autant plus sur un serveur sans X.
* [MediaTomb](http://mediatomb.cc) : Il a de très bons echos mais comme il a besoin d'une base mysql je ne l'ai pas testé.
* [UShare](http://ushare.geexbox.org/) : Très léger, simple à configurer. Par contre il n'est plus développé.

Update 14/06/2009 :
Après des tests plus approfondis de UShare et quelques déceptions, mon choix s'est finalement porté sur Mediatomb qui contrairement à ce j'ai dit n'a pas besoin de mysql.

## Installation d'UShare

La compilation de ushare est relativement simple. La seule dépendance est libupnp :

```
aptitude install libupnp-dev
```

Par contre l'installation est plus que compliqué sur une debian pour que le script de lancement automatique (init.d) s'installe ou il faut. Il faut vraiment jouer sur tous les paramètres (--prefix et --sysconfdir) du fichier configure pour y arriver.

A l'usage ushare a les désavantages suivants :
* Mauvaise gestion (ou pas de gestion du tout) des sous-répertoires.
* Pas de mise à jour automatique en cas d'ajout d'un fichier dans un partage upnp. La seule solution est de mettre une commande du style wget http://monAdresseIP:monPort/web/ushare.cgi?action=refresh dans la cron.
* Documentation pas forcement à jour (le projet étant arrêté cela n'est pas étonnant).

## Mediatomb

### Installation
Suite à mes remarques négatives sur ushare j'ai installé Mediatomb. L'installation est toute simple (un paquet existe) :

```
aptitude install mediatomb
```

La configuration se fait ensuite via l'interface Web : http://adresseIPDuServeur:49152 (voir éventuellement le chapitre suivant sur iptables).

Avant d'ajouter les répertoires, je vous conseille :

* Bien vérifier que vos répertoires et fichiers à partager sont bien lisibles par tout le monde (éventuellement un petit chmod a+r -R peut aider).
* Modifier le fichier de configuration de mediatomb pour ajouter la gestion des mkv et des ts qui sont lisibles par la Freebox. Il faut ajouter les lignes suivantes dans le fichier /etc/mediatomb/config.xml

```
<map from="mkv" to="video/x-matroska"/>
<map from="ts" to="video/mp2t"/>
```

Il ne vous reste plus qu'à ajouter vos répertoires, personnellement je choisi toujours :

* Scan Mode : Inotify.
* Initial Scan : Full
* Recursive : Yes

### En cas d'erreur

J'ai eu un problème ou Mediatomb état inaccessible après le boot. Un restart du service corrige le problème à tout les coups. J'ai regardé le log (/var/log/mediatomb) et je suis tombé sur ce genre d'erreur :

```
2010-09-12 07:38:39    INFO: Loading configuration from: /etc/mediatomb/config.x
ml
2010-09-12 07:38:39    INFO: Checking configuration...
2010-09-12 07:38:39    INFO: Setting filesystem import charset to ANSI_X3.4-1968
2010-09-12 07:38:39    INFO: Setting metadata import charset to ANSI_X3.4-1968
2010-09-12 07:38:39    INFO: Setting playlist charset to ANSI_X3.4-1968
2010-09-12 07:38:39    INFO: Configuration check succeeded.
2010-09-12 07:38:39   ERROR: main: upnp error -117
2010-09-12 07:38:39   ERROR: upnp_cleanup: UpnpUnRegisterRootDevice failed
```
Il m'a semblé que Mediatomb démarre avant que la carte réseau ne soit prête. Pour corriger cela j'ai ajouté un restart du service dès que la carte réseau est prête, j'ai donc ajouté le ficher suivant dans /etc/network/if-up.d/ :

```-
#!/bin/sh
/etc/init.d/mediatomb restart
```
Il ne reste qu'à rendre le fichier exécutable.

```
chmod +x /etc/network/if-up.d/mediatomb
```

## Comment configurer le firewall pour un serveur UPnP

Les règles à mettre en place sont assez simples pour autoriser l'accès sur le réseau local :

```
# Accès upnp sur le réseau local
iptables -A INPUT -s 192.168.0.0/24 -m tcp -p tcp --dport 49152 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -m udp -p udp --dport 49152 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -m udp -p udp --dport 1900 -j ACCEPT
```

Attention au port, le port par défaut d'UShare est le 49152, je n'ai pas trouvé d'informations sur le vrai standard à ce sujet (je n'ai pas beaucoup cherché non plus). Vérifiez bien le port utilisé par votre serveur UPnP.

Avec cette configuration vos autres ordinateurs peuvent accéder au serveur, ce n'est pas encore le cas pour la Freebox HD.

## Accès pour la Freebox HD

J'ai été un peu bourrin dans le sens ou je fais une confiance totale à la Freebox, je lui autorise un accès complet sur tous les ports :

```
# On accepte tout ce qui vient/va de la Freebox HD
iptables -A INPUT -s 212.27.40.254 -j ACCEPT
```

Pour information l'adresse IP ci dessus correspond à hd1.freebox.fr qui correspond au boitier HD. On peut utiliser la même technique pour l'accès au multiposte avec cette fois ci l'adresse qui correspond à mafreebox.freebox.fr :

```
# On accepte tout ce qui vient/va de la Freebox
iptables -A INPUT -s 212.27.38.253 -j ACCEPT
```

