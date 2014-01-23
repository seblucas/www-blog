/*
Title: Horreur ! VMware Player ne marche plus après une mise à jour Debian !
Description: 
Author: Sébastien Lucas
Date: 2010/12/30
Robots: noindex,nofollow
Language: fr
Tags: debian,vmware
*/
# Horreur ! VMware Player ne marche plus après une mise à jour Debian !

Le message d'erreur de VMware Player parle de vmmon non accessible, j'ai confirmé le problème avec dmesg :
```
[   14.772088] vmmon: disagrees about version of symbol smp_ops
[   14.772092] vmmon: Unknown symbol smp_ops
```
Une petite recherche googlienne plus tard et je tombe sur ce [post](http://valiev.blogspot.com/2010_12_01_archive.html) et la manipulation suivante (à faire en root) :
```
wget http://files.archlinux.org.il/vmmon_fix_2.6.36.sh
chmod +x vmmon_fix_2.6.36.sh
./vmmon_fix_2.6.36.sh
```
Bilan ça marche. Pour ceux qui veulent savoir l'origine du problème (et troller sur les responsables de paquets Debian) : http://lists.debian.org/debian-kernel/2010/12/msg00507.html.





