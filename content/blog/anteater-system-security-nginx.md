---
title: "Mise à jour Dokuwiki Anteater et Nginx"
date: 2010-11-25
tags: [dokuwiki,nginx]
slug: anteater-system-security-nginx
disqus_identifier: /blog/anteater-system-security-nginx
---
# Mise à jour Dokuwiki Anteater et Nginx

## Pourquoi ?
Suite à la dernière mise à jour Dokuwiki, j'ai eu une alerte sécurité me disant que mes répertoires data,conf,inc et bin étaient accessibles de l'extérieur. Et la documentation officielle http://www.dokuwiki.org/security ne donnait pas de solution toute faite pour Nginx.

## Solution

Ajouter les lignes suivantes dans la configuration nginx :

```nginx
location ~ ^/(data|conf|bin|inc) {
  deny all;
}
```

EDIT 04/12/2010 : J'avais oublié un ^ dans mon expression régulière .... c'est mal.






