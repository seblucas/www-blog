/*
Title: How to get your command history in Sqlplus with Linux
Description: 
Author: Sébastien Lucas
Date: 2011/05/19
Robots: noindex,nofollow
Language: en
Tags: oracle,tips
*/
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








