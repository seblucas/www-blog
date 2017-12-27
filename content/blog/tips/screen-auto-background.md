---
title: "How to start a program in background with screen"
date: 2011-02-07
tags: [debian,tips]
slug: screen-auto-background
aliases: [/en/tips/screen-auto-background]
---
# How to start a program in background with screen

*	screen : http://www.gnu.org/software/screen/
*	Install

```
aptitude install screen
```

*	start a program in background

```
screen -d -m <YourProgram>
```

*	check the program

```
screen -R
```

And CTRL+A D to detach.





