---
title: "How to find unindexed foreign key with Oracle"
date: 2011-12-28
tags: [oracle]
slug: oracle-find-foreign-key-unindexed
disqus_identifier: /en/tips/oracle-find-foreign-key-unindexed
aliases: [/en/tips/oracle-find-foreign-key-unindexed]
---
# How to find unindexed foreign key with Oracle

All credits to : [this post](http://asktom.oracle.com/pls/asktom/f?p=100:11:0::::P11_QUESTION_ID:4530093713805#26568859366976). Here is the script :

```sql
SELECT table_name, constraint_name,
          cname1
       || NVL2 (cname2, ',' || cname2, NULL)
       || NVL2 (cname3, ',' || cname3, NULL)
       || NVL2 (cname4, ',' || cname4, NULL)
       || NVL2 (cname5, ',' || cname5, NULL)
       || NVL2 (cname6, ',' || cname6, NULL)
       || NVL2 (cname7, ',' || cname7, NULL)
       || NVL2 (cname8, ',' || cname8, NULL) COLUMNS
  FROM (SELECT   b.table_name, b.constraint_name,
                 MAX (DECODE (POSITION, 1, column_name, NULL)) cname1,
                 MAX (DECODE (POSITION, 2, column_name, NULL)) cname2,
                 MAX (DECODE (POSITION, 3, column_name, NULL)) cname3,
                 MAX (DECODE (POSITION, 4, column_name, NULL)) cname4,
                 MAX (DECODE (POSITION, 5, column_name, NULL)) cname5,
                 MAX (DECODE (POSITION, 6, column_name, NULL)) cname6,
                 MAX (DECODE (POSITION, 7, column_name, NULL)) cname7,
                 MAX (DECODE (POSITION, 8, column_name, NULL)) cname8,
                 COUNT (*) col_cnt
            FROM (SELECT SUBSTR (table_name, 1, 30) table_name,
                         SUBSTR (constraint_name, 1, 30) constraint_name,
                         SUBSTR (column_name, 1, 30) column_name, POSITION
                    FROM user_cons_columns) a,
                 user_constraints b
           WHERE a.constraint_name = b.constraint_name
             AND b.constraint_type = 'R'
        GROUP BY b.table_name, b.constraint_name) cons
 WHERE col_cnt >
          ALL (SELECT   COUNT (*)
                   FROM user_ind_columns i
                  WHERE i.table_name = cons.table_name
                    AND i.column_name IN
                           (cname1,
                            cname2,
                            cname3,
                            cname4,
                            cname5,
                            cname6,
                            cname7,
                            cname8
                           )
                    AND i.column_position <= cons.col_cnt
               GROUP BY i.index_name)
/
```

Just a quick addition : all foreign key don't have to be indexed but many do.


