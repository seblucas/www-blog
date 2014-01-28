/*
Title: Some useful queries / tricks around Oracle Materialized Views
Description: 
Author: Sébastien Lucas
Date: 2012/03/28
Robots: noindex,nofollow
Language: en
Tags: oracle
*/
# Some useful queries / tricks around Oracle Materialized Views

## Get all materialized views

```sql
select * from user_mviews
```

## Get latest refresh times for all materialized views

```sql
select * from user_mview_refresh_times
```

## Get information on a log

```sql
select count(*) from mlog$_MyTable;
```

## Get the list of all materialized views on a view log

```sql
SELECT master, owner, NAME, snapshot_site, 
TO_CHAR(current_snapshots,'mm/dd/yyyy hh24:mi') current_snapshots
FROM user_registered_snapshots, user_snapshot_logs
WHERE user_registered_snapshots.snapshot_id = user_snapshot_logs.snapshot_id (+)
```
First column is the master table and name is the materialized view name. An interesting information is the last date to check for never updated view and growing logs.

Source : http://www.oracle-developer.com/mv_refresh.html

## Refresh a view

```sql
execute DBMS_MVIEW.REFRESH ('MyTable', 'F');
```
You can replace the F (as Fast refresh) by a C to get a complete refresh.

## Special care on view log

You may had to add WITH SEQUENCE to your log creation to cope with certain use as stated in Oracle documentation :

Specify SEQUENCE to indicate that a sequence value providing additional ordering information should be recorded in the materialized view log. Sequence numbers are necessary to support fast refresh after some update scenarios.

## You can create a materialized view on a prebuild table

```sql
create table m (col1 number);

create materialized view log on m
with rowid (col1)
including new values;

create table
     m_mv_cstar
as
select count(*) c_star
from   m;

create materialized view m_mv_cstar
 on prebuilt table
 refresh fast
 on commit
as
select count(*) c_star
from   m;

insert into m values (1);

commit;
```

Source : http://oraclesponge.blogspot.fr/2005/12/ora-12034-materialized-view-log.html

## Database link

If you need to refresh some materialized views through a db link on many schemas on the same database, be sure to give a different name to yours db links. If you don't you could have this error :

ORA-04068: existing state of packages has been discarded
ORA-04062: of has been changed
ORA-04062: timestamp of package "SYS.DBMS_SNAPSHOT_UTL" has been changed

Source : http://www.cnblogs.com/hibernate315/archive/2010/04/23/2399283.html

## References

*	[Create Materialized View](http://docs.oracle.com/cd/B12037_01/server.101/b10759/statements_6002.htm)
*	[Create Materialized View Log](http://docs.oracle.com/cd/B12037_01/server.101/b10759/statements_6003.htm)
*	[Simple but thorough explanation](http://www.sqlsnippets.com/en/topic-12868.html)
*	[Another one](http://www.skill-guru.com/blog/2010/01/03/understanding-materialized-view-in-oracle/)
*	[Burleson tips](http://www.dba-oracle.com/art_9i_mv.htm)
*	


