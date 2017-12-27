---
title: "Firmware 2.4.0 : Bilan à tête reposée"
date: 2013-03-07
tags: [epub,ereader]
slug: kobo-ereader-touch-57
disqus_identifier: /blog/kobo-ereader-touch-57
---
# Firmware 2.4.0 : Bilan à tête reposée

Après trois semaines, je pense qu'on peut dresser un bilan sur le dernier firmware. Pour gacher le suspense, j'aime bien !

Les informations ci-dessous sont un complément à [Firmware 2.4.0 : des corrections de bugs (enfin) et quelques nouveautés](/blog/kobo-ereader-touch-56).

A noter que je n'ai pas testé ce dont je ne me sers jamais : 

* Les étagères
* Les annotations
* Les signets (hormis le signet automatique)

## Anomalies

### Consommation de batterie excessive
Quelques très rares utilisateurs ont noté des baisses très rapides de la batterie (de l'ordre de la journée) suite au transfert de fichiers epub.

### Mise en veille rapide après ouverture d'un livre

Juste après l'ouverture d'un livre si vous ne tournez pas de pages pendant un peu plus d'une minute (70 secondes selon les tests), la liseuse se met en veille.

Personnellement ça ne me dérange pas et je considère ça presque comme une nouvelle fonctionnalité mais le consensus (et Kobo) semble le classifier en bug.

### Livres avec DRM ADE non autorisés après le passage en 2.4.0

Si vous avez le problème suivez le guide : http://www.mobileread.com/forums/showpost.php?p=2434189&postcount=6

### Bouton d'achat sur des fichiers kepub.epub chargés manuellement

Comme le chargement de fichier .kepub.epub n'est pas supporté officiellement, il se peut que certains fichiers aient le problème.

Dans ce cas la solution est de modifier la base de données de la liseuse et d'appliquer la requête suivante :

```
UPDATE content SET ___UserID='kepub_user'
WHERE ContentID LIKE 'file:///mnt/%'
AND ContentID LIKE '%kepub.epub%';
```

### Sudoku

Le clavier en bas a un petit bug de couleur.

### Tri des livres

Depuis l'apparition de l'information de série dans notre Kobo, le tri par titre avait été changé pour devenir un tri par Série, Numéro du livre dans la série, Titre du livre.

Encore une fois, étant un grand lecteur de série, je trouvais ça pratique !

Beaucoup d'utilisateurs s'étaient offusqués du fait que le tri par titre n'était plus un tri par titre. Au final, Kobo a rétabli le tri par titre (sans prendre en compte la série). J'espère qu'un choix de tri incluant les séries fera partie des évolutions du prochain firmware.

## La petite bidouille du jour

Vous parlez français mais vous n'êtes pas français (québécois, suisse, belge, ...) et les formats de dates ou de l'heure affichés sur le Kobo ne respectent que les habitudes de France (JJ/MM/AAAA).

Vous pouvez modifier le fichier Kobo/Kobo eReader.conf et ajouter le bloc suivant (pour la Suisse) :

```
[ApplicationPreferences]
CurrentLocale=fr_CH
```

Un redémarrage de votre liseuse plus tard et le format des dates devrait être conforme à vos habitudes (DD. MM. AAAA dans le cas de la Suisse).

Source : http://www.mobileread.com/forums/showthread.php?t=207054

