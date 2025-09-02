---
title: "How to start an Asp.Net application with Windows Seven x64 and Oracle 10g 32bits"
date: 2011-05-06
tags: [dotnet,tips]
slug: oracle32-seven64-aspnet
disqus_identifier: /en/tips/oracle32-seven64-aspnet
aliases: [/en/tips/oracle32-seven64-aspnet]
---
# How to start an Asp.Net application with Windows Seven x64 and Oracle 10g 32bits

## Problem
I had a problem with a Windows Seven x64 with Oracle 10g 32Bits. My Asp.Net application didn't start because of Oracle.

Full error :

```
System.InvalidOperationException: Attempt to load Oracle client libraries threw BadImageFormatException.  This problem will occur when running in 64 bit mode with the 32 bit Oracle client components installed. 
---> System.BadImageFormatException: An attempt was made to load a program with an incorrect format. (Exception from HRESULT: 0x8007000B)
   at System.Data.Common.UnsafeNativeMethods.OCILobCopy2(IntPtr svchp, IntPtr errhp, IntPtr dst_locp, IntPtr src_locp, UInt64 amount, UInt64 dst_offset, UInt64 src_offset)
   at System.Data.OracleClient.OCI.DetermineClientVersion()
```

## Solution

Easy :

*	Select your application pool
*	Do a right click and go to Advanced settings.
*	change "Enable 32-bit Applications" to True.
*	Restart both the pool and the website and everything should be working correctly.

## Source

My source : http://social.msdn.microsoft.com/Forums/en-US/netfx64bit/thread/3f00bf30-2d81-4e6c-9bcc-16e06ebf46eb/





