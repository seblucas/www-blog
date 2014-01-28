/*
Title: How to get the list of open session for an username
Description: 
Author: Sébastien Lucas
Date: 2011/03/15
Robots: noindex,nofollow
Language: en
Tags: oracle,tips
*/
# How to get the list of open session for an username

To be executed as SYSTEM :

```
select username, osuser, machine, terminal, status from v$session where username = 'MYUSER'
```







