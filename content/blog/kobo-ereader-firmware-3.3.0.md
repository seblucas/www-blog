/*
Title: Firmware 3.3.0
Description: 
Author: Sébastien Lucas
Date: 2014/04/23
Robots: noindex,nofollow
Language: fr
Tags: ereader
*/
# Firmware 3.3.0

C'est tout neuf. Cela fait quelques mois que nous testons plusieurs firmwares avec le groupe beta et il commence à être distribué. Je ne sais pas si c'est déjà disponible en France mais cela devrait arriver dans les prochains jours. Il semble être destiné aux Touch, Glo, Aura et Aura HD. Cela doit devenir inquiétant pour les possesseurs de Mini !

## Les changements

Je n'ai encore accès à la liste officielle mais à la fin de la beta nous avions repéré les changement suivants :
 * Lorsque vous finissez un livre, l'ouverture de l'étagère se fait automatiquement.
 * Le pourcentage d'avancement des kepubs est affiché correctement pour les Kobo Touch.
 * Réduction des "dead taps" (avez vous des idées de traduction française ?) qui pouvait créer des signets ou d'avancer de deux pages à la fois.
 * La lumière s'active à partir de 1%!
 * La liste des collections est triée par le nom de fichier si l'option n'est pas spécifié dans le fichier de configuration.
 * Lors de la saisie de notes, la premiere lettre sera une majuscule (le Shift sera activé par défaut).
 * Lors de l'arrêt ou de la mise en veille, il y a d'abord un flash noir avant d'afficher la couverture du livre.

En pratique pas beaucoup de changement qui m'intéressent vraiment mais le support continue.

## Un nouveau problème

Les polices de caractère Gothic et Ryumin auraient perdu le support du gras et de l'italique (attention je ne l'ai pas testé).

## Un changement non officiel intéressant

Si vous ajoutez les lignes suivantes dans votre fichier de configuration `koboEreader.conf` :

```
[FeatureSettings]
FullScreenReading=true
```

La mise en place de ce paramètre ajoute un nouveau menu dans les paramètres de lecture pour paramétrer l'affichage de l'entête et du pied de page lors de la lecture de epub et kepub.

## Source

Mes sources proviennent principalement du groupe beta et notamment de David qui a fait [un excellent message en anglais](http://www.mobileread.com/forums/showpost.php?p=2815222&postcount=17).
