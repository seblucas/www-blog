/*
Title: Détails sur le nouveau site - Volume 1
Description: 
Author: Sébastien Lucas
Date: 2014/04/11
Robots: noindex,nofollow
Language: fr
Tags: blog,nginx
*/
# Détails sur le nouveau site - Volume 1

Comme promis, je vais essayer de détailler le moteur qui fait tourner ce blog.

## Ma problématique

Après quelques années de bons et loyaux services je voulais faire évoluer mon Dokuwiki mais en gardant toujours l'intégralité des pages existantes. J'avais quelques versions de retard et en essayant d'appliquer les nouvelles versions je suis tombé sur quelques problèmes.

De plus le plugin de blogging que j'utilisais n'était compatible qu'avec SQLite 2 ce qui me limitait énormément dans mes choix (notamment en passant en dernière version de Debian).

De plus, j'avais les attentes suivantes pour mon blog :
 * Facilement sauvegardable et déplaçable sur un autre serveur.
 * Affichage le plus rapide possible.
 * Mise en ligne facile de nouveaux articles.
 * Liberté totale du choix de l'interface graphique.
 * Gestion propre de l'historique des éditions d'articles.
 * Les articles doivent être écrits avec une syntaxe simple (wiki, [Markdown](http://fr.wikipedia.org/wiki/Markdown), ...) avec le moins possible d'HTML.

## Mon choix

### De bons vieux fichiers plats

Depuis la fin d'année dernière, je lorgne sur beaucoup d'articles parlant de l'émergence des "Flat File CMS" (je vous laisse faire une recherche Google là dessus). Les plus célèbres candidats sont :
 * [Jekill](http://jekyllrb.com/)
 * [Kirby](http://getkirby.com/)
 * [Statamic](http://statamic.com/)
 * [Ghost](https://ghost.org/)
 * [Octopress](http://octopress.org/)
 * ...

Leur principe est simple :
 * La structure du site est représentée par des répertoires.
 * Les articles sont des fichiers plats (texte).

Bref, il n'y a pas de base de données ce qui simplifie certaines choses.

### La base : Pico

Après beaucoup de recherche, j'ai choisi [Pico](http://picocms.org/) dont les sources sont disponibles sur [Github](https://github.com/picocms/Pico).

J'y ai vu les avantages suivants :
 * Écrit en PHP.
 * Un seul fichier fait tout : `pico.php`.
 * Assez populaire.
 * Il est extensible via des greffons et quelques exemples simples existent.
 * Utilise Markdown.

Ma seule angoisse était que le projet ne bouge pas énormément.

### Quelques modifications de Pico

Je ne vais pas rentrer dans le détail de ce que j'ai du changer (c'est disponible sur [mon Github](https://github.com/seblucas/www-blog)). Les points les plus importants sont :
 * Correction de la détection HTTPS pour Nginx.
 * Mise à jour des dépendances.
 * Ajout de plusieurs greffons : gestion de tags, de l'internationalisation, de la recherche, rss, sitemap, ....
 * Ajout d'un cache rafraîchit automatiquement touted les heures.
 * Utilisation de Parsedown à la place de php-markdown pour plus de rapidité.

Le cache permet de ne pas traiter tous les fichiers de l'arborescence à chaque accès Web. Pour information, le cache consomme 2Mo pour 300 articles. Cela permet de passer de 2s pour afficher une page à 0.35s.

### Tout est stocké sur Github

L'ensemble du site est géré dans [Github](https://github.com/seblucas/www-blog) :
 * la structure liée à Pico ainsi que les fichiers PHP.
 * Les pages du site.
 * Le thème (HTML, Javascript, CSS).
 * Les dépendances : images, zip, ...

Mon mode de fonctionnement actuel est simple :
 * J'écris un article sur mon ordinateur portable (en Markdown).
 * Je le `commit` localement.
 * Je le `push` sur Github régulièrement dans une branche ou dans le master.
 * Quand je veux le publier, je `merge` et je fais un `pull` sur mon VPS.

A terme je voudrais arriver à un workflow plus compliqué ou mon serveur fait un `pull` automatique toutes les heures et fait un `update` sur le tag le plus récent. De cette manière, tout ce qu'il me restera à faire sera de tagger mon dépôt quand les articles sont prêts.

## Bilan

Pour l'instant, je suis satisfait. Je trouve le site un peu plus moderne même si il y a encore beaucoup à faire. Côté technique, le projet était vraiment fun. Le fait que tout soit sur Github est vraiment rassurant.

Dans les articles suivants, je détaillerai mon travail sur le côté graphique et la transformation des articles Dokuwiki au format Markdown.