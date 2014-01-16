/*
Title: COPS 0.4.0
Description: 
Author: Sébastien Lucas
Date: 2013/05/07
Robots: noindex,nofollow
*/
# COPS 0.4.0

Pour cette nouvelle version, des évolutions et quelques corrections de bugs :

*	[Voici COPS : Calibre OPDS PHP Serveur](fr/oss/calibre-opds-php-server)

*	[Liste des changements](fr/oss/calibre-opds-php-server-changelog)

La modification la plus importante est le support de plusieurs bases de données Calibre au sein d'une seule installation de COPS. Il suffit simplement de modifier votre fichier config_local.php de la façon suivante : 

	
	$config['calibre_directory'] = array (
	    "My database name" => "/home/directory/calibre1/", 
	    "My other database name" => "/home/directory/calibre2/");


A noter que si vous effectuez une recherche à la racine du site alors elle se fera sur toutes les bases de données.

J'ai aussi commencé à préparer mes objectifs à long terme (HTML5 et gestion correcte de l’internationalisation). Je remercie aussi tous les contributeurs et aux bêtas testeurs pour leur temps et patience.

Bon test à vous.

PS : Le paquet Synology arrive ...
