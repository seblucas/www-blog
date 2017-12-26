/*
Title: Comment créer un fichier epub avec pandoc et Markdown
Description: 
Author: Sébastien Lucas
Date: 2014/05/07
Robots: noindex,nofollow
Language: fr
Tags: epub,ereader
*/
# Comment créer un fichier epub avec Pandoc et Markdown

## De la simplicité

Après mon précédent article sur le [sujet](/blog/creation-epub-word-calibre), je n'ai pas vraiment réutilisé ce que j'avais appris. Par contre Georges R.R. Martin a publié [un autre chapitre de Winds of Winter](http://awoiaf.westeros.org/index.php/The_Winds_of_Winter) et cela m'a un peu remotivé. Au final j'ai trouvé quelque chose qui est nettement plus simple.

## Installer Pandoc

Tout est expliqué sur le [site de l’outil](http://johnmacfarlane.net/pandoc/installing.html). Je l'ai testé sous Linux et sous Windows et l'utilisation a été aussi simple.

A noter que sous Windows, l’exécutable est installé dans `C:\Users\MON_USER\AppData\Local\Pandoc\pandoc.exe` ce qui n'est pas très naturel.

## Récupérer la source à transformer

Encore une fois je suis passé par un simple copier coller du site vers mon éditeur de texte préféré ([Sublime Text](http://www.sublimetext.com/) dans mon cas).

## Mise en forme Markdown

J'en ai déjà parlé mais j'apprécie vraiment ce format surtout grâce à sa simplicité. Il y a des tutoriels partout sur le Net, je ne vais donc pas en ajouter un autre. Ce qu'il faut retenir :

 * Il faut avoir une ligne vide entre chaque paragraphe.
 * Les titre de chapitres sont de la forme `# Chapitre X`.
 * L'italique se fait en entourant le texte avec une étoile.
 * Le gras se fait en entourant le texte avec deux étoiles.

Après mon copier/coller j'ai donc du modifier les retours à la ligne pour les doubler (pour avoir des vrais paragraphes). J'ai fait un simple chercher/remplacer.

J'ai ensuite passé du temps pour repérer et mettre en forme les parties de texte en italique. C'est le seul moment un peu fastidieux.

## On transforme

La transformation peut être toute simple :

```bash
pandoc -o resultat.epub source.md
```

Mais il est aussi possible de faire quelque chose de plus complexe :

```bash
pandoc -o resultat.epub source.md --epub-cover-image=cover.jpg --epub-metadata=metadata.xml
```

Une petite explication des paramètres :

 * --epub-cover-image=cover.jpg : Pour spécifier une image de couverture
 * --epub-metadata=metadata.xml pour spécifier les métadonnées du fichiers epub (auteur, titre du livre, éditeur, ...)

Pour les métadonnées (`metadata.xml`) j'utilise la matrice suivante :

```xml
<dc:title>TITRE DU LIVRE</dc:title>
<dc:language>LANGUE DU LIVRE (fr, en, ...)</dc:language>
<dc:creator opf:role="aut" opf:file-as="AUTEUR : NOM, PRENOM">AUTEUR : PRENOM NOM</dc:creator>
<dc:publisher>EDITEUR</dc:publisher>
<dc:description>RESUME DU LIVRE</dc:description>
<dc:subject>CATEGORIES (Fantasy, SF) IL PEUT Y EN AVOIR PLUSIEURS</dc:subject>
```

## Bilan

Je me suis fait un joli Epub avec tout les extraits de Winds Of Winter que j'ai pu trouver très rapidement et en utilisant très peu d'outils. Je trouve la méthode beaucoup plus simple que la précédente.

J'ai regardé un peu le fichier Epub généré et il est simple avec une feuille de style très légère et un code HTML logique (les paragraphes sont notamment des balises `<p>` et pas des `<div>`).

Je me suis lancé dans la création d'un vrai Epub complet à partir d'un scan avec un ami donc j'en reparlerai rapidement.

## Sources

 * [http://puppetlabs.com/blog/automated-ebook-generation-convert-markdown-epub-mobi-pandoc-kindlegen](http://puppetlabs.com/blog/automated-ebook-generation-convert-markdown-epub-mobi-pandoc-kindlegen)
 * [http://johnmacfarlane.net/pandoc/epub.html](http://johnmacfarlane.net/pandoc/epub.html)
 * [http://johnmacfarlane.net/pandoc/README.html#pandocs-markdown](http://johnmacfarlane.net/pandoc/README.html#pandocs-markdown)





