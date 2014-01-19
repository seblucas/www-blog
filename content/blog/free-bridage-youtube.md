/*
Title: Y-a-t-il un bridage de Free avec Youtube et les autres services de Video sur le Web
Description: 
Author: Sébastien Lucas
Date: 2012/02/29
Robots: noindex,nofollow
Language: fr
*/
# Y-a-t-il un bridage de Free avec Youtube et les autres services de Video sur le Web

## Énervant ...
Je suis un heureux abonné Free depuis de nombreuses années mais depuis un peu plus d'un an, la visualisation de vidéo sur le Net est quasiment impossible dans la soirée. Avec Youtube même les vidéos en 240p sont impossible à regarder (coupure toutes les 30 secondes). Le matin je peux regarder sans problème des vidéos en 1080p. Pour info j'ai environ 8 à 9 Mbits de bande passante descendante.

Le point de vue de Free est presque compréhensible : c'est lui qui paye la bande passante et Google n'y participe en rien.

Au final ce sont les consommateurs qui sont lésés.

## Comment vérifier le bridage scientifiquement

### Installation d'un proxy
J'ai installé un proxy sur mon serveur 1&1 :
```
aptitude install tinyproxy
```
J'ai ouvert le port du proxy sur le firewall (voir mes autres articles sur le sujet).
### Un cas de test

Comme les liens de téléchargement direct des videos sur Youtube ne sont pas facile à obtenir, j'ai fait un test sur blip.tv.
### Téléchargement de chez moi sans proxy

```
vlad@xbmc:~$ wget http://blip.tv/file/get/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
--2012-02-28 20:48:15--  http://blip.tv/file/get/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
Résolution de blip.tv... 74.122.174.250
Connexion vers blip.tv|74.122.174.250|:80...connecté.
requête HTTP transmise, en attente de la réponse...302 Found
Emplacement: http://j32.video2.blip.tv/11870010419521/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv [suivant]
--2012-02-28 20:48:15--  http://j32.video2.blip.tv/11870010419521/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
Résolution de j32.video2.blip.tv... 8.27.5.254, 4.26.228.254, 8.26.222.254
Connexion vers j32.video2.blip.tv|8.27.5.254|:80...connecté.
requête HTTP transmise, en attente de la réponse...200 OK
Longueur: 344124949 (328M) [video/x-flv]
Sauvegarde en : «Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv.2»

 0% [                                       ] 1 090 094   55,4K/s  eta 85m 19s
```
### Avec proxy

Pour utiliser wget avec un proxy il faut mettre le contenu suivant dans le fichier ~/.wgetrc :
```
http_proxy = http://87.106.98.163:8888/
use_proxy = on
wait = 15
```
Et le résultat :
```
vlad@xbmc:~$ wget http://blip.tv/file/get/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
--2012-02-28 20:50:34--  http://blip.tv/file/get/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
Connexion vers 87.106.98.163:8888...connecté.
requête Proxy transmise, en attente de la réponse...302 Found
Emplacement: http://j32.video2.blip.tv/11870010419521/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv [suivant]
--2012-02-28 20:50:52--  http://j32.video2.blip.tv/11870010419521/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
Connexion vers 87.106.98.163:8888...connecté.
requête Proxy transmise, en attente de la réponse...200 OK
Longueur: 344124949 (328M) [video/x-flv]
Sauvegarde en : «Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv.3»

 0% [                                       ] 1 192 785   97,3K/s  eta 40m 51s
```

Donc deux fois plus rapide.
### Et directement sur le serveur 1&1

```
0:~#  wget http://blip.tv/file/get/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
--2012-02-28 20:53:14--  http://blip.tv/file/get/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
Résolution de blip.tv... 74.122.174.250
Connexion vers blip.tv|74.122.174.250|:80...connecté.
requête HTTP transmise, en attente de la réponse...302 Found
Emplacement: http://j32.video2.blip.tv/11870010419521/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv [suivant]
--2012-02-28 20:53:15--  http://j32.video2.blip.tv/11870010419521/Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv
Résolution de j32.video2.blip.tv... 209.84.23.126
Connexion vers j32.video2.blip.tv|209.84.23.126|:80...connecté.
requête HTTP transmise, en attente de la réponse...200 OK
Longueur: 344124949 (328M) [video/x-flv]
Sauvegarde en : «Striderdoom-Day9Daily423P3BurrowedBanelingFundayMonday293.flv»

 4% [>                                      ] 17 171 305   617K/s  eta 3m 41s
```

Donc 6 fois plus rapide qu'avec le proxy.
###  Et un proxy derrière un tunnel SSL 

Si Free bride en analysant le contenu alors le fait de crypter va solutionner le problème par contre cela entraine une dépense de bande passante supplémentaire. A tester.
## Conclusion

Soit il y a bridage soit la bande passante que Free dédie a ce genre de service est limitée. En tout cas pour les personnes qui ont un serveur hébergé pensez à installer un petit proxy. J'ai remarqué que le proxy peut aider de temps en temps.
