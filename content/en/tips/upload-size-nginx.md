/*
Title: How to upload a big file with nginx
Description: 
Author: Sébastien Lucas
Date: 2011/09/22
Robots: noindex,nofollow
Language: en
Tags: nginx
*/
# How to upload a big file with nginx

Add to your /etc/nginx/nginx.conf :
```
client_max_body_size    150m;
```
Change the size accordingly.


