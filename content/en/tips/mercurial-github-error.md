/*
Title: Error on cloning a Github repository with Mercurial
Description: 
Author: Sébastien Lucas
Date: 2012/03/11
Robots: noindex,nofollow
Language: en
Tags: git,mercurial
*/
# Error on cloning a Github repository with Mercurial

After some hours testing everything preventing me from pushing to my Github account, I found out that some public keys of Github users have been suspended until you approve them. You can read more about it [here](https://github.com/blog/1068-public-key-security-vulnerability-and-mitigation).

The problem for us Windows mercurial users is the message is very unclear : 
```
git remote error: The remote server unexpectedly closed the connection.
```

After using my Linux box to test I finally had a useful error message to correct the problem.


