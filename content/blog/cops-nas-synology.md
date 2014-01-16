/*
Title: COPS sur un NAS Synology
Description: 
Author: Sébastien Lucas
Date: 2012/10/21
Robots: noindex,nofollow
*/
# COPS sur un NAS Synology

J'ai enfin passé un peu de temps pour m'assurer que COPS fonctionne correctement sur un NAS Synology. C'est chose faite et ... tout fonctionne. Pour information, toutes ces manipulations ont été faites sur le DSM 4.1-2647.

## Préparation du NAS

*	Allez à la page "Menu principal > Panneau de configuration > Services Web > Applications Web" sur l'interface de gestion utilisateur, et cochez Activer Web Station

*	Un nouveau partage "web" est créé. Vous devrez peut être adapter les droits d'accès sur ce répertoire.

*	Créer un répertoire "cops".

*	Déposer dans ce répertoire le contenu du zip de la dernière version de COPS.

*	Faire un copier coller de "config_default.php" en "config_local.php"

## Base Calibre dans le répertoire Web

### Principe
Sur le principe, cette méthode est moins sécurisée dans le sens ou toutes les personnes qui ont accès au NAS peuvent télécharger la base de données Calibre (et les livres). Ensuite si votre NAS n'est disponible que chez vous, cela ne change pas grand chose.

Pour la suite je vais considérer que la base Calibre (metadata.db et tous les répertoires) est dans %%\\VotreNas\web\cops\Data\metadata.db%% et que vous avez tout bien copié.
### Modification de la configuration de COPS

Dans ce cas il n'y qu'à modifier les clés suivantes de config_local.php :

	
	$config['calibre_directory'] = './Data/';
	$config['calibre_internal_directory'] = './Data/';


Et tout fonctionne !
## Base Calibre en dehors du répertoire Web

### Principe
Cette configuration est utile si votre bibliothèque Calibre est déjà sur votre NAS (ou que vous voulez mieux la sécuriser).

Dans mon cas ma bibliothèque de test est dans le répertoire "feedbook" dans le partage "logiciel" ce qui correspond au chemin interne "/volume1/logiciel/feedbook".
### Paramétrage de PHP

il faut indiquer au moteur PHP qu'il a le droit d'aller lire dans le répertoire contenant la bibliothèque :

*	Allez à la page "Menu principal > Panneau de configuration > Services Web > Applications Web"

*	Deuxième onglet > Personnaliser PHP open_base_dir 

*	Ajouter à la fin :

	
	:/volume1/logiciel/feedbook/

### Modification de la configuration de COPS

Changer les clés suivantes dans config_local.php :

	
	$config['calibre_directory'] = '/volume1/logiciel/feedbook/';
	$config['calibre_internal_directory'] = '/volume1/logiciel/feedbook/'; 
	$config['cops_x_accel_redirect'] = "X-Sendfile";


Et tout fonctionne toujours !
## Tenté par l'expérience ?

Si vous avez testé, merci de me confirmer ou non le succès de l'opération dans les commentaires.
