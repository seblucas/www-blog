---
title: "Firmware Kobo 2.3.1 : La suite"
date: 2012-12-17
tags: [ereader]
slug: kobo-ereader-touch-48
---
# Firmware Kobo 2.3.1 : La suite

Ci-dessus quelques petites informations glanées un peu partout et le résultat d'une expérimentation.


## Problème avec les étagères

Des utilisateurs ont des soucis d'étagères dupliquées suite à des synchronisations. La seule solution (en plus du reset) est de modifier la base de données Sqlite pour marquer les étagères en trop comme "à supprimer".

Pour l'instant la cause n'est pas claire :

* Soit c'est un bug Kobo.
* Soit cela concernerait que des étagères créées automatiquement par Calibre
* ...

Comme je l'ai déjà dit, je n'utilise pas du tout les étagères donc je n'ai pas expérimenté le problème directement.

## Souci avec la table des matières / navigation

Depuis la dernière version, l'affichage de la coche dans la table des matières (indiquant le chapitre courant) n'est pas toujours correct. De la même manière, l'utilisation du bouton d'avance rapide dans le menu de navigation (bouton avec la double flèche) est aussi aléatoire : j'étais au chapitre 9 et un clic sur l'avance rapide m'a fait arriver au chapitre 1.

C'est une fonctionnalité que j'utilise rarement mais que j'appréciais jusqu'à maintenant.

## Des statistiques dans les Epub ;)

Le titre est suffisamment racoleur !

J'ai lu, il y quelques mois, une bidouille que je me suis promis d'essayer depuis un certain temps et que je viens enfin de tester. Si vous renommez un fichier .epub avant de le copier sur la Kobo en fichier .kepub.epub alors il sera interprété comme un Kepub ce qui débloque certaines fonctionnalités.

J'ai donc copié le fichier MonLivre.epub sur le Kobo et avant d’éjecter la liseuse je l'ai renommé en MonLibre.kepub.epub. Une fois l'éjection faite, je me retrouve avec un livre lisible avec les changements suivants :

* Pas de couverture.
* La pagination se fait au chapitre (certain peuvent aimer, ce n'est pas mon cas).
* Le nom du livre est affiché constamment en cours de lecture.
* Les statistiques sont utilisables.

Je n'ai pas encore bien testé les changements mais cela intéressera certainement du monde !

A noter qu'il est possible de faire des modifications dans Calibre pour qu'il transfère directement dans ce format (le détail dans les liens ci dessous).

Bon test à vous et partagez vos expériences dans les commentaires.

Sources :

* http://www.mobileread.com/forums/showthread.php?t=193294
* http://dsandrei.blogspot.fr/2012/07/koboish-ebooks.html
