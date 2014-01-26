/*
Title: Install Zabbix agent on Centos 5.6
Description: 
Author: Sébastien Lucas
Date: 2011/06/10
Robots: noindex,nofollow
Language: en
Tags: centos,tips
*/
# Install Zabbix agent on Centos 5.6

*	get the rpms from [here](http://repo.andrewfarley.com/). In my case (x64 Centos) :
```
wget http://repo.andrewfarley.com/centos/5/x86_64/zabbix-1.8.3-1.x86_64.rpm
wget http://repo.andrewfarley.com/centos/5/x86_64/zabbix-agent-1.8.3-1.x86_64.rpm
```
*	Install the dependencies :
```
yum install openssl-devel
```
*	Install the rpms :
```
rpm -ivh zabbix-1.8.3-1.x86_64.rpm
rpm -ivh zabbix-agent-1.8.3-1.x86_64.rpm
```
*	Edit your configuration file (at least to change the server IP) :
```
vi /etc/zabbix/zabbix_agentd.conf
```
*	In my case I also had to change the PID file to /tmp/zabbix_agentd.pid
*	Open the TCP port 10050 in your firewall settings
*	Start the service :
```
/etc/init.d/zabbix-agentd restart
```


Source : http://andrewfarley.com/sysadmin/rpm-repository-online






