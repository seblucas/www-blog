/*
Title: Préparer le passage à Systemd sur Archlinux
Description: 
Author: Sébastien Lucas
Date: 2013/03/09
Robots: noindex,nofollow
*/
# Préparer le passage à Systemd sur Archlinux

Le weekend dernier avant la sortie de COPS ([COPS 0.3.2](blog/cops-0.3.2)) j'ai voulu faire un test avec PHP5.4 sur mon Dockstar et j'ai été obligé de faire un redémarrage de php-fpm. Habituellement je fais :

	
	rc.d stop php-fpm
	rc.d start php-fpm

Mais là j'ai le désagréable message suivant :

	
	:: Daemon script php-fpm does not exist or is not executable.

Après recherche cela est au passage de Sysvinit à [Systemd](https///wiki.archlinux.org/index.php/Systemd) de Archlinux. Vous trouverez donc ci-après la méthode de migration la plus sure que j'ai trouvée.

Source : http://archlinuxarm.org/forum/viewtopic.php?f=18&t=4979

## Préparation de systemd

	
	pacman -Sy systemd-sysvcompat
	pacman -Qo /sbin/init

Bien accepter les demandes de confirmation. Ensuite vous devriez pouvoir vérifier ceci :

	
	[root@minus ~]# ls -l /sbin/init
	lrwxrwxrwx 1 root root 26 16 janv. 19:38 /sbin/init -> ../usr/lib/systemd/systemd

## Paramétrage des services à démarrer

Au minimum il faut activer les services suivants

	
	systemctl enable dhcpcd@eth0.service
	systemctl enable sshd.service


Pour obtenir la liste des services activables :

	
	ls /usr/lib/systemd/system/*.service


Vous devez la comparer aux services que vous avez activé dans la section DAEMONS de votre rc.conf :

	
	grep "DAEMON" /etc/rc.conf


J'ai personnellement activé les services suivants :

	
	systemctl enable php-fpm.service
	systemctl enable ntpd.service
	systemctl enable syslog-ng.service
	systemctl enable rpcbind.service
	systemctl enable rpc-mountd.service
	systemctl enable nfsd.service

## Reboot

Le moment stressant, il faut rebooter. Je n'ai eu aucun problème et j'espère qu'il en sera de même pour vous.
## Après le reboot

Systemd doit être activé, vous pouvez donc mettre à jour votre nom d'hôte et la locale par defaut :

	
	localectl set-locale LANG="fr_FR.utf8"
	hostnamectl set-hostname minus


Vous pouvez aussi vérifier le bon chargement de vos services : 

	
	systemctl status php-fpm

## La suite

Dans ce cas le système est encore mixte : le fichier rc.conf existe encore et est encore lu. Dans l'absolu il faudrait supprimer la paquet initscript pour avec un systeme 100% systemd.

Pour l'instant je n'ai pas sauté le pas.
