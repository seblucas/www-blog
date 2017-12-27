/*
Title: Compilation de MPlayer
Date: 2012/11/10
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: multimedia
*/
# Compilation de MPlayer

## Introduction
[MPlayer](http://www.mplayerhq.hu) est un lecteur de média à mon sens plus léger que Xine ou VLC. Il est activement développé.

## Dépendances

```
apt-get install libgtk2.0-dev x-dev libxv-dev subversion
```

Si vous voulez utiliser la sortie OpenGL alors il faut aussi installer :

```
aptitude install libgl1-mesa-dev
```

## Récupération des sources

```
svn checkout svn://svn.mplayerhq.hu/mplayer/trunk mplayer
```

## Compilation

```
cd mplayer
./configure --enable-gui
make
```

## Installation

```
su
make install
```

## Installation d'un skin

```
cd /usr/local/share/mplayer/skins/
wget http://www.mplayerhq.hu/MPlayer/skins/Blue-1.7.tar.bz2
tar xvjf Blue-1.7.tar.bz2
rm Blue-1.7.tar.bz2
ln -s Blue default
```

## Installation de la police

```
cd /usr/local/share/mplayer/skins/
ln -s /usr/share/fonts/truetype/ttf-dejavu/DejaVuSans.ttf subfont.ttf
```

## Premier lancement

```
gmplayer
```


## Fichier de configuration par défaut

à placer dans ~/.mplayer

```-
[deinterlace]
vf-add=yadif

[protocol.rtsp]
profile-desc="Profile Freebox"
#profile=deinterlace

[default]
# Write your default config options here!
#vo=gl:yuv=2:rectangle=1:force-pbo:lscale=2
#vo=gl:yuv=2:rectangle=1:force-pbo
#vo=gl:rectangle=1:force-pbo:slice-height=0:swapinterval=2
vo=xv
ao=alsa:device=spdif
dr=1
framedrop=1
ac=hwac3,hwdts,faad,
ass=1
prefer-ipv4=1
cache=4096
cache-min=20.0
cache-seek-min=50.0
fs=1
idle=1
fixed-vo=1
vsync=yes
loop=0

alang=fr,en
slang=fr,en

really-quiet=1

menu=1
osd=3
ffactor=0.75
sub-bg-alpha=0
sub-bg-color=0
font="Bitstream Vera Sans"
fontconfig=1
subfont-autoscale=1
subfont-osd-scale=4.1
#subfont−text−scale=14
#subfont-blur=2
#subfont-encoding=iso-8859-15
utf8=1
#subcp=iso-8859-15
spuaa=20
ass-color=ffffff10
ass-border-color=000000A0
ass-hinting=3
ass-font-scale=2.0
```

## Un menu avec accès aux chaines Freebox

Attention pour l'utiliser il faut ajouter --enable-menu à la compilation de mplayer.

à placer dans ~/.mplayer (le plus intéressant est à la fin) :

```-
<keybindings name="default">
    <binding key="UP" cmd="menu up" />
    <binding key="DOWN" cmd="menu down" />
    <binding key="LEFT" cmd="menu left" />
    <binding key="RIGHT" cmd="menu right" />
    <binding key="ENTER" cmd="menu ok" />
    <binding key="ESC" cmd="menu cancel" />
    <binding key="HOME" cmd="menu home" />
    <binding key="END" cmd="menu end" />
    <binding key="PGUP" cmd="menu pageup" />
    <binding key="PGDWN" cmd="menu pagedown" />
    <binding key="JOY_UP" cmd="menu up" />
    <binding key="JOY_DOWN" cmd="menu down" />
    <binding key="JOY_LEFT" cmd="menu left" />
    <binding key="JOY_RIGHT" cmd="menu right" />
    <binding key="JOY_BTN0" cmd="menu ok" />
    <binding key="JOY_BTN1" cmd="menu cancel" />
    <binding key="AR_VUP" cmd="menu up" />
    <binding key="AR_VDOWN" cmd="menu down" />
    <binding key="AR_PREV" cmd="menu left" />
    <binding key="AR_NEXT" cmd="menu right" />
    <binding key="AR_PLAY" cmd="menu ok" />
    <binding key="AR_MENU" cmd="menu cancel" />
    <binding key="AR_PREV_HOLD" cmd="menu home" />
    <binding key="AR_NEXT_HOLD" cmd="menu end" />
    <binding key="MOUSE_BTN0" cmd="menu click" />
    <binding key="MOUSE_BTN2" cmd="menu cancel" />
</keybindings>
<keybindings name="list" parent="default">
    <binding key="AR_PREV" cmd="menu pageup" />
    <binding key="AR_NEXT" cmd="menu pagedown" />
</keybindings>
<keybindings name="filesel" parent="list">
    <binding key="BS" cmd="menu left" />
</keybindings>
<keybindings name="chapsel" parent="list" />
<keybindings name="cmdlist" parent="list">
    <binding key="AR_PREV" cmd="menu left" />
    <binding key="AR_NEXT" cmd="menu right" />
</keybindings>
<keybindings name="txt" parent="list" />
<keybindings name="pt" parent="list" />
<keybindings name="pref" parent="list">
    <binding key="AR_PREV" cmd="menu left" />
    <binding key="AR_NEXT" cmd="menu right" />
    <binding key="AR_PREV_HOLD" cmd="menu left" />
    <binding key="AR_NEXT_HOLD" cmd="menu right" />
</keybindings>

<txt name="man" file="manpage.txt"/>

<filesel name="open_file" title="Open File %p"
             filter="/etc/extensions"
             file-action="menu hide
                          loadfile '%p'"/>


<filesel name="open_list" file-action="loadlist '%p'"
         title="Open a playlist: %p"
         filter="/etc/mplayer/extensions_filter"
         actions="d:run 'mp_loader \'%p\' d',c:run 'mp_loader \'%p\' c'" />

<chapsel name="select_chapter" />

<pt name="jump_to"/>

<console name="console0" height="80" vspace="0">Welcome to MPlayer</console>

<txt name="man" file="manpage.txt"/>

<pref name="general_pref" title="General">
      <e property="osdlevel" name="OSD level"/>
      <e property="speed" name="Speed"/>
      <e property="loop" name="Loop"/>
</pref>

<pref name="demuxer_pref" title="Demuxer">
</pref>


<pref name="osd_sub_pref" title="Subtitles">
      <e property="sub" name="Subtitles"/>
      <e property="sub_visibility" name="Visibility"/>
      <e property="sub_forced_only" name="Forced sub only"/>
      <e property="sub_alignment" name="Alignment"/>
      <e property="sub_pos" name="Position"/>
      <e property="sub_delay" name="Delay"/>
      <e property="sub_scale" name="Scale"/>
</pref>

<pref name="audio_pref" title="Audio">
      <e property="volume" name="Volume"/>
      <e property="balance" name="Balance"/>
      <e property="mute" name="Mute"/>
      <e property="audio_delay" name="Delay"/>
</pref>

<pref name="colors_pref" title="Colors">
      <e property="gamma" name="Gamma"/>
      <e property="brightness" name="Brightness"/>
      <e property="contrast" name="Contrast"/>
      <e property="saturation" name="Saturation"/>
      <e property="hue" name="Hue"/>
</pref>

<pref name="video_pref" title="Video">
      <e property="fullscreen" name="Fullscreen"/>
      <e property="panscan" name="Panscan"/>
      <menu menu="colors_pref" name="Colors ..."/>
      <e property="ontop" name="Always on top"/>
      <e property="rootwin" name="Root window"/>
      <e property="framedropping" name="Frame dropping"/>
      <e property="vsync" name="VSync"/>
 </pref>


<cmdlist name="pref_main" title="Preferences" ptr="<>" >
    <e name="General ..." ok="set_menu general_pref"/>
    <e name="Audio ..." ok="set_menu audio_pref"/>
    <e name="Video ..." ok="set_menu video_pref"/>
    <e name="Subtitles ..." ok="set_menu osd_sub_pref"/>
    <e name="Back" ok="menu cancel"/>
</cmdlist>

<pref name="properties" title="Stream Properties">
      <e txt="${filename}" name="Name"/>
      <e txt="${video_format}" name="Video Codec"/>
      <e txt="${video_bitrate}" name="Video Bitrate"/>
      <e txt="${width} x ${height}" name="Resolution"/>
      <e txt="${audio_codec}" name="Audio Codec"/>
      <e txt="${audio_bitrate}" name="Audio Bitrate"/>
      <e txt="${samplerate}, ${channels}" name="Audio Samples"/>
      <e txt="${metadata/Title}" name="Title"/>
      <e txt="${metadata/Artist}" name="Artist"/>
      <e txt="${metadata/Album}" name="Album"/>
      <e txt="${metadata/Year}" name="Year"/>
      <e txt="${metadata/Comment}" name="Comment"/>
      <e txt="${metadata/Track}" name="Track"/>
      <e txt="${metadata/Genre}" name="Genre"/>
      <e txt="${metadata/Software}" name="Software"/>
</pref>

<cmdlist name="main" title="MPlayer OSD menu" ptr="<>" >
      <e name="Pause" ok="pause"/>
      <e name="Chapter ..." ok="set_menu select_chapter"
                            left="seek_chapter -1" right="seek_chapter +1"/>
      <e name="Open ..." ok="set_menu open_file"/>
      <e name="Freebox ..." ok="set_menu freebox"/>
      <e name="Pref" ok="set_menu pref_main"/>
      <e name="Properties" ok="set_menu properties"/>
      <e name="NAS" ok="run /home/vlad/monteNfs"/>
      <e name="Freebox HD" ok="run /home/vlad/monteFtp"/>
      <e name="Quit" ok="quit"/>
</cmdlist>

<cmdlist name="freebox" title="Freebox" ptr="<>" >
            <e name="../" ok="menu cancel"/>
      <e name="France 2" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=201&flavour=ld'
            menu hide"/>
      <e name="France 3" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=202&flavour=ld'
            menu hide"/>
      <e name="France 5" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=203&flavour=ld'
            menu hide"/>
      <e name="Arte" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=204&flavour=ld'
            menu hide"/>
      <e name="Direct 8" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=372&flavour=ld'
            menu hide"/>
      <e name="TMC" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=497&flavour=ld'
            menu hide"/>
      <e name="NT1" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=374&flavour=ld'
            menu hide"/>
      <e name="NRJ 12" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=375&flavour=ld'
            menu hide"/>
      <e name="France 4" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=376&flavour=ld'
            menu hide"/>
      <e name="Virgin 17" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=678&flavour=ld'
            menu hide"/>
      <e name="Game One" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=220&flavour=sd'
            menu hide"/>
      <e name="No Life" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=658&flavour=sd'
            menu hide"/>
      <e name="TV5" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=206&flavour=sd'
            menu hide"/>
      <e name="NRJ Paris" ok="loadfile 'rtsp://mafreebox.freebox.fr/fbxtv_pub/stream?namespace=1&service=686&flavour=sd'
            menu hide"/>
</cmdlist>
```
