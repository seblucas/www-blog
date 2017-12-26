---
title: "COPS 0.2.1"
date: 2012-09-16
tags: [calibre,ereader,nginx,opds,php]
slug: cops-0.2.1
---
# COPS 0.2.1

J'ai eu très peu de temps à accorder à COPS depuis mon retour de vacances, mais j'ai fait suffisamment de corrections de bugs pour ressortir une nouvelle version. La communauté des utilisateurs de COPS s'élargit et j'ai eu beaucoup de mails et de retours via Github, cela m'oblige à être plus professionnel avec ce projet (une bonne chose). Voila le résultat :

* [Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)
* [Liste des changements](/fr/oss/calibre-opds-php-server-changelog)

Les modifications ne concernent que des corrections de bugs à une exception près : la recherche sur le catalogue OPDS. Un utilisateur m'a indiqué que la recherche ne fonctionnait plus à partir de FBReaderJ et j'ai pu confirmer qu'il avait raison. Or, je suis certain que cela fonctionnait parfaitement en mai, j'ai donc pensé donc à une régression de FBReaderJ d'autant plus que Mantano continue de bien fonctionner. 

J'ai essayé de regarder le code (via le [Github](https://github.com/geometer/FBReaderJ)) et j'ai aussi ajouté un [ticket](https://github.com/geometer/FBReaderJ/issues/70) et pour l'instant pas de nouvelles. J'ai aussi validé que ma méthode était bien la bonne (voir [ici](https://groups.google.com/forum/?fromgroups=#!topic/openpub/8Gnd5UgDCUE)).

En désespoir de cause, j'ai ajouté un paramètre (cops_generate_invalid_opds_stream) à modifier dans votre config_local.php pour que COPS génère un flux non conforme. Par contre, cela va permettre la recherche dans certains clients non conformes comme FBReaderJ et Moon+ Reader. 

Je ne suis toujours pas certain que ce soit la bonne solution pour aider les clients non conformes à évoluer dans le bon sens !

Sinon, je suis fier d'annoncer que j'ai encore intégré du code d'un autre contributeur, c'est une excellente chose pour l'avenir de COPS !

Bon test à vous.

