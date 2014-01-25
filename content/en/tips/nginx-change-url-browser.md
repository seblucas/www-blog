/*
Title: Nginx change my server name in my browser
Description: 
Author: Sébastien Lucas
Date: 2011/10/13
Robots: noindex,nofollow
Language: en
Tags: nginx
*/
# Nginx change my server name in my browser

Add this line in your /etc/nginx/nginx.conf :
```
server_name_in_redirect off;
```


