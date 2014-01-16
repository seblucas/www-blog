/*
Title: Migration sur un VPS L de 1&1
Description: 
Author: Sébastien Lucas
Date: 2012/01/05
Robots: noindex,nofollow
*/
# Migration sur un VPS L de 1&1

## Fin du serveur temporaire
Suite au crash de ma clé USB, j'ai du migrer sur un serveur temporaire ([Mon cadeau de Noël : le site cassé](blog/cadeau-noel-site-out)), je suis passé à un hébergement moins amateur. J'ai donc loué un VPS L de 1&1 avec les caractéristiques suivantes :

*	4 Cpu de 500Mhz

*	2048Mo de RAM dont 512Mo de garanti

*	20Go de disque dur en Raid 5

*	Virtualisation avec Virtuozzo

## Service commercial à revoir

Je ne sais pas si c'est parce que ma commande s'est faite entre Noël et Nouvel An mais le service commercial a été un peu mou et j'ai même failli m'énerver. Au final la livraison a été faite en 3 jours après envoi d'une copie de ma carte d'identité et d'un justificatif de domicile.
## Côté technique

Via l'administration 1&1, j'ai accès a une interface Web me permettant d'arrêter/démarré ma machine quand je veux. Je peux aussi la réinitialiser si nécessaire.

La version de Debian préinstallé est une Lenny donc j'ai été obligé de migrer vers une Squeeze (version stable) en mettant à jour le /etc/apt/sources.list :

	
	deb http://update.onlinehome-server.info/distribution/debian squeeze main contrib non-free
	deb http://update.onlinehome-server.info/distribution/debian-security squeeze/updates main contrib non-free
	
	deb http://www.backports.org/debian squeeze-backports main

avant de lancer un 
  aptitude upgrade
  
A part ça le reste de l'installation s'est bien passé et j'ai pu faire le transfert DNS hier dans l'après midi.

A bientôt pour la suite avec certainement l'apparition des commentaires vu que j'ai la puissance nécessaire.
## Performance actuelle

J'ai fait un test avec [blitz.io](http://blitz.io/gb8bLRUrhuEzl) pour vérifier les performances et ça a l'air d'aller. Voila le graphique :
{{ :blog:responsetimes.png? |}}
