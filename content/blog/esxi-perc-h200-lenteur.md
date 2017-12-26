---
title: "Latence d'écriture avec un Perc H200 et VMWare ESXi"
date: 2011-05-16
tags: [vmware]
slug: esxi-perc-h200-lenteur
---
# Latence d'écriture avec un Perc H200 et VMWare ESXi

J'ai été gravement énervé par les performances d'un nouveau serveur Dell Poweredge 110 II. La vitesse d'écriture sur disque était minable (12Mo/s) avec une latence insupportable. Après pas mal de recherche, j'ai trouvé que le contrôleur Raid Perc H200 était fautif parce qu'il désactive le cache des disques. Après quelques heures de recherche j'ai trouvé un [post](http://forum.online.net/index.php?/topic/316-en-cas-de-performances-degradees-de-votre-h200-assurez-vous-de-lactivation-du-cache-disque-sata/page__p__1328__hl__h200__fromsearch__1#entry1328) expliquant une solution au problème. N'ayant pas trouvé l'équivalent en anglais j'en ai fait la traduction : [Slow write with Perc H200 and VMWare ESXi](/en/tips/esxi-perc-h200-slow).







