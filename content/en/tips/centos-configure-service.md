/*
Title: Alternative to update-rc.d with Centos
Description: 
Author: Sébastien Lucas
Date: 2011/06/17
Robots: noindex,nofollow
Language: en
Tags: centos,tips
*/
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







