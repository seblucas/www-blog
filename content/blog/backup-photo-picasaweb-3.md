/*
Title: Sauvegarder ses photos de famille - Partie 3 : La récupération des liens
Description: 
Author: Sébastien Lucas
Date: 2011/08/31
Robots: noindex,nofollow
Language: fr
Tags: picasa,python
*/
# Sauvegarder ses photos de famille - Partie 3 : La récupération des liens

## La problématique
Comme je l'ai déjà dit dans les articles précédents (voir [Sauvegarder ses photos de famille et les rendre disponible à moindre cout - Partie 1](/blog/backup-photo-picasaweb)), Picasa me génère des liens sur les albums qui sont accessibles par tout le monde. Donc mon objectif est de récupérer l'ensemble de ces liens et de les ajouter sur une page web que je vais héberger sur mon Seagate Dockstar.

## Python à la rescousse

Avec un peu de reverse engineering et avec l'API j'ai retrouvé comment reconstituer l'URL d'accès aux albums et j'ai fait un script python qui me permet de me générer une structure HTML prête à être intégrée dans une page.

```python
#!/usr/bin/python
# -*- coding: utf-8 -*-

import gdata.photos.service
import gdata.media
import gdata.geo
import time
import re
import unicodedata

fileht = open("photo.inc", "w+")
fileht.write("<div class='accordeon'>\n");

gd_client = gdata.photos.service.PhotosService()
gd_client.email = 'USER@gmail.com'
gd_client.password = 'PASSWORD'
gd_client.source = 'getPicasaAlbum'
gd_client.ProgrammaticLogin()

albums = gd_client.GetUserFeed()
anneePrec = None;
for album in albums.entry:
  if (re.match ("\d{8} - ", album.title.text)):
    authkey = album.GetAlbumId().split('?')[1]
    annee = album.title.text[0:4];
    if annee is None:
      annee = "tot";
    user = album.user.text
    titre = album.title.text.translate (None, '- ')
    titre = unicodedata.normalize('NFKD', unicode (titre, 'utf-8')).encode('ASCII', 'ignore')
    url = 'http://picasaweb.google.com/%s/%s?authuser=0&amp;%s&amp;feat=directlink#slideshow' %(
      user, titre, authkey)
    print 'title: %s, number of photos: %s' % (album.title.text,
      album.numphotos.text)
    if (anneePrec is None or anneePrec != annee):
      if (anneePrec is not None):
        fileht.write ("  </ul>\n");
      fileht.write ("  <h3 class='expand'>Annee %s</h3>\n" % annee)
      fileht.write ("  <ul class='collapse'>\n");
    fileht.write ("    <li><a class='group' href='%s'>%s / Nb photo : %s</a></li>\n" % (url, album.title.text, album.numphotos.text))
    anneePrec = annee


fileht.write ("  </ul>\n");
fileht.write("</div>");
fileht.close();

```

Attention le script peut être à réadapter en fonction de la règle de nommage de l'album vu que je regroupe par année. La suite mettre le tout dans une belle page HTML agréable à l’œil.






