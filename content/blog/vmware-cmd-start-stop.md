---
title: "Arrêter / Démarrer une VM VMware en ligne de commande"
date: 2010-10-07
tags: [vmware]
slug: vmware-cmd-start-stop
disqus_identifier: /blog/vmware-cmd-start-stop
---
# Arrêter / Démarrer une VM VMware en ligne de commande

## Ce qui ne marche pas chez moi
Il est censé exister un moyen de la faire via l'application Perl scripting API for Windows (ou la version COM), je n'ai jamais reussi à le faire fonctionner. Pour ceux qui voudrait essayer : http://www.petri.co.il/virtual_script_startup_shutdown_vmware_servers.htm.

## Ce qui marche bien

J'ai trouvé l'inspiration sur ce site http://www.cyberciti.biz/tips/start-stop-vmware-virtualization-vms-command.html. Les exemples suivants sont pour Windows, le même principe est applicable sous Linux

### Arrêt d'une machine virtuelle

```
C:\Program Files\VMware\VMware Server>vmrun -T server -h "url" -u user -p password stop "LienVersLeFichierVMX"
```

### Démarrage d'une machine virtuelle

```
C:\Program Files\VMware\VMware Server>vmrun -T server -h "url" -u user -p password start "LienVersLeFichierVMX"
```

### Explications

* url : https://NomServeur:8333/sdk
* LienVersLeFichierVMX : à trouver dans l'interface Web, en cliquant dans configure VM et reprendre le Virtual Machine Configuration File.





