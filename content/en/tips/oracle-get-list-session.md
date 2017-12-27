---
title: "How to get the list of open session for an username"
date: 2011-03-15
tags: [oracle,tips]
slug: oracle-get-list-session
aliases: [/en/tips/oracle-get-list-session]
---
# How to get the list of open session for an username

To be executed as SYSTEM :

```
select username, osuser, machine, terminal, status from v$session where username = 'MYUSER'
```







