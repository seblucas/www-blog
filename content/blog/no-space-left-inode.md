/*
Title: No space left on device et pourtant il reste de la place
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# No space left on device et pourtant il reste de la place

## Le problème
J'avais été confronté à ce problème il y a quelques années et je viens de reperdre du temps ce matin de la même manière. Sur le Dockstar, j'essaye bêtement de créer un nouveau script à mettre dans la cron et là le message d'erreur ultime :

	
	No space left on device

Ma première réaction est de faire un df pour me rendre compte qu'il me reste environ 60% de place disponible.
## L'explication

Il reste bel et bien de la place disponible mais plus d'inodes. Pour vérifier cela :

	
	df -i


Pour retrouver les fichiers fautifs j'ai emprunté la méthode expliquée [ici](http://www.ivankuznetsov.com/2010/02/no-space-left-on-device-running-out-of-inodes.html). Dans mon cas j'ai exécuté les commandes suivantes

	
	for i in /*; do echo $i; find $i |wc -l; done
	for i in /var/*; do echo $i; find $i |wc -l; done
	for i in /var/lib/*; do echo $i; find $i |wc -l; done


Pour trouver que c'était les sessions PHP (fichiers sess_GUID) qui prenaient une place de folie. J'ai donc ajouté le script suivant dans mon cron.daily :

	:::bash
	find /var/lib/php5/ -type f -cmin +1440 -print0 | xargs -r -0 rm

Ce script supprime toutes les sessions vieilles de plus d'une journée (1440 minutes).

Je vais ajouter ce genre de test sur mes machines supervisées par Zabbix car c'est vraiment trompeur.






