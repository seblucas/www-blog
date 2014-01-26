/*
Title: Sauvegarde simple des VMs d'un hôte VMWare ESXi
Description: 
Author: Sébastien Lucas
Date: 2011/05/12
Robots: noindex,nofollow
Language: fr
Tags: perl,vmware
*/
# Sauvegarde simple des VMs d'un hôte VMWare ESXi

## Pourquoi ?
J'ai déployé dernièrement un serveur ESXi (donc la version gratuite de l'hyperviseur ESX de VMWare) et rien n'existe pour faciliter les sauvegardes (ce qui n'est pas le cas de la version payante).

## Alternatives trop complexes pour moi

En cherchant un peu sur la toiles j'ai trouvé plusieurs possibilités :
*	GhettoVCB.sh : http://communities.vmware.com/docs/DOC-8760
*	MKSBackup : http://www.magikmon.com/mksbackup/ghettovcb.en.html
*	backup-vm.bat : http://blog.peacon.co.uk/completely-free-backup-for-esxi/

Au final les deux premiers étaient trop complexes pour moi et le dernier trop spécifique mais avec un beau potentiel.

## Une solution moins puissante mais plus simple

### Principe
J'utilise le composant PERL esxi-control.pl développé [ici](http://blog.peacon.co.uk/esxi-control-pl-script-vm-actions-on-free-licensed-esxi/) (le site officiel semblant mort, une copie est disponible [ici](/blog/esxi-control)) pour communiquer avec le serveur ESXi. A côté de cela j'ai fait des scripts batch Windows pour automatiser mes sauvegardes

### Installation de VMware vSphere CLI Perl

A récupérer ici : http://www.vmware.com/support/developer/vcli/

J'ai pris la version Windows et je n'ai pas testé la version Linux pour le moment.

### Installation des dépendances

La seule dépendance est esxi-control.pl à récupérer [ici](http://blog.peacon.co.uk/wiki/Esxi-control.pl). J'ai choisi la simplicité et j'ai placé ce fichier dans le répertoire C:\Program Files\VMware\VMware vSphere CLI\Perl\bin.

### Scripts de sauvegarde

```
set PERL5LIB=
set esxi_server=XXX.XXX.XXX.XXX
set esxi_username=root
set esxi_password=MyPassword
set esxi_datastore_in=datastore1
set esxi_datastore_out=datastore2

perl.exe esxi-control.pl --server %esxi_server% --username %esxi_username% --password %esxi_password% --action shutdown --vmname %1
REM Waiting for 2 minutes
perl -e "sleep (120);"
perl.exe esxi-control.pl --server %esxi_server% --username %esxi_username% --password %esxi_password% --action delete-file --file "[%esxi_datastore_out%] %1/%1.vmdk"
perl.exe esxi-control.pl --server %esxi_server% --username %esxi_username% --password %esxi_password% --action delete-file --file "[%esxi_datastore_out%] %1/%1.vmx"
perl.exe esxi-control.pl --server %esxi_server% --username %esxi_username% --password %esxi_password% --action delete-file --file "[%esxi_datastore_out%] %1/%1.vmxf"
perl.exe esxi-control.pl --server %esxi_server% --username %esxi_username% --password %esxi_password% --action copy-file --sourcefile "[%esxi_datastore_in%] %1/%1.vmdk" --destfile "[%esxi_datastore_out%] %1/%1.vmdk"
perl.exe esxi-control.pl --server %esxi_server% --username %esxi_username% --password %esxi_password% --action copy-file --sourcefile "[%esxi_datastore_in%] %1/%1.vmx" --destfile "[%esxi_datastore_out%] %1/%1.vmx"
perl.exe esxi-control.pl --server %esxi_server% --username %esxi_username% --password %esxi_password% --action copy-file --sourcefile "[%esxi_datastore_in%] %1/%1.vmxf" --destfile "[%esxi_datastore_out%] %1/%1.vmxf"
perl.exe esxi-control.pl --server %esxi_server% --username %esxi_username% --password %esxi_password% --action poweron --vmname %1
```
Quelques explications :
*	Ce script est à installer dans C:\Program Files\VMware\VMware vSphere CLI\Perl\bin. 
*	set PERL5LIB= : la machine windows avait déjà un Perl installé par Oracle et la variable d'environnement bloquait l’exécution.
*	esxi_server : Adresse IP du serveur ESXi
*	esxi_username : Nom de l'utilisateur ayant accès au serveur ESXi
*	esxi_password : ... devinez !
*	esxi_datastore_in : Datastore dans lequel sont stockées les machines virtuelles.
*	esxi_datastore_out : Datastore dans lequel stocker les sauvegardes (dans mon cas un partage NFS sur un NAS).
*	La paramètre donné à ce script doit être le nom de la VM à sauvegarder.

ATTENTION :
*	Il faut créer les répertoire sur le datastore de sauvegarde (esxi_datastore_out), le script ne les crée pas.
*	Les machines sont arrêtées avant sauvegarde et redémarrées après.
*	Il y a une attente de 2 minutes après la demande d'arrêt, cela peut être limite pour certains Windows.

Il est possible d'adapter le script pour éviter d'arrêter les machines en lançant un snapshot avant de faire les sauvegardes et libérer ce snapshot à la fin. Personnellement ça ne m'intéressait pas (je fais une sauvegarde complète en ayant planifié un reboot par mois).

### Script à ajouter aux tâches planifiées

```
for %%X in (vm1 vm2 vm3 vm4) do (saveOneVM.cmd %%X)
```





