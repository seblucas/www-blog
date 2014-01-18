/*
Title: Installation des VMWare Tools sur une Squeeze
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Installation des VMWare Tools sur une Squeeze

## Pourquoi c'est pas si simple
J'utilise au boulot VMWare Server en dernière version à ce jour (2.0.2) qui par défaut donne une version très ancienne des VMWare Tools. Ces VMWare Tools ne compile donc pas avec un noyau récent.

Suite à cela j'ai essayé [open-vm-tools](http://open-vm-tools.sourceforge.net/) (une version open source des VMWare tools). Ce package est disponible en contrib dans Squeeze avec la commande suivante :
```
aptitude install --without-recommends open-vm-tools open-vm-dkms
```
Le --without-recommends permet d'installer les outils dans le driver X (inutile pour un serveur headless). Cela semble marcher mais j'ai préféré prendre les outils officiels en attendant que ces outils soient un peu plus reconnus.
## Récupérer un linux.iso récent

Personnellement, j'ai utilisé un VMWare Player récent sous Linux. Le fichier linux.iso est trouvable dans le répertoire suivant /usr/share/vmware/isoimages si il n'existe pas il suffit de créer une nouvelle machine virtuelle debian par exemple et il va le télécharger automatiquement.
## Installation

*	Faire pointer le lecteur CD virtuel de la machine virtuelle vers linux.iso

*	Monter le cd dans la machine virtuelle

*	Décompresser l'archive
```
tar xvzf /media/cdrom/VMwareTools-8.4.3-282343.tar.gz -C .
```

*	lancer l'installation
```
cd vmware-tools-distrib/
./vmware-install.pl
```

*	Voila c'est fini

