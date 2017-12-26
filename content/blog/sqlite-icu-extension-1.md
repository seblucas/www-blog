/*
Title: La gestion des différentes cultures avec SQLite - Partie 1
Description: 
Author: Sébastien Lucas
Date: 2014/05/18
Robots: noindex,nofollow
Language: fr
Tags: sql,sqlite
*/
# La gestion des différentes cultures avec SQLite - Partie 1

## Pourquoi un article à ce sujet ?

Depuis que je travaille sur [COPS](/en/oss/calibre-opds-php-server) je me suis souvent plongé sur les problèmes de tri et de recherche avec les caractères accentués français. J'ai eu plusieurs mails d'utilisateurs qui voulaient faire des recherches sans spécifier les accents (rechercher epee retrouve tous les livres comportant le mot épée). De mon côté ce qui m'embêtait le plus était l'ordre d'affichage des auteurs et des livres pour les cas qui commencent par des caractères accentués.

Je vais essayer de rentrer dans le détail avec des exemples précis dans la suite de cet article.

## Mise en avant du problème de tri

Je me suis donc connecté sur une base Calibre avec des œuvres françaises. J'ai ensuite lancé la requête utilisée par COPS pour regrouper les livres par leur première lettre et voila le résultat :

```sql
SQLite version 3.7.13 2012-06-11 02:05:22
Enter ".help" for instructions
Enter SQL statements terminated with a ";"
sqlite> select substr (upper (sort), 1, 1) as title, count(*) as count
   ...> from books
   ...> group by substr (upper (sort), 1, 1)
   ...> order by substr (upper (sort), 1, 1);
1|8
2|4
3|1
4|1
5|2
9|1
A|51
B|32
C|127
D|72
E|43
F|62
G|23
H|40
I|16
J|16
K|9
L|51
M|91
N|21
O|21
P|86
Q|2
R|58
S|81
T|53
U|4
V|26
W|2
X|2
Y|3
Z|5
À|3
Â|2
Ç|2
É|5
é|8
î|1
œ|1
```

Et là vous voyez le problème, ma requête est censée être ordonnée (voir le order by) mais tous les caractères spéciaux se retrouvent à la fin après le Z. En plus, certaines lettres restent en minuscule.

## Mise en avant du problème de recherche

Je me suis créé une base de test avec le mot "épée" orthographié de façon différente :

 * epee
 * épée
 * Épée
 * Epee
 * èpèe

J'ai ensuite fait une requête avec un "Like" qui, en SQLite, ne tient pas compte de la casse pour les caractères latins.

```sql
sqlite> select title from books where title like '%épée%';
épée
sqlite> select title from books where title like '%epee%';
epee
Epee
```

Outre le fait qu'il serait agréable qu'une recherche de "epee" ne se préoccupe pas des accents nous voyons bien que pour la première requête le mot "Épée" n'a pas été retenu donc la promesse de non sensibilité à la casse n'est pas tenue.

## SQLite n'est pas prêt pour le français

En effet, par défaut, il est possible de stocker des données de plusieurs cultures dans une base SQLite mais leur exploitation est plus difficile.

Le cas est encore plus vrai pour les caractères non latins (cyrillique, slave, persan, ...)

## Un embryon de solution : ICU

Dans les sources de SQLite il y a un [répertoire icu](http://www.sqlite.org/src/tree?name=ext/icu) avec les sources d'un plugin permettant d'ajouter des capacités d'internationalisation à SQLite.

Je ne vais pas rentrer dans le détail de la compilation (je le ferais peut être plus tard si vous m'en parlez dans les commentaires) mais je l'ai compilé et activé via la commande suivante :

```sql
sqlite> .load './libSqliteIcu.so'
sqlite> select icu_load_collation ('fr_FR', 'FRENCH');
```

## Le tri avec ICU

Dans la section précédente j'ai défini la collation FRENCH que je vais utiliser ici :

```sql
sqlite> select substr (upper (sort), 1, 1) as title, count(*) as count
   ...> from books
   ...> group by substr (upper (sort), 1, 1)
   ...> order by substr (upper (sort), 1, 1) collate FRENCH;
1|8
2|4
3|1
4|1
5|2
9|1
A|51
À|3
Â|2
B|32
C|127
Ç|2
D|72
E|43
É|13
F|62
G|23
H|40
I|16
Î|1
J|16
K|9
L|51
M|91
N|21
O|21
Œ|1
P|86
Q|2
R|58
S|81
T|53
U|4
V|26
W|2
X|2
Y|3
Z|5
```

Ça marche mieux !

Les deux problèmes précédents sont résolus :

 * les variations du A sont correctement positionnées avant le B (c'est l'effet du `collate FRENCH`).
 * certaines lettres sont correctement mises en majuscule (î, é, ...). La fonction upper est modifiée par ICU pour gérer correctement les accents.

## Amélioration de la recherche avec ICU

En reprenant le même cas que précédemment (la base avec les différentes orthographes pour épée), cela donne :

```sql
sqlite> select title from books where title like '%épée%';
épée
Épée
sqlite> select title from books where title like '%epee%';
epee
Epee
```

Il y a du mieux dans le sens que le Like devient réellement non sensible à la casse. Par contre, il y a encore du boulot pour avoir une recherche simple.

## Et ça arrive quand dans COPS ?

Malheureusement pas tout de suite :

 * Pour utiliser la bibliothèque ICU, il faut la compiler ce qui n'est pas très user friendly.
 * Les utilisateurs de COPS utilisent beaucoup de matériels différents (Synology, NAS Zyxel, QNap, PC normal) ce qui ne simplifie pas la tâche pour que cette fonctionnalité puisse toucher le plus grand nombre.
 * J'utilise la bibliothèque PDO pour que PHP accède à la base SQLite et celle-ci ne peut pas charger de bibliothèque externe. Il faudrait utiliser la bibliothèque SQLite3 directement.

Par contre, j'apprends et c'est important.
