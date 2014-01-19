/*
Title: COPS : version alpha avec support des navigateurs de nos liseuses
Description: 
Author: Sébastien Lucas
Date: 2012/04/18
Robots: noindex,nofollow
Language: fr
*/
# COPS : version alpha avec support des navigateurs de nos liseuses

## COPS ?
Il y a quelque temps, j'ai rendu public un projet que j'utilise chez moi depuis l'an dernier (voir [Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)). Ce programme PHP permet d'avoir un catalogue OPDS à partir d'une bibliothèque Calibre. J'ai aussi parlé de mon envie de faire une application web sur le même principe avec la contrainte d'être utilisable sur les navigateurs de nos liseuses. 

Voila, j'ai une version qui commence à bien marcher, Youpi! 

## Ou ... Ou ;)

L'URL de test est la suivante : http://goo.gl/0nUPM (j'ai pensé à vous et j'ai généré une URL courte).

Vous pouvez y accéder à partir de :

*	votre ordinateur (testé sur Firefox)

*	votre tablette (testé sur Chrome / ICS)

*	votre smartphone (testé sur la navigateur par défaut de Galaxy S)

*	votre liseuse (testé sur Kobo uniquement)

Le rendu devrait être à chaque fois très similaire.

Attention : 

*	le design est volontairement très (peut être trop) sobre pour rester lisible sur un écran e-ink.

*	J'ai encore de bons yeux mais je sais que le texte en italique est un peu petit.
## Ce qui marche

*	La navigation générale (un clic / doigt sur une section permet d'avoir le détail)

*	Le retour à l'accueil (via l’icône de maison en haut)

*	La visualisation des couverture de livre (en miniature)

*	Le téléchargement (attention il faut être patient sur la Kobo avant de voir la fenêtre de confirmation du téléchargement)
## Ce qui ne marche pas (encore)

*	La recherche ne fonctionne pas pour le moment.

*	Je n'ai pas encore ajouté une fiche avec le détail d'un livre (pour avoir le résumé ou d'autres informations)

*	Pas de support du français (je sais c'est une honte)

*	J'ai à chaque fois un redémarrage de la Kobo quand je quitte le navigateur (bouton Home), je pense que je suis maudit. Par contre la navigation fonctionne bien.
## Ce qui doit être amélioré

*	La vitesse notamment sur le Kobo, je me suis lâché sur le CSS3 et c'est peut être une mauvaise idée.

*	La gestion des miniatures pour éviter l'affichage un peu lent des couvertures

*	Les tailles des polices de caractères pour être un peu plus lisible
## Ou le télécharger ?

Nulle part pour le moment, je le garde bien au chaud tant qu'il n'est pas un peu plus avancé. Je vais profiter de quelques jours de vacance pour me reposer et je reprendrai le développement d'arrache-pied en mai en intégrant d'autres idées (les vôtres peut être ?).

Si le retour est bon, j'ajouterai certainement un forum pour pouvoir en discuter. En attendant bon test à vous !
