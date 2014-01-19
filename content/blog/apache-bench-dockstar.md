/*
Title: Performance d'un serveur web sur un dockstar (Apache bench)
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Performance d'un serveur web sur un dockstar (Apache bench)

## Installation d'Apache Bench
L'installation d'[Apache Bench](http://httpd.apache.org/docs/2.0/programs/ab.html) se fait tout simplement avec aptitude (même sans avoir à installer apache) :
```
aptitude install apache2-utils
```
##  Lancement du test d'une page complète sur le LAN et le résultat

```
$ab -kc 10 -n 50 http://blog.slucas.fr/blog/nginx-gzip-css-js
This is ApacheBench, Version 2.3 `<$Revision: 655654 $>`
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking blog.slucas.fr (be patient).....done


Server Software:        nginx/0.7.67
Server Hostname:        blog.slucas.fr
Server Port:            80

Document Path:          /blog/nginx-gzip-css-js
Document Length:        12130 bytes

Concurrency Level:      10
Time taken for tests:   16.277 seconds
Complete requests:      50
Failed requests:        0
Write errors:           0
Keep-Alive requests:    0
Total transferred:      630550 bytes
HTML transferred:       606500 bytes
Requests per second:    3.07 [#/sec] (mean)
Time per request:       3255.446 [ms] (mean)
Time per request:       325.545 [ms] (mean, across all concurrent requests)
Transfer rate:          37.83 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        1  420 1050.5      1    3001
Processing:   948 2624 1029.6   2773    3809
Waiting:      850 2516 1021.6   2652    3694
Total:        949 3044 1496.8   2853    6805

Percentage of the requests served within a certain time (ms)
  50%   2853
  66%   3691
  75%   3790
  80%   3800
  90%   5494
  95%   5614
  98%   6805
  99%   6805
 100%   6805 (longest request)

```
Dans l'exemple je lance 10 connexions en parallèle 50 fois de suite. 
## Même exemple mais sur une image

```
$ ab -kc 10 -n 50 http://blog.slucas.fr/lib/images/license/button/cc-by-nc-sa.png
This is ApacheBench, Version 2.3 `<$Revision: 655654 $>`
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking blog.slucas.fr (be patient).....done


Server Software:        nginx/0.7.67
Server Hostname:        blog.slucas.fr
Server Port:            80

Document Path:          /lib/images/license/button/cc-by-nc-sa.png
Document Length:        686 bytes

Concurrency Level:      10
Time taken for tests:   0.031 seconds
Complete requests:      50
Failed requests:        0
Write errors:           0
Keep-Alive requests:    50
Total transferred:      48700 bytes
HTML transferred:       34300 bytes
Requests per second:    1592.00 [#/sec] (mean)
Time per request:       6.281 [ms] (mean)
Time per request:       0.628 [ms] (mean, across all concurrent requests)
Transfer rate:          1514.27 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   1.0      0       4
Processing:     1    2   0.9      1       6
Waiting:        1    1   0.9      1       5
Total:          1    2   1.4      1       6
WARNING: The median and mean for the processing time are not within a normal deviation
        These results are probably not that reliable.

Percentage of the requests served within a certain time (ms)
  50%      1
  66%      1
  75%      1
  80%      2
  90%      5
  95%      6
  98%      6
  99%      6
 100%      6 (longest request)
```
## Analyse du résultat

On voit tout de suite que le Dockstar n'est pas un foudre de guerre (environ 3 requêtes par secondes), par contre pour la moitié des visiteurs la page s'affiche en moins de 3 secondes. Pour information, l'essentiel de la charge ne vient pas nginx mais de PHP (il n'y a qu'a voir la différence entre les deux lancements). La prochaine étape est de vérifier le plus gros consommateur PHP (donc lié à dokuwiki) et de voir si c'est légitime (et éventuellement améliorable) ou pas.

Dans le pire des cas si je veux améliorer les choses, il me restera la solution du serveur de cache ([Varnish](http://www.varnish-cache.org/) par exemple).






