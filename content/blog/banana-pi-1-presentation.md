---
title: "2 Dockstar morts ! Banana Pi à la rescousse"
date: 2014-08-30
tags: [dockstar,rpi,bpi]
slug: banana-pi-1-presentation
disqus_identifier: /blog/banana-pi-1-presentation
---
# 2 Dockstar morts ! Banana Pi à la rescousse

## La mort de mes deux Dockstar

En juillet mon Dockstar qui me sert de serveur NFS / OpenVPN / Serveur Web m'a lâché. Les leds ne fonctionnaient plus depuis plus d'un an mais il fonctionnait toujours correctement. Pour information il avait quasiment 500 jours d'uptime. J'ai ressorti mon Dockstar de backup ... et je ne sais pas ce qui s'est passé mais il ne marche plus non plus.

Je me suis retrouvé devant plusieurs choix :

 * Acheter un [BusPirate](http://dangerousprototypes.com/docs/Bus_Pirate) et ressusciter au moins un des Dockstar.
 * Le remplacer par un Raspberry Pi.
 * Trouver un remplaçant.

## Phase transitoire : Raspberry Pi

En transition j'ai reutilisé un Raspberry Pi (avec 512Mo de Ram) pour remplacer mon Dockstar. Et j'ai été extrêmement déçu :

 * Le CPU du Dockstar était beaucoup plus rapide et donc tout rame.
 * J'ai utilisé le même disque dur 2,5 pouces que pour le Dockstar mais j'ai du passer par un hub USB ce qui complique le branchement électrique. Le Dockstar n'avais besoin de rien.
 * L'accès au disque dur est plus lent. Je ne peux pas le quantifier vu que le Dockstar est mort mais cela se sent. Je pense que le fait que le port réseau soit sur le bus USB est très impactant.
 * Le transfert réseau est d'une lenteur infernale. Le Dockstar avait une interface Gigabit et j'avais régulièrement des vitesse de transfert de l'ordre de 18~22Mo/s. Le Raspberry Pi lui me limite à 3~4Mo/s.

Bref la période transitoire n'a pas duré longtemps.

## Un remplaçant ?

Mes critères sont simples :

 * Petite taille.
 * 1 port Gigabits ou vrai 100Mbits.
 * Faible Consommation (moins de 5W sans le disque dur).
 * Au moins aussi rapide que le Dockstar.
 * Au moins 256Mo de RAM.
 * Port USB rapides ou port SATA éventuellement.
 * Mois de 70€.

A cause des contraintes de prix j'ai vite écarté les [ODROID](http://www.hardkernel.com/main/main.php). Je me dirigé vers les dizaines d'offres qui utilisent des Allwinner A20 :

 * [Banana Pi](http://www.banana-pi.com/eindex.asp)
 * [cubietruck](http://cubieboard.org/tag/cubietruck/)
 * [Hummingbird](http://linux-sunxi.org/Merrii_Hummingbird_A20)
 * [OLinuXino](https://www.olimex.com/Products/OLinuXino/A20/)

Le Banana Pi étant le moins cher avec SATA + Gigabits, j'ai donc craqué.

## Banana Pi

Mon Banana Pi est installé depuis une semaine avec la distribution [Bananian](http://www.bananian.org/) (Debian Wheezy adaptée aux drivers A20).

Je vais détailler l'installation et ajouter des photos dans les semaines qui viennent mais pour le moment j'en suis pleinement satisfait :

 * un cœur du A20 est environ 30% plus rapide que le CPU d'un Raspberry Pi. Donc avec les deux cœurs le Banana Pi est quasiment trois fois plus rapide.
 * 1Go de RAM (- 128Mo pour le circuit vidéo).
 * Le réseau fonctionne bien et je retrouve les performances du Dockstar.

Il me reste la consommation à vérifier mais d'après mes lectures cela devrait aller.