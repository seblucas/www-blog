---
title: "Vous l'attendiez ..... Ce site est disponible en ipv6"
date: 2011-01-15
tags: [nginx]
slug: blog-ipv6-ready
disqus_identifier: /blog/blog-ipv6-ready
---
# Vous l'attendiez ..... Ce site est disponible en ipv6

## Ca marche ...
Je sais : tout le monde se fout de l'ipv6 mais vu que ça m'a pris environ 1/2 heure pourquoi s'en priver. Cela faisait longtemps que mon registrar autorisait les enregistrements AAAA (pour l'ipv6) et j'ai lu une nouvelle de Google qui participe activement à une journée ipv6 : http://googleblog.blogspot.com/2011/01/world-ipv6-day-firing-up-engines-on-new.html. 

Bilan, ce site est déjà prêt pour le 8 juin 2011.

Pour info http://blog.slucas.fr est accessible à la fois en ipv4 et ipv6 et j'ai créé http://blog-ipv6.slucas.fr accessible uniquement en ipv6 pour test.

## Mais ce n'est pas passé loin

J'ai quand même eu une angoisse concernant nginx, je me suis rendu compte que les répertoires systèmes de dokuwiki étaient accessibles (voir [ici](/blog/anteater-system-security-nginx)) et que c'était directement lié à l'ipv6. J'ai donc cherché un peu sur le web malheureusement sans réponse. J'ai donc posé la question sur la mailing list de nginx (voir [ici](http://forum.nginx.org/read.php?2,166530)) pour m'entendre répondre que la version de nginx de Squeeze est trop ancienne pour supporter mon contrôle.

Au début j'ai pensé compiler la dernière version de nginx, mais une grande flemme aidant j'ai trouvé une solution plus simple :

```
location ~ ^/(data|conf|bin|inc) {
  return 404;
}
```
Au final je remplace une erreur 403 par une 404 ce qui ne me pose aucun problème.

## Comment ai-je testé

Tout simplement avec Firefox/Iceweasel qui gère très bien l'ipv6 par défaut, mais il est possible de le désactiver en tapant about:config dans la barre de location et en changeant le parametre `<network.dns.disableIPv6>`.





 
