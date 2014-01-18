/*
Title: Sqlplus en mode console et les caractères accentués
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Sqlplus en mode console et les caractères accentués

## Invite de commande Windows
Il faut savoir que l'encodage de caractères dans une invite de commande Windows n'est pas la même que dans Windows (CP850 en ligne de commande et Win1252 pour le reste). Donc si vous voulez voir correctement les caractères spéciaux il faut changer la variable d'environnement NLS_LANG : 
```
set NLS_LANG=FRENCH_FRANCE.WE8PC850
```
## Invite de commande Windows et scripts externes

Dans le cas de lancement de scripts externes (avec @) il faut encore changer son fusil d'épaule et spécifier le NLS_LANG en fonction de l'encodage des scripts donc sous Windows certainement de la façon suivante :
```
set NLS_LANG=FRENCH_FRANCE.WE8MSWIN1252
```
## Console Linux via Putty

Le maître mot est la **cohérence**.

Donc si votre console a une configuration du style LANG=fr_FR.UTF-8 alors :

*	Il faut modifier la configuration de votre session putty (Dans Window -> Translation) pour choisir le jeu de caractères UTF-8.

*	Modifier votre bash_profile pour ajouter le bon NLS_LANG ou lancer votre sqlplus de la façon suivante (via un alias) : 
```
NLS_LANG=FRENCH_FRANCE.UTF8 sqlplus
```

Dans le même série si LANG=fr_FR.iso885915@euro : 

*	Putty : ISO-8859-15

*	NLS_LANG=FRENCH_FRANCE.WE8ISO8859P15

En procédant comme ça, jamais de problème avec les caractères accentués. Au pire il reste sqlplusw, Toad ou isqlplus.







