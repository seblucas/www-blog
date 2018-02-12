---
title: "Banana Pi - Installation Bananian"
date: 2014-08-31
tags: [bpi]
slug: banana-pi-2-installation-bananian
disqus_identifier: /blog/banana-pi-2-installation-bananian
---
# Banana Pi - Installation Bananian

## Bananian

En fait [Bananian](http://www.bananian.org/) est une distribution orientée serveur basée sur Debian Wheezy (architecture armhf). Cette distribution est faite par un partenaire de LeMaker (créateur de Banana Pi).

J'ai installé la version 14.08. L'installation est bien expliquée sur le site.

## Installation de la distribution

Très simple :

 * Se munir d'une carte SD de 4Go minimum.
 * Télécharger la [dernière version](http://www.bananian.org/_media/bananian-latest.zip).
 * La décompresser.
 * L'installer sur la carte SD, avec Linux la commande est simple :

```bash
dd if=bananian-latest.img  of=/dev/<your-sd-card> bs=1M && sync
```

 * Avec Windows il faut utiliser [Win32 DiskManager](http://sourceforge.net/projects/win32diskimager/).

## C'est fini

Après il suffit d'insérer la carte et c'est bon.

A noter que la version de OpenSSH utilisée est très récente et qu'il faudra peut être mettre à jour votre version pour pouvoir vous connecter. J'ai notamment du mettre à jour [PuTTY](http://www.putty.org/) en version 0.63.

## Premier test CPU

J'ai vite voulu lancer un test CPU avec la commande suivante :

```bash
sysbench --test=cpu --cpu-max-prime=10000 run
```

et j'ai obtenu score très mauvais (700s) alors que le Raspberry Pi avait un score de 500s. En fait la cadence par défaut du CPU n'est pas bonne (environ 700MHz au lieu des 1GHz annoncé).

## Installation de cpufreq

Plutôt que de simplement changer la fréquence, j'ai mis en place cpufreqd pour avoir une cadence qui varie entre 600MHz et 1GHz.

```bash
apt-get install cpufreq-utils
```

J'ai ajouté les lignes suivantes dans `/etc/rc.local` : 

```bash
echo 600000 > /sys/devices/system/cpu/cpu0/cpufreq/scaling_min_freq
echo 600000 > /sys/devices/system/cpu/cpu1/cpufreq/scaling_min_freq
echo 25 > /sys/devices/system/cpu/cpufreq/ondemand/up_threshold
echo 10 > /sys/devices/system/cpu/cpufreq/ondemand/sampling_down_factor
```

Et ça marche.

## Vitesse du CPU

Le graphe est sans appel :

![Banana Pi CPU](/blog/SysBenchBananaPi.png)

Pour information un ODROID-U3 arrive à un score de 34s.

J'ai pu voir certains tests du Banana Pi sur le net qui indiquaient une vitesse plus faible en monocore. Ces tests sont clairement faux, à mon avis ils utilisaient des binaires de sysbench pour ARMv6 au lieu de ARMv7.