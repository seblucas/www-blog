---
title: "How to force an update of Oracle's statistics"
date: 2012-03-10
tags: [oracle]
slug: oracle-force-statistics-update
aliases: [/en/tips/oracle-force-statistics-update]
---
# How to force an update of Oracle's statistics

```
exec dbms_stats.gather_schema_stats( ownname => '&ownername',estimate_percent => 20, method_opt => 'for all columns size auto',options => 'Gather' ,cascade => true,degree => 4);
```

replace &ownername by the name of the schema you want to update.
