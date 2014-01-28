/*
Title: Install Oracle 10g on Centos 5.6
Description: 
Author: Sébastien Lucas
Date: 2011/06/17
Robots: noindex,nofollow
Language: en
Tags: centos,oracle,tips
*/
# Install Oracle 10g on Centos 5.6

See : http://ivan.kartik.sk/oracle/install_ora10gR2_redhat.html

The only thing you have to change is the startup scripts that does not correctly stop the service. With Centos it seems that the Kill script is not called if there is no file in /var/lock/subsys/. Instead you can use this one : 
```bash
#!/bin/bash
#
# oracle Init file for starting and stopping
# Oracle Database. Script is valid for 10g and 11g versions.
#
# chkconfig: 345 99 01
# description: Oracle Database startup script

# Source function library.

. /etc/rc.d/init.d/functions

ORACLE_OWNER="oracle"
ORACLE_HOME="/opt/oracle/102"

case "$1" in
start)
echo -n $"Starting Oracle DB:"
su - $ORACLE_OWNER -c "$ORACLE_HOME/bin/dbstart $ORACLE_HOME"
touch /var/lock/subsys/oracle
echo "OK"
;;
stop)
echo -n $"Stopping Oracle DB:"
su - $ORACLE_OWNER -c "$ORACLE_HOME/bin/dbshut $ORACLE_HOME"
rm -f /var/lock/subsys/oracle
echo "OK"
;;
*)
echo $"Usage: $0 {start|stop}"
esac
```





