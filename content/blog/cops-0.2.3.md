/*
Title: COPS 0.2.3
Description: 
Author: Sébastien Lucas
Date: 2012/12/06
Robots: noindex,nofollow
*/
# COPS 0.2.3

Pour cette nouvelle version, quelques nouvelles fonctionnalités :

*	[Voici COPS : Calibre OPDS PHP Serveur](fr/oss/calibre-opds-php-server)

*	[Liste des changements](fr/oss/calibre-opds-php-server-changelog)

Le plus gros changement est que l'intégration au Nas Synology et donc aux autres système avec Apache est complète, il ne manque plus qu'un package officiel pour faciliter l'installation. J'ai aussi ajouté les évaluations associées aux livre ainsi que la langue du livre dans le détail.

Pour la prochaine version, il faudrait que j'intègre des [Facets](http://opds-spec.org/2011/06/14/faceted-search-browsing/) dans le catalogue OPDS afin de pouvoir filtrer tout le catalogue par langue.

A noter que je suis en cours d'écriture d'un petite bibliothèque de gestion des métadonnées Epub en PHP pour pouvoir mettre à jour les Epub téléchargés en fonction des modifications effectuées dans Calibre. Je pensais réutiliser une bibliothèque existante mais je n'ai rien trouvé qui me convienne.

Bon test à vous.
