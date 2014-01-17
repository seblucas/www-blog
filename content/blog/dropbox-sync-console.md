/*
Title: Récupérer des répertoires Dropbox en console
Description: 
Author: Sébastien Lucas
Date: 2012/01/24
Robots: noindex,nofollow
*/
# Récupérer des répertoires Dropbox en console

## Pourquoi ?
Je veux profiter du serveur 1and1 pour héberger quelques petit sites et autres données privées (photos, musique, ...) et j'ai trouvé que Dropbox était pas mal fait pour ce genre de chose (j'ai pris l'habitude de crypter le contenu de mon dropbox). Le seul point problématique restait l'absence d'interface graphique, heureusement je suis tombé sur ce site : 

http://ubuntuservergui.com/ubuntu-server-guide/install-dropbox-ubuntu-server


## Installation

### Création d'un compte

	
	adduser dropbox
	su - dropbox

### Téléchargement

*	Version 32 bits :

	
	wget -O dropbox.tar.gz "http://www.dropbox.com/download/?plat=lnx.x86"


*	Version 64 bits : 

	
	wget -O dropbox.tar.gz "http://www.dropbox.com/download/?plat=lnx.x86_64"

### Vérification

Il faut bien vérifier que la variable d'environnement LANG est bien spécifiée :

	
	printenv LANG

Dans le cas ou la variable n'existe pas, il faut exécuter (en root) : 

	
	aptitude install locales
	dpkg-reconfigure locales

### Installation

	
	tar -xzvf dropbox.tar.gz
	~/.dropbox-dist/dropboxd


Il faut ensuite copier l'URL affichée dans la console et la mettre dans votre meilleur navigateur et vous connecter à votre compte. Il est possible de quitter avec CTRL+C le programme dropboxd.
### Synchronisation

La synchronisation manuelle se passe facilement : 

	
	~/.dropbox-dist/dropbox


Le plus propre est de faire un fichier init.d (je l'ajouterai plus tard).
### Gestion avancée

Il est possible de faire une gestion plus fine (exclure des répertoire, vérifier le statut, ...) avec un programme python :

	
	wget -O ~/.dropbox/dropbox.py "http://www.dropbox.com/download?dl=packages/dropbox.py"
	chmod +x ~/.dropbox/dropbox.py


La documentation est la suivante : 

	
	~/.dropbox/dropbox.py help
	 
	Note: use dropbox help <command> to view usage for a specific command.
	 
	 status       get current status of the dropboxd
	 help         provide help
	 puburl       get public url of a file in your dropbox
	 stop         stop dropboxd
	 running      return whether dropbox is running
	 start        start dropboxd
	 filestatus   get current sync status of one or more files
	 ls           list directory contents with current sync status
	 autostart    automatically start dropbox at login
	 exclude      ignores/excludes a directory from syncing

