---
title: "Migration du site sur Hugo"
date: 2017-12-29
tags: [blog,hugo]
slug: blog-migration-hugo-1
disqus_identifier: /blog/blog-migration-hugo-1
series: ["Migration Hugo"]
---
# Migration du site sur Hugo

## Pourquoi ?

Comme je l'avais déjà dit précédemment (il y a 3 ans déjà) j'aime le principe de Flat File CMS et j'ai longtemps lorgné sur [Jekill](https://jekyllrb.com/) avant de me décider sur [Hugo](https://gohugo.io/). Je n'ai pas toute une liste d'arguments autour de mon choix, Hugo a la réputation d'être très rapide et j'ai trouvé quelques bons tutoriels donc je me suis lancé.

Mes contraintes étaient les suivantes :

 * Aucune perte de pages
 * Support des tags
 * Liberté totale sur le HTML / CSS / JS
 * On reste sur du Markdown (je n'ai aucune envie d'apprendre autre chose)
 * Si possible un support NoScript pour les adeptes

## Mon choix

### Le thême

Mon choix s'est porté sur [Cocoa Enhanced](https://github.com/mtn/cocoa-eh-hugo-theme), car il est tout simple, tout propre.

Ensuite je l'ai un peu adapté.

### La migration

Je ne vais pas rentrer dans le détail de ce que j'ai du changer (c'est disponible sur [mon Github](https://github.com/seblucas/www-blog), regardez la branche hugo). Les points les plus importants sont :

 * Utilisation de dingue de sed (je pense que je vais faire un article spécial avec tout ce que j'ai appris) : voir [ici](https://github.com/seblucas/www-blog/tree/hugo/tools) pour quelques exemples.
 * Des `git mv` dans tous les sens pour garder l'historique.
 * Des [alias](https://gohugo.io/content-management/urls/#aliases) pour presque toutes les pages pour ne pas perdre le référencement.
 * Je garde l'[internationalisation](https://gohugo.io/content-management/multilingual/)
 * Un peu de changements à la main.


### Déploiement automatique

Tout est toujours sur Github, mais maintenant un push sur Github entraine le déploiement automatiquement. Je l'ai associé à [Netlify](https://www.netlify.com/). Le site est donc hébergé sur un CDN gratuitement, c'est cool.

## Bilan

C'est tout nouveau, mais pour l'instant ça me plait. J'espère que ça me motivera à republier plus d'articles.