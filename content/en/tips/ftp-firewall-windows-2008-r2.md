/*
Title: Windows 2008 R2 default FTP firewall rule don't work
Description: 
Author: Sébastien Lucas
Date: 2011/06/15
Robots: noindex,nofollow
Language: en
Tags: tips,windows
*/
# Windows 2008 R2 default FTP firewall rule don't work

If you just installed the FTP server on your new Windows Server 2008 R2 and begin to loose patience.... The default firewall rules don't work. The cleanest (IMHO) solution so far is to execute the following commands :
```
sc sidtype ftpsvc unrestricted
net stop ftpsvc & net start ftpsvc 
```

If you don't like my solution, just add a new rule for your TCP port 21, it should work.

Sources : 

*	Basic configuration
    * http://learn.iis.net/page.aspx/309/configuring-ftp-firewall-settings/

*	Problem with default firewall rules :
    * http://connect.microsoft.com/WindowsServerFeedback/feedback/details/524831/default-ftp-firewall-port-21-rule-is-broken-in-windows-2008-r2
    * http://mwsite.net/2009/12/15/default-ftp-firewall-rule-broken-in-windows-2008-r2/
    * http://arstechnica.com/civis/viewtopic.php?f=17&t=43736







