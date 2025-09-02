---
title: "Alternative to update-rc.d with Centos"
date: 2011-06-17
tags: [centos,tips]
slug: centos-configure-service
disqus_identifier: /en/tips/centos-configure-service
aliases: [/en/tips/centos-configure-service]
---
# Alternative to update-rc.d with Centos

*	Add you file to /etc/init.d
*	Make it executable : 

```
chmod +x /etc/init.d/YourFile
```

*	Magic ...

```
chkconfig --add YourFile --level 0356 
```







