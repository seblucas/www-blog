/*
Title: Oracle et les fonctions analytiques et autre fonctions à connaitre
Description: 
Author: Sébastien Lucas
Date: 2011/10/20
Robots: noindex,nofollow
Language: fr
Tags: oracle
*/
# Oracle et les fonctions analytiques et autre fonctions à connaitre

## Les fonctions analytiques
Je me suis rendu compte qu'elles étaient assez peu connues (bien que très pratiques) et comme j'ai trouvé un très bon tutoriel sur les fonctions du style AVG, LAG et LEAD, CORR, MAX et MIN, RATIO_TO_REPORT, STDDEV et VARIANCE, NTILE, ROW_NUMBER, RANK, DENSE_RANK et COUNT, FIRST et LAST, FIRST_VALUE et LAST_VALUE, PERCENTILE_CONT et PERCENTILE_DISC et le partitionnement (PARTITION). Lisez avec attention :

http://lalystar.developpez.com/fonctionsAnalytiques/

## La concaténation de chaine de caractères

### Source
*	http://www.oracle-base.com/articles/misc/StringAggregationTechniques.php
*	http://www.oracle-developer.net/display.php?id=306

###  Avant la 10g 

Le plus simple était de passer par une fonction.

###  en 10g : COLLECT 

cela passe par trois étapes :
*	Création d'un type
```sql
CREATE OR REPLACE TYPE t_varchar2_tab AS TABLE OF VARCHAR2(4000);
```
*	Création d'une fonction
```sql
CREATE OR REPLACE FUNCTION tab_to_string (p_varchar2_tab  IN  t_varchar2_tab,
                                          p_delimiter     IN  VARCHAR2 DEFAULT ',') RETURN VARCHAR2 IS
  l_string     VARCHAR2(32767);
BEGIN
  FOR i IN p_varchar2_tab.FIRST .. p_varchar2_tab.LAST LOOP
    IF i != p_varchar2_tab.FIRST THEN
      l_string := l_string || p_delimiter;
    END IF;
    l_string := l_string || p_varchar2_tab(i);
  END LOOP;
  RETURN l_string;
END tab_to_string;
/
```
*	La requête
```sql
SELECT deptno,
       tab_to_string(CAST(COLLECT(ename) AS t_varchar2_tab)) AS employees
FROM   emp
GROUP BY deptno;
```

###  en 11g : LISTAGG 

```sql
SELECT deptno, LISTAGG(ename, ',') WITHIN GROUP (ORDER BY ename) AS employees
FROM   emp
GROUP BY deptno;
```

## Les tables virtuelles

http://www.oracle-developer.net/display.php?id=207

## Transformer les colonnes en lignes ou le pivot

### Le problème
https://forums.oracle.com/forums/thread.jspa?threadID=305252

### En 10g

L'extension MODEL permet de s'en sortir. Voir http://technology.amis.nl/blog/300/pivoting-in-sql-using-the-10g-model-clause.

### En 11g

Cette nouvelle version amène une nouvelle fonction de PIVOT.

## Accès direct à un fichier CSV

http://oracle.developpez.com/guide/architecture/tables/?page=Chap1#L1.5.1
