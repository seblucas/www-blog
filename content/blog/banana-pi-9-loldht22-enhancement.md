/*
Title: Banana Pi - Amélioration du programme de lecture de la sonde DHT22
Description: 
Author: Sébastien Lucas
Date: 2014/11/16
Robots: noindex,nofollow
Language: fr
Tags: bpi
*/
# Banana Pi - Amélioration du programme de lecture de la sonde DHT22

## Gestion de code erreur

Pour éviter d'avoir des lectures erronées dans le graphe RPI-Monitor (mesures à 0 notamment), j'ai modifié le programme pour que lorsque que si aucune mesure n'a pu être faite (même avec les 10 essais), il y a un code d'erreur en retour.

De la même manière j'ai modifié le script bash pour gérer correctement les codes d'erreur.

Voir les commits suivants :

 * https://github.com/seblucas/lol_dht22/commit/3de823e81a1143b634752787c9047e077712cf93
 * https://github.com/seblucas/lol_dht22/commit/f65751aaca0f8907f686b94c35b34e7ce60a93ab

## Vérification de la cohérence des mesures

En analysant mes deux semaines de mesures je me suis rendu compte que j'ai eu une mesure de température enregistrée à -3126°C ce qui n'est pas très cohérent.

J'imagine qu'il y a un vrai bug dans le programme pour ressortir une mesure fausse à ce point, pour le moment j'ai juste ajouté un palliatif tout simple en ajoutant un contrôle de cohérence pour que les mesures faites restent dans le cadre des [spécifications du DHT22](https://www.sparkfun.com/datasheets/Sensors/Temperature/DHT22.pdf).

Voir les commits suivants :

 * https://github.com/seblucas/lol_dht22/commit/496e8c8ecb8bd91bd918a8218dd346b0a3400de2
 * https://github.com/seblucas/lol_dht22/commit/dcfa90adf9071247a2bcfa31abbdfcc49eb728a1