/*
Title: Sauvegarder ses photos de famille - Partie 2 : Le transfert
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Sauvegarder ses photos de famille - Partie 2 : Le transfert

## PicasaWebSync
Pour transférer des photos sur Picasa Web Album il est possible d'utiliser l'outil de transfert intégré au site. Pour mon cas cela ne sera pas suffisant car :

*	Je dois retailler les photos pour avoir au max une résolution de 2048x2048

*	J'ai beaucoup de photos

J'ai donc trouvé un outil faisant le transfert et le redimensionnement des photos si nécessaire [ici](http://www.geekytidbits.com/2011/04/picasawebsync/), suite à un test plutôt concluant, j'ai trouvé quelques problèmes :

*	Pas de transmission des informations Exif dans la cas d'un redimensionnement.

*	Quelques bugs

*	Impossible de transmettre des vidéos

*	Impossible de changer la date des albums créés

J'ai créé des correctifs pour les deux premiers points via un [fork github](https///github.com/vlad59/PicasaWebSync) qui a été réintégré dans la version officielle par l'auteur. 

J'ai donc pu envoyer quelques milliers de photos sur Picasa. Malheureusement même si mes répertoires sont toujours de la forme : YYYYMMDD - Thème, le tri n'est pas bon. Comme je l'ai précisé il est impossible de changer la date de publication d'un album avec le SDK .Net mais par contre c'est possible via python ...
## Un peu de python

J'ai donc réalisé un petit script (inspiré par ce [lien](http://stackoverflow.com/questions/4559030/not-able-to-change-a-date-of-my-picasa-web-albums-album-via-python-api)) qui change la date de l'album et qui permet d'avoir un tri correct des photos.

`<code python updateAlbum.py>`
#!/usr/bin/python

import gdata.photos.service
import gdata.media
import gdata.geo
import time
import re

gd_client = gdata.photos.service.PhotosService()
gd_client.email = 'name@gmail.com'
gd_client.password = 'password'
gd_client.source = 'TimestampUpdater'
gd_client.ProgrammaticLogin()

albums = gd_client.GetUserFeed()
for album in albums.entry:
  if (re.match ("\d{8} - ", album.title.text)):
      print 'match : %s: %s/%s/%s' % (album.title.text,
                                      album.title.text[0:4],
                                      album.title.text[4:6],
                                      album.title.text[6:8])
      album.timestamp = gdata.photos.Timestamp(
         text="%d000" % time.mktime((int(album.title.text[0:4]),
                                     int(album.title.text[4:6]),
                                     int(album.title.text[6:8]),
                                     12, 00, 00, -1, -1, -1)))
      updated_album = gd_client.Put(
        album,
        album.GetEditLink().href,
        converter=gdata.photos.AlbumEntryFromString)


  print 'title: %s, number of photos: %s, id: %s' % (album.title.text, 
    album.numphotos.text, album.gphoto_id.text)
`</code>`

Et voilà avec ça, j'ai les photos dans le bon ordre.

Reste les vidéos (ou je n'ai aucune idée du problème) et faire une jolie page PHP pour afficher les albums disponibles.






