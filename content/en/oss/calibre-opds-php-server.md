/*
Title: Here is COPS : Calibre OPDS (and HTML) PHP Server
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: calibre,ereader,nginx,opds,php
*/
# Here is COPS : Calibre OPDS (and HTML) PHP Server

## Why ?
In my opinion Calibre is a marvelous tool but is too big and has too much dependencies to be used only for its content server.

That's the main reason why I coded this OPDS / HTML content server. I needed a simple tool to be installed on a small server (Seagate Dockstar in my case).

I initially thought of Calibre2OPDS but as it generate static file no search was possible.

So COPS's main advantages are :
*	No need for many dependencies.
*	No need for a lot of CPU or RAM.
*	Not much code.
*	Search is available.
*	With Dropbox / Owncloud it's very easy to have an up to date OPDS content server.
*	100% OPDS valid code (checked with http://opds-validator.appspot.com/).
*	It was fun to code.

**Disclaimer**

It's been reported as working on most web servers (Nginx, Apache, Cherokee, Lighttpd, IIS) and is used a lot on NAS (Synology, QNap, ReadyNas).

I personally protect my COPS catalog with Basic HTTP auth and HTTPS. It's secure enough for my needs.

On the OPDS client side I mainly tested with FBReader Mantano Reader and Aldiko on Android (these 3 also ask for user/password if you have protected your COPS catalog). I also used [Ibis Reader](http://ibisreader.com/) with success but there is no support for password.
Other users have reported COPS working with Stanza, Megareader, Shubook and Bluefire.

## Features

*	HTML5 / CSS3 interface with responsive design.
*	Multiple Calibre database support in a single COPS install.
*	Epub metadata update like Calibre Content Server (enable it with $config['cops_update_epub-metadata']) : If you fixed the author name / a tag / the serie name of a book in Calibre, then the epub you'll download with COPS will contain the fix.
*	Calibre custom columns.
*	[Facets](http://opds-spec.org/2011/06/14/faceted-search-browsing/) in the OPDS feed to filter book list (the only OPDS clients supporting it are Mantano Reader and Bluefire for now).
*	Multilanguage : English, French, German, Russian, Spanish, Catalan, Italian, Norwegian Bokmål, Chinese.
*	Certainly many other.

## Demo

If you want to try it, you can use this URL in your favourite OPDS client :

http://cops-demo.slucas.fr/feed.php

You can also use any browser :

http://cops-demo.slucas.fr/index.php

## Prerequisites for installation

*	PHP 5.3 / 5.4 with GD image processing & SQLite3 support.
*	A web server with PHP support (Nginx, Apache, Cherokee, Lighttpd, IIS).
*	The path to a Calibre library (metadata.db, format, & cover files).

On any Debian base Linux you can use :

```
aptitude install php5-gd php5-sqlite
```

## Install

*	Extract the zip file to a folder in web space (visible to the web server).
*	If a first-time install, copy config_local.php.example to config_local.php
*	Edit config_local.php to match your config. The most important config item to edit are :
    * $config['calibre_directory'] : Path to your Calibre directory.
    * $config['cops_use_url_rewriting'] : If you want to enable URL rewriting.
*	Add some other config item from config_default.php

## Known problems

None for now. Please add an issue on [Github](https://github.com/seblucas/cops/issues?state=open) if you find one ;).

## Any problem / question

Read the [Wiki](https://github.com/seblucas/cops/wiki).

I'll check this [MobileRead thread](http://www.mobileread.com/forums/showthread.php?p=1988610) frequently. You can also send me an email (on the bottom of [this page](/user/sebastien_lucas)).

## Want to help me ?

You like COPS or you simply want to support me, you can [offer me a drink](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9CNHDRJ6GX2Z4). I promise it will only be used for good and never for evil.

My main objective would be to buy a used Kindle Paperwhite to fix the HTML rendering of COPS with this eReader.

## Download

This project is open source (GPL v2) and available through [GitHub](https://github.com/seblucas/cops). If you have any code modification you can use merge request or send your patches to my email (on the bottom of [this page](/user/sebastien_lucas)).

You can download it here ([Changelog](https://github.com/seblucas/cops/releases)) :

[cops-1.0.0RC1.zip](https://github.com/seblucas/cops/releases/download/1.0.0RC1/cops-1.0.0RC1.zip)

You can download older releases [here](https://github.com/seblucas/cops/releases)
