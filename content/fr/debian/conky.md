/*
Title: Installer et configurer Conky
Date: 2012/11/10
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: xfce
*/
# Installer et configurer Conky

## Inutile mais amusant
[Conky](http://conky.sourceforge.net/) est un petit outil permettant de monitorer votre ordinateur. Il vous permet d'avoir des informations sur la santé de votre système directement sur le fond d'écran :

*	Charge CPU 
*	uptime
*	Utilisation RAM 
*	Températures (CPU, GPU, HDD)
*	Vitesse des ventilateurs

## Dépendances

Ce ne sont de réelles dépendances mais sans contrôle de température, conky est à mon avis un peu inutile.
D'abord l'installation :

```
apt-get install hddtemp lm-sensors
```

Je conseille d'activer le service hddtemp. Ensuite il faut configurer libsensors :

```
sensors-detect
```

Ne pas hésiter à accepter la modification automatique du fichier /etc/modules. Il reste à vérifier que tout fonctionne :

```
modprobe <Module détecté par sensors-detect>
sensors
hddtemp /dev/hda
```

## Installation

Comme toujours c'est facile :

```
apt-get install conky
```

Si vous voulez suivre la température de vos disques durs, il vous faudra certainement reconfigurer le paquet hddtemp pour mettre en place le service :

```
dpkg-reconfigure hddtemp
```

Vous pouvez prendre le conky.conf donné en exmple pour créer votre propre fichier :

```
cp /etc/conky/conky.conf ~/.conkyrc
```

## Copie d'écran

![Image](/fr/debian/fondecranxfceconky.jpg){.centered}

## Mon conkyrc

```-
alignment bottom_right
background yes
border_width 1
cpu_avg_samples 2
default_color white
default_outline_color white
default_shade_color white
draw_borders no
draw_graph_borders yes
draw_outline no
draw_shades no
font 6x10
gap_x 5
gap_y 10
minimum_size 5 5
net_avg_samples 2
no_buffers yes
out_to_console no
own_window yes
own_window_type desktop
own_window_hints below,skip_taskbar
own_window_transparent yes
double_buffer yes
stippled_borders 0
update_interval 3.0
uppercase no
use_spacer none

TEXT
$nodename - $sysname $kernel on $machine
$hr
${color grey}Uptime:$color $uptime
${color grey}Frequency (in MHz):$color $freq
${color grey}Frequency (in GHz):$color $freq_g
${color grey}RAM Usage:$color $mem/$memmax - $memperc%
${color grey}Swap Usage:$color $swap/$swapmax - $swapperc%
${color grey}CPU Usage:$color $cpu% ${cpubar 4}
${color grey}Processes:$color $processes  ${color grey}Running:$color $running_processes
$hr
${color grey}File systems:
${color grey} /     $color${fs_free /}/${fs_size /} ${fs_bar 6 /}
${color grey} /home $color${fs_free /mnt/spare}/${fs_size /mnt/spare} ${fs_bar 6 /mnt/spare}
${color grey}Networking:
Up:$color ${upspeed eth0} k/s${color grey} - Down:$color ${downspeed eth0} k/s
$hr
${color grey}Cpu/MoBo:$color ${platform w83627hf.656 temp 2}/${platform w83627hf.656 temp 1}
${color grey}/dev/hda;/dev/hdb:$color ${hddtemp /dev/hda};${hddtemp /dev/hdb}
$hr
${color grey}Name                  PID   CPU%   MEM%
${color lightgrey} ${top name 1} ${top pid 1} ${top cpu 1} ${top mem 1}
${color lightgrey} ${top name 2} ${top pid 2} ${top cpu 2} ${top mem 2}
${color lightgrey} ${top name 3} ${top pid 3} ${top cpu 3} ${top mem 3}
${color lightgrey} ${top name 4} ${top pid 4} ${top cpu 4} ${top mem 4}
```

