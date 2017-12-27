---
title: "How to upload a big file with nginx"
date: 2011-09-22
tags: [nginx]
slug: upload-size-nginx
aliases: [/en/tips/upload-size-nginx]
---
# How to upload a big file with nginx

Add to your /etc/nginx/nginx.conf :

```
client_max_body_size    150m;
```

Change the size accordingly.


