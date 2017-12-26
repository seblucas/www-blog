---
title: "Migration Git vers Mercurial"
date: 2011-02-08
tags: [git,mercurial]
slug: git-to-mercurial
---
# Migration Git vers Mercurial

## Pourquoi
Dans la série "je fais des forks" (voir [Migration de Subversion vers Mercurial](/blog/subversion-to-mercurial)), j'ai du travailler sur un projet actuellement hébergé sur github (et donc Git) comme je préfère travailler avec mercurial j'ai du le porter.

## Pré-requis

il faut bien sur que mercurial soit installé et il faut aussi installer le client git :

```
aptitude install git-core
```
il faut aussi activer l'extension convert en modifiant le fichier /etc/mercurial/hgrc.d/hgext.rc et en décommantant la ligne 

```
#hgext.convert =
```

## Lancement de la conversion : 1er essai

```
hg convert git://github.com/xxx/project.git copie
```
Et là comme avec subversion, ça ne marche pas avec une erreur bizarre.

## Lancement de la conversion : 2ième essai

### Clone local

```
git clone git://github.com/xxx/project.git project
```

### Conversion

```
hg convert project copie
```
Ca marche !





