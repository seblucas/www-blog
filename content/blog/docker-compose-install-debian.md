---
title: "How to install docker compose with Debian"
date: 2018-02-11
tags: [debian,docker]
slug: docker-compose-install-debian
disqus_identifier: /blog/docker-compose-install-debian
---

# How to install docker compose with Debian

The easiest way is with pip (so that it's also working on Armhf and Arm64) :

```
apt-get -y install python-pip
pip install setuptools --upgrade
pip install wheel
pip install docker-compose
```

Tested on Stretch and Jessie.