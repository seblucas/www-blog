/*
Title: COPS 0.3.1
Description: 
Author: Sébastien Lucas
Date: 2013/01/27
Robots: noindex,nofollow
Language: fr
Tags: calibre,ereader,nginx,opds,php
*/
# COPS 0.3.1

Pour cette nouvelle version, quelques nouvelles fonctionnalités :
*	[Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)
*	[Liste des changements](/fr/oss/calibre-opds-php-server-changelog)

La principale motivation de cette nouvelle version est la rationalisation du paramétrage pour la préparation d'un SPK (package Synology). Oui vous avez bien entendu, cela devrait arriver dans les jours / semaines qui viennent.

Ensuite j'ai aussi ajouté un paramétrage qui me tenait à cœur pour activer la [recherche à facettes](http://fr.wikipedia.org/wiki/Recherche_%C3%A0_facettes) (ou en [anglais](http://opds-spec.org/2011/06/14/faceted-search-browsing/)) dans le catalogue OPDS. Grosso modo cela me permet de pouvoir filtrer chaque liste de livres en fonction de Tags. J'ai par exemple un Tag Read que j'ai affecté à chaque livre que j'ai déjà lu. Avec le paramétrage suivant :

```
$config['cops_books_filter'] = array ("Tout" => "", "Non lu" => "!Read", "Lu" => "Read")
```

Je peux afficher facilement uniquement les livres non lus si besoin. Attention seul Mantano Reader (Android) et Bluefire (IOS) supportent ces fonctionnalités (Si vous êtes un fan d'un autre client OPDS, demandez à l'auteur d'ajouter le support). Le même type de filtre sera ajouté sur le catalogue HTML dans un prochaine version.

J'ai aussi ajouté un support basique des colonnes personnalisées de Calibre (pour l'instant seulement quelques types).

Enfin si vous possédez un autre NAS qu'un Synology (QNap, ReadyNas, ...) et que votre NAS supporte l'installation d'outils via des packages, essayez d'en savoir plus, je ne pourrai certainement pas faire le package (sans le matériel pour tester c'est impossible) mais j'aiderai du mieux que je peux.

Bon test à vous.
