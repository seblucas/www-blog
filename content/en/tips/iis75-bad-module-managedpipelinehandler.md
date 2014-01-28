/*
Title: With IIS 7.5 I had an error about PageHandlerFactory-Integrated and ManagedPipelineHandler 
Description: 
Author: Sébastien Lucas
Date: 2012/02/12
Robots: noindex,nofollow
Language: en
Tags: dotnet
*/
# With IIS 7.5 I had an error about PageHandlerFactory-Integrated and ManagedPipelineHandler 

The error is : Handler “PageHandlerFactory-Integrated” has a bad module “ManagedPipelineHandler” in its module list.

For an unknown reason, the link between IIS and ASP.net is not correct so you'll have to register the framework into IIS. In my case the solution was :

```
%windir%\Microsoft.NET\Framework64\v4.0.30319\aspnet_regiis.exe -i
```
If your server is not 64 bits change Framework64 with Framework.

If your problem is not caused by the framework 4.0 change the directory accordingly.

Source : http://wishmesh.com/2010/08/iis-7-5-error-handler-pagehandlerfactory-integrated-has-a-bad-module-managedpipelinehandler-in-its-module-list/


