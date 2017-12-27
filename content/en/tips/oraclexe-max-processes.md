---
title: "Error ORA-12516 with Oracle XE with lots of connections"
date: 2012-05-15
tags: [oracle]
slug: oraclexe-max-processes
aliases: [/en/tips/oraclexe-max-processes]
---
# Error ORA-12516 with Oracle XE with lots of connections

Oracle XE 10g has no hard limit on the number of processes but by default it is limited to 20 or 40 processes. You can change it :

*	Start sqlplus and connect to your database using system user
*	Execute the following code :

```sql
alter system set processes=300 scope=spfile;
alter system set sessions=300 scope=spfile;
```

*	Restart cleanly your database

Sources : 

*	http://ranajitsahoo.blogspot.fr/2010/01/bpel-oracle-xe-ora-12516-tnslistener.html
*	http://stackoverflow.com/questions/906541/how-many-connections-can-oracle-express-edition-xe-handle


