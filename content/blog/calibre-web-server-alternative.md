/*
Title: Alternative au serveur de contenu de Calibre
Description: 
Author: Sébastien Lucas
Date: 2013/01/07
Robots: noindex,nofollow
Language: fr
*/
# Alternative au serveur de contenu de Calibre

## Pourquoi ?
Comme vous le savez peut être Calibre contient un serveur HTTP qui permet de partager simplement l'ensemble de sa bibliothèque via des pages Web assez bien faite. Ce serveur se lance en cliquant sur le bouton "Connecter / Partager" et ensuite "Démarrer le serveur de contenu". Le serveur est ensuite accessible par défaut sur le port 8080 (http://127.0.0.1:8080/).

Je vois quelques défauts à Calibre et ce serveur :

*	La version Linux de Calibre a beaucoup de dépendances et même pour le paquet calibre-server il faut pas mal de bibliothèques graphiques

*	Étant donné que Calibre n'est pas un outil client-serveur la base de données ne peut pas facilement se déporter sur un serveur indépendant.

*	Pour moi Calibre est une application graphique qui a sa place sur mon ordinateur portable et pas sur mon serveur. Alors qu'un service Web doit tourner 24h/24 et doit donc être sur un serveur.

*	La solution de passer Calibre2Opds (qui fait aussi des pages Web classiques) ne me tentait pas vu qu'il faut régulièrement relancer le traitement pour avoir un site à jour et qu'il n'y a pas de possibilité de recherche dynamique.

Malgré tous ces défauts j'aime suffisamment Calibre pour le conserver comme outil de gestion de bibliothèque par contre j'aimerai que le contenu de ma bibliothèque soit accessible de partout à n'importe quel moment.

## Dropbox

Comme je l'ai déjà dit Calibre est installé sur mon ordinateur portable (sous Windows 7) alors que mon serveur est hébergé (et sous Debian).

Pour partager facile les données j'ai choisi de placer mon répertoire de travail de Calibre dans Dropbox ce qui fait qu'à chaque ajout ou modification d'un livre les données sont automatiquement synchronisée dans le Cloud. J'avais pensé passer un serveur Owncloud mais pour l'instant le volet de synchronisation n'existe on accède direction à un partage Webdav.
## Configuration du Dropbox sur le Linux

Voir [Récupérer des répertoires Dropbox en console](/blog/dropbox-sync-console).
## Installation de Calibre PHP Server

### Qui
Une personne sur Mobileread (encore et toujours) a mis à disposition un serveur PHP tout simple permettant un accès complet à sa bibliothèque Calibre. Les liens sont les suivants : 

*	[Discussion sur le forum MobileRead](http://www.mobileread.com/forums/showthread.php?p=1966227) 

*	http://charles.the-haleys.org/calibre/

### Dépendances

Mon serveur a déjà une base pour gérer le PHP (avec Nginx), les seules dépendances étaient :
```
aptitude install php5-gd smarty php5-sqlite
```

Ne pas oublier de redémarrer le fastcgi PHP après ces installations.

### Paramétrage lié à smarty

Le serveur a besoin de smarty et d'un répertoire de travail pour smarty, j'ai choisi de tout stocker sur /tmp
```bash
cd /tmp/
mkdir smarty
cd smarty/
mkdir smarty_cache
mkdir smarty_templates_c
cd ..
chown www-data:www-data -R smarty/
```
### Installation du serveur

Simple :
```bash
su -
cd /var/www
wget http://charles.the-haleys.org/calibre/calibre_php_server-V0.2.8.zip
unzip calibre_php_server-V0.2.8.zip
mv  calibre_php_server-V0.2.8/ ebook
cd ebook
cp config_default.php config_local.php
vi config_local.php
```

Dans mon cas le fichier de config est le suivant :
```
<?php
        /*
                Name:            Calibre PHP webserver
                license:         GPL v3
                copyright:       2010, Charles Haley
                         http://charles.haleys.org

        */

        $config = array();

        /*

         * The title that appears at the top of every page in the default template
         */
        $config['page_title'] = 'Mes livres';

        /*

         * The directory containing calibre's metadata.db file, with sub-directories
         * containing all the formats.
         */
        $config['library_dir'] = '/var/calibre/Dropbox/Calibre';

        /*

         * The directory containing the PHP code.
         */
        $config['web_dir'] = '.';

        /*

         * The directory in web space where smarty will find the templates.
         */
        $config['smarty_web_dir'] = $config['web_dir'] . '/smarty';

        /*

         * The directory where smarty is to store its caches and the like. The web
         * server must have write access here.
         */
        $config['smarty_dir'] = '/tmp/smarty';

        /*

         * The directory containing the Smarty PHP files, and in particular the file
         * Smarty.class.php.
         */
        $config['smarty'] = '/usr/share/php/smarty/libs';

        /*

         * The maximum width of a cover. A cover's aspect ratio is preserved, so
         * one of width or height will win.
         */
        $config['cover_max_width'] = 100;
        $config['cover_max_height'] = 100;

        /*

         * The maximum number of books appearing on a page.
         */
        $config['books_page_count'] = 20;

        /*

         * The format of the publication date. Use the same format strings as
         * calibre's GUI.
         */
        $config['pubdate_format'] = 'dd-MMM-yyyy';

        /*

         * The format of the timestamp, which is called 'date' in calibre.
         */
        $config['timestamp_format'] = 'dd-MMM-yyyy';

        /*

         * The list of fields, custom or otherwise, to display in the information
         * column of a book and in the categories pages. An entry of '*' means
         * all fields. A value of '' means no fields. A value of
         *              array('foo', 'bar', 'pubdate')
         * means the three fields named. The items in this list must be lowercase.
         */
        $config['fields_to_display'] = '*';

        /*

         * The list of fields, custom or otherwise, not to display in the information
         * column of a book and in the categories pages. Entries as in
         * 'fields_to_display'. The 'not_to_display' filter is applied first.
         */
        $config['fields_not_to_display'] = '';

        /*

         * Use the short form books display. If true, then the fields displayed
         * on the books display will be limited to XXX, the length of the comment
         * will be limited to the value of YYY, and a URL will be added to get
         * the full details
         */
        $config['use_short_form'] = false;
        $config['fields_in_short_form'] = array('title', 'authors', 'series', 'tags');
        $config['short_form_comments_length'] = 500;

        /*

         * Automatically make the following fields into URLS. Has the same syntax
         * as fields_to_display. To make no fields into URLS, use
         * $config['fields_to_make_urls'] = array();
         */
        $config['fields_to_make_urls'] = '*';

        /*

         * A search that books must match to be displayed. This is a restriction
         * in calibre terms. If the restriction is a string, then it is applied to
         * all accesses. If it is an array, then the keys are usernames, and the
         * appropriate restriction is applied based on the user. In this case, the
         * user key '*' is the default. Example:
         * $config['restrict_display_to'] = array('bill'=>'series:1632', '*'=>'');
         * which says that bill can see only the books in the 1632 series, while
         * everyone else has no restrictions.
         */
        $config['restrict_display_to'] = '';

        /*

         * Restrict showing links to formats. This is an array of booleans similar
         * to restrict_display_to. Links are enabled when the value is true.
         * $config['enable_format_download'] = true;
         * Set the array per-user to enable or disable the links on that basis.
         * $config['enable_format_download'] = array('bill'=>true, '*'=>false);
         * If the value is an array and the user is not and '*' is not, then the
         * result is 'true' -- links to formats are enabled.
         */
        $config['enable_format_download'] = true;

        /*

         * Use built-in authentication. The format of the password file is the one
         * generated by apache's htpasswd: username:password. Be sure that you
         * use an encryption that your installation of PHP supports. Don't put your
         * password file into web_dir
         */
        $config['use_internal_login'] = false;
        $config['password_file'] = 'some path goes here';

        /*

         * Default initial sort. Set the field to the field name (see these in
         * the sort dialog box) and the direction to 'ascending' or 'descending'.
         * Be sure to use the exact spelling for the field as found in the sort box,
         * including case.
         */
        $config['initial_sort_field'] = 'Title';
        $config['initial_sort_direction'] = 'ascending';
?>
```
### Configuration de Nginx

Mon fichier de configuration Nginx :
```
server {

        listen [::]:80;

        server_name xxx.mydomain.com;

        access_log  /var/log/nginx/ebook.access.log;
        error_log /var/log/nginx/ebook.error.log;
        root   /var/www/ebook;
        index index.php;

        location ~ \.php$ {
               include /etc/nginx/fastcgi_params;
               fastcgi_split_path_info ^(.+\.php)(/.*)$;
               fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
               fastcgi_param  PATH_INFO        $fastcgi_path_info;
               fastcgi_pass    unix:/tmp/fcgi.sock;
        }
}
```
### Ça marche

Je vous encourage à lire le README du serveur PHP Calibre pour le reste de la configuration.
### Quelques adaptations

J'ai commencé à faire quelques adaptations sur le template pour le transformer en xhtml et le rendre valide.

Mon but ultime est de modifier le template pour que le rendu soit optimisé pour la Kobo :

*	adapté à sa faible résolution.

*	adapté au noir et blanc.

*	adapté à l'imprécision du tactile IR et donc avec des zones cliquables assez grandes.

N'hésitez pas à me contacter si vous voulez m'aider sur ce projet.

La version xhtml est téléchargeable ci-dessous :
{{:blog:calibre-php-server-xhtml.zip|}}
## Au final

Ce serveur ne me correspond pas totalement, j'ai donc développé [COPS](/fr/oss/calibre-opds-php-server).
