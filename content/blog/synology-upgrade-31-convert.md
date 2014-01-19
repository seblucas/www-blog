/*
Title: Mise à jour de Diskstation Manager en 3.1 sur NAS Synology et lenteurs 
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
Language: fr
*/
# Mise à jour de Diskstation Manager en 3.1 sur NAS Synology et lenteurs 

## Regle n°1 : Ne pas mettre à jour un système qui fonctionne
Bonne idée du vendredi matin, j'ai mis à jour le firmware de mon NAS en version 3.1. J'avais vaguement lu que dans le cadre de photostation des nouvelles miniatures (en 1280x1280 belle taille pour des miniatures) devaient être faites pour l'Ipad.

Depuis vendredi j'ai un process convert qui doit travailler sur ces miniatures, qui prends 100% du CPU, qui empêche la mise en veille des disques et surtout qui ne me sert à rien vu que je n'aurais certainement jamais d'Ipad (ce n'est pas dans ma philosophie).

Ca m'apprendra à faire des mises à jours non nécessaires.
## Palliatif

En regardant le forum anglais de Synology j'ai trouvé d'autres naufragés comme moi et un palliatif m'a intéressé (voir [ce post](http://forum.synology.com/enu/viewtopic.php?f=169&t=34446&start=15#p139187)) : 
```
/usr/syno/etc/rc.d/S77synomkthumbd.sh stop
```

Cela arrête la génération des miniatures. Il reste encore à voir si un autre service du Synology le redémarre et si ça pose problème à Photostation mais pour l'instant ça me va.



