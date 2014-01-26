/*
Title: Un "correctif" pour la gestion de l'italique avec la version 2.3.1 
Description: 
Author: Sébastien Lucas
Date: 2012/12/19
Robots: noindex,nofollow
Language: fr
Tags: ereader
*/
# Un "correctif" pour la gestion de l'italique avec la version 2.3.1 

C'est dingue, je fais un billet par jour en ce moment !

## Problème d'affichage de l'italique

J'ai trouvé sur [MobileRead](http://www.mobileread.com/forums/showpost.php?p=2346374&postcount=17) un post indiquant que le nom de fichier de la police devait être cohérent avec le nom interne de la police pour que l'affichage de l'italique fonctionne correctement.

Pour avoir le nom interne sous Windows, il suffit de double cliquer sur le fichier ttf (il correspond à la zone Nom de la police).

J'ai donc connecté mon Kobo à l'ordinateur et j'ai renommé les fichiers correspondant à la police Averia Sans de la manière suivante (notez l'espace en plus) : 
*	AveriaSans-Regular.ttf -> Averia Sans-Regular.ttf
*	AveriaSans-Bold.ttf -> Averia Sans-Bold.ttf
*	AveriaSans-BoldItalic.ttf -> Averia Sans-BoldItalic.ttf
*	AveriaSans-Italic.ttf -> Averia Sans-Italic.ttf

Et voila les italiques fonctionnent correctement.

Cela ne concerne que les polices personnalisées mais cela permet de retrouver un rendu correct.


