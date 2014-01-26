/*
Title: URL propres avec Dokuwiki
Description: 
Author: Sébastien Lucas
Date: 2010/09/29
Robots: noindex,nofollow
Language: fr
Tags: dokuwiki,nginx
*/
# URL propres avec Dokuwiki

## Cas général
### Liens

*	Dokuwiki et les moteurs de recherche : http://www.dokuwiki.org/fr:seo
*	Dokuwiki et le mode rewrite (en anglais) : http://www.dokuwiki.org/rewrite
### Installation

J'ai donc suivi le lien sur le rewrite pour modifier dokuwiki :
*	userewrite = 1
*	useslash = 1
J'ai ensuite modifié ma configuration nginx en conséquence (comme indiqué dans le lien) :
```
        root   /var/www/xxx;
        index doku.php;

        location / {
                try_files $uri $uri/ @dokuwiki;
        }

        location @dokuwiki {
                rewrite ^/_media/(.*) /lib/exe/fetch.php?media=$1 last;
                rewrite ^/_detail/(.*) /lib/exe/detail.php?media=$1 last;
                rewrite ^/_export/([^/]+)/(.*) /doku.php?do=export_$1&id=$2 last;
                rewrite ^/(.*) /doku.php?id=$1&$args last;
        }


        location ~ \.php$ {
                include /etc/nginx/fastcgi_params;
                fastcgi_param   SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                fastcgi_pass    127.0.0.1:9000;
        }
```
### Bilan

Ca marche bien .... sauf pour les tags qui restent avec des urls longues comme le bras.
## Les tags

J'ai cherché un petit peu et j'ai juste trouvé un post sur une mailing list correspondant exactement à mon problème : http://www.freelists.org/post/dokuwiki/PATCH-Clean-URLs-for-tags-and-blogarchive .
J'ai donc bêtement appliqué son patch et tout a fonctionné du premier coup. Il restait juste à ajouter une règle dans la configuration nginx :
```
        location @dokuwiki {
                rewrite ^/_media/(.*) /lib/exe/fetch.php?media=$1 last;
                rewrite ^/_detail/(.*) /lib/exe/detail.php?media=$1 last;
                rewrite ^/_export/([^/]+)/(.*) /doku.php?do=export_$1&id=$2 last;
                rewrite ^/tag/(.*) /doku.php?id=tag:$1&do=showtag&tag=tag:$1 last;
                rewrite ^/(.*) /doku.php?id=$1&$args last;
        }
```
Si besoin, le patch pour le plugin tag est en dessous :
```-
diff -Naur -x '*.dat' dokuwiki/lib/plugins/tag/action.php slucas-wiki/lib/plugins/tag/action.php
--- dokuwiki/lib/plugins/tag/action.php 2009-04-27 19:56:32.000000000 +0000
+++ slucas-wiki/lib/plugins/tag/action.php      2010-09-27 20:03:39.000000000 +0000
@@ -78,6 +78,7 @@
     }

     function _handle_tpl_act(&$event, $param) {
+        global $ID;
         global $lang;

         if($event->data != 'showtag') return;
@@ -86,7 +87,7 @@
         $tagns = $this->getConf('namespace');
         $flags = explode(',', trim($this->getConf('pagelist_flags')));

-        $tag   = trim(str_replace($this->getConf('namespace').':', '', $_REQUEST['tag']));
+        $tag   = trim(str_replace($this->getConf('namespace').':', '', $ID));
         $ns    = trim($_REQUEST['ns']);

         if ($helper =& plugin_load('helper', 'tag')) $pages = $helper->getTopic($ns, '', $tag);
diff -Naur -x '*.dat' dokuwiki/lib/plugins/tag/helper.php slucas-wiki/lib/plugins/tag/helper.php
--- dokuwiki/lib/plugins/tag/helper.php 2009-05-11 13:45:14.000000000 +0000
+++ slucas-wiki/lib/plugins/tag/helper.php      2010-09-27 20:15:34.000000000 +0000
@@ -134,7 +134,8 @@
                 }
             } else {
                 $class = 'wikilink1';
-                $url   = wl($tag, array('do'=>'showtag', 'tag'=>$tag));
+                if ($conf['userewrite'] == 1) $url = wl($tag);
+                else $url   = wl($tag, array('do'=>'showtag', 'tag'=>$tag));
             }
             $links[] = '<a href="'.$url.'" class="'.$class.'" title="'.hsc($tag).
                 '" rel="tag">'.hsc($title).'</a>';
@@ -232,6 +233,7 @@
             if (!(($tag{0} == '+') || ($tag{0} == '-'))) continue;
             $cleaned_tag = substr($tag, 1);
             $tagpages = $this->topic_idx[$cleaned_tag];
+            if (!$tagpages) $tagpages = array();
             $and = ($tag{0} == '+');
             foreach ($pages as $key => $page) {
                 $cond = in_array($page['id'], $tagpages);

```
## Le plugin cloud

Ce plugin (http://www.dokuwiki.org/plugin:cloud) n'était pas non plus adapté aux url propres dans les nuages de tags qu'il génère, je l'ai donc modifié de la même manière que le plugin tag.
```-
diff -Naur -x '*.dat' dokuwiki/lib/plugins/cloud/syntax.php slucas-wiki/lib/plugins/cloud/syntax.php
--- dokuwiki/lib/plugins/cloud/syntax.php       2010-09-03 09:50:16.000000000 +0000
+++ slucas-wiki/lib/plugins/cloud/syntax.php    2010-09-28 11:53:52.000000000 +0000
@@ -102,7 +102,8 @@
                             $name = $word;
                         }
                     } else {
-                        $link = wl($id, array('do'=>'showtag', 'tag'=>$word));
+                        if ($conf['userewrite'] == 1) $link = wl($id);
+                        else $link = wl($id, array('do'=>'showtag', 'tag'=>$word));
                     }
                     $title = $word;
                     $class .= ($exists ? '_tag1' : '_tag2');
```






