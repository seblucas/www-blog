/*
Title: Comment passer au noyau 3.5 sur le Dockstar (Archlinux)
Description: 
Author: Sébastien Lucas
Date: 2012/10/03
Robots: noindex,nofollow
Language: fr
Tags: archlinux,dockstar
*/
# Comment passer au noyau 3.5 sur le Dockstar (Archlinux)

Comme je l'ai déjà dit auparavant je suis passé à Archlinux sur le Dockstar essentiellement pour la gestion matérielle de la cryptographie mais aussi pour bénéficier d'un noyau plus récent (3.1) alors que la Squeeze en 2.6.36.

J'ai voulu tester le noyau 3.5 notamment pour le [BFQ](http://retis.sssup.it/~fabio/linux/bfq/) qui théoriquement permet d'éliminer totalement les latences de connexion quand le Dockstar sature sur les I/O (copie réseau par exemple). 

Attention à bien lire l'ensemble cet article car il faut vérifier certaines choses pour éviter le drame.

## Mise à jour de Uboot

C'est le point principal à vérifier : pour installer un noyau après le 3.1, il faut obligatoirement avoir un Uboot récent sous peine de ne plus pouvoir démarrer. La mise à jour est simple : 
```bash
cd /tmp
wget http://projects.doozan.com/uboot/install_uboot_mtd0.sh
chmod +x install_uboot_mtd0.sh
./install_uboot_mtd0.sh
```

A la fin de l'installation, une invite proposera de mettre à jour les variables d'environnement Uboot : faites attention de ne le faire que si vous avez bien tout sauvegardé ou que vous pouvez facilement tout modifier de mémoire (netconsole, délai de chargement, ...).
## Mise à jour du numéro d'architecture (archnumber)

Cette phase ne doit pas être obligatoire mais cela permet d'être au propre. Le numéro d'architecture était 2097 précédemment (c'est le numéro du Sheevaplug), le Dockstar a obtenu depuis son propre numéro : 2998.

donc à vérifier avec :
```
fw_printenv arcNumber 
```

et éventuellement à mettre à jour avec :
```
fw_setenv arcNumber 2998
```
## Mise à jour du noyau

Simple : 
```
pacman -S linux-kirkwood linux-headers-kirkwood
```

Un petit reboot et tout doit fonctionner comme avant.
## Kernel Oops

Comme je n'ai pas de bol, cette mise à jour ne me conviens pas. Mon Dockstar était parfaitement stable avec le noyau 3.1 (quelques mois d'uptime) et après 24 heures de noyau 3.5, j'ai eu le plaisir d'avoir une erreur noyau liée à mon utilisation de nzbget. J'ai essayé de compiler la dernière version mais cela n'a rien corrigé.

Donc retour en version 3.1 :
```
pacman -S linux linux-headers
```

Beaucoup d'utilisateurs de Dockstar utilisent le noyau 3.5 donc si vous n'utilisez pas nzbget, n'hésitez pas à essayer.
