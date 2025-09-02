---
title: "How to get the list of locks with Oracle"
date: 2011-03-15
tags: [oracle,tips]
slug: oracle-get-locks
disqus_identifier: /en/tips/oracle-get-locks
aliases: [/en/tips/oracle-get-locks]
---
# How to get the list of locks with Oracle

## Detection
To be executed as SYSTEM : 

```sql
select session_id
,      serial#
,      c.status
,      substr(oracle_username,1,20) User_ORA
,      os_user_name User_os
,      substr(object_name,1,20) Objet
,      substr(decode(a.locked_mode,
              0, 'None',           /* Mon Lock equivalent */
              1, 'Null',           /* N */
              2, 'Row-S (SS)',     /* L */
              3, 'Row-X (SX)',     /* R */
              4, 'Share',          /* S */
              5, 'S/Row-X (SSX)',  /* C */
              6, 'Exclusive',      /* X */
       to_char(a.locked_mode)),1,20) Mode_Lock
,      program Programme
   from v$locked_object a
   ,    dba_objects b
   ,    v$session c 
  where a.object_id = b.object_id
  and c.sid=a.session_id
```

## Kill a locked session

```sql
alter system kill session 'SESSION_ID,SERIAL#';
```







