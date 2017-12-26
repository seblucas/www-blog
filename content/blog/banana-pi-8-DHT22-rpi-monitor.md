---
title: "Banana Pi - Intégration des relevés du DHT22 dans RPI-Monitor"
date: 2014-11-06
tags: [bpi]
slug: banana-pi-8-DHT22-rpi-monitor
---
# Banana Pi - Intégration des relevés du DHT22 dans RPI-Monitor

## DHT22 ?

Vous vous souvenez de mon article sur le [capteur de température / hygrométrie DHT22](banana-pi-7-DHT22-temperature-hygrometrie). L'intérêt d'une lecture instantanée est très limitée, je veux donc avoir des relevés réguliers afin de pouvoir avoir une jolie courbe et de pouvoir analyser les tendances.

## Intégration avec RPI-Monitor

### Création du démon

J'ai suivi le même principe que pour le script qui gère la température du CPU et du SSD, j'ai créé un fichier de démon qui met à jour un fichier `/run/dht_temp` qui contient la température et le taux d'humidité (n'oubliez pas modifier le chemin d'accès à `lol_dht22`).

Pour s'assurer que ce programme soit lancé au démarrage, on fait simple en ajoutant ces lignes à la fin de `/etc/rc.local` :

```bash
nohup /usr/local/bin/dht22-daemon.sh &
```

### Modification de la configuration de RPI-Monitor

J'ai donc commencé par modifier `/etc/rpimonitor/template/temperature_bananian.conf` pour ajouter les nouvelles sources de données :

```
dynamic.4.name=paliertemp
dynamic.4.source=/run/dht-temp
dynamic.4.regexp=Temperature = (.*?) 
dynamic.4.postprocess=
dynamic.4.rrd=GAUGE

dynamic.5.name=palierhum
dynamic.5.source=/run/dht-temp
dynamic.5.regexp=Humidity = (.*?) 
dynamic.5.postprocess=
dynamic.5.rrd=GAUGE
```

Attention aux lignes avec les expressions régulières, il y a un espace après la parenthèse fermante. On peut ensuite modifier les indicateurs :

```
web.status.1.content.4.name=Temperature
web.status.1.content.4.icon=cpu_temp.png
web.status.1.content.4.line.1=JustGageBar("CPU", "°C",0, data.cputemp , 100,100,
80,percentColors,50,60)+" "+JustGageBar("PMU", "°C",0, data.soc_temp , 100,100,8
0,percentColors,35,45)+" "+JustGageBar("Disk", "°C",0, data.hddtemp , 100,100,80
,percentColors,40,45)+" "+JustGageBar("Ambiante", "°C",0, data.paliertemp , 100,
100,80,percentColors,25,35)+" "+JustGageBar("Hygro", "%",0, data.palierhum, 100,
100,80,percentColors,70,80)
```

Et finir par les graphes :

```
web.statistics.1.content.1.name=Hygrometrie
web.statistics.1.content.1.graph.1=palierhum
web.statistics.1.content.1.ds_graph_options.palierhum.label=Ambiant hygrometrie (%)

web.statistics.1.content.8.name=Temperature
web.statistics.1.content.8.graph.1=soc_temp
web.statistics.1.content.8.graph.2=hddtemp
web.statistics.1.content.8.graph.3=cputemp
web.statistics.1.content.8.graph.4=paliertemp
web.statistics.1.content.8.ds_graph_options.soc_temp.label=PMU temperature (deg C)
web.statistics.1.content.8.ds_graph_options.hddtemp.label=HDD temperature (deg C)
web.statistics.1.content.8.ds_graph_options.cputemp.label=CPU temperature (deg C)
web.statistics.1.content.8.ds_graph_options.paliertemp.label=Ambiant temperature (deg C)
```

Mon fichier complet est sur [Github](https://github.com/seblucas/lol_dht22/blob/master/rpimonitor/temperature_bananian.conf).

## Des graphes

Au final j'ai ce que je veux :

![Graphe](/blog/AmbiantTemperature.png)

J'ai bien évidemment le même pour l'hygrométrie.

## Prochaine étape

J'hésite encore entre ajouter les informations sur la température extérieure ou travailler sur des sondes distantes (une par pièce) qui transmettent par ondes RF le résultat.