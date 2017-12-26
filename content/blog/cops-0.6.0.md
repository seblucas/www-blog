---
title: "COPS 0.6.0"
date: 2013-07-25
tags: [calibre,ereader,nginx,opds,php]
slug: cops-0.6.0
---
# COPS 0.6.0

Beaucoup de changements pour cette nouvelle version :

* [Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)
* [Liste des changements](/fr/oss/calibre-opds-php-server-changelog)

Les plus gros changements sont cachés :

* le moteur de rendu des pages HTML a été totalement changé. Il est maintenant entièrement en JavaScript ce qui permet d'avoir un catalogue au moins deux fois plus rapide.
* La gestion des icônes et des miniatures de livres a été complètement revue afin d'améliorer la qualité surtout pour les périphériques avec une densité de pixel importante (Retina, Nexus et la majorité des smartphones).

ATTENTION : j'ai changé un pourcentage non négligeable du code, il y a donc un risque de nouveaux bugs (même si je m'en sert sans problèmes depuis environ 1 mois). N'hésitez donc pas à me prévenir ici, sur Github ou par Mail.

Ensuite il y a aussi trois nouvelles fonctionnalités (en fait il y en plus mais il faudra regarde la liste de changements) :

* Il est maintenant possible d'envoyer un livre par mail. Pur cela il faut configurer $config['cops_mail_configuration'] avec votre serveur SMTP. Pour le moment seuls les formats EPUB, PDF, MOBI  sont supportés, je le rendrai configurable plus tard. J'ai fait cette évolution en pensant au Send To Kindle mais cela fonctionne avec des mails normaux.
* Il est maintenant possible de se connecter à un COPS sécurisé avec le navigateur de la Kobo (il suffit de pointer sur la page login.html)
* Toutes les listes de livres sont maintenant filtrables par les étiquettes (tags). C'est à activer via $config['cops_html_tag_filter'] ou directement dans la page de paramétrage. Cela fonctionne de la façon suivante : un click sur un tag n'affiche que les livres correspondant à ce tag (et ajoute une ligne bleue sur la gauche du tag), un deuxième click affiche les livres ne correspondant pas ce tag (et affiche une ligne rouge à la droite du tag). Bien sur il est possible de mélanger autant de critères que vous voulez.

ATTENTION : je sais que certains d'entre vous ont des bibliothèques Calibre avec 2000 ou 3000 tags. Le système de filtrage que je viens de décrire n'est certainement pas pour vous. Personnellement j'ai modifié à la main tous les tags de mes livres pour me limiter à 25 tags et ça marche. Par contre si vous avez des idées d'améliorations, n'hésitez pas à me les communiquer.

Comme toujours un grand merci aux contributeurs et aux beta testeurs.

Bon test à vous.

