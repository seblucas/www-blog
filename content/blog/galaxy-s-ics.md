/*
Title: Passage à Ice Cream Sandwich avec mon Samsung Galaxy S - L'installation
Description: 
Author: Sébastien Lucas
Date: 2012/05/16
Robots: noindex,nofollow
Language: fr
Tags: android
*/
# Passage à Ice Cream Sandwich avec mon Samsung Galaxy S - L'installation

## Petit rappel
Il y a maintenant presque un an je postais un autre billet ([Samsung Galaxy S / Android : Bilan après 1 an](/blog/galaxy-s-one-year-after)). Entretemps je suis passé sur la ROM Simplicity ([voir sur xda](http://forum.xda-developers.com/showthread.php?t=1203047)) et j'hésitais depuis longtemps à passer sur ICS (Ice Cream Sandwich). J'avais été assez impressionné par le passage de la Folio en ICS (voir [Ice Cream Sandwich sur Folio 100 - Une semaine après](/blog/ice-cream-sandwich-folio-100-1)) et donc j'étais tenté.

Les avantages que j'avais repéré étaient :

*	Interface vraiment plus sympathique.

*	Chrome

*	Meilleure accélération matérielle pour l'interface

*	Meilleure vitesse

Et mes craintes étaient :

*	Perte de Touchwiz (l'interface propriétaire de Samsung) à laquelle je m'étais bien habitué.

*	Plantage total et perte du téléphone :(

*	Plus forte consommation de batterie

*	Plantages plus fréquents

Au final, j'ai voulu tenter l'aventure.


## Choix de la ROM

Il y a pléthore de ROM ICS adaptées au Galaxy S (il suffit de regarder [ici](http://forum.xda-developers.com/forumdisplay.php?f=665)). Après réflexion, j'ai fini par choisir la ROM SlimICS parce qu'elle me semblait relativement paramétrable malgré une taille raisonnable.

Plus d'information sur la ROM :

*	http://forum.xda-developers.com/showthread.php?t=1488096 (en)

*	http://forum.frandroid.com/topic/99627-rom404-slim-ics-33-clean-simple-and-fast/ (fr)

*	http://galaxys-team.fr/viewtopic.php?t=24169 (fr)
## Préparation de l'installation

Prudence est mère de sûreté !


*	J'ai fait une sauvegarde nandroid de ma ROM (via CWM)

*	J'ai utilise SMS Backup+ pour sauvegardes mes SMS / MMS

*	J'ai utilisé la boite à outils (voir post précédent) pour sauvegarder mon répertoire EFS

Une fois tout cela fini j'ai sauvegarde l'ensemble de mon téléphone (en le connectant au PC), je l'ai chargé à fond et j'ai enlevé la carte µSD externe.

J'ai aussi téléchargé préalablement les ROMs que je voulais installé et une ROM JVU au cas ou il y aurait problème.
## Installation

Je ne vais pas recopier les tutoriels existants sur le Web, j'en ai suivi plusieurs pour arriver à mes fins. Je vais juste détailler les étapes importantes :

*	Partir d'une ROM Gingerbread (2.3) minimum.
    * http://forum.frandroid.com/topic/87087-tuto236-i9000xxjvu-value-pack/

*	Installer un noyau permettant d'accéder à CWM
    * Idem que le lien précédent

*	Installer une ROM CyanogenMod 9
    * http://forum.frandroid.com/topic/99275-rom-cyanogenmod-9-nightlies-quotidiennes/

*	Installer SlimICS
    - Télécharger les derniers fichiers Base et Essentials qui correspondent au Galaxy S (donc I9000) sur http://www.slimroms.com
    - Entrer dans CWM faire un wipe cache / davlik cache
    - appliquer les zips  Base et Essentials à la suite
    - Rebooter le téléphone

Il faut savoir que j'ai du recommencer 3 fois l'installation avant que cela fonctionne correctement, je vous conseille donc de bien vous préparer et de bien valider que vous avez accès au mode download avant de vous lancer. Je pense que mon problème venait de vouloir passer par une ROM JW4 au lieu d'une ROM JVU mais je n'en suis pas certain.

La phase qui m'a posé problème est l'installation de la ROM CM9, j'avais toujours un démarrage en boucle (bootloop) ou je pouvais voir très rapidement un Android couché avec une croix rouge (pas bon signe). Lors de mon dernier essai j'ai eu le fonctionnement normal :

*	Lancement de l'installation du fichier zip de la CM9

*	à environ 20% de l'installation le téléphone redémarre

*	Ne pas pas stresser et enlever sa batterie

*	L'installation continue.

Au final après deux heures de stress, j'ai un téléphone fonctionnel (GSM / 3G / ...) sous ICS. La suite sur mon ressenti au prochain épisode !
