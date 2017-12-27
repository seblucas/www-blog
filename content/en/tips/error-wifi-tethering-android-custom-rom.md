---
title: "Error when try Wifi Tethering on Android custom ROM"
date: 2012-05-07
tags: [android]
slug: error-wifi-tethering-android-custom-rom
aliases: [/en/tips/error-wifi-tethering-android-custom-rom]
---
# Error when try Wifi Tethering on Android custom ROM

*	Problem
The only error message was Error each I wanted to start the tethering.
*	Solution
Many custom ROM disable the netfilter module. That was the case with my Simplicity Rom for my Galaxy S, I enabled it with the app Semaphore (for my kernel) and everything worked as expected.

