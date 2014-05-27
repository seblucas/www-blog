/*
Title: La gestion des différentes cultures avec SQLite - Partie 2
Description: 
Author: Sébastien Lucas
Date: 2014/05/26
Robots: noindex,nofollow
Language: fr
Tags: sql,sqlite
*/
# La gestion des différentes cultures avec SQLite - Partie 2

## Les expressions régulières

La bibliothèque ICU présentée dans l'[article précédent](/blog/sqlite-icu-extension-1) permet aussi de faire des recherche par expressions régulières (beaucoup plus puissant qu'un `like`).

## Premier essai

```sql
sqlite> select title from books where title REGEXP '[eéèêë]p[eéèêë]e';
```

Je dois vous avouer que j'ai été très étonné mais cela ne renvoie aucun résultat.

Cela est du au fait que la recherche se fait sur toute la chaîne et donc correspond en fait à `^[eéèêë]p[eéèêë]e$`.

**Première déconvenue**

## Deuxième essai

```sql
sqlite> select title from books where title REGEXP '.*[eéèêë]p[eéèêë]e.*';
epee
épée
èpèe
```

C'est mieux ! Mais il y a toujours le problème de la majuscule et la saisie n'est pas simple.

**Deuxième déconvenue**

## Bilan

Cela ne correspond pas du tout à mon besoin dans COPS. Ce dont j'aurais besoin se rapproche plus la fonctionnalité de recherche de chaîne de caractères qui fait partie de ICU (voir [ici](http://userguide.icu-project.org/collation/icu-string-search-service) ou [là](http://icu-project.org/apiref/icu4c/usearch_8h.html)). Cette fonctionnalité permet notamment de faire de la recherche asymétrique c'est à dire que si je recherche le caractère `é` alors il ne me trouvera que les mots contenant `é` alors que si je recherche `e` alors je retrouve tous les mots contenant `e` et toutes ses variantes accentuées.

Je vais voir pour coder et tester cela (mon dernier programme en C date un peu).