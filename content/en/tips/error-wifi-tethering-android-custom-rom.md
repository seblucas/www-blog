/*
Title: Error when try Wifi Tethering on Android custom ROM
Description: 
Author: Sébastien Lucas
Date: 2012/05/07
Robots: noindex,nofollow
Language: en
Tags: android
*/
# Error when try Wifi Tethering on Android custom ROM

*	Problem
The only error message was Error each I wanted to start the tethering.
*	Solution
Many custom ROM disable the netfilter module. That was the case with my Simplicity Rom for my Galaxy S, I enabled it with the app Semaphore (for my kernel) and everything worked as expected.

