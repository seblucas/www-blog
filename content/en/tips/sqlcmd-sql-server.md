---
title: "Scripting with Sql Server 2005"
date: 2011-05-28
tags: [sqlserver,tips]
slug: sqlcmd-sql-server
aliases: [/en/tips/sqlcmd-sql-server]
---
# Scripting with Sql Server 2005

Easiest way to go is to get sqlcmd from [here](http://www.microsoft.com/downloads/en/details.aspx?familyid=d09c1d60-a13c-4479-9b91-9e8b9d835cdc&displaylang=en), you'll have to get :

*	sqlncli.msi : Microsoft SQL Server Native Client
*	SQLServer2005_SQLCMD.msi

There is many good tutorials around but to be quick the standard command line is

```
sqlcmd -SServer -UUser -PPassword -dDatabase -iMyFile.sql
```

You can also add -b to error out in case of SQL error.






