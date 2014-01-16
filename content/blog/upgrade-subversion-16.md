/*
Title: Mise à jour vers Subversion 1.6
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Mise à jour vers Subversion 1.6

## Subversion 1.6
La version 1.6 de subversion complète les ajouts de la version 1.5 notamment au niveau du sharding. Grosso modo la sharding (je n'ai pas trouvé de traduction française correcte) fait baisser de façon important le nombre de fichiers et répertoires dans les dépôts subversion. C'est notamment important car certains système de fichiers ont un nombre de répertoires limités et de manière générales les systèmes de fichiers ont des performances moindres quand le nombre de fichiers et/ou de répertoires augmente (NTFS par exemple). La version 1.6 ajout le fait de compresser les shard pour encore réduire le nombre de fichiers et faciliter la mise en cache et réduire les I/O.

Lien utiles :

*	http://subversion.apache.org/docs/release-notes/1.6.html

*	http://subversion.apache.org/docs/release-notes/1.5.html

*	http://softwareproductionengineering.blogspot.com/2010/07/subversion-case-sensitivity-svnadmin.html
## Pack

la commande doit être logiquement la suivante :

	
	svnadmin pack dépôt

En pratique mes dépôts sont trop anciens (portés des la version 1.2) et le svnadmin upgrade de la 1.5 n'a pas du créer les shards correctement. Donc la commande précédente n'a rien donné. J'ai donc été amené à porter l'ensemble de mes dépôts.
## Mise à jour complète des dépôts

### Déplacement du répertoire subversion

	
	cd /var/
	mv svn svn-old
	mkdir svn

### Conversion

`<code bash upgradeSvn16.sh>`
#!/bin/bash

cd svn-old
dirList=$(find . -maxdepth 1 -type d)
cd ..
for directory in $dirList; do
  if [ $directory != "." ]( $directory != "." )
  then
    svnadmin create svn/$directory
    svnadmin dump svn-old/$directory | svnadmin load svn/$directory
    svnadmin pack svn/$directory
    chown -R :www-data svn/$directory
    chmod -R g+w svn/$directory
  fi
done
`</code>`
Télécharger et installer le script ci-dessus dans /var et quelques heures plus tard l'ensemble de vos dépôts sont entièrement 1.6.

## Bilan

Dans mon cas le gain de place est minime (quelques Mo) par contre la migration a fait baisser le nombre de fichiers d'un tiers.


