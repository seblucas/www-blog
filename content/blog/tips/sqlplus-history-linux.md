---
title: "How to get your command history in Sqlplus with Linux"
date: 2011-05-19
tags: [oracle,tips]
slug: sqlplus-history-linux
disqus_identifier: /en/tips/sqlplus-history-linux
aliases: [/en/tips/sqlplus-history-linux]
---
# How to get your command history in Sqlplus with Linux

*	Install rlwrap

```
aptitude install rlwrap
```
*	Add an alias to your profile

```
alias sqlplus='rlwrap sqlplus'
```
*	Reload your profile and enjoy








