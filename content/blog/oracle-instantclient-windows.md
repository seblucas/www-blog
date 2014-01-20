/*
Title: Configuration de Oracle Instant Client sous Windows
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
Language: fr
Tags: oracle
*/
# Configuration de Oracle Instant Client sous Windows

## Installation
J'ai installé le contenu de ces deux fichiers :

*	instantclient-basic-win32-10.2.0.5.zip

*	instantclient-sqlplus-win32-10.2.0.5.zip
dans le répertoire c:\oracle.

J'ai ensuite ajouté mes fichiers : 

*	tnsnames.ora

*	slqnet.ora
dans ce même répertoire
## Configuration

Il ne reste plus qu'à mettre à jour les variables d'environnement :

*	Aller dans les propriétés du Poste de travail

*	Onglet Avancé

*	Cliquer sur Variables d'environnement

*	Modifier la variable PATH pour ajouter "c:\oracle;" en début.

*	Ajouter TNS_ADMIN, LD_LIBRARY_PATH et SQLPATH avec la valeur "c:\oracle"





