/*
Title: How to merge a forked repository with GitHub
Description: 
Author: Sébastien Lucas
Date: 2011/08/25
Robots: noindex,nofollow
Language: en
Tags: git
*/
# How to merge a forked repository with GitHub

I recently forked [this repository](https://github.com/bradyholt/PicasaWebSync) and after my first pull request I wanted to update my fork. Here is how to do it :

```bash
git clone git@github.com:vlad59/PicasaWebSync.git
cd PicasaWebSync/
git remote add upstream git://github.com/bradyholt/PicasaWebSync.git
git fetch upstream
git merge upstream/master
git push
```







