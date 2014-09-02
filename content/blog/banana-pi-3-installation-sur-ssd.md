/*
Title: Banana Pi - Boot sur SATA
Description: 
Author: Sébastien Lucas
Date: 2014/09/01
Robots: noindex,nofollow
Language: fr
Tags: bpi
*/
# Banana Pi - Boot sur SATA

## Mise en place du SSD

Comme le Banana Pi est équipé un port SATA, j'ai acheté un SSD Crucial M500 120Go.

Je l'ai branché avec le câble que j'ai reçu avec le Banana Pi. Attention si vous voulez faire de la récupération l'alimentation SATA sur le Banana Pi semble être inversée (+5V et GND) par rapport au standard.

## Premier démarrage

Au début j'avais utilisé une vieille alimentation usb 1.2A venant d'un téléphone et le Banana Pi s'est arrêté plusieurs fois en plein milieu du boot. En remplaçant l'alimentation par un bloc pouvant délivrer 2A plus de problèmes.

## Partitionnement et formation

Je ne vais pas vous apprendre à utiliser `fdisk` et `mkfs.ext4`. Il y a beaucoup de tutorial bien fait sur le Net, je vous laisse chercher ;).

## Copie du système sur le SSD

Vous pouvez le faire en dehors du Banana Pi. Je l'ai fait en live sur le Banana Pi :

 * On monte le SSD :

```bash
mount /dev/sda1 /mnt
```

 * On copie toutes les données :

```bash
rsync -ahPHAXx --delete --exclude={/dev/*,/proc/*,/sys/*,/tmp/*,/run/*,/mnt/*,/media/*,/lost+found} / /mnt
```

 * On monte la partition de boot :

```bash
mount /dev/mmcblk0p1 /boot
```

 * Modification du fichier uEnv.txt pour adapter le root :

```
root=/dev/sda1
```

 * Redémarrez

## Vitesse du SSD

### Préparation

```bash
sysbench --test=fileio --file-total-size=8G prepare
```

### Lecture séquentielle

```bash
root@minus ~ # sysbench --test=fileio --file-total-size=8G --file-test-mode=seqrd --init-rng=on --max-time=300 --max-requests=0 run
sysbench 0.4.12:  multi-threaded system evaluation benchmark

Running the test with following options:
Number of threads: 1
Initializing random number generator from timer.


Extra file open flags: 0
128 files, 64Mb each
8Gb total file size
Block size 16Kb
Periodic FSYNC enabled, calling fsync() each 100 requests.
Calling fsync() at the end of test, Enabled.
Using synchronous I/O mode
Doing sequential read test
Threads started!
Done.

Operations performed:  524288 Read, 0 Write, 0 Other = 524288 Total
Read 8Gb  Written 0b  Total transferred 8Gb  (167.07Mb/sec)
10692.66 Requests/sec executed

Test execution summary:
    total time:                          49.0325s
    total number of events:              524288
    total time taken by event execution: 47.6566
    per-request statistics:
         min:                                  0.03ms
         avg:                                  0.09ms
         max:                                  9.99ms
         approx.  95 percentile:               0.47ms

Threads fairness:
    events (avg/stddev):           524288.0000/0.00
    execution time (avg/stddev):   47.6566/0.00
```

Lecture : **167.07Mb/sec**

### Écriture séquentielle

```bash
root@minus ~ # sysbench --test=fileio --file-total-size=8G --file-test-mode=seqwr --init-rng=on --max-time=300 --max-requests=0 run
sysbench 0.4.12:  multi-threaded system evaluation benchmark

Running the test with following options:
Number of threads: 1
Initializing random number generator from timer.


Extra file open flags: 0
128 files, 64Mb each
8Gb total file size
Block size 16Kb
Periodic FSYNC enabled, calling fsync() each 100 requests.
Calling fsync() at the end of test, Enabled.
Using synchronous I/O mode
Doing sequential write (creation) test
Threads started!
Done.

Operations performed:  0 Read, 524288 Write, 128 Other = 524416 Total
Read 0b  Written 8Gb  Total transferred 8Gb  (41.46Mb/sec)
 2653.47 Requests/sec executed

Test execution summary:
    total time:                          197.5861s
    total number of events:              524288
    total time taken by event execution: 191.7346
    per-request statistics:
         min:                                  0.10ms
         avg:                                  0.37ms
         max:                               1604.23ms
         approx.  95 percentile:               0.14ms

Threads fairness:
    events (avg/stddev):           524288.0000/0.00
    execution time (avg/stddev):   191.7346/0.00
```

Ecriture : **41.46Mb/sec**

### Lecture/Écriture aléatoire

```bash
root@minus ~ # sysbench --test=fileio --file-total-size=8G --file-test-mode=rndrw --init-rng=on --max-time=300 --max-requests=0 run
sysbench 0.4.12:  multi-threaded system evaluation benchmark

Running the test with following options:
Number of threads: 1
Initializing random number generator from timer.


Extra file open flags: 0
128 files, 64Mb each
8Gb total file size
Block size 16Kb
Number of random requests for random IO: 0
Read/Write ratio for combined random IO test: 1.50
Periodic FSYNC enabled, calling fsync() each 100 requests.
Calling fsync() at the end of test, Enabled.
Using synchronous I/O mode
Doing random r/w test
Threads started!
Time limit exceeded, exiting...
Done.

Operations performed:  40920 Read, 27280 Write, 87286 Other = 155486 Total
Read 639.38Mb  Written 426.25Mb  Total transferred 1.0406Gb  (3.552Mb/sec)
  227.33 Requests/sec executed

Test execution summary:
    total time:                          300.0033s
    total number of events:              68200
    total time taken by event execution: 25.8486
    per-request statistics:
         min:                                  0.03ms
         avg:                                  0.38ms
         max:                                 11.77ms
         approx.  95 percentile:               0.60ms

Threads fairness:
    events (avg/stddev):           68200.0000/0.00
    execution time (avg/stddev):   25.8486/0.00
```

### Nettoyage

```bash
sysbench --test=fileio --file-total-size=8G cleanup
```

## Bilan

C'est peut être pas top quand on voit les performances du SSD. Par contre quand on vient d'un disque dur branché en USB sur un Dockstar, c'est le grand luxe.