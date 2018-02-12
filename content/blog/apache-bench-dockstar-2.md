---
title: "Performance d'un serveur web sur un Dockstar (Apache bench) - Partie 2"
date: 2011-10-12
tags: [dockstar,nginx]
slug: apache-bench-dockstar-2
disqus_identifier: /blog/apache-bench-dockstar-2
---
# Performance d'un serveur web sur un Dockstar (Apache bench) - Partie 2

## Bilan un an après
Avec les dernières modifications sur le cache Nginx, j'ai décidé de refaire le test.

## Résultat de l'extérieur

```
# ab -kc 10 -n 50 http://blog.slucas.fr/blog/nginx-gzip-css-js
This is ApacheBench, Version 2.3 <$Revision: 655654 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking blog.slucas.fr (be patient).....done


Server Software:        nginx/1.1.0
Server Hostname:        blog.slucas.fr
Server Port:            80

Document Path:          /blog/nginx-gzip-css-js
Document Length:        14727 bytes

Concurrency Level:      10
Time taken for tests:   7.254 seconds
Complete requests:      50
Failed requests:        0
Write errors:           0
Keep-Alive requests:    0
Total transferred:      765550 bytes
HTML transferred:       736350 bytes
Requests per second:    6.89 [#/sec] (mean)
Time per request:       1450.885 [ms] (mean)
Time per request:       145.089 [ms] (mean, across all concurrent requests)
Transfer rate:          103.06 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:       36  179  96.8    189     485
Processing:   377 1225 463.7   1272    2088
Waiting:       49  240 191.4    204    1421
Total:        531 1405 465.1   1483    2377

Percentage of the requests served within a certain time (ms)
  50%   1483
  66%   1657
  75%   1796
  80%   1882
  90%   1936
  95%   1989
  98%   2377
  99%   2377
 100%   2377 (longest request)
```

Avec une page plus grosse (14727 bytes à la place de 12130 bytes) je passe de 3 requêtes par secondes à 6,89. 50% des clients sont servis en moins d'une seconde et demie.

## Résultat depuis le réseau local

```
$ ab -kc 10 -n 50 http://blog.slucas.fr/blog/nginx-gzip-css-js
This is ApacheBench, Version 2.3 <$Revision: 655654 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking blog.slucas.fr (be patient).....done


Server Software:        nginx/1.1.0
Server Hostname:        blog.slucas.fr
Server Port:            80

Document Path:          /blog/nginx-gzip-css-js
Document Length:        14727 bytes

Concurrency Level:      10
Time taken for tests:   0.121 seconds
Complete requests:      50
Failed requests:        0
Write errors:           0
Keep-Alive requests:    0
Total transferred:      765550 bytes
HTML transferred:       736350 bytes
Requests per second:    414.53 [#/sec] (mean)
Time per request:       24.124 [ms] (mean)
Time per request:       2.412 [ms] (mean, across all concurrent requests)
Transfer rate:          6198.14 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        1    4   1.7      4       9
Processing:    13   19   2.4     20      24
Waiting:        4    7   1.4      7      10
Total:         14   23   1.7     23      26

Percentage of the requests served within a certain time (ms)
  50%     23
  66%     24
  75%     24
  80%     24
  90%     25
  95%     26
  98%     26
  99%     26
 100%     26 (longest request)
```

Impressionnant cela veut donc dire une chose, le point bloquant du test venant de l'extérieur est ma ligne ADSL, pas le Dockstar. Donc je peux arrêter d'optimiser le Dockstar et attendre tranquillement que mon nombre de visites motive un hébergement externe.

J'ai fait plus de tests avec un niveau de parallélisme plus important :

```
$ ab -kc 30 -n 50 http://blog.slucas.fr/blog/nginx-gzip-css-js
This is ApacheBench, Version 2.3 <$Revision: 655654 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking blog.slucas.fr (be patient).....done


Server Software:        nginx/1.1.0
Server Hostname:        blog.slucas.fr
Server Port:            80

Document Path:          /blog/nginx-gzip-css-js
Document Length:        14727 bytes

Concurrency Level:      30
Time taken for tests:   0.282 seconds
Complete requests:      50
Failed requests:        0
Write errors:           0
Keep-Alive requests:    0
Total transferred:      765550 bytes
HTML transferred:       736350 bytes
Requests per second:    177.18 [#/sec] (mean)
Time per request:       169.319 [ms] (mean)
Time per request:       5.644 [ms] (mean, across all concurrent requests)
Transfer rate:          2649.22 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        2    9   5.7      6      22
Processing:    33   54  34.0     45     277
Waiting:        9   18   6.7     16      32
Total:         35   64  33.2     62     282

Percentage of the requests served within a certain time (ms)
  50%     62
  66%     64
  75%     67
  80%     69
  90%     72
  95%     73
  98%    282
  99%    282
 100%    282 (longest request)


$ ab -kc 50 -n 50 http://blog.slucas.fr/blog/nginx-gzip-css-js
This is ApacheBench, Version 2.3 <$Revision: 655654 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking blog.slucas.fr (be patient).....done


Server Software:        nginx/1.1.0
Server Hostname:        blog.slucas.fr
Server Port:            80

Document Path:          /blog/nginx-gzip-css-js
Document Length:        14727 bytes

Concurrency Level:      50
Time taken for tests:   0.306 seconds
Complete requests:      50
Failed requests:        0
Write errors:           0
Keep-Alive requests:    0
Total transferred:      765550 bytes
HTML transferred:       736350 bytes
Requests per second:    163.46 [#/sec] (mean)
Time per request:       305.881 [ms] (mean)
Time per request:       6.118 [ms] (mean, across all concurrent requests)
Transfer rate:          2444.11 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        3    9   2.2     10      12
Processing:    54  121  75.0     94     295
Waiting:       12   35  20.3     31      87
Total:         57  129  74.3    105     304

Percentage of the requests served within a certain time (ms)
  50%    105
  66%    107
  75%    112
  80%    115
  90%    277
  95%    296
  98%    304
  99%    304
 100%    304 (longest request)


```
