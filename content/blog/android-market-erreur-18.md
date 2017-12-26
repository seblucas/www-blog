/*
Title: Erreur -18 à l'installation de mise à jour avec l'Android Market
Description: 
Author: Sébastien Lucas
Date: 2011/03/19
Robots: noindex,nofollow
Language: fr
Tags: android
*/
# Erreur -18 à l'installation de mise à jour avec l'Android Market

## La mise à jour d'Angry Birds Seasons pour la Saint Patrick
J'ai voulu mettre à jour Angry Birds Seasons sur ma tablette Folio 100 il y a quelques jours et le téléchargement a planté. J'ai ensuite essayé toutes les manipulations classiques : 
* Reboot
* Suppression des données du market (Paramètre -> Applications -> Gérer les applications -> Virer les paramètres d'android market)
et cela n'a rien résolu.

Google m'a ensuite donné la réponse (http://www.google.fi/support/forum/p/Android+Market/thread?tid=7d004179e5574276&hl=en) :
* Bien vérifier que le débogage USB de la tablette  est désactivé.
* Prendre un câble mini-usb et brancher la tablette sur un ordinateur.
* Au bout de quelques secondes, activer le stockage de masse sur la tablette.
* Sur l'ordinateur aller dans le répertoire .android_secure et supprimer le fichier smdl2tmp1.asec
* Voila !







