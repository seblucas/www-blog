---
title: "Quelques news sur la Kobo"
date: 2013-02-11
tags: [epub,ereader]
slug: kobo-ereader-touch-54
---
# Quelques news sur la Kobo

Malheureusement en ce moment la "vraie vie" me prend pas mal de temps, je ne peux donc pas garder mon rythme habituel d'écriture. Vous trouverez ci-après toute une série d'informations diverses et variées sur la Kobo.

D'autres nouvelles orientées bidouille dans quelques jours.


## Image de couverture avec les .kepub.epub

Vous avez peut être lu un de mes précédents articles ([Firmware Kobo 2.3.1 : La suite](/blog/kobo-ereader-touch-48)) où j'expliquais qu'en renommant un fichier epub en kepub.epub le moteur de rendu utilisé par le Kobo changeait et que cela amenait toute une série de changements.

Un des principaux problèmes était la perte de la couverture du livre. David Forrester a trouvé [une astuce](http://www.mobileread.com/forums/showpost.php?p=2389073&postcount=15) pour corriger ce problème. Dans Calibre, procédez ainsi :

* Sélectionnez le livre
* Clic droit et sélectionnez "Personnalisez le livre"
* Dans la boite de dialogue, appuyez sur le bouton "Exploser le livre". Un explorateur de fichier va s'ouvrir avec le contenu de l'epub.
* Trouvez le fichier OPF. Il est souvent nommé "package.opf" ou "content.opf". Il doit contenir du XML.
* Ouvrez ce fichier dans un éditeur de texte (Notepad++).
* Trouvez la section "`<manifest>`".
* Dans cette section vous devriez trouver quelque chose de ce style : 

```
<item href="Images/cover.jpg" id="cover.jpg" media-type="image/jpeg" />
```

* Ajoutez properties="cover-image" dans cette ligne pour arriver à cela :

```
<item href="Images/cover.jpg" id="cover.jpg" media-type="image/jpeg" properties="cover-image" />
```

* Enregistrez le fichier
* Dans Calibre, appuyez sur le bouton "Reconstruire le livre".

Attention : 

* Cela va modifier le fichier Epub dans Calibre. 
* Cette modification n'est pas dans le standard Epub. Ce qui fait que les fichiers epub modifiés de cette manière ne sont plus valides (mais restent lisibles sur toutes les plateformes que j'ai testé).

Pour toutes ces raisons je n'ai jamais mis en application cette technique, j'ai modifié COPS pour générer à la volée des fichiers .kepub.epub avec la bonne structure sans mettre en péril le fichier epub original. La version contenant cette modification devrait sortir très bientôt.

A noter aussi que David Forrester s'interroge sur le fait d'intégrer la création de .kepub.epub dans le driver Kobo de Calibre (un peu à la façon de ce [driver alternatif](https://github.com/jgoguen/calibre-kobo-driver)).

## Gestion des métadonnées de série en Epub3

Comme indiqué dans un précédent article ([Quelques news sur la Kobo](/blog/kobo-ereader-touch-52)), Kobo s'est engagé à supporter l'Epub3 cette année. Les spécifications de l'Epub2 pour les métadonnées ne permettaient pas la gestion des séries. Calibre a un peu pallié à ce problème en ajoutant les métadonnées suivantes :

* meta avec le type "calibre:series"
* meta avec le type "calibre:series_index"

Par contre, ce n'est pas un standard et c'est donc assez peu supporté (non supporté par Kobo, supporté par Mantano).

L'Epub3 permet un support direct via une [technique relativement complexe](http://idpf.org/epub/30/spec/epub30-publications.html#sec-dctitles-examples). Une petite explication complémentaire :

* Le titre du livre est "The Fellowship of the Ring" :

```
<dc:title id="t1">The Fellowship of the Ring</dc:title>
<meta refines="#t1" property="title-type">main</meta>
```

* La série du livre est "The Lord of the Rings" et c'est le premier livre :

```
<dc:title id="t2">The Lord of the Rings</dc:title>
<meta refines="#t2" property="title-type">collection</meta>
<meta refines="#t2" property="group-position">1</meta>
```

* Le titre complet du livre est "THE LORD OF THE RINGS, Part One: The Fellowship of the Ring" :

```
<dc:title id="t3">THE LORD OF THE RINGS, Part One: The Fellowship of the Ring</dc:title>
<meta refines="#t3" property="title-type">extended</meta> 
```

En pratique, pour le moment, la Kobo ne le supporte pas et ne met pas à jour les colonnes série de la liseuse. J'espère que cela va vite changer : à suivre !

### Groupe Beta

Comme indiqué dans un précédent message, nous avons des nouveaux firmwares à tester. Ensuite, je n'ai aucune information (ni sentiment) sur une future date de livraison.


