/*
Title: Installer un serveur Subversion sur un NAS Synology
Description: 
Author: Sébastien Lucas
Date: 2010/10/15
Robots: noindex,nofollow
Language: fr
Tags: subversion,synology
*/
# Installer un serveur Subversion sur un NAS Synology

## Pourquoi ce NAS
Il y a pas mal de concurrence dans le domaine des NAS, j'ai choisi la marque Synology parce qu'il est accessible par SSH/telnet et donc modifiable assez simplement.
## Installation de ipkg

[ipkg](http://fr.wikipedia.org/wiki/Special:Search?search=ipkg) est grosso modo un équivalent de apt-get/aptitude. Sur mon DS210j il s'installe comme cela (attention l'archive à télécharger dépends de votre NAS) : 

*	Activer la connexion SSH dans la console d'administration

*	Se connecter en SSH

*	Executer ces commandes :
```bash
wget http://ipkg.nslu2-linux.org/feeds/optware/cs08q1armel/cross/unstable/syno-mvkw-bootstrap_1.2-7_arm.xsh
chmod +x ./syno-mvkw-bootstrap_1.2-7_arm.xsh
./syno-mvkw-bootstrap_1.2-7_arm.xsh
rm ./syno-mvkw-bootstrap_1.2-7_arm.xsh
ipkg update
```
Pour être sur d'installer la bonne version correspondant à votre NAS voir [ici](http://forum.synology.com/wiki/index.php/Overview_on_modifying_the_Synology_Server,_bootstrap,_ipkg_etc#How_to_install_ipkg)

## Installation de subversion

```
ipkg update
ipkg install subversion
```
## Paramétrage sur svn+ssh

### Attention
Une mise à jour de firmware Synology risque de supprimer l'ensemble des bidouilles ci dessous (les dépôt vont bien sur rester).
### Pourquoi svn+ssh

La méthode la plus documentée consiste à utiliser svnserve en démon : http://forum.synology.com/wiki/index.php/Step-by-step_guide_to_installing_Subversion. Je n'aime pas trop cette méthode :

*	elle oblige une configuration "complexe" de svnserve pour chaque dépôt. Il faut en effet modifier les fichiers passwd et svnserve.conf de chaque dépôt (et comme j'en ai une bonne dizaine mon côté fainéant m'a poussé à trouver une solution). 

*	elle est très intrusive sur le système Synology (fichier services et inetd à modifier)

*	Pas très sécurisée

En plus, je voulais éventuellement pouvoir accéder à mes dépôts subversion via internet donc je me suis dirigé sur svn+ssh avec l'utilisation d'une clé pour automatiser tout ça. 

J'ai trouvé un début de tutoriel ici : http://forum.synology.com/enu/viewtopic.php?f=3&t=9753.
### Console d'administration Synology

*	Créer un utilisateur (j'ai choisi svn)

*	Créer un nouveau partage (j'ai aussi choisi svn)
### Bidouillage pour autoriser la connexion en ssh de l'utilisateur svn

Par défaut seul root a le droit de se connecter en ssh, il va donc falloir ruser :

*	On crée un répertoire home pour svn :
```
mkdir /user
mkdir /user/svn
chown svn.root /user/svn
```

*	On modifie le /etc/passwd pour ajouter le répertoire home et le shell à notre utilisateur svn :
```
svn:x:<Number>:<Group>:Subversion user:/user/svn:/bin/ash
```
Vous pouvez vous connecter avec l'utilisateur svn
### Préparation de la connexion svn+ssh

Le principe d'une connexion svn+ssh est bien sur de lancer une connexion ssh et ensuite via celle ci de lancer svnserve avec certains paramètres. Comme je savais ce que je voulais, j'ai utilisé une méthode de sioux : lors d'une connexion par svn+ssh le profile n'est pas exécuté donc /opt/bin (lieu ou sont stockés les éléments installés via ipkg) n'est pas dans le path. J'ai donc créé un petit script dans /usr/bin :
```bash
#!/bin/ash

/opt/bin/svnserve -r /volume1 $@
```
Quelques explications : 

*	le -r /volume1 est pour préciser la racine virtuelle (pour alléger les url des dépôts)

*	le $@ permet de passer l'ensemble des paramètres de l'appelant

*	ce fichier est à rendre exécutable (chmod +x)

*	la documentation de svnserve : http://svnbook.red-bean.com/nightly/fr/svn.ref.svnserve.html#svn.ref.svnserve.sw
 
Pour faire plus simple il est aussi possible de faire un lien symbolique directement sur /opt/bin/svnserve.
### Test

#### Création d'un dépôt
Se connecter en svn
```
cd /volume1/svn
svnadmin create test
```
#### Checkout

Sur une autre machine (windows ou Linux), faire un checkout de la façon suivante : 
```
svn co svn+ssh://svn@AdresseIpDuNas/svn/test
```
Une fois le mot de passe saisi tout doit fonctionner correctement.

Si le choix du lien symbolique a été fait il faut remplacer l'url par la suivante : 
```
svn co svn+ssh://svn@AdresseIpDuNas/volume1/svn/test
```
### Ajout de clé privée/publique pour se faciliter la vie

A compléter

