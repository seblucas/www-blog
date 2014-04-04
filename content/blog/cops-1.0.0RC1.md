/*
Title: COPS 1.0.0RC1
Description: 
Author: Sébastien Lucas
Date: 2014/04/04
Robots: noindex,nofollow
Language: fr
Tags: calibre,ereader,nginx,opds,php
*/
# COPS 1.0.0RC1

Quelques corrections de bugs et quelques évolutions pour cette nouvelle version :
*	[Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)
*	[Liste des changements](/fr/oss/calibre-opds-php-server-changelog)

Je pense avoir oublié de faire un billet sur la sortie de la version 0.9.0 donc cela va être plus long que d'habitude. Le point commun entre les deux versions est le fait d'intégrer un maximum de tests unitaires et de retravailler le code pour qu'il soit le plus lisible possible. Le projet a plus de deux ans et il devennait nécessaire de s'outiller afin de limiter les risques de bugs ou de régresssions.

## 0.9.0

Le point le plus important de la version 0.9.0 est la modification de la recherche pour qu'elle fonctionne avec de l'autocompletion et propose des résultats organisés par catégories.

La seconde évolution est le paramètre $config ['cops_ignored_categories'] qui permet d'ignorer des catégories (éditeur, étiquettes, ...). Cela peut aussi être modifier directement dans COPS.

## 1.0.0RC1

L'évolution la plus importante est l'ajout d'un lecteur d'Epub embarqué. J'ai du le coder quasiment entièrement en me basant sur [Monocle](https://github.com/joseph/monocle). Pour information, il est en beta test depuis septembre dernier et j'hésitais vraiment à le diffusion car j'avais des doutes sur sa légitimité. Pour l'utiliser il suffit de cliquer sur l'icone avec l'oeil dans le détail d'un livre.

Si vous constatez des problèmes avec ce module, je vous remercie de vérifier la [valididité](http://validator.idpf.org/) de votre livre avant de m'en faire part.

## Merci ;)

Comme d'habitude merci à tous les contributeurs et testeurs.

Bon test à vous.
