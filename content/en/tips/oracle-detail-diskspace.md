/*
Title: How to find diskspace used of objects with Oracle
Description: 
Author: Sébastien Lucas
Date: 2014/06/19
Robots: noindex,nofollow
Language: en
Tags: oracle
*/
# How to find diskspace used of objects with Oracle

```sql
select owner, segment_name,sum(bytes/1024/1024) from dba_segments
group by owner, segment_name
order by sum(bytes/1024/1024) desc
```

If you only need the diskspace by owner :

```sql
select owner,sum(bytes/1024/1024) from dba_segments
group by owner
order by sum(bytes/1024/1024) desc
```

Source : https://community.oracle.com/thread/2364575?tstart=0