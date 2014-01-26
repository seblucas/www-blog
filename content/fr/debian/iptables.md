/*
Title: Tutoriel Iptables
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: debian,iptables
*/
## Tutoriel Iptables

### Netfilter, iptables ??
Voir [Netfilter](http://fr.wikipedia.org/wiki/Special:Search?search=Netfilter)
### La méthode Debian (avec un peu de sel)

Dans pas mal d'autres distributions, il y a une fichier /etc/init.d/iptables qui est chargé automatiquement. Il n'y a pas de fichier de ce style dans Debian (au moins dans Etch, Lenny et Squeeze). La méthode Debian (voir [ici](http://www.debian-administration.org/articles/445)) est de charger les règles du firewall dès que le réseau est démarré (donc l'ordinateur est toujours protégé).

Donc comment faire :
*	Se connecter en root
*	Créer un fichier nommé firewall.sh qui va contenir les règles iptables (plus de détail après).
*	Valider que ce fichier est exécutable :
```
chmod +x firewall.sh
```
*	Exécuter firewall.sh et vérifier si tout fonctionne encore normalement (ssh, samba, torrent, www, ...)
```
./firewall.sh
```
*	Tout fonctionne correctement, donc enregistrons les règles dans un fichier (pour moi dans /etc) :
```
iptables-save > /etc/firewall.conf
```
*	Créer une script pour lancer les règles :

```
echo "#!/bin/sh" > /etc/network/if-up.d/iptables 
echo "iptables-restore < /etc/firewall.conf" >> /etc/network/if-up.d/iptables 
chmod +x /etc/network/if-up.d/iptables 
```
### Mise à jour des règles du firewall

Pour les mettre à jour il faut :
*	Éditer firewall.sh pour faire les changements voulus.
*	L'exécuter et vérifier que tout marche comme escompté.
*	Lancer :

```
iptables-save > /etc/firewall.conf
```

*	Fini ;)
### Un script simple expliqué

#### Attention
Ce script est peut être très mauvais, et peut exposer votre ordinateur.
#### Script complet

Il peut être téléchargé [ici](/en/debian/iptables-script).
#### Explications détaillées

Mon ordinateur a une seule carte réseau et est derrière un routeur. C'est un simple poste de travail.

```
#!/bin/sh

iptables -F
iptables -X
```

*	iptables -F : vide toutes les commandes iptables.
*	iptables -X : supprime toutes les commandes iptables.

```
# Default rules

iptables -P INPUT DROP
iptables -P FORWARD DROP
iptables -P OUTPUT ACCEPT
```

iptables -P défini le fonctionnement par défaut.

```
iptables -A INPUT -i lo -j ACCEPT
iptables -A FORWARD -i lo -j ACCEPT
iptables -A FORWARD -o lo -j ACCEPT
```

Je ne suis pas certain que cela serve mais cela ne doit pas faire de mal. Chaque process peut communiquer via lo.

```
#Samba access but only in the LAN

iptables -A INPUT -s 192.168.0.0/24 -p udp -m udp --dport 137 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -p udp -m udp --dport 138 -j ACCEPT
iptables -A INPUT  -m state --state NEW -m tcp -p tcp -s 192.168.0.0/24 --dport 139 -j ACCEPT
iptables -A INPUT  -m state --state NEW -m tcp -p tcp -s 192.168.0.0/24 --dport 445 -j ACCEPT
```

Ca devient intéressant. Même si je suis derrière un routeur sans transfert de port (donc sans possibilité d'accéder à ma machine), je peux limiter l'acces aux partages samba à mon LAN (192.168.0.0/24).

```
# We accept incoming connections on the torrent port

iptables -A INPUT -p tcp --dport 34567 -m state --state NEW -j ACCEPT
```

Ouverture de port pour le torrent (ici le 34567).

```
# SSH

iptables -A INPUT -p tcp --dport 22 -m state --state NEW -m recent --set --name SSH -j ACCEPT
iptables -A INPUT -p tcp --dport 22 -m recent --update --seconds 60 --hitcount 4 --rttl --name SSH -j DROP
```

Pour le ssh c'est presque comme le torrent. MAis pour se protéger des méchants hackeurs en herbe, j'ai mis une limite de 4 connexions par minute (60 secondes). Chaque fois que quelqu'un essaye d'ouvrir une cinquième connexion il est banni pour une minute supplémentaire. Il existe d'autres solution pour vous prémunir d'attaques ssh (et avoir un /var/log/auth.log propre) :
*	Utiliser fail2ban
*	Ne pas utiliser le port 22 comme port externe
*	désactiver la connexion par mot de passe (utilisez des clés)

```
# Ping

iptables -A INPUT -p icmp -m limit --limit 30/minute -j ACCEPT
iptables -A INPUT -p icmp -j DROP
```

Comme pour le ssh, on limite à 30 ping par minute.

```
# PPTP VPN

iptables -A INPUT -j ACCEPT -p tcp --sport 1723
iptables -A INPUT -j ACCEPT -p gre
```

J'utilise [pptpclient](http://pptpclient.sourceforge.net/) pour me connecter à un VPN PPTP Windows. Dans ce cas il faut ouvrir un port TCP et autoriser un nouveau protocole (gre).

```
# rtsp only on LAN

iptables -A INPUT -s 192.168.0.0/24 -m tcp -p tcp --dport 554 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -m udp -p udp --dport 554 -j ACCEPT

# upnp A/V only on LAN

iptables -A INPUT -s 192.168.0.0/24 -m tcp -p tcp --dport 49200 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -m udp -p udp --dport 49200 -j ACCEPT
iptables -A INPUT -s 192.168.0.0/24 -m udp -p udp --dport 1900 -j ACCEPT

# FTP only on LAN

iptables -A INPUT  -m state --state NEW -m tcp -p tcp -s 192.168.0.0/24 --dport
21 -j ACCEPT
iptables -A INPUT  -m state --state NEW -m tcp -p tcp -s 192.168.0.0/24 --dport
20 -j ACCEPT
```

Toujours le même principe, il faut juste connaitre les port à ouvrir. Pour le serveur FTP, avec mes règles seul le mode actif sera possible (le mode passif est possible mais la configuration est un peu plus complexe).

```
# We allow TCP and UDP connections already established to enter

iptables -A INPUT -p tcp -m state --state ESTABLISHED,RELATED -j ACCEPT
iptables -A INPUT -p udp -m state --state ESTABLISHED,RELATED -j ACCEPT
```

Ici on autorise toutes les connexions démarrées.

```
echo "Use iptables-save to update /etc/firewall.conf"
```

Un petit rappel.

