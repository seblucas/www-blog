/*
Title: How to find long running queries with Oracle
Description: 
Author: Sébastien Lucas
Date: 2014/03/03
Robots: noindex,nofollow
Language: en
Tags: oracle
*/
# How to find long running queries with Oracle

```sql
select elapsed_time/1000000 seconds, gv$sql.*
from gv$sql
order by elapsed_time desc;
```

If you need to check the content of the placeholders (:paramX) then try this query :

```sql
select * from v$sql_bind_capture bc
where bc.sql_id = 'SQL ID' and bc.child_number = XXXX
```

Source : Stackoverflow but lost the direct link.