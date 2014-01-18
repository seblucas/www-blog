/*
Title: Mise à jour Dokuwiki Anteater et Nginx
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Mise à jour Dokuwiki Anteater et Nginx

## Pourquoi ?
Suite à la dernière mise à jour Dokuwiki, j'ai eu une alerte sécurité me disant que mes répertoires data,conf,inc et bin étaient accessibles de l'extérieur. Et la documentation officielle http://www.dokuwiki.org/security ne donnait pas de solution toute faite pour Nginx.
## Solution

Ajouter les lignes suivantes dans la configuration nginx :
```
location ~ ^/(data|conf|bin|inc) {
  deny all;
}
```

EDIT 04/12/2010 : J'avais oublié un ^ dans mon expression régulière .... c'est mal.






