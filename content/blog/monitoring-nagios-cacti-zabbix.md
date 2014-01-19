/*
Title: Une solution de monitoring assez simple : Zabbix
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
Language: fr
*/
# Une solution de monitoring assez simple : Zabbix

## Pourquoi ?
Suite à la mise en ligne de nouveaux services hébergés, j'ai eu besoin d'une solution de monitoring de serveur. Mes besoins étaient limités dans le sens ou :

*	je n'ai que 3 serveurs hébergés à contrôler,

*	j'ai une petite dizaine de machines virtuelles en local que je peux suivre (l'occasion fait le larron),

*	Peu de besoin de contrôle très fréquent (par exemple regarder le CPU toutes les 10s ou autre) vu que les machines sont très largement surdimensionnées.

*	Besoin fort de contrôler l'état de services Windows et démons Linux et de vérifier l'état de certains ports TCP.
## Les challengers

Avec les limites précédentes en tête j'ai regardé les possibilités et j'ai trouvé les challengers suivants :

*	[Nagios](http://www.nagios.org/)

*	[Cacti](http://www.cacti.net/)

*	[Zabbix](http://www.zabbix.com/)

*	Une solution maison.
## And the winner is ...

Je ne vais pas rentrer dans le détail de mon cheminement mais au final Nagios et Cacti m'ont semblé trop complexes et trop lourd pour mon cas, et Zabbix au contraire m'a bien plu (totalement subjectif). J'ai notamment bien aimé la simplicité d'installation des agents à mettre sur les serveurs à monitorer (anglicisme quand tu nous tiens).

Il y a une vrai distinction entre les :

*	Elements : qui sont le résultat de mesures executés à une fréquence paramétrable.

*	Déclencheurs : qui permettent de déclencher des alertes (de niveau paramétrable) si un élément dépasse un seuil (ceci n'est qu'un exemple, il y a toute une série de formules utilisables).

*	Graphiques

*	Actions : Qui en fonction des déclencheurs, de l'heure et du niveau d'alerte permettent de prévenir les administrateurs (via un email, jabber, sms, ...)

L'installation s'est passée sans problème avec une Squeeze 64bits en utilisant une base MySql. J'ai utilisé le tutoriel suivant pour installer Zabbix 1.8.5 : http://sourcode.net/zabbix-1-9-3-on-debian-squeeze/. Attention par contre en faisant des copier de ligne de commandes depuis le tutoriel, j'ai du en retaper une partie il y avait des caractères bizarres à la place des espaces.

Prochaine étape : mettre en place un monitoring de la base Oracle de production.

Liens utiles : 

*	http://wiki.monitoring-fr.org/zabbix/start

*	http://www.packtpub.com/article/triggers-in-zabbix-1.8






