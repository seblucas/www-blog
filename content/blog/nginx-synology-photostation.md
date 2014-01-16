/*
Title: Nginx et Photostation
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Nginx et Photostation

## Problème
J'ai un nas Synology (voir [Installer un serveur Subversion sur un NAS Synology](blog/synology-subversion-ssh)) et j'utilise activement photostation pour partager avec mes photos de famille. Pour simplifier l'url à donner à ma famille j'ai créé un sous domaine sur mon dockstar et il ne restait plus qu'à configurer nginx pour qu'il fasse office de proxy.
## Configuration nginx

	
	        location /photo {
	                proxy_pass http://192.168.0.42/photo;
	        }
	
	        location /blog {
	                proxy_pass http://192.168.0.42/blog;
	        }
	

Code super simple, il faut juste remplacer l'adresse ip par la bonne. La seule astuce consiste à devoir aussi définir le proxy sur /blog.





