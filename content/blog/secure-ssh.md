---
title: "How to have a secure ssh server"
date: 2011-12-31
tags: [debian]
slug: secure-ssh
disqus_identifier: /en/tips/secure-ssh
aliases: [/en/tips/secure-ssh]
---
# How to have a secure ssh server

There's is some easy steps to follow :

*	If possible change the sshd daemon listening port ([How to change the listening port of Sshd](/blog/sshd-change-port))
*	If you enabled login through private key ([How to open an ssh session with a private key](/blog/ssh-connect-private-key)), you can disable password authentication. You just have to edit /etc/ssh/sshd_config to add :

```
PermitEmptyPasswords no
```

*	You can also use [fail2ban](http://www.fail2ban.org/wiki/index.php/Main_Page) to ban script kiddies.


