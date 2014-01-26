/*
Title: Firmware 2.0.0 retours après quelques jours et quelques autres choses
Description: 
Author: Sébastien Lucas
Date: 2012/07/14
Robots: noindex,nofollow
Language: fr
Tags: ereader
*/
# Firmware 2.0.0 retours après quelques jours et quelques autres choses

## A tête reposée
Après quelques jours de tests et de lectures de différents forums sur Internet, je vais essayer de résumer les problèmes qui ressortent sur le firmware 2.0.


## Arrêt de la diffusion du firmware

Un sujet est apparu sur [MobileRead](http://www.mobileread.com/forums/showthread.php?t=184544) concernant le problème de mise à jour de liseuses qui plantent (qui restent figées sur l'animation de démarrage : les cubes qui bougent). Je n'en ai pas entendu parler sur les forums français.

Il y a aussi eu [une communication officielle de Kobo](http://www.mobileread.com/forums/showthread.php?t=184642) à ce sujet. J'ai fait un résumé rapide ci-dessous :

le problème de l'animation de démarrage en boucle est confirmé. Les solutions proposées sont de forcer un arrêt (Bouton power pendant au moins 30 secondes) si cela ne fonctionne pas tenter un reset (avec trombone) ou au pire de faire un factory reset (voir les trucs et astuces). Le fait de faire un Factory reset fonctionne car le firmware 2.0.0 a été enlevé des MAJ automatiques (Confirmé par [Sameer](http://www.mobileread.com/forums/showpost.php?p=2148128&postcount=276)).
Une cause probable du problème est d'avoir trop de livres sur la liseuse.

Cela peut donc expliquer pourquoi certaines personnes ne peuvent pas passer en dernière version en faisant une synchronisation.

Je ne ferai pas la liste de tous les messages mais Kobo se fait insulter copieusement sur MobileRead suite à la publication du firmware et à son retrait. N'ayant pas été victime de problème, je trouve ça assez injuste mais c'est mon côté gentil.

## Régressions

### Affichage de l'heure en cours de lecture
C'est le point qui me dérange le plus et je pense ne pas être le seul. Le pire c'est que cela semble très facile à corriger.

### Césure

Je l'ai mis dans la partie régression car je ne suis pas un maniaque des césures et que j'aimerai les désactiver de temps en temps.

### Gestion des polices

Il y a clairement une différence de rendu des polices avec le nouveau firmware. Cela me gène notamment avec la police Averia Sans, le pire est que le rendu semble correct avec les kepubs.

### Vitesse de changement de page

Je trouve (et je ne suis pas le seul) que les changements de pages sur les epubs sont notablement plus lent. Pour les kepubs tout a l'air de bien fonctionner par contre.

## Plantages

### Impossible d'utiliser les étagères
Le problème vient souvent de l'activation des étagères via le plugin. Dans ce cas, deux solutions :
*	Factory reset (dans les paramètres)
*	Changement de compte (voir après).
  
La deuxième solution est plus efficace car vous devriez garder vos epubs déjà chargés.

### En modifiant les polices

J'ai lu à plusieurs reprises (dont un en commentaire ici) des cas de liseuses figées en changeant les polices et leur paramétrage. Je ne l'ai pas reproduit.

## Nouveautés absentes de la liste de changements

### Navigateur Web
Le Navigateur Web marche beaucoup mieux qu'avant. Sur COPS j'utilise FancyApps pour faire des belles fenêtres et cela fonctionnait très moyennement (voire pas du tout) sur le 1.9.17 alors que ça fonctionne totalement sur le nouveau firmware.

Le navigateur supporte aussi beaucoup plus de balises HTML5 qu'avant (Score de 246 + 2 points bonus sur http://html5test.com/)

### EPUB3

Mes tests sur les EPUB3 n'ont pas été concluants mais, d'autres utilisateurs ont été plus chanceux que moi (voir [ici](http://www.mobileread.com/forums/showthread.php?t=184492)). Il faut bien utiliser les bonnes polices.

### qualité des images (via CBR / CBZ)

Je trouve la qualité des images meilleures (peut être un tramage avant affichage).

### Changement de compte

Une fonctionnalité cachée du changement de compte (Paramètre -> Compte) est de réinitialiser la base de données et donc d'enlever les bidouilles activées par le plugin (pour utiliser les étagères notamment).

## Divers

### Lien direct vers le firmware
http://download.kobobooks.com/firmwares/kobo3/Devario/kobo3-update-2.0.0.zip

### Kobo desktop avec Wine

A priori, tout fonctionne correctement, il faut juste associer via la configuration de Wine un lecteur à /media/KOBOereader/).

Voir : http://www.mobileread.com/forums/showthread.php?t=184541

### Baisse du prix du Kobo ... outre Atlantique

Le Kobo eReader Touch se trouve à $49.98 donc vraiment vraiment pas cher (voir [ici](http://www.mobileread.com/forums/showthread.php?t=184765)).

### Firmware 2.0.0 et Calibre

Je ne l'ai pas encore testé par moi même mais cela semble fonctionner (même si l'auteur du plugin Kobo de Calibre a ajouté un gros Warning lors d'une synchronisation avec un firmware 2.0.0).

Je vais certainement l'essayer ce Week-end, je ferai un autre post à ce moment là pour confirmer.
