/*
Title: Version mobile du template Arctic pour Dokuwiki
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: android,dokuwiki
*/
# Version mobile du template Arctic pour Dokuwiki

## Pourquoi ?
Le template utilisé sur ce site est [Arctic](http://www.dokuwiki.org/template:arctic) et le résultat me plait dans un navigateur traditionnel. Mais le résultat est nettement plus discutable avec un navigateur d'un smartphone (iphone, android, bada, blackberry, Symbian, Windows Phone et autres tablettes) pour les raisons suivantes :
*	La sidebar de droite n'est pas adaptée à un périphérique avec une faible largeur.
*	Les marges et autres padding doivent être réduits pour avoir le maximum de surface pour le texte.
*	Il faut indiquer au navigateur mobile qu'il ne doit pas faire de zoom (se faire passer comme un navigateur de PC traditionnel).

## Les solutions existantes

A ma connaissance, Dokuwiki ne permet pas la personnalisation du template par visiteur (via un cookie par exemple). J'ai vu des plugins ou des modifications du coeur de Dokuwiki pour mettre en place du multitemplate (voir [ici](http://www.dokuwiki.org/plugin:multitemplate_styleman) ou [là](http://www.dokuwiki.org/template:multitemplate)) mais à chaque fois c'est trop ancien pour être utilisé sur ma version de Dokuwiki. D'autre part, j'ai lu (mais j'ai perdu la source) que le multitemplate occasionnait des problèmes avec le cache (à confirmer).

Une autre solution consiste à avoir une arborescence et des pages différentes pour les mobiles (ou encore un autre dokuwiki synchronisé avec le premier et un template mobile uniquement). Personnellement ça ne plait pas de dupliquer l'information, j'ai donc écarté cette solution (d'autant plus que ça complique le référencement). 

Ensuite j'ai suivi ce [sujet](http://forum.dokuwiki.org/thread/5270) du forum Dokuwiki ou j'ai appris pas mal de choses sur les manières de gérer la problématique : 
*	$INFO['ismobile'] ou clientismobile() permet de savoir si le navigateur est mobile ou non. Par contre les smartphones récents (vrai navigateurs) et les plus anciens (wap) sont mélangés.
*	Des modifications de template.php permettent d'avoir un template différent pour les mobiles.

Au final ces solutions ne me plaisent pas énormément.

## La CSS à la rescousse

La solution que j'ai préférée est d'ajouter une CSS spécifique aux smartphones qui va surcharger les CSS du template. Au final les smartphones auront plus de boulot mais cela simplifie le fonctionnement.

L'objectif de la CSS spécifique au mobiles est :
*	Réduire les marges et la padding.
*	Enlever les consignes float (le rendu donnera une colonne unique avec les sidebar tout en bas).
*	Maximiser la taille des div.

Au final cela ne semble pas perturber le cache.

## Le code

### la CSS ajoutée
```css
body {
  margin: 0.1em;
}

div#wrapper {
  width: 98%;
  padding: 0.1em;
}

div.dokuwiki div.right_sidebar, div.dokuwiki div.left_sidebar {
  float: none;
  width: 99%;
}

div.dokuwiki div.right_page, div.dokuwiki div.left_page {
  padding: 0;
  width: 99% !important;
}

div.dokuwiki div.toc {
  float: none;
  width: 99%;
  margin: 0.1em;
}
```
Comme indiqué précédemment le but est juste de réduire les marges et maximiser l'espace affiché.

### La modification de main.php

il s'agit juste de 3 lignes ajoutées avant le `</head>` :
```html
    <meta name="HandheldFriendly" content="true" />
    <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no" />
    <link rel="stylesheet" media="only screen and (max-device-width: 599px)" type="text/css" href="<?php echo DOKU_TPL?>arctic_mobile.css" />
```

Il est aussi possible d'ajouter ces lignes dans le fichier meta.html.

## Le diff

TODO


