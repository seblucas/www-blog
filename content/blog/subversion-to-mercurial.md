/*
Title: Migration de Subversion vers Mercurial
Description: 
Author: Sébastien Lucas
Date: 2011/01/29
Robots: noindex,nofollow
Language: fr
Tags: mercurial,subversion
*/
# Migration de Subversion vers Mercurial

## Pourquoi
J'ai voulu faire un fork d'un projet actuellement sous Subversion accessible uniquement en https et cela n'a pas été si simple que ça.
## Pré-requis

il faut bien sur que mercurial soit installé et il faut aussi installer les binding python pour subversion :
```
aptitude install python-subversion
```
il faut aussi activer l'extension convert en modifiant le fichier /etc/mercurial/hgrc.d/hgext.rc et en décommantant la ligne 
```
#hgext.convert =

```
## Lancement de la conversion : 1er essai

```
hg convert https://www.domaine.com/repos/Commun/Projet/SousProjet test-hg
```
l'url du dépôt subversion peut sembler complexe car il a plusieurs projets dans le dépôt (c'est dans le répertoire SousProjet qu'on trouve trunk, tags et branches). Au final cette méthode n'a pas fonctionné je pense que c'est du au fait que le dépôt est en https avec un certificat autosigné.
## Lancement de la conversion : 2ième essai

### Création d'un mirroir Subversion du dépôt

*	Création du dépôt
```
svnadmin create svn-mirror
```

*	Création du fichier svn-mirror/hooks/pre-revprop-change (avec vi ou autre)
```
#!/bin/sh

exit 0
```

*	Rendre le fichier précédent exécutable
```
chmod +x svn-mirror/hooks/pre-revprop-change
```

*	Mettre à jour le mirroir local (remplacer /home/user par le chemin qui vous correspond)
```
svnsync init file:///home/user/svn-mirror https://www.domaine.com/repos/Commun
svnsync sync file:///home/user/svn-mirror
```
### Utilisation de convert en local

```
hg convert file:///home/user/svn-mirror/Projet/SousProjet test-hg
```
Ca marche !





