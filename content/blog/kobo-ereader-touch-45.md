---
title: "Meilleure gestion des séries dans la Kobo"
date: 2012-12-05
tags: [ereader]
slug: kobo-ereader-touch-45
---
# Meilleure gestion des séries dans la Kobo

Le titre est racoleur mais le résultat l'est un peu moins pour le moment. Néanmoins c'est l'occasion de faire un petit tutoriel sur le sujet.

## Prérequis

* Une liseuse Kobo (jusque là c'est logique) avec le firmware 2.2.0 au minimum. A ce jour ce firmware n'est déployé qu'au Japon et son installation manuelle n'est pas recommandée par Kobo. Personnellement comme je suis dans le groupe test, j'ai la dernière version beta. Jusqu'à preuve du contraire cela devrait marcher sur les Touch, Glo et Mini.
* Calibre 0.9.8 configuré pour utiliser le driver Kobo.

## Configuration de Calibre

Cette opération n'est à faire qu'une seule fois, les paramètres sont ensuite sauvegardés.

* Démarrez Calibre
* Connectez votre Kobo (cliquez bien sur Connecter sur la liseuse)
* Après une grosse minute l'interface de Calibre change pour faire apparaitre l’icône "Appareil"
![Image](/blog/calibre_appareil.jpg){.centered}
* Cliquer le menu de l'icône "Appareil" (le petit v à droite)
* Sélectionner configurer cet appareil
* Dans l'écran de configuration cocher "Set Series information"
![Image](/blog/calibre_kobo_config.jpg){.centered}
* Cliquer sur Ok
* Calibre va vous demander de redémarrer pour valider les modifications. Acceptez.

## Transfert de livre via Calibre

C'est cette partie qui pour l'instant n'est pas encore géniale :

* Une fois la liseuse connectée à Calibre, Sélectionner des livres (avec une série si possible).
* Faire une clic droit sur la sélection et choisir Envoyer au lecteur > Envoyer vers la mémoire du lecteur.
* Attendre que le transfert soir terminé et ejectez proprement la Kobo et déconnectez l'USB.
* La liseuse va analyser les livres ajoutés. 

Sur la liseuse si vous allez sur votre bibliothèque vous devriez voir vos livres ... mais sans série. 
  
Pour que cela fonctionne il faut que vous refassiez la manipulation une seconde fois (connexion USB, transfert, déconnexion).

Cette fois ci, si vous allez dans le menu bibliothèque de la liseuse, vous devriez voir sous le titre la série et l'index du livre dans la série. A noter que le tri prend bien en compte les séries et numéros.

Pour la petite histoire, le transfert doit être fait deux fois car les données de série et d'index doivent être mises à jour dans la base de données et les enregistrements correspondant aux livres ajoutés ne sont créés qu'à partir de l'analyse des données (donc fin de première étape).

## Bilan

Le fait de faire deux fois le boulot n'est pas génial, mais en étant pragmatique les alternatives ne sont pas nombreuses :

* Ne pas lire de livres faisant partie de séries. Mouais.
* Faire modifier à Calibre le titre du libre pour y intégrer la série (voir [Kobo eReader Touch : trucs et astuces d'origine diverse](/blog/kobo-ereader-touch-5)).
* Utiliser les étagères ce qui règle le fait des regrouper mais pas la question de l'ordre.

Personnellement j'aime bien. J'espère que pour la sortie officielle du prochain firmware une solution plus propre sera disponible. 
