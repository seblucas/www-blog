/*
Title: vmnetcfg.exe absent après une installation de VMware Player
Description: 
Author: Sébastien Lucas
Date: 2010/10/25
Robots: noindex,nofollow
Language: fr
Tags: vmware
*/
# vmnetcfg.exe absent après une installation de VMware Player

## Problème
Après l'installation de VMware player sur le poste d'un collègue, les machines virtuelles en mode bridge ne récupèrent plus d'adresse IP. Un indice : c'est un ordinateur portable avec une carte réseau filaire et une carte réseau Wifi (actuellement désactivée). Le problème vient donc du fait que le bridge se fait sur la mauvaise interface réseau et il existe un outil pour régler ce genre de détail : vmnetcfg.exe. Malheureusement ce fichier n'est pas installé avec VMware Player.

## Solution

*	Soit installer une version d'évaluation de VMware Workstation pour avoir accès à l'outil
*	Utiliser la technique précisée sur le lien suivant : http://efreedom.com/Question/3-187767/VMWare-Player-311-Missing-Vmnetcfgexe-Utility-Get





