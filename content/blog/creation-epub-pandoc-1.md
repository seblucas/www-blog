---
title: "Transformer un livre papier en Epub"
date: 2014-05-13
tags: [epub,ereader]
slug: creation-epub-pandoc-1
---
# Transformer un livre papier en Epub

Comme je l'ai dit dans [un article précédent](/blog/creation-epub-pandoc), un ami m'a demandé de l'aide pour créer un fichier Epub. Pour répondre à un défi de ses enfants il a voulu transformer [Ellana L'envol de Pierre Bottero](http://fr.wikipedia.org/wiki/Ellana_l%27envol) en Epub. Il a réalisé le scan, l'OCR et a même créé un fichier Epub (j'essaye de le motiver pour faire un tutoriel).

Par contre il a rencontré les problèmes suivants :

 * Comme la plupart des livres jeunesse il y a une petite image à chaque nouveau chapitre. donc un simple OCR ne suffit pas. Pour l'instant il a décidé de garder ça pour plus tard.
 * Quand je dis qu'il a fait l'OCR, il n'a pas reconstitué les paragraphes ni enlevé les numéros de page. Donc l'Epub généré est illisible.
 * Le découpage des paragraphes n'était pas correct et l'Epub n'avait pas de table des matières.

## Export du texte

Pour récupérer le corps du texte je me suis servi de Calibre. J'ai fait une conversion en TXT en faisant attention de changer le formatage dans la partie "Sortie Texte" pour générer du Markdown.

Le début de mon fichier est de ce style :

```
1 





2 





3 





Préface 



J'aime l'idée d'un savoir transmis de maître à élève. 

J'aime l'idée qu'en marge des «maîtres institutionnels» que sont parents et 

enseignants, d'autres maîtres soient là pour défricher les chemins de la vie et 

aider à y avancer. Un professeur d'aïkido côtoyé sur un tatami, un philosophe 

rencontré dans un essai ou sur les bancs d'un amphithéâtre, un menuisier aux 

mains d'or prêt à offrir son expérience... 



J'aime l'idée d'un maître considérant comme une chance et un honneur 

d'avoir un élève à faire grandir. Une chance et un honneur d'assister aux 

progrès de cet élève. Une chance et un honneur de participer à son envol en lui 

offrant des ailes. Des ailes qui porteront l'élève bien plus haut que le maître 

n'ira jamais. 



J'aime cette idée, j'y vois une des clefs d'un équilibre fondé sur la 

transmission, le respect et l'évolution. 

Je l'aime et j'en ai fait un des axes du *Pacte des Marchombres*. 

...
```

## Transformation du texte

J'ai utilisé le chercher/remplacer de Sublime Text pour les transformations suivantes.

Amateurs d'expressions régulières préparez vous !

### Suppression des numéros de page

Ici je repère toutes les lignes qui ne contiennent que chiffres et je replace par un saut de ligne.

```
Chercher : \n*^\d{1,3}\n+

Remplacer : \n\n
```

### Mise en forme des chapitres

Dans ce livre tous les chapitres commencent par "Chapitre" (sauf pour quelques exceptions). Au dessus des chapitres il y a 3 sections globales (Chutes, Rebonds, Rencontres), c'est pour ça que mes chapitres sont décorés avec deux dièses. J'ai du reprendre certains chapitres à la main.

```
Chercher : ^(Chapitre \d{1,3})\n+

Remplacer : ## $1\n\n
```

### Suppression des faux saut de lignes

Ici c'est plus fourbe, je me suis bien amusé à construire cette expression régulière. L'objectif est de reformer des paragraphes corrects. Je me doute qu'il y a beaucoup d'outils pour le faire automatiquement mais avec cette méthode je n'ai que 5 ou 6 cas à reprendre manuellement.

```
Chercher : ^([^\#\n])(.+)([^\.\?\:\!\»])\n\n

Remplacer : $1$2$3 
```

### Ajout du lien vers la carte du monde

J'ai récupéré une image correspondant à la carte du monde dans lequel le livre se déroule et j'ai pu l'intégrer dans mon fichier Markdown :

```
# L'autre monde

![Carte](carte-monde.png)
```

## Relecture

La relecture est primordiale car toutes les étapes (scan, OCR, formatage, ...) peuvent avoir des effets de bords. J'ai effectué une relecture partielle pour le moment et mon ami et moi faisons un relecture plus assidue avec le livre papier.

## Bilan

Les manipulations ci dessus m'ont pris 2 ou 3 heures et le résultat est correct (la relecture le confirmera ou pas). Le couple Pandoc et Markdown n'est par contre pas adapté pour intégrer les images liées au paragraphes je vais certainement essayer Sigil.