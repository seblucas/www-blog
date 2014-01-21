/*
Title: Installation de NoMachine
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: debian
*/
# Installation de NoMachine

## Introduction
Une fois n'est pas pas coutume, je préfère installer [NoMachine](http://www.nomachine.com/) (pas GPL) plutôt que vncserver ou vino pour accéder à distance à ma machine avec un interface graphique. J'ai trouvé l'installation de vncserver beaucoup trop compliquée avec beaucoup de modifications manuelles à faire pour avoir un accès authentifié (avec XDMCP(( [XDMCP](http://fr.wikipedia.org/wiki/Special:Search?search=XDMCP) ))). L'installation de NX est par contre enfantine.

## Installation de la partie serveur

*	Télécharger le client, node et serveur à l'adresse suivante http://www.nomachine.com/download-package.php?Prod_Id=5

*	Installer les dépendances

```
apt-get install libaudiofile0
```


*	Installer les 3 paquets

```
dpkg -i nxclient_`<Version>`_i386.deb 
dpkg -i nxnode_`<Version>`_i386.deb 
dpkg -i nxserver_`<Version>`_i386.deb 
```


*	C'est terminé
## Installer et configurer la partie cliente

### Installer le client NX
TODO : ajouter les liens
### Lancer NX Connection Wizard

{{:fr:debian:nxclient01.png|}}

*	Cliquer sur Next
### Configuration de l'ordinateur cible

{{:fr:debian:nxclient02.png|}}

*	Session : Nom avec lequel vous allez retrouver votre connection distante

*	Host : identifiant de la machine distante

*	Régler le type de connection pour que les performances soient bonnes
### Configuration du window manager de l'ordinateur cible

{{:fr:debian:nxclient03.png|}}

*	Première liste déroulante : laisser Unix

*	Deuxième liste déroulante : choisir Custom (il n'y a pas XFCE dans la liste).

*	Avant de pouvoir choisir la résolution il faut d'abord cliquer sur le bouton Settings
### Paramétrage XFCE

{{:fr:debian:nxclient04.png|}}

*	Dans "Run the following command" : saisir startxfce4.

*	Sélectionner "New virtual desktop".

*	Cliquer sur OK
### Sélection de la résolution

{{:fr:debian:nxclient05.png|}}

*	Je vous laisse choisir la résolution voulue

*	Cliquer sur Next
### Fin

{{:fr:debian:nxclient06.png|}}

*	Cliquer sur Finish
### Premier test

{{:fr:debian:nxclient07.png|}}

*	Renseignez votre nom d'utilisateur et mot de passe (comme pour une connection ssh normale) et voila !

