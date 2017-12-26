/*
Title: Kobo eReader Touch : trucs et astuces d'origine diverse
Description: 
Author: Sébastien Lucas
Date: 2011/12/11
Robots: noindex,nofollow
Language: fr
Tags: ereader
*/
# Kobo eReader Touch : trucs et astuces d'origine diverse

## Origine des informations
Vous allez trouver ci-dessous une série de trucs et astuces que j'ai pu lire sur le Web. Je ne suis donc en aucun cas l'auteur ou l'inventeur de ces techniques, j'ai juste fait un effort (tout relatif) de copier coller et/ou de traduction.

Par contre je trouve intéressant de les avoir au même endroit.

Mes principales sources d'informations sont :
* http://www.mobileread.com/forums/forumdisplay.php?f=223
* http://forum.hardware.fr/hfr/gsmgpspda/tablet/unique-readers-ebook-sujet_21496_1.htm
* http://www.teamalexandriz.org/forum/index.php?topic=11266.0
* http://www.teamalexandriz.org/forum/index.php?topic=10055.0

## Bidouilles

###  Enlever le logo FNAC - Avoir la couverture du livre en cours de lecture 
En plus de la technique précédente (voir [Kobo by Fnac : sortie officielle et différences avec le Kobo original](/blog/kobo-ereader-touch-4)). 

~~Pour enlever l'écran de veille Fnac, une nouvelle technique a été trouvée :~~
* Brancher votre Kobo
* Naviguer dans la mémoire et ouvrir le dossier .kobo (ce répertoire sera caché sous Linux ou MacOSX)
* ~~Puis ouvrez le dossier Kobo dans lequel se trouve un fichier "Kobo eReader.conf"~~
* ~~Éditez le fichier, et cherchez la section [PowerOptions] passez les valeurs showBookCoverWhenOff et showBookCoverWhenSuspended à true~~

La méthode précédente n'est plus valide avec le firmware 2.0.0, il faut donc utiliser la méthode suivante (modification du fichier affiliate.conf dans le même répertoire).

Sinon le contenu du fichier affiliate.conf pour un Kobo original est :

```
[General]
affiliate=Kobo
```
Alors que pour un Fnac c'est (essayez de deviner) :

```
[General]
affiliate=fnac
```

### Installation manuelle d'un firmware

#### Téléchargement du firmware
Le dernier firmware est trouvable à l'adresse suivante : http://download.kobobooks.com/firmwares/kobo3/albacore/kobo3-update-1.9.14.zip

#### Installation

C'est très simple :
* Dezipper le fichier zip téléchargé. Il contient 2 fichiers et un répertoire
    * KoboRoot.tgz
    * manifest.md5sum
    * répertoire upgrade
* Connecter votre Kobo à l'ordinateur
* Copier les deux fichiers et le répertoire dans le répertoire .kobo
* Ejecter le Kobo
* Le firmware s'installe

### Modification du firmware pour ajouter l'accès telnet / ftp

Je n'ai pas du tutoriel pour le moment, mais dès que j'aurais fait la manipulation j'écrirai un article complet.

Mes sources : 
* http://www.chauveau-central.net/pub/KoboTouch/
* http://blog.ringerc.id.au/2011/01/enabling-telnet-and-ftp-access-to-kobo.html
* http://www.mobileread.com/forums/showthread.php?t=141388 (notamment les pages 2 et 3).

###  Ajout manuel d'un favori sur le navigateur 

L'utilisation du clavier sur la liseuse est assez fastidieuse surtout pour les URL ou il faut souvent passer du clavier classique au clavier avec les chiffres et caractères spéciaux.
Pour se faciliter la tâche il suffit de connecter par USB la liseuse et de modifier le fichier koboEreader.conf (dans le répertoire .kobo). Ce fichier contient par exemple :

```
[BROWSER_FAVOURITES_GROUP]
http%253A%252F%252Fen.mobile.wikipedia.org%252F=
http%253A%252F%252Fwww.ctv.ca%252Fservlet%252FPage %252Fctv%252Fmobile%252Fslim=
http%253A%252F%252Fm.weatheroffice.gc.ca%252Fcity% 252Fpages%252Fqc-147_e.html=
http%253A%252F%252Fwww.google.com%252F=
```

Certains caractères sont à remplacer :
* % -- %25
* : -- %253A
* / -- %252F

Et chaque favori se termine par un =.

Source : http://www.mobileread.com/forums/showpost.php?p=1906318&postcount=158.

## Gestion de la bibliothèque

### Ajouter la série et l'index du livre dans le Kobo
Comme vous le savez certainement la bibliothèque n'affiche que le titre du livre et rien concernant la série ou le numéro du livre dans la série. Pour pallier à ça vous pouvez utiliser Calibre et le plugin MetaData plugboards.

Il faut donc aller dans Preferences et ensuite Tableaux de connexions de métadonnées.

Par exemple avec ce paramétrage :

```
format:ePub
Device:Kobo
Source Template: {series:re(([^\s])[^\s]+(\s|$),\1)}{series_index:0>2s| - | - }{title}
Destination Field: title
```
Dans le cas ou livre fait partie d'une série on ajoute en début du titre le nom de série (en compressé : que la première lettre de chaque mot) et l'index du livre dans la série.

Plus d'informations : 
* http://www.mobileread.com/forums/showthread.php?t=154958
* http://www.mobileread.com/forums/showthread.php?t=118563

A noter que les métadonnées series et series_index ne sont officiellement inclues dans la norme EPUB (voir http://dublincore.org/documents/dcmi-terms/ pour la liste officielle) par contre elles sont supportées par de nombreux logiciel (Calibre, Aldiko, ...). Merci à Patrick pour cette information.

### Importer les annotation dans Calibre

Connecter le Kobo à Calibre (version 0.8.24 minimum) faire un click droit sur le bouton envoyer au périphérique et lancer récupérer les annotations.

### Faire une réinitialisation usine (Factory reset)

Le bouton se trouve dans le menu paramétrage avec les informations techniques.

**Attention** : Par contre il faut enlever la carte micro sd avant de faire l'opération (confirmé par des représentants de Kobo).

Dans le cas ou la liseuse ne démarre plus il reste les possibilités suivantes : 
* Tirer sur le bouton de démarrage pendant 15 secondes.
* Démarrer le Kobo en appuyant sur le bouton home.
* Dans le pire des cas utiliser une trombone sur l'arrière du Kobo.
* Grâce à un mail d'un lecteur, il reste une dernière technique (ultime) pour faire un hard reboot : 
    * Appuyer sur le bouton Home et le laisser appuyé
    * Donner une impulsion sur le bouton reset avec un trombone
    * Ne relâcher le bouton Home que quand la Kobo s'allume avec le message "Reinitialisation"
    * Encore merci à lui.

### Comment utiliser la liseuse dans la connecter avec le logiciel (et donc créer un compte)

Depuis le firmware 1.9.14 c'est malheureusement un passage obligé. J'ai personnellement créé un compte bidon avec un adresse email bidon mais pour ceux que ça embête une solution existe : 
* En anglais : http://www.mobileread.com/forums/showpost.php?p=1828566&postcount=262
* En français : http://forum.pcinpact.com/topic/153932-ebook-le-topic-de-le-book/page__view__findpost__p__2647337

Attention c'est dangereux. Le principe étant d'aller insérer une ligne dans la table user dans le base sqlite du Kobo (fichier .kobo\KoboReader.sqlite).

## Lecture

### Ajouter un livre sur le Kobo

#### Directement avec l'explorateur de fichier

Quand le Kobo est connecté avec le cable micro usb fourni à un ordinateur il vous demande si vous voulez le connecter ou non. Si vous choisissez de la faire alors il est reconnu comme un périphérique de stockage USB (comme une clé). Vous pouvez alors glisser le ou les fichiers epub directement à la racine ou dans un répertoire si vous préférez.

#### Avec Calibre

Bien vérifier que vous avez bien paramétré Calibre pour votre Kobo (si nécessaire vous pouvez relancer l'assistant de démarrage). En ensuite il suffit de connecter le Kobo (comme dans le point précédent) de faire un clic droit sur un livre et sélectionner Envoyer au lecteur.

###  Impossible de changer la marge sur mon livre 

Le seul moyen connu à ce jour est de passer par une conversion avec Calibre :
* clic-droit sur le livre
* Convertir les livres
* Convertir les livres individuellement
* Présentation
* onglet Filter Style Information
* cocher la case Marges
* cliquer sur OK pour lancer la conversion

Dans certains cas il faut aussi cocher la case : "supprimer l'interligne entre les paragraphes".

### Ajouter une nouvelle police de caractère sur le Kobo

C'est aussi simple que d'ajouter un livre : 
* Connecter le Kobo à l'ordinateur (bien penser à cliquer sur Connecter sur le Kobo)
* Créer un répertoire "fonts" sur le Kobo
* Copier vos fichier ttf dans ce répertoire Kobo
* Ejecter proprement le Kobo
* La police est ajoutée aux polices disponibles pour la lecture

Attention il faut copier au moins copier les styles suivants :
* Regular
* Bold
* Italic
* BoldItalic

C'est aussi de cette manière qu'il est possible d'installer des polices de caractères russe, chinoise ou japonaise pour lire des livres en VO.

Quelques liens :
* http://atouchofkobo.wordpress.com/2011/11/14/viewing-a-czech-epub/
* http://atouchofkobo.wordpress.com/2011/08/28/260/
* http://www.mobileread.com/forums/showthread.php?t=164635

### Ou j'en suis dans mon chapitre ?

La sempiternelle question que je me pose tous les soirs, est ce que je me couche en plein milieu d'un chapitre ou ne me reste-t-il que 2 ou 3 pages avant la fin du chapitre pour terminer proprement.

Dans les fichiers Kepub l'affichage du numéro de page courant se fait au chapitre donc dans ce cas la réponse est facile.

Dans les fichiers Epub normaux, le numéro de page est global au livre donc la meilleure solution est de taper en bas et au milieu (en cours de lecture) pour faire apparaitre le menu. Juste au dessus du menu il y une barre ou chaque trait indique un chapitre et les pages déjà lues sont en noir.

Ce n'est pas très précis (notamment sur les livres de 1000 pages ou plus) mais ça donne une idée.
