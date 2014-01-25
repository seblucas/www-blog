/*
Title: How to force an update of Oracle's statistics
Description: 
Author: Sébastien Lucas
Date: 2012/03/10
Robots: noindex,nofollow
Language: en
Tags: oracle
*/
# How to force an update of Oracle's statistics

```
exec dbms_stats.gather_schema_stats( ownname => '&ownername',estimate_percent => 20, method_opt => 'for all columns size auto',options => 'Gather' ,cascade => true,degree => 4);
```

replace &ownername by the name of the schema you want to update.
