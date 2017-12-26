/*
Title: Sortie du firmware 1.9.16 et revue de Web
Description: 
Author: Sébastien Lucas
Date: 2011/12/27
Robots: noindex,nofollow
Language: fr
Tags: ereader
*/
# Sortie du firmware 1.9.16 et revue de Web

## Désolé, mais le principal est là
Comme indiqué dans un précédent article (voir [Mon cadeau de Noël : le site cassé](/blog/cadeau-noel-site-out)), je suis désolé du retard de la sortie de cet article qui était prêt avant Noël et que je gardais au chaud sur une clé USB défaillante ...

Enfin c'était la seule perte dans l'histoire, ma paranoïa m'a au moins permis d'avoir une sauvegarde complète de la configuration et des données (sauf les dernières modifications) pour vite renaitre de mes cendres. Et je n'ai pas assez bu pendant les fêtes pour oublier trop de texte.

## Firmware 1.9.16

Le changelog officiel est le suivant :

* Amélioration de la vitesse pour tourner les pages et rechercher
* Un texte plus fin et plus vif pour une meilleure expérience de lecture
* La nouvelle liste 'Recommandé pour vous" trouve automatiquement des livres correspondants a vos goûts
* Le menu ACCEUIL simple et amélioré contient désormais la Bibliothèque , la Librairie et le Reading Life
* Les icônes pour les paramètres , la synchronisation et l'Aide sont désormais accessible sous le menu ACCEUIL

J'ai lu pas mal de mauvais commentaires sur cette version, notamment sur le besoin de cliquer deux fois pour accéder aux menus. Je n'ai pas ce genre de problème et depuis ce firmware je n'ai pas eu une seule fois le problème de "double tap" :

* je tape une fois pour changer de page rien ne se passe
* je tape une deuxième fois et zou il passe deux pages.

J'espère que cela va durer.

Pour ceux qui ont des problèmes, je vous conseille de faire un factory reset ou au pire de revenir au firmware précédent (j'ai détaillé l'installation manuelle sur cette page [Kobo eReader Touch : trucs et astuces d'origine diverse](/blog/kobo-ereader-touch-5)).

Pour revenir sur les nouveautés, pas grand chose d'intéressant :

* Toujours pas de dictionnaire fr
* Toujours pas de catégories pour la bibliothèque
* Un Amazonisation au niveau de l'intégration de la boutique Kobo. A surveiller.

Ce dernier point commence à me faire peur et j'en ai parlé sur la liste de diffusion de la beta. Mon argumentaire était que j'avais acheté une liseuse pas une liseuse sponsorisée par des publicités. En plus lors de mon achat il n'existait rien dans le firmware m'indiquant un intégration trop forte sur le site de vente. Cela a au moins l'avantage d'ajouter la possibilité d'afficher ses favoris dans la barre du bas en lieu et place des recommandations.

## Test de liseuses dans Micro Hebdo 714 & 715

voir ici pour le lien : http://www.lekiosque.fr/magazine-1167142-Micro-Hebdo.html
Le bilan est que la Kobo sort deuxième mais est légèrement déclassée du fait qu'elle soit associée avec un magasin en ligne (Kobo + Fnac).

## Le vrai buzz d'avant Noël

Ce buzz vient du format Kepub mis en avant par Kobo, qui logiquement doit juste permettre de facilement synchroniser les livres sur les différents périphériques supportés par Kobo (android, liseuse Kobo Touch, PC, ...). Mais au final cela rends le fichier (vendu comme un epub) lisible uniquement sur une liseuse Kobo donc au revoir l'interopérabilité.

Pour l'instant le Fnac a eu comme réaction de rembourser ce qui n'est pas une vrai réponse.

Je ne vais tout détailler, d'autres l'ont fait mieux que moi : 

* https://plus.google.com/107252663012827113536/posts/9gmCxWEaqDx
* Message de Sony France : http://www.sony.fr/discussions/message/721020#721020

Au final cela oblige l'honnête lecteur (si il veut bidouiller) a devenir un pirate et :

* déplomber le DRM
* enlever les fichier Kobo.css et js ajouté
* et enfin obtenir un **vrai** epub qui puisse être valide.

Pour l'instant je reste (à peu près) droit dans me bottes : je n'ai acheté qu'un livre chez Kobo (un vrai epub avec DRM), un chez Sony (encore un vrai epub avec DRM) et plusieurs chez http://librairie.immateriel.fr/ (epub sans DRM). J'aurais aimé rester sans DRM mais sur des sorties de livres il n'y a pas trop de choix malheureusement.

## Mise à jour des trucs et astuces

J'ai aussi pris le temps de mettre à jour la page des trucs et astuces : [Kobo eReader Touch : trucs et astuces d'origine diverse](/blog/kobo-ereader-touch-5)

## Test exhaustif des formats pris en charge

J'ai pu lire (je ne sais plus ou) que la Kobo ne supportait que le PDF et l'epub. C'est faux !
Je viens de faire un essai avec ma Kobo (pas by Fnac) et un Kobo by Fnac d'un collègue en version 1.9.16 et j'ai réussi à intégrer et lire les formats suivants :

Type de fichier    | Résultat  | Commentaire
---------------    | --------- | -----------
Txt Ansi           | ~OK       | Fichier bien intégré mais les accents sont mal représentés
Txt Utf-8 sans BOM | OK        |
Txt Utf-8 avec BOM | OK        |
Rtf                | OK        | Attention le RTF a été créé avec Wordpad pas Word pour avoir un fichier standard
CBZ avec PNG       | OK        |
CBZ avec JPG       | OK        |
Mobi simpliste     | OK        | j'ai pris l'exemple suivant : [Gutemberg](http://www.gutenberg.org/ebooks/18262)
PDF                | OK        |
EPUB               | OK        |

Je vais compléter le tableau dans la semaine avec des HTML, CBR, images seules et des mobi plus complexes (avec table des matières, ...).

Je mettrai à disposition un zip avec mes cas de tests pour que les sceptiques puissent tester et m'envoyer un [mail](/user/sebastien_lucas) si ils voient des différences sur leur liseuse.

Le fichier zip est : [testkobo.zip](/blog/testkobo.zip)
