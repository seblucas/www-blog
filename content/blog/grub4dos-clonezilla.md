/*
Title: Comment démarrer Clonezilla avec Grub4dos
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Comment démarrer Clonezilla avec Grub4dos

## Enfin !
Après de nombreux, nombreux, nombreux essais j'ai enfin trouvé une solution qui fonctionne. Pour information j'ai essayé avec clonezilla-live-1.2.8-23-i686.iso (voir http://clonezilla.org/ pour le téléchargement).
## Copie de l'iso sur la clé

J'ai choisi de créer un dossier Iso sur ma clé dans lequel j'ai copié le fichier clonezilla-live-1.2.8-23-i686.iso.
## Modification du menu.lst

Ajouter dans votre menu.lst (voir [Utiliser une clé USB pour démarrer Debian](/blog/grub4dos-usb-debian)) :

	
	title Clonezilla 
	find --set-root /Iso/clonezilla-live-1.2.8-23-i686.iso 
	map --heads=0 --sectors-per-track=0 /Iso/clonezilla-live-1.2.8-23-i686.iso (0xff) 
	map --hook 
	root (0xff)
	loopback loop /Iso/clonezilla-live-1.2.8-23-i686.iso 
	kernel /live/vmlinuz boot=live live-config union=aufs nolocales noprompt vga=788 edd=off ip=frommedia toram findiso=/Iso/clonezilla-live-1.2.8-23-i686.iso 
	initrd /live/initrd.img 






