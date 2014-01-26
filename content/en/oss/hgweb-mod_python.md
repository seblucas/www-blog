/*
Title: hgweb(dir) and mod_python
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: mercurial
*/
# hgweb(dir) and mod_python

## Why
The default howto  ([here](http://www.selenic.com/mercurial/wiki/index.cgi/HgWebDirStepByStep)) make hgweb(dir) execute as cgi. That makes it really slow especially on old hardware.

## The solution

A while ago I spent a whole day to make it work with mod_python and apache, after that I was really fed up so instead of making a clean howto I just sent [this mail](http://www.selenic.com/pipermail/mercurial/2007-May/013222.html) to Mercurial's mailing list.

## Howto

*	First make sure that mod_python is enabled. If not :

```
apt-get install libapache2-mod-python
a2enmod mod_python
/etc/init.d/apache2 reload
```

*	Download modpython_gateway.py (from [here](http://www.aminus.net/wiki/ModPythonGateway)). Don't try to use [WSGIHandler](http://trac.gerf.org/pse/wiki/WSGIHandler), it contains some bug in the initialisation of PATH_INFO. Install it (in your python path or /var/hg) :

```
mkdir /var/hg
wget http://www.aminus.net/browser/modpython_gateway.py
cp modpython_gateway.py /var/hg
```

*	Copy hgwebdir.cgi to /var/hg/hgwebdir.py
*	Add this function to /var/hg/hgwebdir.py (you can change the variable name, if you don't like toto)  :

```python
def test(environ, start_response):
    toto = wsgiapplication(make_web_app)
    return toto (environ, start_response)
```

*	Add this to your apache configuration (to keep apache configuration clean, I personally prefer adding the mercurial configuration to an external file like /etc/apache2/hg.conf) :

```
<Location /hg>
  PythonPath "sys.path + [ '/var/hg' ]"
  #PythonDebug On #Uncomment this ligne if you got a problem and need debug information
  SetHandler mod_python
  PythonHandler modpython_gateway::handler
  PythonOption SCRIPT_NAME /hg
  PythonOption wsgi.application hgwebdir::test
</Location>
```

*	If you followed my advice about the external file /etc/apache2/hg.conf, you still have to update your apache configuration :

```
Include /etc/apache2/hg.conf
```

*	Restart apache

```
/etc/init.d/apache2 reload
```

*	Enjoy
## Complete /var/hg/hgwebdir.py

```python
#!/usr/bin/env python

#
# An example CGI script to export multiple hgweb repos, edit as necessary

# send python tracebacks to the browser if an error occurs:

#import cgitb
#cgitb.enable()

# adjust python path if not a system-wide install:

#import sys
#sys.path.insert(0, "/path/to/python/lib")

# If you'd like to serve pages with UTF-8 instead of your default

# locale charset, you can do so by uncommenting the following lines.
# Note that this will cause your .hgrc files to be interpreted in

# UTF-8 and all your repo files to be displayed using UTF-8.
#

#import os
#os.environ["HGENCODING"] = "UTF-8"

from mercurial.hgweb.hgweb_mod import hgweb
from mercurial.hgweb.hgwebdir_mod import hgwebdir
from mercurial.hgweb.request import wsgiapplication


# The config file looks like this.  You can have paths to individual

# repos, collections of repos in a directory tree, or both.
#

# [paths]
# virtual/path = /real/path

# virtual/path = /real/path
#

# [collections]
# /prefix/to/strip/off = /root/of/tree/full/of/repos

#
# collections example: say directory tree /foo contains repos /foo/bar,

# /foo/quux/baz.  Give this config section:
#   [collections]

#   /foo = /foo
# Then repos will list as bar and quux/baz.

#
# Alternatively you can pass a list of ('virtual/path', '/real/path') tuples

# or use a dictionary with entries like 'virtual/path': '/real/path'

def make_web_app():
    return hgwebdir("/var/hg/hgweb.config")

def test(environ, start_response):
    toto = wsgiapplication(make_web_app)
    return toto (environ, start_response)

```

## Solving problems

If this howto don't work for you, here is what you should do :
*	Uncomment the line about PythonDebug.
*	Reload Apache.
*	Check all error messages from your web browser and in /var/log/apache2/error.log.

