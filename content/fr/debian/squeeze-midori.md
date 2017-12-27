/*
Title: Midori : l'autre navigateur Web
Date: 2012/11/10
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: debian,xfce
*/
# Midori : l'autre navigateur Web

## Encore un !!
C'est ce que je me suis dit aussi au début, en plus des classiques Opera, Firefox, Chrome, .... chaque gestionnaire de fenêtre essaye de pousser son navigateur. 

Un petit historique, j'ai commencé à l'utiliser sur un vieux portable PIII-1,1GHz avec 256Mo de RAM. Ce n'est pas un foudre de guerre et avec Iceweasel (firefox à la sauce Debian) cela ramait encore plus. J'ai donc essayé Midori à ce moment là et cela a vraiment redonner une jeunesse à ce portable. J'ai donc donné une chance à ce navigateur sur mon ordinateur principal et je reste fan.

## Midori ?

Midori est un navigateur créé par le projet Xfce dans le but d'avoir quelque chose de simple et leger. La faq complète est [ici](http://wiki.xfce.org/midori/faq). La page wikipedia est bien faite et une fois n'est pas coutume la page française est plus fournie que l'anglaise : http://fr.wikipedia.org/wiki/Midori_(navigateur). J'ai aussi trouvé un petit comparatif de vitesse : http://www.n1fo.fr/2009/12/benchmark-navigateurs-internet-2eme-partie-sous-ubuntu-le-18-decembre/.

## Installation

```
aptitude install midori
```

## Améliorer l'expérience

### Rendre midori navigateur par defaut

*	Installer galternatives

```
aptitude install galternatives
```

*	Le lancer (il doit demande le mot de passe root)
*	Sélectionner x-www-browser et mettez midori comme choix.

### Changer le user-agent

La majorité des sites ne supportent pas midori en temps que tel, je conseille donc de changer le user-agent en safari (onglet réseau des préférences).

### Changer le fonctionnement des onglets

Par défaut un CTRL+clic ouvre les onglets à coté de l'onglet courant, je préfère que les nouveaux onglets soient ouvert tout à la fin :

*	Edition -> Préférences
*	Onglet Interface
*	Décocher Ouvrir les onglets à côté de l'actuel 

### Mettre en place le correcteur orthographique

*	Edition -> Préférences
*	Onglet Comportement
*	Cocher Activer la vérification de l'orthographe
*	indiquer fr_FR comme dictionnaire.

Pour éviter de vous arracher les cheveux comme moi, pour corriger une faute il faut que le mot entier soit sélectionné (via une double click par exemple) avant de cliquer sur le bouton droit.

### Configurer les plugins

*	Outils -> Extensions

### Debogger une page "à la firebug"

*	Outils -> Inspecter la page

### Importer ses signets de Firefox

http://libre-et-ouvert.blogspot.com/2009/03/importer-ses-marque-pages-firefox-dans.html

### Installer flash

J'ai juste installé le paquet flashplugin-nonfree et tout a fonctionné.
De temps en temps dans Youtube la video devient grise : CTRL+F5 solutionne le problème.

### Liens intéressants

*	http://doc.slitaz.org/en:guides:midori

