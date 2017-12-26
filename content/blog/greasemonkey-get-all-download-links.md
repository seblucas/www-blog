---
title: "Comment récupérer tous les liens de téléchargement d'un page web"
date: 2011-08-22
tags: [javascript]
slug: greasemonkey-get-all-download-links
---
# Comment récupérer tous les liens de téléchargement d'un page web

## Pourquoi ?
Sur une page web que je visite régulièrement il y a toute une série de lien qui pointent vers des services de téléchargement spécialisés (comme megaupload, dl.free.fr, ...) et pour les intégrer facilement dans [pyLoad](http://pyload.org/), j'ai eu besoin de récupérer rapidement l'ensemble des liens.

## La solution

J'ai fait un script avec GreaseMonkey (extension Firefox) qui reporte les liens dans une div à moitié transparente en haut à gauche de la page.

```javascript
*/*///////////////////////////////////////////////////
// Get all download links v1.0
*/*///////////////////////////////////////////////////
//Create a div  in the top left with all download links for a specific regex
//
//Author:
// Sébastien Lucas (http://blog.slucas.fr)
//
//Credits:
//
//Changelog:
//
*/*////////////////////////////////////////////////////


// ==UserScript==
// @name           ChercheLien
// @namespace      fr.slucas.ChercheLien
// @include        http://www.yourFavoriteWebSite.org/*
// ==/UserScript==

var allLinks, thisLink, linkList, regMega;
linkList = "<p>Liste Liens : </p>";
regMega = new RegExp ("megaupload");
allLinks = document.evaluate(
    '//a[@href]',
    document,
    null,
    XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,
    null);
for (var i = 0; i < allLinks.snapshotLength; i++) {
    thisLink = allLinks.snapshotItem(i);
    if (regMega.test (thisLink))
    {
        linkList += "<p>" + thisLink + "</p>";
    }
    
    // do something with thisLink
}
//alert (linkList);
var logo = document.createElement("div");
logo.innerHTML = '<div style="float: left; height: 0px; text-align: left; opacity: 0.3;">' +
    linkList +
    '</div>';
document.body.insertBefore(logo, document.body.firstChild);
```

Pour utiliser le script il faut remplacer le site web en haut par votre site préféré et changer la ligne suivante par votre expression régulière favorite :

```
regMega = new RegExp ("megaupload");
```

C'est librement inspiré (= copié honteusement ;))) de ce [lien](http://diveintogreasemonkey.org/patterns/match-attribute.html).

## Reste à faire

* Rendre cette extension plus générique en permettant de saisir en live l'expression régulière et ensuite faire la recherche.
* Faire le copier dans le presse papier automatiquement.






