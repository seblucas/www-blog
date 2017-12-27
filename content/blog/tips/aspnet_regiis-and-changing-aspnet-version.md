---
title: "Changing Aspnet Version on IIS5 ou 6 with aspnet_regiis"
date: 2012-04-06
tags: [dotnet,iis]
slug: aspnet_regiis-and-changing-aspnet-version
aliases: [/en/tips/aspnet_regiis-and-changing-aspnet-version]
---
# Changing Aspnet Version on IIS5 ou 6 with aspnet_regiis

You may already have had the following message while creating a new virtual directory or trying to change the aspnet version :


Changing the Framework version requires a restart of the W3SVC service. Alternatively, you can change the Framework version without restarting the W3SVC service by running: aspnet_regiis.exe -norestart -s IIS-Viirtual-Path

Do you want to continue (this will change the Framework version and restart the W3SVC service)?


The problem is how to get the IIS-Viirtual-Path, easy once you know it :

```
aspnet_regiis -lk
```

Source : http://stackoverflow.com/questions/1804208/how-do-you-work-out-the-iis-virtual-path-for-an-application
