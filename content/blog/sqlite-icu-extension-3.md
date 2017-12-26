---
title: "La gestion des différentes cultures avec SQLite - Partie 3"
date: 2014-05-29
tags: [sql,sqlite]
slug: sqlite-icu-extension-3
---
# La gestion des différentes cultures avec SQLite - Partie 3

## La compilation de l'extension ICU

La bibliothèque ICU présentée dans les articles précédents ([ici](/blog/sqlite-icu-extension-1) et [là](/blog/sqlite-icu-extension-2)) est assez simplement modifiable et j'ai créé un projet Github que je vais mettre à jour au fur et à mesure de mes découvertes. Pour être complet, je vais donc documenter comment compiler l'extension.

### Documentation officielle

La documentation officielle est disponible [ici](https://github.com/seblucas/sqlite-enhanced-icu/blob/master/README.txt).

### Installation des dépendances

```bash
aptitude install libicu-dev libsqlite3-dev build-essential
```

### Récupération des sources

Pour simplifier j'ai fait un paquet sur Github :

```bash
wget https://github.com/seblucas/sqlite-enhanced-icu/archive/0.0.1.tar.gz
tar xvzf 0.0.1.tar.gz
cd sqlite-enhanced-icu-0.0.1/
```

### Compilation

```bash
gcc -shared icu.c `icu-config --ldflags` -fPIC -o libSqliteIcu.so
```

le flag `-fPIC` n'est obligatoire que si vous utilisez un OS 64 bits.

## Une autre extension

Comme c'est souvent le cas, c'est après avoir codé un truc qu'on se rend compte que ça existait déjà.

Ici la bibliothèque que j'ai trouvé ne correspond pas à 100% à ce que je veux vu qu'elle gère uniquement les collations et la gestion de la casse.

Je vous laisse donc découvrir [nunicode](https://bitbucket.org/alekseyt/nunicode).