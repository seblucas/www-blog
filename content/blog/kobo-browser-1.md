---
title: "Quelques tests sur le navigateur de la Kobo eReader Touch"
date: 2012-04-13
tags: [ereader]
slug: kobo-browser-1
disqus_identifier: /blog/kobo-browser-1
---
# Quelques tests sur le navigateur de la Kobo eReader Touch

## Pourquoi ?
Depuis le temps que j'en parle, j'ai vraiment envie d'adapter COPS (voir [Voici COPS : Calibre OPDS PHP Serveur](/fr/projects/calibre-opds-php-server)) pour qu'il puisse aussi fournir des pages web adaptées au navigateur de la Kobo (et par extension aux autres liseuses). Et j'ai commencé à faire des tests pour tester les capacités sur navigateur notamment en téléchargement de fichiers epub.

## Les modalités du test

J'ai créé une page html toute simple et valide W3C disponible [ici](http://cops-demo.slucas.fr/index.html) avec 3 tests :
  - Un lien direct vers un fichier epub hébergé dans l'espace web (idem que pour les catalogues hébergés sur dropbox).
  - Un lien vers un fichier PHP renvoyant un fichier epub
  - Un lien vers un fichier epub avec de l'URL rewriting (voir Wikipedia). Au final ce lien appelle le même script php que précédemment.

Dans tous les cas un type mime correct est envoyé : application/epub+zip.
Dans les deux derniers cas une entête Content-Disposition est envoyée pour spécifier un nom complet.

## Les résultats

###  Firefox sous Windows 
  - OK
  - OK avec le nom complet
  - OK avec le nom complet

### Kobo eReader Touch avec firmware 1.9.17

  - La fenêtre de téléchargement apparait le nom alice.epub
  - Rien ne se passe
  - La fenêtre de téléchargement apparait avec le nom alice.epub (au lieu de 8.epub) mais au téléchargement le bon fichier est créé.

~~Autre fonctionnement étrange à partir du moment ou j'ai cliqué sur un lien alors dès que j'essaye de quitter via le bouton Home ou le menu alors la liseuse redémarre.~~ Un lecteur m'a confirmé ne pas avoir eu de problème de plantage à la visualisation de la page (avec le firmware 1.9.16). Suite à cela j'ai fait un factory reset de mon Kobo (version 1.9.17) et tout fonctionne correctement. Mon problème devait être du à un résidu d'un des firmwares beta.


~~Ce dernier point me fait peur et risque de ruiner mon beau projet ...~~ Je compte donc sur toi Oh lecteur pour faire le test sur ta propre liseuse et m'envoyer un mail pour me dire si le fonctionnement est le même ou pas. Attention ne pas oublier de préciser la marque de sa liseuse (Kobo, Nook, Sony, ...) et la version de firmware.

EDIT : J'ai eu suffisamment de réponses de possesseurs de Kobo (merci à ceux qui m'ont écrit) pour valider que mon problème de plantage m'était spécifique. Vu qu'il a été résolu, ne vous embêtez pas à faire le test, il y a 99% de chance que vous ayez les mêmes résultats que moi (après factory reset). Par contre si vous possédez une autre liseuse, merci d'avance :).

## Bilan définitif

* ~~La Kobo plante ....~~
* Le navigateur de la Kobo n'essaye même pas de télécharger des liens pointant sur des scripts
* Le navigateur ne respecte pas l'entête Content-Disposition.
* Le nom de fichier affiché n'est pas toujours correct, mais le téléchargement est correct.

Le bilan est acceptable pour la Kobo, ouf !

