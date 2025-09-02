---
title: "Failed to auto-start Oracle Net Listener using /ade/vikrkuma_new/oracle/bin/tnslsnr"
date: 2011-05-17
tags: [oracle,tips]
slug: oracle10g-tnslsnr-error
disqus_identifier: /en/tips/oracle10g-tnslsnr-error
aliases: [/en/tips/oracle10g-tnslsnr-error]
---
# Failed to auto-start Oracle Net Listener using /ade/vikrkuma_new/oracle/bin/tnslsnr

Edit the file $ORACLE_HOME/bin/dbstart to change this line

```
ORACLE_HOME_LISTNER=/ade/vikrkuma_new/oracle
```
to

```
ORACLE_HOME_LISTNER=$ORACLE_HOME
```

More info [here](http://www.oracle-base.com/articles/linux/AutomatingDatabaseStartupAndShutdownOnLinux.php).







