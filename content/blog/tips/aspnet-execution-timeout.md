---
title: "How to prevent execution timeout with Asp.net application"
date: 2012-03-10
tags: [dotnet]
slug: aspnet-execution-timeout
disqus_identifier: /en/tips/aspnet-execution-timeout
aliases: [/en/tips/aspnet-execution-timeout]
---
# How to prevent execution timeout with Asp.net application

There is two solutions :

 * Execute your page with Visual Studio (there will never be any timeout).
 * Add this into your web.config (under the system.web tag) :

```
<httpRuntime executionTimeout="300" />
```

In this case the execution timeout is set to 300 seconds (so 5 minutes).

