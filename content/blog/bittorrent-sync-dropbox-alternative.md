/*
Title: BitTorrent Sync : Une alternative à Dropbox / Owncloud ?
Description: 
Author: Sébastien Lucas
Date: 2014/06/07
Robots: noindex,nofollow
Language: fr
Tags: dropbox,calibre
*/
# BitTorrent Sync : Une alternative à Dropbox ?

## Le contexte

J'ai loué un VPS avec pas mal de place (200Go) pour pouvoir l'utiliser pour centraliser des sauvegardes et tenter de me libérer de Dropbox / Google Drive / OneDrive / ...

Mon utilisation de Dropbox pour le moment se limite à cela :

 * Ma base Calibre.
 * Mes différents projets de développements (depuis mon crash de disque dur de l'an dernier).
 * Du vrai partage avec des amis.
 * Des scans de documents importants

## L'aventure Owncloud

J'ai beaucoup essayé d'utiliser [Owncloud](http://owncloud.org/) avec notamment son [client Windows et Linux](http://owncloud.org/sync-clients/) et je dois avouer que j'ai toujours été déçu :

 * L'intégration avec Nginx a été longue mais a fini par arriver.
 * La synchronisation de répertoire m'a causé pas mal de problèmes y compris des suppressions de données. J'ai notamment eu des répertoires de Calibre qui ne se synchronisaient jamais certainement à cause d'accents dans leurs noms.
 * Le passage aux versions supérieures n'ont jamais été automatiques et j'ai souvent du tout réinstaller et transférer à nouveau les données.
 * Il est impossible de spécifier que le partage ne doit se faire que dans un seul sens (partage en lecture seule) et donc il peut y avoir des conflits.

Le seul élément que j'ai vraiment apprécié est la copie de fichiers via le navigateur mais il y a beaucoup d'alternatives bien moins complexes qui font le même travail.

## BitTorrent Sync

Je vais tout de suite parler du plus gros défaut de [BitTorrent Sync](http://www.bittorrent.com/intl/fr/sync), il n'est pas libre et les sources ne sont pas disponibles. Pour relativiser c'est aussi le cas de Dropbox et consorts.

Je ne vais pas vous expliquer comment ça marche, d'autres l'ont déjà fait ([Korben](http://korben.info/sauvegarder-photos-telephone-sur-ordinateur.html) ou [jcd](http://jcd.lv/post/2013/04/24/Installer-BitTorrent-Sync)). Je vous laisse consulter Google si besoin.

Pour résumer BitTorrent Sync est clairement meilleur que le client Owncloud pour mes besoins :

 * Il est possible de faire un partage en lecture seule.
 * Aucun souci lors des mises à jour de version.
 * Utilisation raisonnable de ressources.

Bilan je l'utilise avec plaisir depuis quelques mois.

## Est ce que btsync est plus sûr que Dropbox

### Localisation des données

De la même manière que ma précédente solution avec Owncloud, j'ai choisi d'héberger mes données sur un serveur privé localisé en France. Donc :

 * Moins de risque que la NSA passe par là.
 * Pas d'exploitation commerciale de mes données.

### Sécurisation des transferts

La FAQ réponds à la question :

> No. BitTorrent Sync is based on the BitTorrent protocol, but all the traffic is encrypted using a private key derived from the shared secret. Your files can be viewed and received only by the people with whom you share your private secret.

Donc le transfert est crypté.

### Mes données passent-elles par des tiers ?

C'est un sujet que je n'ai pas retrouvé souvent en faisant des recherches sur Internet. Avec la paramétrage par défaut, il faut savoir que le client btsync contacte un `tracker` public pour lui transmettre la clé de votre partage. Si un autre client btsync transmet la même clé alors la synchronisation entre les deux client btsync va commencer. C'est expliqué sur le site de BitTorrent Sync :

> Serveur de suivi BitTorrent. BitTorrent Sync peut utiliser un serveur de suivi spécifique pour faciliter la recherche de pairs. Le serveur de suivi voit la combinaison de SHA1(clé secrète):ip:port et aide les pairs à se connecter directement. Le serveur de suivi BitTorrent Sync joue aussi le rôle de serveur STUN et peut aider à réaliser un NAT pour les pairs afin qu’ils puissent établir une connexion directe, même derrière un NAT.

Donc la première réponse est les clés (cryptées) passent par un tiers.

Ensuite le transfert peut passer par un tiers si la communication directe entre les deux clients est impossible (pas de transfert de port, pas UPNP, ...) alors les données vont passer par un serveur de relais. Attention les données seront toujours cryptées. Encore une fois c'est bien expliqué sur le site de BitTorrent Sync :

> Dans de rares cas, les pairs ne peuvent pas communiquer directement. Cela se produit généralement quand les appareils se trouvent dans un bureau, derrière des pare-feux puissants. Dans ce cas, BitTorrent fournit un serveur de relais pour acheminer le trafic entre les pairs. Tout le trafic est chiffré en AES avec votre clé secrète, ce qui signifie que nous n’avons absolument pas accès à vos données.
>
> Vous pouvez désactiver cette option, mais les pairs risquent de ne pas pouvoir communiquer.

Donc les données (cryptées) peuvent aussi passer par un tiers dans certains cas. Mais en relativisant toutes les données peuvent un peu voyager sur le Net donc ce n'est pas si grave.

### Une configuration de paranoïaque

Ma situation est simple :

 * 1 ordinateur portable sur lequel je fais toutes les modifications.
 * 1 VPS hébergé.
 * 1 NAS sur mon réseau local.
 * 1 NAS hébergé chez un proche.

Je ne travaille que sur mon portable et les 3 autres périphériques sont en lecture seule.

Donc ma configuration VPS est la suivante sur tous mes partages :

![Configuration VPS](/blog/btsync-paranoid.png){.centered}

La configuration des 3 autres clients est la même à ces différences :

 * Search LAN est coché.
 * J'ai ajouté un hôte prédéfini : mon serveur VPS.

En faisant ça je me limite à mes 4 hôtes mais sans pouvoir interdire à un autre hôte de se connecter si il connaît mon identifiant de partage.

## L'avenir

J'ai repéré un petit projet intéressant [Syncthing](http://syncthing.net/) qui règle notamment la sécurisation des liens entres les serveurs.

A suivre !