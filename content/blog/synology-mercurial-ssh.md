/*
Title: Installer un serveur Mercurial sur un NAS Synology
Description: 
Author: Sébastien Lucas
Date: 2011/11/27
Robots: noindex,nofollow
Language: fr
*/
# Installer un serveur Mercurial sur un NAS Synology

## Historique
Cela fait maintenant quasiment deux ans que j'ai fait ce genre de modification mais je n'ai jamais eu le temps de le documenter. Je vais essayer de rattraper ce retard. Par contre je vous conseille de lire le précédent article dédié à Subversion ([Installer un serveur Subversion sur un NAS Synology](/blog/synology-subversion-ssh)) avant de me lire.

## Installation du package

```
ipkg install py26-mercurial
```
Cela peut prendre du temps car il va aussi installer python.
## Paramétrage du push via ssh

### Pré-requis
Je vais réutiliser le même user que pour Subversion (svn) mais rien de vous empêche d'en créer un spécifique.
### Préparation de l'accès ssh

De la même façon que pour Subversion il faut que la commande hg soit accessible immédiatement après la connexion ssh donc je fais un lien dans /usr/bin :
```
cd /usr/bin/
ln -s /opt/bin/hg hg
```
### Création d'un nouveau dépôt

```
cd /volume1/hg/
hg init newrepo
```
### Premier clone

Simple : 
```
hg clone ssh://svn@`<IP DU NAS>`///volume1/hg/newrepo
```
### Utilisation de clé privée/publique

Comme indiqué dans l'article concernant Subversion, pour gagner du temps je vous conseille d'utiliser des clés (avec pageant ou ssh-agent). Je ferai l'article prochainement.

