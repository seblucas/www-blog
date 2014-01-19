/*
Title: Petite revue de Web autour du Kobo eReader Touch et quelques trucs et astuces en prime
Description: 
Author: Sébastien Lucas
Date: 2012/01/09
Robots: noindex,nofollow
Language: fr
*/
# Petite revue de Web autour du Kobo eReader Touch et quelques trucs et astuces en prime

## Pas trop d'articles en ce moment
Et oui pas trop d'articles en ce moment essentiellement par manque de temps (des choses à faire dans la vrai vie). Néanmoins je vais essayer de faire un petit tour de ce qui s'est passé autour du Kobo ces dernières semaines.

D'autre part j'ai régulièrement mis à jour l'article sur les trucs et astuces (voir [Kobo eReader Touch : trucs et astuces d'origine diverse](/blog/kobo-ereader-touch-5)) avec de nouveaux et/ou des corrections sur des thèmes existants. Je trouve plus logique de tout rassembler à un endroit même si ça ne colle pas avec l'esprit blog. A terme je ferai peut être un wiki public si des personnes sont intéressées pour m'aider à le maintenir (vous pouvez me contacter si vous vous en sentez la motivation pour m'épauler).

## Firmware 1.9.16

Ce firmware a engendré beaucoup de plaintes et de remarques négatives :

*	Les suggestions ne sont pas très appréciées (même si elles sont remplaçables par les livres préférés).

*	Des problèmes de qualité de texte ont été détectés par certain et un bug reproductible a été découvert sur la qualité du texte après passage sur un menu (voir [ici](http://www.mobileread.com/forums/showpost.php?p=1895682&postcount=120)).

*	Des problèmes de lenteur au changement de page

*	Des soucis dans la page d’accueil (besoin de taper deux fois pour une action)

*	Des lenteurs avec les "grosses" bibliothèque (> 300 livres) qui seraient reproductibles.

*	...

Je n'ai aucun de ces problèmes ...

Mais pas mal de personnes sont revenues en version 1.9.14.

Pour le souci de qualité de menu une correction a été faite et j'ai pu la tester pour le groupe beta, mais malheureusement elle amène de nouveaux bugs. Bilan, il faut attendre que ça se fasse et que Kobo fasse mieux.
## Excellente vente pour le Kobo by Fnac

Cette nouvelle a déjà été reprise partout sur le Web, je ne vais donc pas épiloguer. C'est une excellente nouvelle pour espérer un suivi dans le temps de la liseuse.
## Kobo et le respect de la vie privée

Vaste sujet : Kobo est une entreprise qui veut nous vendre des livres et nous aimerions lui donner le moins d'informations possible  (voire aucune information).

Des angoisses sont nées notamment suite à l'affichage des suggestions qui sont bien sur basées sur les achats fait dans la librairie Kobo (et pas sur les autres médias intégrés manuellement) et d'un fichier .kobo/Kobo/Kobo eReader.conf qui contient des informations Google Analytics.

Je vais faire une traduction partielle d'un excellent article posté sur MobileRead (voir [ici](http://www.mobileread.com/forums/showthread.php?t=162713)) :

*	Ces informations ne sont pas apparues avec la version 1.9.16

*	Les statistiques sont envoyées à Google Analytics à chaque synchronisation

*	Ces envois ne concernent pas votre adresse email, livres chargés manuellement, numéro de carte de paiement, sites visités via le navigateur intégré, ...

*	Les statistiques sont vidées à chaque redémarrage.

L'auteur de cet article propose une analyse du contenu envoyé : http://pastie.org/3079390.

Et pour les plus paranoïaque d'entre nous le moyen de tout arrêter en bidouillant le Kobo (je ne suis pas responsable blah blah de l'explosion de votre liseuse) :

*	[Sauver ce fichier](http://dl.dropbox.com/u/756750/s/KoboRoot.tgz) dans le répertoire .kobo (comme dans une mise à jour de firmware).

*	Éjecter de déconnecter le Kobo

*	La mise à jour sera très rapide.

Le principe est simple : modifier le fichier /etc/hosts de la Kobo (qui est un Linux je le rappelle) pour faire pointer les serveurs de Google vers la Kobo.

Je n'ai pas testé mais vu que je fais une synchronisation uniquement quand il y a un nouveau firmware, je n'envoie pas grand chose à leurs serveurs.
## Outil de création/optimisation de CBZ

Comme vous le savez la résolution d'un Kobo est faible (800 * 600) et le nombre de niveaux de gris est encore pire (16) donc même pour des mangas en noir et blanc la qualité n'est pas toujours au rendez vous.

Un compatriote français a fait un outil posté sur [MobileRead](http://www.mobileread.com/forums/showthread.php?t=164411) qui permet d'optimiser les CBZ pour le Kobo.

Je ne l'ai pas testé (comme je l'ai dit pas de temps) mais vous pouvez le faire : http://dl.free.fr/ifUOPEDQ3

## Peut être des plugins pour le Kobo

Ce n'est que le début mais un [sujet de MobileRead](http://www.mobileread.com/forums/showthread.php?t=163997) (encore) indique que quelqu'un a réussi à compiler un programme et le lancer sur un Kobo eReader Touch.

Ça ne marche pas fort pour le moment mais c'est un début.

