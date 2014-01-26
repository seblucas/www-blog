/*
Title: Compiler MPlayer
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: multimedia
*/
## Compiler MPlayer

### Introduction
[MPlayer](http://www.mplayerhq.hu) is a media player which is IMHO a little lighter than Xine or VLC. It's a very active project.

### Dependencies

```
apt-get install libgtk2.0-dev x-dev libxv-dev subversion
```

if you want to use the OpenGL output you also have to install this :

```
aptitude install libgl1-mesa-dev
```

### Getting the sources

```
svn checkout svn://svn.mplayerhq.hu/mplayer/trunk mplayer
```

### Compiling

```
cd mplayer
./configure --enable-gui
make
```

### Installing

```
su
make install
```

### Configuring the skin

```
cd /usr/local/share/mplayer/skins/
wget http://www.mplayerhq.hu/MPlayer/skins/Blue-1.7.tar.bz2
tar xvjf Blue-1.7.tar.bz2
rm Blue-1.7.tar.bz2
ln -s Blue default
```

### Configuring the font

```
cd /usr/local/share/mplayer/skins/
ln -s /usr/share/fonts/truetype/ttf-dejavu/DejaVuSans.ttf subfont.ttf
```

### First use

```
gmplayer
```

