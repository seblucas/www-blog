/*
Title: Meilleure gestion des césures pour le firmware 2.0.0
Description: 
Author: Sébastien Lucas
Date: 2012/07/22
Robots: noindex,nofollow
Language: fr
*/
# Meilleure gestion des césures pour le firmware 2.0.0

Suite à la lecture de plusieurs réponses de forums [en anglais](http://www.mobileread.com/forums/showthread.php?t=184838) ou [en français](http://forum.teamalexandriz.org/les_liseuses_debook_readers/mise_jour_2.0_du_kobo_22965.msg142066.html#msg142066), j'ai voulu faire un essai. 

Je suis donc parti d'un firmware ou je n'ai gardé que le fichier gérant les césures et je l'ai modifié avec le dictionnaire de césure de libreoffice que j'ai récupéré sur une Debian Sid. J'ai aussi modifié les paramètres suivants : 

*	LEFTHYPHENMIN 2

*	RIGHTHYPHENMIN 3



Au final :

{{:blog:koboroothyphenfr.zip|}}

La méthode d'installation :

*	Télécharger le fichier

*	Connecter votre liseuse en USB

*	Placer le fichier KoboRoot.tgz (qui est dans le zip) dans le répertoire .kobo de votre liseuse

*	Ejecter la liseuse

*	La débrancher

*	L'installation devrait être très rapide.

J'ai vu des différences (dans le bon sens) mais je dois préciser que comme je désactive la plupart du temps la justification, j'ai très peu de césures.

EDIT : pour répondre à Loendi, les fichiers relatifs au dictionnaire ne sont pas cryptés il sont compressés en gzip. il faut donc les décompresser avec gunzip sous Linux ou 7-zip sous Windows. Une fois décompressés ce sont des fichiers HTML organisés mot par mot par exemple : 

```
`<w>`
`<p>`
`<a name="At"/>`
`<b>`At`</b>`&nbsp;[ate]`<br>`
`<br>`
`<ol>``<li>`Symbole chimique de l`<renvoi id="R218705-1" role="RESEAU">`astate`</renvoi>`.`</li>``</ol>``<br>`de (source&nbsp;`<b>``<b>`a`</b>`s`<b>`t`</b>`ate`</b>`)
`</p>`
`</w>`
```

Je ne pense que ce soit un format standard mais je ne m'y connais pas beaucoup.
