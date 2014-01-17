/*
Title: Taille de police différente selon les ebooks
Description: 
Author: Sébastien Lucas
Date: 2012/05/07
Robots: noindex,nofollow
*/
# Taille de police différente selon les ebooks

## Vive les vacances
Lors de mes courtes vacances, j'ai lu sur mon Kobo et en commençant un nouveau livre j'ai la désagréable surprise de le voir apparaitre avec une taille de caractère énorme. En rouvrant mon précédent livre j'ai retrouvé la taille à laquelle j'étais habitué.

Vu que j'avais un peu de temps, j'ai essayé de comprendre la cause de tout cela au lieu de bêtement changer le paramétrage de la Kobo (ce qui est gênant étant donné que je lis 2 ou 3 livres en parallèle).
## EPUB = HTML dans un ZIP

Un fichier epub est un fichier ZIP avec une série de fichier HTML et un feuille de style CSS. Pour comprendre l'origine du problème j'ai d'abord ouvert ce fichier epub avec Sigil pour en analyser la feuille de style et la comparer avec mon livre précédent.

Bilan : je ne savais pas trop ou chercher donc je n'ai pas trouvé grand chose. Mais je suis tenace donc je continue.
## Firebug pour la victoire

Vu que les fichiers epub contiennent des fichier HTML j'ai extrait le premier chapitre ainsi que la feuille de style et j'ai ouvert ce fichier dans Firefox et j'ai activé le plugin Firebug (merveilleux d'ailleurs). La différence était évidente.

Les paragraphes (balise p) de ces deux fichiers ont tous les deux les mêmes informations concernant la taille de la police de caractère :

	:::css
	font-size: 1.33333em;


Par contre ces paragraphes sont situés dans le balise body qui a elle aussi un spécification de taille de police :

*	Livre 1 : avec une taille normale

	:::css
	font-size: 1em;


*	Libre 2 : avec une grande taille

	:::css
	font-size: 1.25em;


La taille de police du paragraphe étant relative à celle du body (pour simplifier elles se multiplient et ne se remplacent pas) :

*	La taille de police du livre 1 : 1 * 1.33333 = 1.33333em

*	La taille de police du livre 2 : 1.25 * 1.33333 = 1.66666em
  
CQFD

J'ai donc juste modifié la taille de police spécifié dans la classe du body et mon problème est résolu.
## Autres problèmes : même explication

Dans les trucs et astuces liées à la Kobo ([Kobo eReader Touch : trucs et astuces d'origine diverse](/blog/kobo-ereader-touch-5)), j'ai indiqué que si les marges n'étaient pas modifiables il fallait modifier l'epub via Calibre : cela revient à simplifier la feuille de style.

Dans mon livre 2, les interlignes ne sont pas modifiables : c'est lié à une instruction line-height dans la feuille de style.

Etc.
### Bilan

Messieurs les éditeurs et Messieurs des sociétés de numérisation : restez simple, pas de balises inutiles qui peuvent gâcher le plaisir de lecture.

La feuille de style doit être légère. Cela entraine quelques avantages pour nous lecteurs :

*	Nos liseuses ne rament pas.

*	Les fichiers epub sont moins gros (moins de couts de bande passante et moins d'attente)

*	Les liseuses peuvent s'adapter plus facilement.

Je vous laisse consulter [le blog de lecteursencolere](http://lecteursencolere.com/) pour en apprendre beaucoup plus sur le sujet.

J'ai essayé de chercher si il y avait des recommandations ou des obligations sur les tailles de polices issues du standard EPUB mais je n'ai rien trouvé de tel.
