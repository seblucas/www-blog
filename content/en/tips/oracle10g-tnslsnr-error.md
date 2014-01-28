/*
Title: Failed to auto-start Oracle Net Listener using /ade/vikrkuma_new/oracle/bin/tnslsnr
Description: 
Author: Sébastien Lucas
Date: 2011/05/17
Robots: noindex,nofollow
Language: en
Tags: oracle,tips
*/
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







