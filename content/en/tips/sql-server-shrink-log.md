/*
Title: How to shrink on Sql Server
Description: 
Author: Sébastien Lucas
Date: 2012/06/05
Robots: noindex,nofollow
Language: en
Tags: sql
*/
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
