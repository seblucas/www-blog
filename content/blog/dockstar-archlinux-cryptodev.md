/*
Title: Dockstar et ArchLinux : tout ça pour l'accélération matérielle
Description: 
Author: Sébastien Lucas
Date: 2012/04/17
Robots: noindex,nofollow
Language: fr
Tags: archlinux,dockstar
*/
# Dockstar et ArchLinux : tout ça pour l'accélération matérielle

## Pourquoi ?
Depuis le crash de ma clé USB en décembre, j'ai un peu laissé tomber le Dockstar pour me concentrer sur le serveur hébergé chez 1&1. Mais j'ai pu lire quelques articles sur le forum de Jeff Doozan ([un exemple ici](http://forum.doozan.com/read.php?2,6849)) qui m'ont donné envie de refaire quelques expérimentations amusantes (donc potentiellement inutiles).


## Installation de ArchLinux

### Préparation du Dockstar
Mon Dockstar était déjà prêt donc je n'ai rien eu à faire. Donc allez voir mes précédents articles si besoin.
### Téléchargement

```
wget http://archlinuxarm.org/os/ArchLinuxARM-armv5te-latest.tar.gz
```
### Préparation de la clé

Pour aller plus vite j'ai mis ma clé USB sur mon ordinateur portable (en dev/sdb). Je l'ai partitionné de la même manière que mon installation debian (sdb1 = partition /).
```
mk2fs /dev/sdb1
mkdir usb
mount /dev/sdb1 usb
cd usb
tar xvzf ../ArchLinuxARM-armv5te-latest.tar.gz
sync
cd ..
umount usb
```
### Boot

Au boot on démarre directement sur notre ArchLinux (mot de passe root/root).
## Accélération matérielle des algorithmes de cryptage

### mv_cesa / cryptodev
Notre Dockstar possède une unité de calcul cryptographique dédiée avec notamment la prise en charge du AES. Mon objectif était que tous les programmes qui doivent chiffrer des informations puissent le faire via le matériel, en effet il y a :

*	l'accès SSH

*	Le transfert via SFTP

*	Un VPN OpenVPN

*	Un site Web en HTTPS

*	...
  
Le moyen le plus propre est d'utiliser le module noyau crytodev que la bibliothèque openssl qui peut l'utiliser si elle est compilée pour.
### Installation

#### Installation du package
```
pacman -Syyuf
pacman -S openssl-cryptodev
```
Il faut accepter tout ce qu'il propose (désinstaller le package openssl notamment).
#### Modification des règles udev

```
echo '"KERNEL=="crypto", MODE="0666"' > /etc/udev/rules.d/99-cryptodev.rules
```
#### Ajout du chargement du module

Ajout le module cryptodev dans le fichier /etc/rc.conf :
```
MODULES=(cryptodev)
```
#### Reboot et test

Après un reboot vous devriez avoir ce genre de sortie :
```
[root@alarm ~]# openssl engine
(cryptodev) BSD cryptodev engine
(dynamic) Dynamic engine loading support
```
### Bench Openssl

Test avec l'accélération matérielle :
```
openssl speed -elapsed -evp aes-128-cbc
openssl speed -elapsed -evp aes-256-cbc
```

Attention au paramètre -elapsed qui est très important pour pouvoir comparer une implémentation matérielle et logicielle. Sans ce paramètre les chiffres ne sont pas comparables.

Pour le avant / après un petit graphique :

{{ :blog:grapheopenssl.png? |}}

On voit que l'implémentation matérielle est nettement moins rapide avec des blocs de petite taille mais se rattrape à partir des blocs d'un Ko.

### Bench iperf

Merci à thana54 sur HFR qui m'a bien aidé (voir [ici](http://forum.hardware.fr/hfr/OSAlternatifs/Hardware-2/seagate-dockstar-computer-sujet_71314_86.htm#t1308661)).

Pour ce test je fais un test iperf via un tunnel crypté SSH.

Sur le dockstar : 
```
iperf -s
```

Sur une autre machine Linux de test (en réseau filaire), on créé le tunnel :
```
ssh -L 5001:localhost:5001 IPDockstar 
```

Sur cette même machine on lance iperf :
```
iperf -c 127.0.0.1 -t 60 -i 10
```

Bilan :

*	Avec support matériel : 60Mbits/sec.

*	Sans support matériel : 45Mbits/sec.

Pour information un iperf sans tunnel SSH sature sans problème un tuyau à 100Mbits/sec (environ 310Mbits/sec pour thana54).

Un petit graphe :

{{ :blog:grapheiperf.png? |}}

### Source

*	Installation : http://archlinuxarm.org/forum/viewtopic.php?f=30&t=2452

*	Modalité de test : http://vdupain.wordpress.com/2010/10/15/debits-vpn/

*	Le post qui a tout déclenché : http://www.altechnative.net/2011/05/22/hardware-accelerated-ssl-on-marvell-kirkwood-arm-using-openssl-on-fedora/

