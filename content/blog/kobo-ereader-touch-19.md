---
title: "Quelques petits trucs sur le Kobo"
date: 2012-06-30
tags: [ereader]
slug: kobo-ereader-touch-19
disqus_identifier: /blog/kobo-ereader-touch-19
---
# Quelques petits trucs sur le Kobo

## En attendant le nouveau firmware
Comme le nouveau firmware se rapproche avec beaucoup de bonnes nouvelles ..., je vais parler de quelques petites choses autour de la liseuse.

En attendant la bonne nouvelle très rapidement.

## Une belle police

J'ai trouvé [sur un autre forum](http://forum.teamalexandriz.org/les_liseuses_debook_readers/vos_polices_preferees_21165.15.html) une belle police : Averia.

Plus de détails sur la police sur sa page Web : http://iotic.com/averia/

C'est une police avec des bords irréguliers qui rappelle un peu les caractères imprimés sur un papier qui boit un peu l'encre. J'ai personnellement choisi la version Sans Serif et c'est devenu ma police par défaut.

## Un peu plus d'informations sur le fichier koboEreader.conf

Pour ceux qui, comme moi, font des factory reset assez régulièrement, la seule chose à sauvegarder (en plus des livres qui sont dans Calibre) sont les paramétrages de marge, police et interlignage. Tous ces paramètres se retrouvent dans le fichier de configuration (koboEreader.conf) :

```
[Reading]
homePageList=SomeFakeShortlistTabID
pageTurningOption=option2
readingAdobeShowPageNumbers=false
readingAlignment=
readingFontFamily=Averia Sans
readingFontSize=24
readingLeftMargin=6
readingLineHeight=1.775
readingRightMargin=6
```
Faire une petite sauvegarde de ces paramètres permet de vite retrouver ses marques après un factory reset.

## Mini revue de Web

* [La fin des DRM pour les ebooks des éditions Michel Lafon](http://www.actualitte.com/actualite/lecture-numerique/usages/la-fin-des-drm-pour-les-ebooks-des-editions-michel-lafon-35084.htm) : Une bien bonne nouvelle.
* [Le Nook vendu à l'international dans le courant de l'année](http://www.actualitte.com/actualite/monde-edition/economie/le-nook-vendu-a-l-international-dans-le-courant-de-l-annee-35069.htm) : Pour les déçus du Kobo qui veulent voir si l'herbe est plus verte ailleurs.

C'est tout pour aujourd'hui. La prochaine fois, je ferai un tutoriel rapide sur la structure de la base de données de la Kobo (fichier KoboReader.sqlite).

