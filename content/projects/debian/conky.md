---
title: "Install and configure Conky"
date: 2012-11-10
tags: [xfce]
slug: conky
aliases: [/en/debian/conky]
---
# Install and configure Conky

## Useless but fun
[Conky](http://conky.sourceforge.net/) is a light-weight system monitor. It allow you to have informations about your computer directly on your background like :

*	CPU load
*	uptime
*	RAM use
*	Temperatures (CPU, GPU, HDD)
*	Fan speed

## Dependencies

It's not reel dependencies but without any temperature monitor, Conky is, in my opinion, is a little useless.
First the installation :

```
apt-get install hddtemp lm-sensors
```

I advise to enable the daemon hddtemp. Next you'll have to configure libsensors :

```
sensors-detect
```

Do not hesitate to accept the automatic modification of /etc/modules. To conclude you just have to test :

```
modprobe <Module detected by sensors-detect>
sensors
hddtemp /dev/hda
```

## Installation

As always easy :

```
apt-get install conky
```

If you want to monitor your HDD temperature, you should reconfigure hddtemp to enable the daemon :

```
dpkg-reconfigure hddtemp
```

You can the use the example conky.conf provided to create your own file :

```
cp /etc/conky/conky.conf ~/.conkyrc
```

## Screenshot

![Image](/fr/debian/fondecranxfceconky.jpg)

## My conkyrc

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

