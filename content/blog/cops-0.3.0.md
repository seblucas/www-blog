/*
Title: COPS 0.3.0
Description: 
Author: Sébastien Lucas
Date: 2013/01/06
Robots: noindex,nofollow
Language: fr
Tags: calibre,ereader,nginx,opds,php
*/
# COPS 0.3.0

Pour cette nouvelle version, beaucoup de nouvelles fonctionnalités :

*	[Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)

*	[Liste des changements](/fr/oss/calibre-opds-php-server-changelog)

Le plus gros changement est la mise à jour des métadonnées des fichiers Epub lors du téléchargement. Pour le moment il faut l'activer manuellement via le paramètre "cops_update_epub-metadata". La mise à jour concerne les éléments suivants :

*	Titre

*	Auteur

*	Série

*	Index du livre dans la série

*	Étiquettes (tags)

*	Résumé

Il me reste à traiter :

*	La couverture

*	les liens ISBN / Google / Amazon

*	L'éditeur

*	La date de parution

Même si je pense l'avoir bien testé, je conseille d'actualiser votre sauvegarde avant d'activer le paramètre.

J'ai aussi ajouté la possibilité de désactiver les popup qui apparaissent pour visualiser le détail d'un livre (paramètre "cops_use_fancyapps"), cela peut faciliter l'usage sur les Sony PRS-T1 par exemple.

J'ai aussi ajouté un permalien (à gauche du titre du livre dans le détail) permettant de facilement donner le lien d'un livre à un ami.

Enfin pour mieux diagnostiquer les cas ou COPS est mal configuré, j'ai ajouté une page checkconfig.php qui permet de valider la bonne configuration du serveur et de COPS.

Bonne année 2013 à tous et bon test à vous.
