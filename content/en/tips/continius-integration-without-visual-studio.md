/*
Title: Continuous Integration without Visual Studio
Description: 
Author: Sébastien Lucas
Date: 2012/11/06
Robots: noindex,nofollow
Language: en
Tags: dotnet
*/
# Continuous Integration without Visual Studio

When trying to build a project using WCF with TeamCity, I had this error


(GetReferenceAssemblyPaths target) -> C:\Windows\Microsoft.NET\Framework\v4.0.30319\Microsoft.Common.targets(847,9): warning MSB3644: The reference assemblies for framework ".NETFramework,Version=v4.0" were not found. To resolve this, install the SDK or Targeting Pack for this framework version or retarget your application to a version of the framework for which you have the SDK or Targeting Pack installed. Note that assemblies will be resolved from the Global Assembly Cache (GAC) and will be used in place of reference assemblies. Therefore your assembly may not be correctly targeted for the framework you intend.



My build agent does not have Visual Studio installed (only the framework). The easiest way is to download Windows SDK ([here](http://www.microsoft.com/download/en/confirmation.aspx?id=8279)) and to install only these things :

*	.NET Development > Intellisense and Reference Assemblies

*	.NET Development > Tools

450Mo later the error will go away.

Source : http://stackoverflow.com/questions/2730765/net-4-0-build-issues-on-ci-server

