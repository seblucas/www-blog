/*
Title: Installation de Owncloud 4.5.X avec Debian et Nginx
Description: 
Author: Sébastien Lucas
Date: 2012/11/28
Robots: noindex,nofollow
*/
# Installation de Owncloud 4.5.X avec Debian et Nginx

C'est l'outil que j'utilise en remplacement de Dropbox notamment pour synchroniser ma bibliothèque Calibre pour COPS. Pour l'instant j'en suis assez satisfait.

## Installation

### Pré-requis
Pour les dépendances c'est exactement pareil que pour la version 4.0.X (voir [Installation de Owncloud 4.0.2 avec Debian et Nginx](blog/owncloud-4-install-debian-nginx)).
### Suppression de l'ancienne installation et installation propre

Comme j'avais lu que la mise à jour posait problème, j'ai choisi la simplicité et j'ai supprimé mon répertoire owncloud et j'ai réinstallé (encore une fois vous pouvez suivre le précédent tutoriel en remplaçant le numéro de version par 4.5.3 pour la dernière version à la date d'écriture de ce billet).

Ensuite si vous avez quelques Go dans votre cloud vous pouvez tenter la mise à jour.
### Configuration Nginx et patches

J'ai laissé ma configuration Nginx identique à la version précédente et je n'ai pas été obligé de modifier les sources : cela fonctionne donc maintenant correctement avec Nginx à la place d'Apache.
## Bilan

Le nouvel outil de synchronisation (1.1.1) marche mieux. Je n'ai pas essayé pour le moment la synchronisation de l'agenda ou des contacts avec mon compte Gmail ou mon téléphone Android.

En tout cas pour mon utilisation de partage de la bibliothèque Calibre cela fonctionne très bien.

Un petit détail : mes logs sont saturés de messages d'avertissement liés à l'utilisation de Xcache. Je n'ai as trouvé de solution pour le moment, juste des explications ne faisant pas avancer le problème : 

*	http://stackoverflow.com/questions/2976829/xcache-var-size-error

*	http://forum.owncloud.org/viewtopic.php?f=3&t=4547
