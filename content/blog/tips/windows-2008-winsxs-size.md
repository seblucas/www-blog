---
title: "Windows 2008 R2 Server : Windows directory's size growing a lot"
date: 2012-02-12
tags: [windows]
slug: windows-2008-winsxs-size
aliases: [/en/tips/windows-2008-winsxs-size]
---
# Windows 2008 R2 Server : Windows directory's size growing a lot

I use Zabbix for monitoring some servers at work and I found that the free space on a Windows Server 2008 (only used as a Web server) was decreasing slowly for 3 months (almost 1Go a month). I'm still safe as I followed Microsoft guideline and had a system partition with 40Go.

At first I thought some colleague used it to store some temporary file or that some program was leaking too much log. But after some digging the main growing directory is Windows.

I looked on the Internet and found many links about the mighty directory Winsxs and no real solution. I also found that the space used by the directory is false in the explorer because hard links are not handled correctly.

After having laughed and cried a little, I found [this link](http://www.happysysadm.com/2011/06/clean-up-winsxs-on-windows-2008-r2.html) which allow you to regain a little space.


