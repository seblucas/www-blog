---
title: "Nginx change my server name in my browser"
date: 2011-10-13
tags: [nginx]
slug: nginx-change-url-browser
disqus_identifier: /en/tips/nginx-change-url-browser
aliases: [/en/tips/nginx-change-url-browser]
---
# Nginx change my server name in my browser

Add this line in your /etc/nginx/nginx.conf :

```
server_name_in_redirect off;
```


