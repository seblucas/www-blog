/*
Title: How to update the date & time with ntp
Description: 
Author: Sébastien Lucas
Date: 2017/04/03
Robots: noindex,nofollow
Language: en
Tags: debian
*/
# How to update the date & time with ntp

```
sudo service ntpd stop
sudo ntpd -gq
sudo service ntpd start
```

Another easier way :

```
sudo sntp -s pool.ntp.org
```
