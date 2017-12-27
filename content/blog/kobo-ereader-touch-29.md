---
title: "Epub et le dictionnaire français sur le Kobo"
date: 2012-08-29
tags: [ereader]
slug: kobo-ereader-touch-29
disqus_identifier: /blog/kobo-ereader-touch-29
---
# Epub et le dictionnaire français sur le Kobo

J'ai reçu beaucoup de message de personnes qui ont des problèmes avec le dictionnaire. Le principal problème est que la définition par défaut (dans la popup) est en anglais.

D'après mes tests, le problème vient des fichiers epubs eux-même. Comme je l'ai dit dans un précédent article un fichier epub est un fichier zip, donc j'ai ouvert un fichier epub avec 7-zip (mon gestionnaire de zip préféré) et j'ai ensuite ouvert le fichier content.opf qui contient les métadonnées du libre et j'ai trouvé la ligne suivante : 

```
<dc:language>UND</dc:language>
```

La langue du livre est dans ce cas UND (undetermined certainement ??) alors qu'il est bien écrit en français. Si j'ouvre un autre livre français j'ai bien :

```
<dc:language>fr</dc:language>
```

Dans le premier cas (UND) un clic long sur un mot fait apparaitre le dictionnaire par défaut (donc l'anglais) dans le deuxième cas (fr) le dictionnaire français. J'ai pu le tester sur deux livres et en faisant un redémarrage de la liseuse entre chaque essai.

J'ai indiqué lors de discussions dans le groupe beta que dans le cas ou la dictionnaire n'existe pas pour la langue du fichier epub, il serait mieux que le dictionnaire correspondant à la langue du Kobo plutôt que l'anglais.

Merci de m'indiquer si mon explication colle aux problèmes que vous avez repérés.

