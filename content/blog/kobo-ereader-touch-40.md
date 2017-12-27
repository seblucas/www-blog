---
title: "ATTENTION : Ne pas installer les mises à jour Kobo manuellement"
date: 2012-10-19
tags: [ereader]
slug: kobo-ereader-touch-40
disqus_identifier: /blog/kobo-ereader-touch-40
---
# ATTENTION : Ne pas installer les mises à jour Kobo manuellement

Il y avait déjà quelques messages à ce sujet de MDK (dernièrement [ici](http://www.mobileread.com/forums/showpost.php?p=2270166&postcount=42)) et depuis hier un utilisateur de Glo en a fait la douloureuse expérience en installant une mise à jour prévue certainement pour un Touch.

Vous pouvez lire la fin de son expérience ici : http://www.mobileread.com/forums/showthread.php?t=185660&page=2. Un développeur de Kobo (George Talusan) a envoyé une liste de commande à lancer pour réparer le Glo. Un autre sujet a été posté sur le même sujet avec une autre astuce : http://www.mobileread.com/forums/showthread.php?t=194206.

Ce qu'il faut retenir, un fichier d'update contient trois fichiers :

* Koboroot.gz : Futur système de fichier. Devrait être commun aux 3 environnements
* Manifest.md5sum : Somme de contrôle MD5
* Update file : Ce fichier contient notamment des mises à jour de UBoot (comme sur les Dockstar et autre PlugComputer) qui lui peut être différent entre les modèles de Kobo. Il contient aussi le fichier uImage (grosso modo le noyau) qui pourrais aussi être différent.

Je ne mettrais donc plus à disposition les liens direct sur les firmwares. Si vous voulez tenter l'aventure il reste le sujet sur MobileRead : http://www.mobileread.com/forums/showthread.php?t=185660.

A noter que mon Touch (à l'origine venant des Etats Unis) ne veux toujours pas installer la version 2.1.5.


