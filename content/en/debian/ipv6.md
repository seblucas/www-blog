/*
Title: Debian & IPV6
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: iptables
*/
# Debian & IPV6

## Why ?
I'm lucky enough to have an Internet provider which gives me a free /64 ipv6 network. And I'm geek enough to try it just to know about it. 

## Things you should know

When your computer is behind a router. Only your router has an ip (ipv4) address on the internet. All the computer in your LAN use a system called NAT to access Internet. That's why you need to configure your router to forward specific TCP port if you want to access a computer through ssh, ftp or web. So using a router brings a little security to your LAN.

With IPV6, every computer in your LAN is directly connected to Internet so your router does not bring any security at all. You absolutely NEED to configure an IPV6 firewall.

## I really don't want it

Starting with Sarge (at least) IPV6 is built in the kernel. So if you don't want it you'll have to explicitly disable it. There's is many known methods, I'll only link to them (I didn't tried any of them) :

*	http://www.debian-administration.org/articles/409
*	http://ubuntuforums.org/showthread.php?t=6841

## Check if everything is working

There is many way to check if it's working :

## Ping an IPV6 server (here www.kame.net) :

```
ping6 2001:200:0:8002:203:47ff:fea5:3085
```

## Check if your DNS work correctly :

```
aptitude install host
host www.kame.net
```

you should get two lines :

```
www.kame.net has address 203.178.141.194
www.kame.net has IPv6 address 2001:200:0:8002:203:47ff:fea5:3085
```

## Try your internet browser

There is many sites to check if you got an IPV6 address :
*	http://6to4.nro.net/
*	http://go6.net/
*	http://www.sixxs.net/ (check the upper right)
*	http://www.kame.net/ (you should see a dancing kame, Note that I never got it working with Iceweasel 2.X although the other were working fine. After an upgrade I can confirm that Iceweasel 3.X show a dancing kame)
*	many more

## What is cool about IPV6 ?

The number one reason is that it's much more fun to remember eight groups of four hexadecimal digits than four numbers between 0 and 255. Honestly there is no real interest to have a working IPV6 setup now.
There is still some interesting things to do :
*	See a dancing kame : http://www.kame.net
*	IPV6 torrent trackers, IPV6 video on demand, ... : http://www.sixxs.net/misc/coolstuff/

## Firewall samples

## ip6tables
creating an IPV6 firewall is as almost the same as for IPV4, the difference lies in the name of the program to use :
*	iptables -> ip6tables
*	iptables-save -> ip6tables-save
*	iptables-restore -> ip6tables-restore

You can check my other [howto about netfilter](/en/debian/iptables).

## Paranoid firewall

You really shouldn't use it , as it totally blocks any IPV6 communications :

```-
#!/bin/sh

ip6tables -F
ip6tables -X

ip6tables -P INPUT DROP
ip6tables -P OUTPUT DROP
ip6tables -P FORWARD DROP
```

## My firewall

Warning : this firewall may be totally fucked up and may allow aliens to take control of your computer.

```-
#!/bin/sh

ip6tables -F
ip6tables -X

# Default rules
ip6tables -P INPUT DROP
ip6tables -P FORWARD DROP
ip6tables -P OUTPUT ACCEPT

# lo connection are OK
ip6tables -A INPUT -i lo -j ACCEPT
ip6tables -A FORWARD -i lo -j ACCEPT
ip6tables -A FORWARD -o lo -j ACCEPT

# We allow ssh
ip6tables -A INPUT -p tcp --dport 22 -m state --state NEW -j ACCEPT

# We allow ping be with a limit
ip6tables -A INPUT -p ipv6-icmp -m limit --limit 30/minute -j ACCEPT
ip6tables -A INPUT -p ipv6-icmp -j DROP


# already TCP et UDP connections are allowed
ip6tables -A INPUT -p tcp -m state --state ESTABLISHED,RELATED -j ACCEPT
ip6tables -A INPUT -p udp -m state --state ESTABLISHED,RELATED -j ACCEPT

echo "Use ip6tables-save to update the rules for the next startup"
```

