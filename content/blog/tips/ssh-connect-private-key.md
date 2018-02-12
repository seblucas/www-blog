---
title: "How to open an ssh session with a private key"
date: 2011-12-31
tags: [debian]
slug: ssh-connect-private-key
disqus_identifier: /en/tips/ssh-connect-private-key
aliases: [/en/tips/ssh-connect-private-key]
---
# How to open an ssh session with a private key

First you'll have to have a private key setup. Then :

*	Create the .ssh directory and secure it :

```bash
mkdir .ssh
chmod 700 .ssh
```

*	Then create the authorized_keys and secure it

```bash
cd .ssh
touch authorized_keys
chmod 600 authorized_keys
```

*	Then copy your public key to authorized_keys
*	Enjoy

As a side note you can use pageant and putty to connect through private key on Windows. 


