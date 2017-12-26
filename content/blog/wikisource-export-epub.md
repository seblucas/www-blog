/*
Title: Export au format EPUB sur Wikisource
Description: 
Author: Sébastien Lucas
Date: 2012/09/30
Robots: noindex,nofollow
Language: fr
Tags: ereader
*/
# Export au format EPUB sur Wikisource

Pour faire suite au précédent article sur l'export EPUB de Wikipedia, aujourd'hui c'est le tour de Wikisource !

## Comment faire

C'est assez simple, chaque article (livre) qui permet le téléchargement d'un EPUB est accompagné d'un petit losange vert (le logo du format). Il y a ensuite un lien "Télécharger en EPUB" en haut de l'écran. A noter que le téléchargement prend un peu de temps.

J'ai fait mes essais sur [Arsène Lupin](http://fr.wikisource.org/wiki/Ars%C3%A8ne_Lupin_gentleman-cambrioleur).

## Un fichier EPUB valide ?

Le fichier n'est pas valide à cause de l'utilisation d'un attribut "lang" à la place de "xml:lang". Cela dit je ne pense pas que ça va perturber le reste du test.

## Sur la Kobo

Points négatifs : 
* La taille de l'interligne n'est pas modifiable. C'est même plus étrange que cela car l'interligne du titre du chapitre change bien mais pas celui du texte.
* La lettrine de chaque début de paragraphe apparait en deuxième ligne.

Points positifs : 
* La taille de police et la police sont modifiables.
* Les marges sont modifiables.
* La table des matières est complète et utilisable via les menus.
* Il y a une couverture.

Les points négatifs sont assez désagréables pour une bonne expérience de lecture. J'ai donc décidé de faire d'autres tests sur d'autres lecteurs EPUB.

## Sur Firefox

J'ai extrait le fichier xhtml du premier chapitre et le fichier Css et le rendu de la lettrine sur Firefox est impeccable (même en redimensionnant la fenêtre). J'ai aussi validé que le changement de "line-height" via Firebug était correct (pour les interlignes).

## Sur Mantano Reader (Android)

La lettrine apparait aussi en deuxième ligne (même comportement que sur la Kobo). Je ne peux pas (ou ne sais pas) comment changer la taille de l'interligne, je ne peux donc pas tester cette partie.

## Sur FBReaderJ (Android)

C'est encore plus étrange, la lettrine n'en est plus vraiment une (pour le cas du premier chapitre, c'est juste un L majuscule avec une taille un peu plus importante) et l'ensemble du premier paragraphe est en gras avec une taille de police plus grande. Cela se reproduit pour le premier paragraphe de tous les chapitres.

## Conclusion

Ben ... Je ne sais pas trop quoi dire. Le fichier est valide et seul Firefox en fait un rendu correct. C'est étrange : soit le code Html / Css est faux soit les lecteurs d'Epub que j'ai testé sont nuls !

Si vous avez d'autres liseuses (Sony, Bookeen, Pocketbook, ...), je suis curieux de lire vos commentaires sur le rendu de ce fichier.
