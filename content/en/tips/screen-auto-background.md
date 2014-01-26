/*
Title: How to start a program in background with screen
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
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





