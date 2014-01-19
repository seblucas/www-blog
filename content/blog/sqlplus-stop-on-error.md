/*
Title: Comment faire pour que Sqlplus s'arrête en cas d'erreur
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
Language: fr
*/
# Comment faire pour que Sqlplus s'arrête en cas d'erreur

Dans le cas de requête automatique (notamment d'intégration continue) il est intéressant d'arrêter le script à la première erreur ce qui n'est pas le mode de fonctionnement par défaut de sqlplus. Il suffit d'ajouter en début du script à exécuter :
```
WHENEVER OSERROR  EXIT 9
WHENEVER SQLERROR EXIT SQL.SQLCODE
```

La première ligne permet de gérer les erreurs liées à l'OS (un script absent, une erreur SP2, ...) tandis que la deuxième gère les erreurs SQL.

Source : [http://www.orafaq.com/wiki/SQL*Plus_FAQ](http://www.orafaq.com/wiki/SQL*Plus_FAQ)





