/*
Title: Comment créer un fichier epub avec Word et Calibre
Description: 
Author: Sébastien Lucas
Date: 2012/01/03
Robots: noindex,nofollow
*/
# Comment créer un fichier epub avec Word et Calibre

## Pourquoi ?
Dans un [billet d'Actualitté](http://www.actualitte.com/actualite/monde-edition/international/george-r-r-martin-offre-des-extraits-du-t6-de-la-saga-trone-de-fer-30904.htm), j'ai vu que George R. R. Martin avait mis en ligne un futur chapitre de volume 6 de la série de Trône de fer (A song of ice and fire en VO). Comme je suis un vrai fan je me suis précipité pour trouver une page avec le texte certes mais surtout un choix de couleur de fond discutable...

Je me suis donc dit : pourquoi ne pas transformer le texte en un vrai epub pour le lire calmement sur ma liseuse.

## Des essais infructueux

###  Convertisseur online 
Sur le papier ce site a l'air pas mal : http://ebook.online-convert.com/convert-to-epub.

En pratique l'epub est correct mais il a trop de style à mon gout.
## Un copier coller dans Sigil

J'ai aussi télécharger [Sigil](http://code.google.com/p/sigil/) qui est éditeur WYSIWYG d'ebook. Je dois être très con mais l'utilisation ne m'a pas paru évidente et je n'ai pas eu le courage d'aller plus loin. 

Peut être pour une autre fois.
## Du potentiel

### Merci ebooksgratuits.com
Au final je suis tombé sur un [tutoriel](http://www.ebooksgratuits.com/guides/methode_a_z_pour_creer_un_ebook.htm) comme je les aime. Il utilise un outil propriétaire (Word) mais il m'a semblé très simple.
### Etape 1 : on récupère le modèle (.dot)

http://www.ebooksgratuits.com/guides/epub_tuto.zip
### Etape 2 : on créé un nouveau document (vide) basé sur ce modèle

Je n'ai pas installé le fichier dot (pour tout avouer je ne sais plus comment ça fonctionne). J'ai donc simplement fait un clic droit sur le fichier epub_tuto.dot et cliqué sur Nouveau.

Word s'est ouvert avec un nouveau document vide. J'ai activé les macros (utile pour la suite)
### Etape 3 : Copier / Coller

Je suis allé sur le site de GRRM et fait un simple copier coller du texte du chapitre vers le document Word.

A noter que cela perd une partie de la mise en forme (notamment l'italique). Je m'en occuperai plus tard.
### Etape 4 : Application du style

J'ai tout sélectionné et appliqué le style Normal.
### Etape 5 : Macro magique Typo

La macro Typo va corriger plein de petites choses magiquement (Les espaces de début/fin de lignes ont disparut, le texte est mieux justifié, ...)

A noter que cette macro n'est pas adaptée à l'anglais elle m'a changé des "oe" en "œ".
### Etape 6 : J'ajoute le titre du chapitre

Dans mon cas le titre du chapitre est "Theon" et c'est une image dans la page Web d'origine. Je l'ai donc ajouté et lui ai donné le style Titre 1.

A la fin de cette étape de fichier Word est prêt.
### Etape 7 : Sauvegarde en HTML filtré

Comme le titre l'indique on va sauvegarder le fichier Word en HTML filtré (très important).
### Etape 8 : Import du HTML dans Calibre

Un simple glisser/déposer permet d'importer le fichier dans Calibre
### Fin : Transformation en epub

*	Lancer Calibre

*	Faire un click droit sur le HTML que vous avez importé (il est reconnu comme un zip) et faire Convertir les livres -> Convertir individuellement.

*	Dans "Metadonnées" vous pouvez renseigner le titre, l'auteur, la série, la couverture, etc.

*	Dans "Détection de la structure" il faut :
    * Changer la marque de chapitre pour la mettre à none
    * Enlever le contenu de la zone "Insérer un saut de page avant"

*	Dans "Table des matières" il faut :
    * Changer le niveau 1 TDM en : //h:h1
    * Changer le niveau 2 TDM en : //h:h2

*	Cliquer sur le bouton OK

Ça a suffit pour moi. J'ai pu lire l'epub confortablement sur ma liseuse. Je ne le met pas à disposition car c'est expressément interdit dans le blabla légal du blog de GRRM mais c'est très simple à faire.



