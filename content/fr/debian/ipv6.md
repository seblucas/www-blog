/*
Title: Debian & IPV6
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: iptables
*/
## Debian & IPV6

### Pourquoi ?
J'ai la chance d'avoir un fournisseur Internet me donnant un sous-réseau /64 en ipv6 et je suis suffisamment geek pour avoir envie de comprendre à quoi ça sert. 
### Quelques éléments à comprendre

Quand votre ordinateur est derrière un routeur, seul votre routeur a une IP publique. L'ensemble de votre LAN utilisent un système appellé NAT pour accéder à Internet. C'est pourquoi il faut configurer des transferts de ports TCP pour accéder à un ordinateur du LAN de l'extérieur (pour du ssh, ftp ou web). Donc le routeur sécurise un peu votre réseau interne.

Avec l'IPV6, chaque ordinateur de votre LAN est directement connecté sur Internet et est donc accessible par n'importe quel autre ordinateur ayant une adresse IPV6. Il est donc primordial d'avoir un parefeu bien configuré.
### Je ne veux pas d'IPV6

A partir de la version Sarge (au moins) IPV6 est inclus dans le kernel debian. Si l'IPV6 ne vous interesse pas il faut le desactiver explicitement. J'ai trouvé toute une série de méthode permettant de le désactiver (je n'en ai testée aucune) :


*	http://www.debian-administration.org/articles/409

*	http://ubuntuforums.org/showthread.php?t=6841

### Vérifier que tout fonctionne

Il y a plusieurs possibilités :
#### Faire un ping sur une serveur IPV6 (ici www.kame.net) :

```
ping6 2001:200:0:8002:203:47ff:fea5:3085
```

#### Vérifier que le DNS marche correctement :

```
aptitude install host
host www.kame.net
```

Le résultat doit comporter deux lignes (ipv4 et ipv6) :

```
www.kame.net has address 203.178.141.194
www.kame.net has IPv6 address 2001:200:0:8002:203:47ff:fea5:3085
```

### Essayer avec un navigateur Internet

Il y a pas mal de sites pour tester :

*	http://6to4.nro.net/

*	http://go6.net/

*	http://www.sixxs.net/ (Vérifier en haut à droite)

*	http://www.kame.net/ (La tortue doit être animée)

*	bien d'autres

### Super et à quoi ça sert

La vrai raison est qu'il est super drôle de se souvenir de 8 groupe de 4 chiffres hexadécimaux. En étant sérieux, pour l'instant il n'y a aucun intérêt mais la pénurie d'adresse ipv4 s'accélérant, l'adoption généralisée de l'ipv6 ne devrais plus tarder.
En cherchant bien il y a ceci :

*	Voir une tortue dancer : http://www.kame.net

*	http://www.sixxs.net/misc/coolstuff/

### Exemples de scripts de parefeu

#### ip6tables
Un parefeu ipv6 est quasiment identique à un parefeu ipv4, la différence réside dans le nom du programme à utiliser :

*	iptables -> ip6tables

*	iptables-save -> ip6tables-save

*	iptables-restore -> ip6tables-restore

Voir mon article sur iptable : [en:debian:iptables](/en/debian/iptables).
#### Parefeu paranoiaque

Comme son nom l'indique, il revient à bloquer tout le traffic ipv6 :

```-
#!/bin/sh

ip6tables -F
ip6tables -X

ip6tables -P INPUT DROP
ip6tables -P OUTPUT DROP
ip6tables -P FORWARD DROP
```

#### Mon parefeu

Attention : ce script est peut-être completement nul.

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

