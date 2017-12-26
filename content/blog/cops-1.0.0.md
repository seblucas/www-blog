---
title: "COPS 1.0.0"
date: 2016-07-08
tags: [calibre,ereader,nginx,opds,php]
slug: cops-1.0.0
---
# COPS 1.0.0

Quasiment deux ans ;) et beaucoup de corrections de bugs et quelques évolutions pour cette nouvelle version :

* [Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)
* [Liste des changements](/fr/oss/calibre-opds-php-server-changelog)

## Ajout de la translittération

[La translittération, quésaco](https://fr.wikipedia.org/wiki/Transcription_et_translitt%C3%A9ration) ?

Cela permet notamment de faciliter la recherche pour les langues non latines (slaves et grecques par exemple). Cela permet de résoudre aussi des recherches de mots avec accents français.

Attention cela impacte fortement les performances de la recherche.

## Ajout de la gestion des colonnes personnalisées

La gestion des colonnes personnalisées de COPS était partielle depuis quelques années, elle devient complète grace à un Pull Request de Mike Schwörer.

Pour la configuration, regardez [ces lignes](https://github.com/seblucas/cops/blob/master/config_default.php#L173-L201) du fichier `config_default.php`.

## Merci aux contributeurs et donateurs

Merci beaucoup aux nombreux contributeurs qui m'ont redonné de la motivation au moment ou elle baissait beaucoup. A noter qu'il y a beaucoup plus de code écrit par des contributeurs que par moi, je dois dire que cela me motive encore plus.

Un gros merci aux traducteurs, COPS est maintenant disponible en 26 langues ! A noter que si vous voulez participer tout se passe maintenant sur [Transifex](https://www.transifex.com/projects/p/cops/).

## Avenir de COPS : COPS 2.0

Le plan général est d'avoir d'un côté une API REST en PHP et de l'autre autant de clients que possible (HTML, Android, IOS, Windows, ...).

La réécriture a subi de nombreux coups d'arrêt suite à des problèmes personnels et un vrai travail assez stressant par moment. Mais je pense être arrivé à un état [montrable](https://github.com/seblucas/cops/issues/279). La partie interface graphique HTML est disponible sur [Github](https://github.com/seblucas/cops-html-ui). La partie API en PHP ne l'est pas pour le moment (voir la suite).

Il reste beaucoup à faire mais mon seul objectif maintenant est de changer le [framework PHP](https://github.com/vlucas/bulletphp) que j'ai utilisé pour l'API par quelque chose de plus reconnu avec une plus grande base de développeurs : pour le moment ce sera [Silex](http://silex.sensiolabs.org/).

Je vais faire comme George R. R. Martin et ne pas donner de date, je partagerai les sources de l'API dès que la migration sera au moins entamée et je ferai un appel à l'aide pour m'aider à finir le plus vite possible.

## Merci ;)

Comme d'habitude merci à tous les contributeurs, traducteurs et testeurs.

Bon test à vous et bonne vacances par avance.
