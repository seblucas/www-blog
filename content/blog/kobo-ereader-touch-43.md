/*
Title: De la bidouille autour de la Kobo
Description: 
Author: Sébastien Lucas
Date: 2012/11/30
Robots: noindex,nofollow
*/
# De la bidouille autour de la Kobo

Désolé pour le peu d'articles en ce moment, je suis assez pris par le travail et la vraie vie en ce moment. J'ai aussi pas mal lu (notamment La Religion de Tim Willocks et le dernier Goncourt). Mais, vous trouverez, ci-après, un aperçu de ce qui a éveillé mon intérêt ces derniers jours.

## Compilation du plugin Kobo

J'ai essayé d'installer un environnement de compilation adapté à la Kobo. Je n'ai pas eu le temps pour le moment d'aller jusqu'à la compilation du plugin (mon but), mais je vais publier au fur et à mesure mes avancées.

Pour le moment, la première partie est ici : [Création d'un environnement de compilation Kobo - Partie 1](fr/oss/kobo-build-environment-1)
## Dictionnaires personnalisés sur la Kobo

Malgré ce titre, il y a à la fois une bonne et une mauvaise nouvelle.

La mauvaise nouvelle c'est que les dictionnaires sont maintenant cryptés ou compressés d'une manière non connue (auparavant ils étaient simplement compressés en Gzip).

La bonne nouvelle c'est qu'une méthode a été trouvée sur [MobileRead](http://www.mobileread.com/forums/showthread.php?t=194986) pour ajouter des dictionnaires personnalisés. En fait, l’algorithme utilisé est [MARISA](http://code.google.com/p/marisa-trie/). Il a, à priori, le mérite de créer des petits fichiers.

Les sources de cet outil sont librement téléchargeables et je compte passer un peu de temps pour me créer un dictionnaire basé sur les données de [Wiktionnaire](http://fr.wiktionary.org/wiki/Wiktionnaire:Page_d%E2%80%99accueil) dont la base de données est librement distribuée. Il ne me reste plus qu'à trouver du temps.

Pour le moment, il existe quelques dictionnaires alternatifs :

*	Anglais : http://www.mobileread.com/forums/showthread.php?t=196925

*	Japonais-Anglais : http://www.mobileread.com/forums/showthread.php?t=197828
  
## Plugin mis à jour

Le plugin a été mis à jour de façon mineure depuis mon dernier article. Pour le moment, je change régulièrement de firmware (pas mal de tests pour le groupe beta), donc je ne l'utilise plus. Cependant les échos sont bons, vous pouvez donc l'installer sans crainte.

http://www.mobileread.com/forums/showthread.php?t=193377

## Un remplacement pour l'interface de la Kobo

Toujours sur MobileRead, une personne a posté des images d'un programme Java qui remplace l'interface de la Kobo (nickel).

Le sujet est à lire ici : http://www.mobileread.com/forums/showthread.php?t=196994

Ce développement est basé sur le travail d'un autre [bloggeur](http://a-hackers-craic.blogspot.be/) (excellent d'ailleurs) qui a beaucoup parlé de la [Kobo](http://a-hackers-craic.blogspot.be/search/label/kobo).

Personnellement, je ne crois pas trop au Java sur un processeur si lent mais j’apprécie l'effort.

## Firmware Japonais / prochain firmware

Suite à mon dernier article lié à la Kobo ([Sortie du firmware 2.2.0 au Japon](blog/kobo-ereader-touch-42)), le firmware 2.2.1 a été déployé au Japon sans grande information sur le détail des modifications.

Du côté du groupe bêta, ça bosse pas mal mais je ne pense que la sortie soit imminente pour le moment.
