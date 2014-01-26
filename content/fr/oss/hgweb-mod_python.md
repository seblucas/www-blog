/*
Title: hgweb(dir) avec mod_python
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: mercurial
*/
# hgweb(dir) avec mod_python

## Pourquoi se casser la tête
Par défaut hgweb(dir) s'execute en cgi si on suit la documentation officielle ([ici](http://www.selenic.com/mercurial/wiki/index.cgi/HgWebDirStepByStep)). Ce qui entraine un rendu assez lent.

## La solution

Il y a quelques temps j'ai passé une journée complète pour le faire fonctionner avec mod_python et apache, suite à cela j'ai juste eu le courage de donner la procédure dans un [mail](http://www.selenic.com/pipermail/mercurial/2007-May/013222.html) à la mailing list de mercurial.

## Tutoriel

*	D'abord assurez vous que mod_python est bien installé et fonctionnel. Sinon :

```
apt-get install libapache2-mod-python
a2enmod mod_python
/etc/init.d/apache2 reload
```

*	Télécharger modpython_gateway.py (à partir d'[ici](http://www.aminus.net/wiki/ModPythonGateway)). Ne pas essaye d'utiliser [WSGIHandler](http://trac.gerf.org/pse/wiki/WSGIHandler), Ce programme doit contenir quelques bugs dans l'initialisation de PATH_INFO. L'installer (dans le PYTHON_PATH ou /var/hg) :

```
mkdir /var/hg
wget http://www.aminus.net/browser/modpython_gateway.py
cp modpython_gateway.py /var/hg
```

*	Copier hgwebdir.cgi dans /var/hg/hgwebdir.py
*	Ajouter cette fonction à /var/hg/hgwebdir.py (Vous pouvez changer le nom de la variable, si vous n'aimez pas toto)  :

```python
def test(environ, start_response):
    toto = wsgiapplication(make_web_app)
    return toto (environ, start_response)
```

*	Ajouter ceci à votre configuration apache (personnellement pour garder le fichier de configuration d'apache propre j'ai ajouter la configuration suivante dans /etc/apache2/hg.conf) :

```
<Location /hg>
  PythonPath "sys.path + [ '/var/hg' ]"
  #PythonDebug On #Decommenter cette ligne si problème pour avoir plus d'information
  SetHandler mod_python
  PythonHandler modpython_gateway::handler
  PythonOption SCRIPT_NAME /hg
  PythonOption wsgi.application hgwebdir::test
</Location>
```

*	Si vous avez créé un fichier /etc/apache2/hg.conf, il ne vous reste qu'à ajouter ce qui suit à la fin du fichier de configuration apache :

```
Include /etc/apache2/hg.conf
```

*	Redémarrer apache

```
/etc/init.d/apache2 reload
```

*	Profitez

## Fichier /var/hg/hgwebdir.py complet

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

## Résolutions de problème

Si ce tutoriel ne fonctionne pas chez vous :
*	Decommenter la ligne concernant PythonDebug.
*	Relancer Apache.
*	Bien vérifier les messages d'erreur dans le navigateur internet et dans /var/log/apache2/error.log.

