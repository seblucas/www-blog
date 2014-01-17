/*
Title: Le cache fastcgi et Nginx - Partie 3
Description: 
Author: Sébastien Lucas
Date: 2011/10/11
Robots: noindex,nofollow
*/
# Le cache fastcgi et Nginx - Partie 3

## Passage à nginx 1.1.0
Le passage à une version récente de nginx apporte le paramètre fastcgi_cache_bypass qui va me permettre d'avoir une installation rapide et pérenne.

MAIS il faut commencer par régler les régressions (ou les changement de principes).

## Le cache ne fonctionne plus

Après moulte recherche j'ai trouvé une phrase anodine dans le [changelog de nginx](http://nginx.org/en/CHANGES) : en 0.8.44 :

Change: now nginx does not cache by default backend responses, if they have a "Set-Cookie" header line.

Pour régler le problème (c'est à dire forcer le cache même si tout semble indiquer que le cache serait une mauvaise solution), j'ai trouvé une solution sur ce [post](http://forum.nginx.org/read.php?2,121511). Donc mon code ressemble à çà :

	
	location ~ doku\.php$ {
	               fastcgi_cache mycache;
	               fastcgi_cache_key $request_method$host$request_uri;
	               fastcgi_cache_valid 1h;
	               fastcgi_ignore_headers Expires Cache-Control Set-Cookie;
	               include /etc/nginx/fastcgi_params;
	               fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	               fastcgi_pass    unix:/tmp/fcgi.sock;
	}

## Le cache oui mais il faut me laisser bosser :P

Avec la configuration ci dessus le cache est actif pour tout le monde ... même moi. Je ne peux donc plus me connecter pour ajouter/modifier des articles. Je vous laisse imaginer que ce n'est pas une solution viable.

Comme je suis le seul contributeur à ce blog, il faut juste que je trouve une solution pour que le cache ne s'applique pas à moi. La solution la plus simple que j'ai trouvé est de faire un contrôle sur cookie : Si le navigateur du visiteur a un certain cookie alors il ne passe pas par le cache. Bingo ça marche :

	
	location ~ doku\.php$ {
	               set $pasdecache "";
	               if ($http_cookie ~ pasdecache) {
	                        set $pasdecache "Y";
	               }
	               fastcgi_ignore_headers Expires Cache-Control Set-Cookie;
	               fastcgi_cache mycache;
	               fastcgi_cache_key $request_method$host$request_uri;
	               fastcgi_cache_valid 1h;
	               fastcgi_cache_bypass $pasdecache;
	               fastcgi_no_cache $pasdecache;
	               include /etc/nginx/fastcgi_params;
	               fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	               fastcgi_pass    unix:/tmp/fcgi.sock;
	}

J'ai utilisé [Firecookie](/https///addons.mozilla.org/fr/firefox/addon/firecookie/) pour me créer un cookie qui expire en 2013 et cela fonctionne suffisamment pour écrire cet article.


