---
title: "Banana Pi - Relevé de température et hygrométrie avec une sonde DHT22"
date: 2014-11-04
tags: [bpi]
slug: banana-pi-7-DHT22-temperature-hygrometrie
disqus_identifier: /blog/banana-pi-7-DHT22-temperature-hygrometrie
---
# Banana Pi - Relevé de température et hygrométrie avec une sonde DHT22

## DHT22 ?

Sous ce nom étrange se cache un capteur de température et d'humidité qui est assez simple à interfacer avec un Raspberry Pi et donc un Banana Pi.

![DHT11 et DHT22](/blog/DHT11-DHT22.jpg)

A gauche le DHT11 (moins précis) et à droite le DHT22 que j'ai utilisé.

Pour information je l'ai acheté à moins de 4,00 € sur Ebay.

## Connexion de la sonde au Banana Pi

Je ne vais pas plagier le travail d'un compatriote, je vous conseille donc de suivre [ce tutoriel](http://www.manuel-esteban.com/lire-une-sonde-dht22-avec-un-raspberry-pi/).

C'est exactement le même principe pour le Banana Pi avec les mêmes pins GPIO. Pour information le plan des GPIO du Banana Pi est [ici](http://wiki.bananapi.org/index.php/Bananapi_pin_definition).

Ne faite pas comme moi et ne vous dites pas que la valeur de la résistance de pull-up n'est pas vraiment importante. En dessous de 4kΩ j'ai beaucoup de lectures qui échouent. Pour l'instant je suis à 5.1kΩ et tout se passe bien.

Contrairement à ce qui est dit dans l'article vous pouvez alimenter le DHT22 en 5V sans risquer de le griller (voir [la spécification](https://www.sparkfun.com/datasheets/Sensors/Temperature/DHT22.pdf)), je l'ai fait et il fonctionne bien. Certaines personnes trouvent que la qualité de la réponse est meilleure de cette manière. Ma théorie est que leur 3.3V est de mauvaise qualité (~3.1V comme on voit souvent).

## Récupération des valeurs

J'ai utilisé un lol_dht22 : un programme C qui utilise la bibliothèque [WiringPi adapté au Banana Pi](https://github.com/LeMaker/WiringBPi). J'ai modifié ce programme et mis à jour les sources sur [Github](https://github.com/seblucas/lol_dht22). La compilation se fait simplement :

```
git clone https://github.com/seblucas/lol_dht22.git
cd lol_dht22
./configure
make
```

Et pour l’exécution c'est encore plus simple :

```
./loldht
usage: ./loldht <pin>
description: pin is the wiringPi pin number
using 7 (GPIO 4)
Raspberry Pi wiringPi DHT22 reader
www.lolware.net
Humidity = 62.60 % Temperature = 20.90 *C
```

Je n'ai pas essayé les différentes bibliothèques Python autour du DHT22 sachant que ce programme fonctionne parfaitement. Je vous laisse donc faire l'essai.

## La suite

 * Intégrer la mesure de température à [RPI-Monitor](banana-pi-5-rpi-monitor).
 * Intégrer plusieurs sondes.
 * Tester la DHT11 moins fiable mais peut être suffisante.