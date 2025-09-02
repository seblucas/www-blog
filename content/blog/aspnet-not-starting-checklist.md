---
title: "Things to check when an Asp.Net site is not working correctly"
date: 2011-05-06
tags: [dotnet,tips]
slug: aspnet-not-starting-checklist
disqus_identifier: /en/tips/aspnet-not-starting-checklist
aliases: [/en/tips/aspnet-not-starting-checklist]
---
# Things to check when an Asp.Net site is not working correctly

TODO

## Framework

*	Check that your .Net framework are correctly installed
*	Check that your .Net framework are correctly linked with IIS
    * In case of XP : use regiis to relink your framework with IIS
    * In case of IIS6 or newer : don't forget to enable your filter.

## Application pool

*	Check that the correct version of framework is selected (1.1, 2.0 or 4.0)
*	Try with the classic pipeline instead of integrated (with IIS7 and newer)
*	If the error comes from Oracle, see [How to start an Asp.Net application with Windows Seven x64 and Oracle 10g 32bits](/blog/oracle32-seven64-aspnet)

## Website

## Permissions

*	Change the permissions RECURSIVELY on your virtual directory to add IUSR_ with full rights







