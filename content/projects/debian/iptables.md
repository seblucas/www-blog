---
title: "Iptables howto"
date: 2012-11-10
tags: [debian,iptables]
slug: iptables
aliases: [/en/debian/iptables]
---
# Iptables howto

## Netfilter, iptables ??
See [Netfilter](http://fr.wikipedia.org/wiki/Special:Search?search=Netfilter)

## The Debian way (and a little of my way)

In a lot of other Linux distributions, there is a file /etc/init.d/iptables which is loaded automatically. There is no such file in Debian (at least in Etch and Lenny). The Debian way (see [here](http://www.debian-administration.org/articles/445)) is to load the firewall rules as soon as the network is started (so your computer is always protected).

So how do we do this :

*	First log on as root
*	create a file named firewall.sh which will contain all your iptables rules (detail later).
*	make sure firewall.sh can be executed :

```
chmod +x firewall.sh
```

*	Execute firewall.sh and check if everything still works as expected (ssh, samba, torrent, www, ...)

```
./firewall.sh
```

*	Everything works fine so let's save our rules to a file (I prefer to save it in /etc) :

```
iptables-save > /etc/firewall.conf
```

*	Create a script to start the rules :

```
echo "#!/bin/sh" > /etc/network/if-up.d/iptables 
echo "iptables-restore < /etc/firewall.conf" >> /etc/network/if-up.d/iptables 
chmod +x /etc/network/if-up.d/iptables 
```

## Firewall rules update

If you need to update your firewall rules :

*	Edit firewall.sh to make your desired changes.
*	Execute it and check if everything works as expected
*	If everything runs ok, run :

```
iptables-save > /etc/firewall.conf
```

*	That's all

## A simple firewall script explained

## Disclaimer
This script may be really bad, may expose your computer to many threats. I simply don't know enough about iptables to be sure of it.

## Full script

The full script can be downloaded [here](/en/debian/iptables-script).

## Detailed explanation

My computer has only one network card and is behind a router. It's a simple workstation.

```
#!/bin/sh

iptables -F
iptables -X
```

*	iptables -F : flush all the iptables chains.
*	iptables -X : delete all the iptables chains.

```
# Default rules
iptables -P INPUT DROP
iptables -P FORWARD DROP
iptables -P OUTPUT ACCEPT
```

iptables -P define the policy (the default way of handling connections).

```
iptables -A INPUT -i lo -j ACCEPT
iptables -A FORWARD -i lo -j ACCEPT
iptables -A FORWARD -o lo -j ACCEPT
```

I don't know if this is needed but it can't hurt. Every process in my computer are allowed to communicate through lo.

```
#Samba access but only in the LAN
iptables -A INPUT -s 192.168.0.0/24 -p udp -m udp --dport 137 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -p udp -m udp --dport 138 -j ACCEPT
iptables -A INPUT  -m state --state NEW -m tcp -p tcp -s 192.168.0.0/24 --dport 139 -j ACCEPT
iptables -A INPUT  -m state --state NEW -m tcp -p tcp -s 192.168.0.0/24 --dport 445 -j ACCEPT
```

It's getting interesting. Even if I'm behind a router with no port forwarding so no one in the outside can connect to my computer through samba, I can limit samba access to my lan (192.168.0.0/24). Note that we only take care on the packet with NEW state. Other state will be taken care of later.

```
# We accept incoming connections on the torrent port
iptables -A INPUT -p tcp --dport 34567 -m state --state NEW -j ACCEPT
```

You need to open the port you're using for torrent (here 34567).

```
# SSH
iptables -A INPUT -p tcp --dport 22 -m state --state NEW -m recent --set --name SSH -j ACCEPT
iptables -A INPUT -p tcp --dport 22 -m recent --update --seconds 60 --hitcount 4 --rttl --name SSH -j DROP
```

About ssh it's basically like torrent. But to protect myself against scripts kiddies trying all sort of dictionary attack, I've set a limit of 4 connections each 60 seconds. Each time someone try to open a fifth connection it gets banned for 60 second. Another solution is to configure your router to avoid forwarding the ssh port (22) and use another one . I personally use both techniques and my /var/log/auth.log is totally clean.

```
# Ping
iptables -A INPUT -p icmp -m limit --limit 30/minute -j ACCEPT
iptables -A INPUT -p icmp -j DROP
```

Like with ssh, there's a limit if 30 ping within a minute.

```
# PPTP VPN
iptables -A INPUT -j ACCEPT -p tcp --sport 1723
iptables -A INPUT -j ACCEPT -p gre
```

I use [pptpclient](http://pptpclient.sourceforge.net/) to connect to a Windows PPTP VPN. To allow the connection I have to open a tcp port and a to allow a new protocol.

```
# rtsp only on LAN
iptables -A INPUT -s 192.168.0.0/24 -m tcp -p tcp --dport 554 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -m udp -p udp --dport 554 -j ACCEPT

# upnp A/V only on LAN
iptables -A INPUT -s 192.168.0.0/24 -m tcp -p tcp --dport 49200 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -m udp -p udp --dport 49200 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -m udp -p udp --dport 1900 -j ACCEPT

# FTP only on LAN
iptables -A INPUT  -m state --state NEW -m tcp -p tcp -s 192.168.0.0/24 --dport 21 -j ACCEPT
iptables -A INPUT  -m state --state NEW -m tcp -p tcp -s 192.168.0.0/24 --dport 20 -j ACCEPT
```

Here are some other rules. that's basically the same thing over and over. The real deal is to know wich port to open : for my upnp server for exemple you need to open three port to make it work correctly. A small note about the FTP server, with rules like above you can only connect with an active connection (passive would of course be possible but I had no use of the added complexity).

```
# We allow TCP and UDP connections already established to enter
iptables -A INPUT -p tcp -m state --state ESTABLISHED,RELATED -j ACCEPT
iptables -A INPUT -p udp -m state --state ESTABLISHED,RELATED -j ACCEPT
```

Here we allow already established connection.

```
echo "Use iptables-save to update /etc/firewall.conf"
```

A little reminder.

