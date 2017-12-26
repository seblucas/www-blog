---
title: "Quelques nouvelles sur le monde des petites machines ARM (et autres Google TV) "
date: 2012-11-10
tags: [dockstar,rpi]
slug: a10-google-tv-1
---
# Quelques nouvelles sur le monde des petites machines ARM (et autres Google TV) 

Vous trouverez ci-après quelques liens sur des articles qui m'ont intéressé depuis quelques semaines. Ce monde bouge vite et j'espère vraiment qu'un vrai support Linux arrivera vite.

## L'architecture x86 perd du terrain

A lire [ici](http://www.clubic.com/processeur/actualite-520629-architecture-x86-recule-parts-de-marche-intel-amd.html), le changement est assez notable pour en parler un peu (et pour entrainer des pages de discussions chez Clubic). Même si je pense qu'on aura toujours besoin de PC normaux, c'est vrai qu'avec une tablette très à la mode les netbooks sont vraiment en difficulté.

## Linux et XBMC sur un Allwinner A10

La version d'XBMC n'est pas encore utilisable en production mais ça avance.

Pour XBMC :

* https://github.com/empatzero/xbmca10
* http://linux-sunxi.org/XBMC
* http://forum.xbmc.org/showthread.php?tid=126995&page=110

Pour des images Linux en armhf :

* http://guillaumeplayground.net/mele-a2000-headless-debian-wheezy-armhf-with-nand-install-v1/

Au final la société derrière le A10 est totalement inutile mais la communauté a réussi à faire pas mal de choses.

## Crowdfounding pour des sources GPL

Je ne sais pas si vous connaissez le site http://www.j1nx.nl/ qui est une excellente source d'information pour les boitiers à base d'ARM. La personne derrière le site (Peter Steenbergen) a décidé de démarrer une campagne de crowdfounding pour qu'une société chinoise décide de fournir les sources du noyau ainsi que les modifications de Uboot et du système de build pour un SOC AMLogic 8726-M3. Par contre, même si ces éléments sont, pour la plupart, sous licence GPL (c'est à dire qu'on devrait déjà avoir les sources), cette société ne le fera que si ils ont un certain nombre de commandes; d’où la demande de financement.

Le lien si vous voulez participer : http://www.indiegogo.com/open-amlogic-box

Les spécifications :

* Amlogic-8726M3 Cortex A9, CPU Max 1GHz.
* Mali-400 GPU
* 1 GB memory
* 4 GB flash storage
* WiFi: 802.11b/g/n
* 10/100Mbps LAN
* 2 USB
* Lecteur de carte SD
* Sortie composite, YUV / Sortie optique SPDIF / HDMI
* Télécommande

Je pense que je vais acheter un modèle pour participer même si le prix peut paraitre assez élevé (pour information la version dual core est disponible au même prix chez [OvalElephant](http://www.ovalelephant.com/index.php?route=product/product&product_id=2085)). Mais il faut garder en tête qu'ils sont obligés d'ajouter la TVA (ce que les sites chinois ne font jamais).

## Ouya

Quelques nouvelles ont été postée sur le [blog de la Ouya](http://www.ouya.tv/blog/), notamment un article sur la mise à jour du matériel et logiciel ([ici](http://www.ouya.tv/the-big-hardware-update-and-more/)). Les informations à retenir :

* Une photo du PCB
* La console sera sur Jelly Bean
* Les kits de développement sont disponibles.

