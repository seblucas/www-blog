/*
Title: Le crash de vendredi et 1&1
Description: 
Author: Sébastien Lucas
Date: 2012/05/27
Robots: noindex,nofollow
Language: fr
Tags: dropbox,nginx,vps
*/
# Le crash de vendredi et 1&1

## Un crash ... Encore !
Et oui cela faisait longtemps mais le site a été indisponible vendredi matin pendant environ 1 heure. Cela était dû à une particularité du VPS 1&1 et Dropbox. J'ai eu de la chance et j'ai pu le réparer rapidement, j'espère que cela n'a pas gêné outre mesure.

## Qu'est ce qu'un VPS 1&1

Les VPS fournis par 1&1 sont des systèmes paravirtualisés avec Virtuozzo (lié à OpenVZ) donc il n'y a pas virtualisation matérielle comme avec VMWare.

Il s'agit d'une virtualisation par conteneurs : c'est à dire que le noyau Linux du serveur exécute tous les processus de tous les conteneurs mais interdit la communication entre processus de conteneurs différents.
## Garantie de 512Mo de RAM

Sur le VPS que j'ai loué (le moins cher), j'ai droit à 512Mo de RAM et éventuellement une utilisation à 2Go en pointe. Le problème : la phrase 512Mo de RAM garantie est partiellement vraie car il y a des autres limites qui sont fixées à chaque conteneur (à tort ou à raison, là n'est pas le problème).

Ces limites sont consultables sur l'interface Virtuozzo ou via votre VPS : 
```
s40:~# cat /proc/user_beancounters
Version: 2.5
       uid  resource                     held              maxheld              barrier                limit              failcnt
 67216902:  kmemsize                  7335999              7375510             20971520             23068672                    0
            lockedpages                     0                    0                  256                  256                   10
            privvmpages                 62341                62338               524288               576716                    0
            shmpages                     9089                 9089                20480                20480                   51
            dummy                           0                    0  9223372036854775807  9223372036854775807                    0
            numproc                        41                   41                   96                   96                    0
            physpages                   22424                22334           2147483647           2147483647                    0
            vmguarpages                     0                    0               131072           2147483647                    0
            oomguarpages                23510                23420  9223372036854775807           2147483647                    0
            numtcpsock                      9                    9                  360                  360                    0
            numflock                        1                    2                  188                  206                    0
            numpty                          1                    1                   16                   16                    0
            numsiginfo                      0                    1                  256                  256                    0
            tcpsndbuf                  140032               140032              1720320              2703360                 5298
            tcprcvbuf                  147456               147456              1720320              2703360                    0
            othersockbuf                13968                13968              1126080              2097152                    0
            dgramrcvbuf                     0                    0               262144               288358                    0
            numothersock                   13                   13                  360                  360                    0
            dcachesize                 394380               398136              3145728              3460300            625106375
            numfile                      1124                 1128                 4096                 4096                    0
            dummy                           0                    0                    0                    0                    0
            dummy                           0                    0                    0                    0                    0
            dummy                           0                    0                    0                    0                    0
            numiptent                      18                   18                  100                  105                    0

```

Par exemple : la limite de mémoire partagée (un type de mémoire) est relativement basse et manque de bol c'est celle qu'utilise Nginx pour le cache. Donc, en utilisant 32Mo de cache de pages HTML et 10Mo de cache HTTPS, j'arrive au max de ce que le serveur peut allouer en mémoire partagée. Pour préciser mon problème : si je lance la commande free, j'arrive à une utilisation mémoire de l'ordre de 146Mo. Si j'essaie de passer le cache HTML à 64Mo Ngix refuse de démarrer. J'utilise moins de la moitié de la RAM du VPS et j'ai une impossibilité d'allocation mémoire. Par sécurité, j'ai donc passé le cache HTML à 16Mo pour avoir encore un peu de réserve.

Pour information, il est impossible d'ajouter du swap sur un VPS Virtuozzo.

## Dropbox

La cas de Dropbox est encore plus lourd : comme son but est de synchroniser les fichiers locaux avec ceux du Cloud, il a besoin de vérifier le statut de tous les fichiers locaux. Malheureusement pour moi, mon répertoire Dropbox contient beaucoup de petits fichiers (lié à Calibre) et la limite de "dcachesize" (inodes en cache) de Virtuozzo est trop faible.

Bilan : dès que je lance le démon Dropbox, mon VPS est inaccessible car l'allocation mémoire est bloquée pour tous les processus (je n'ai même plus le droit de lancer un reboot). C'est pourquoi, vous voyez un nombre de failcnt important dans l'exemple précédent : c'est le crash de vendredi.

Donc, ma solution pour feinter l'ours a été de supprimer mon répertoire Dropbox et de relancer une synchronisation complète (comme ça, il y a 0 fichier existant et je n'explose pas la limite). Malheureusement, le processus Dropbox a dû être redémarré automatiquement et là il y a eu vérification de l'existant -> Crash.

Un petit aparté : Le démon Dropbox sous Linux prend environ 200Mo de RAM constamment ... c'est évidemment beaucoup trop.
## Le service client 1&1

Comme tout ne peut pas être négatif, le service client 1&1 a répondu rapidement à mes mails. Malheureusement pour moi, ils ne veulent pas augmenter les limites pour mon VPS et je ne peux pas passer sur un VPS plus costaud, donc je vais devoir trouver une autre solution dans l'année qui vient.
## Bilan

*	Dès qu'il y a paravirtualisation (1&1, Gandi, ...), la RAM garantie ne veut pas dire grand chose, il faut avoir les informations sur les limites.
*	Dropbox est assez immonde en terme d'utilisation mémoire.
*	Je comprends pourquoi OVH est plus cher 
## Autres informations à ce sujet

*	http://florent.clairambault.fr/serveur-prive-1and1-une-belle-arnaque
*	http://wiki.openvz.org/UBC_auxiliary_parameters
*	http://www.webhostingtalk.com/showthread.php?t=682317

