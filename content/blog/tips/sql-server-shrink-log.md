---
title: "How to shrink on Sql Server"
date: 2012-06-05
tags: [sql]
slug: sql-server-shrink-log
disqus_identifier: /en/tips/sql-server-shrink-log
aliases: [/en/tips/sql-server-shrink-log]
---
# How to shrink on Sql Server

*	First run this command (warning it doesn't backup anything) :

```
Backup log <DATABASENAME> with No_Log
```

*	Then you can shrink the journal with Management Studio :
    * Right click on the database, 
    * All tasks, 
    * Shrink database, 
    * Files, 
    * Select log file, 
    * OK.

Source : http://stackoverflow.com/questions/56628/how-do-you-clear-the-transaction-log-in-a-sql-server-2005-database
