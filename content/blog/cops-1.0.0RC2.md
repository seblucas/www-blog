/*
Title: COPS 1.0.0RC2
Description: 
Author: Sébastien Lucas
Date: 2014/07/31
Robots: noindex,nofollow
Language: fr
Tags: calibre,ereader,nginx,opds,php
*/
# COPS 1.0.0RC2

Quelques corrections de bugs et quelques évolutions pour cette nouvelle version :
* [Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)
* [Liste des changements](/fr/oss/calibre-opds-php-server-changelog)

## Template bootstrap

Le point le plus important de cette version est l'ajout d'un nouveau template d'affichage utilisant le framework [bootstrap](http://getbootstrap.com/). Pour l'instant, il faut l'activer manuellement en allant dans le paramétrage de COPS (la petite clé en bas à gauche) et en cliquant sur `Click to switch to Bootstrap`. Il est possible de revenir en arrière en cliquant sur l’icône d'image à droite du bouton de recherche.

Mon objectif était d'avoir une interface en colonne ce qui m'a obligé à faire des choix difficiles et préférer des icônes au texte.

Dîtes moi ce que vous en pensez !

## Amélioration Kindle

J'ai aussi passé beaucoup de temps à faire des changements pour que l'affichage soit correct sur les Kindle (merci aux deux utilisateurs qui m'ont aidé).

Là, encore, je n'ai pas de Kindle donc tenez moi au courant.

## Merci aux donateurs

J'avais lancé une campagne de dons (le lien est [ici](/fr/oss/calibre-opds-php-server)) pour pouvoir m'acheter un Kindle et améliorer son support et pour le moment j'ai reçu un peu plus de 50€. Merci à tous les généreux donateurs et si tout va bien mon objectif sera atteint avant la fin de l'année.

## Avenir de COPS

J'ai beaucoup pensé à l'évolution de COPS ces derniers temps. Je veux continuer à le supporter et à le faire évoluer (il y a encore 3 ou 4 manques importants pour mon utilisation spécifique).

Par contre, comme COPS était mon premier projet PHP (je ne connaissais pas le langage avant), j'ai fait beaucoup de très mauvais choix techniques et d'architecture. Au final, COPS devient difficile à faire évoluer.

C'est pourquoi, j'ai commencé il y 2 mois une réécriture complète. Pas d'inquiétude cela ne signifie pas la mort de COPS mais je vais privilégier l'implémentation des nouvelles fonctionnalités dans le nouveau projet. C'est ce qui explique le grand délai entre la version 1.0.0RC1 et cette version.

Ce nouveau projet sera, bien sûr, libre et disponible pour Github, je veux juste me laisser le temps de valider l'architecture avant de le rendre public.

## Merci ;)

Comme d'habitude merci à tous les contributeurs et testeurs.

Bon test à vous.
