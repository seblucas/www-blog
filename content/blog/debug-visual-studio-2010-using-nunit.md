---
title: "How to debug a NUnit use case with Visual Studio 2010"
date: 2011-12-03
tags: [dotnet,windows]
slug: debug-visual-studio-2010-using-nunit
disqus_identifier: /en/tips/debug-visual-studio-2010-using-nunit
aliases: [/en/tips/debug-visual-studio-2010-using-nunit]
---
# How to debug a NUnit use case with Visual Studio 2010

There was no problem before the switch to VS 2010 and framework 4.0. So after some googling here is the solution :

*	Edit your nunit.exe.config (should be in your Program directory next to nunit.exe)
*	under `<configuration>` add : 

```
<startup>
  <supportedRuntime version="v4.0.30319" />
</startup>
```

*	and under `<runtime>` add:

```
<loadFromRemoteSources enabled="true" />
```

Sources :

*	http://stackoverflow.com/questions/3542904/nunit-2-5-7-requires-explicit-debug-attach-under-vs2010
*	http://stackoverflow.com/questions/930438/nunit-isnt-running-visual-studio-2010-code

