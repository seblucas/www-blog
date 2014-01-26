/*
Title: Mes modifications sur le template mnml-blog
Description: 
Author: Sébastien Lucas
Date: 2011/09/18
Robots: noindex,nofollow
Language: fr
Tags: dokuwiki
*/
# Mes modifications sur le template mnml-blog

## Rappel
Comme dit dans mon précédent billet, je viens de passer sur le template [mnml-blog](http://www.dokuwiki.org/template:mnml-blog). J'ai fait quelques modifications légères soit purement graphiques soit pour mieux intégrer des plugins.

En voici le détail.

## Modifications graphiques mineures

Toutes ces modifications ont été faites dans le fichier user/screen.css.

J'ai voulu ajouté une légère ombre bleue autour de la barre de navigation horizontale (pour rappeler la couleur des liens et des titres) : 
```css
#tmpl_header_nav

{
  -moz-box-shadow: 0 0 4px 1px #2B85A2;
  -webkit-box-shadow: 0 0 4px 1px #2B85A2;
  box-shadow: 0 0 4px 1px #2B85A2;
}
```

J'ai aussi ajouté une ombre grise autour de la page principale :
```css
div#pagewrap
{
  -moz-box-shadow: 0 0 5px 5px #AAA;
  -webkit-box-shadow: 0 0 5px 5px #AAA;
  box-shadow: 0 0 5px 5px #AAA;
}
```

## Version mobile du site

Comme pour mon précédent template (voir [Version mobile du template Arctic pour Dokuwiki](/fr/oss/dokuwiki-arctic-mobile)), j'ai voulu ajouter une version optimisée pour les smartphones.

### Modification du main.php

J'ai ajouté avant le `</head>` : 
```html
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, height=device-height, user-scalable=no" />
```

### Modification de user/screen.css

Pour simplifier j'ai viré purement et simplement la barre latérale de droite et le champ de recherche (mais il serait possible de les garder et les mettre à la fin par exemple).
```css
@media (max-device-width: 599px)
{
div#tmpl_sidebar
{
display:none;
}

#tmpl_header_nav_search

{
display:none;
}

div#pagewrap
{
width: 98%;
min-width: 98%;
max-width: 98%;
padding: 0 5px;
margin: 0;
}

#tmpl_header #tmpl_header_nav ul li.level1 a, #tmpl_header #tmpl_header_nav ul li.level1 a:visited

{
  padding: 10px 5px;
}

.dokuwiki div#content
{
width: 100%;
}
}
```

## Intégration du plugin translation

Pour certaines parties du site à la fois en français et anglais, j'utilise le plugin [translation](http://www.dokuwiki.org/plugin:translation) et j'ai voulu l'intégrer dans la barre de navigation horizontale.

### Modification du main.php

Voici le diff :
```php
--- main.php    2011-09-18 12:41:42.000000000 +0000
+++ /new/main.php     2011-09-16 15:18:57.000000000 +0000
@@ -220,6 +236,15 @@
                    echo $interim;
                 }
             }
+
+        $translation_plugin = &plugin_load('syntax','translation');
+        if ( $translation_plugin ) {
+                if (!plugin_isdisabled($translation_plugin->getPluginName())) {
+                print $translation_plugin->_showTranslations();
+                }
+        }
+
+
             if (tpl_getConf("mnmlblog_search") &&
                 tpl_getConf("mnmlblog_search_pos") === "headernav"){
                 echo "\n            <div id=\"tmpl_header_nav_search\" class=\"dokuwiki\">\n";
```

### Modification de user/screen.css

```css
.plugin_translation ul li {
  padding: 0;
  margin: 0;
  list-style: none outside none;
  float: left;
}

.plugin_translation ul li a, .plugin_translation ul li a:visited {
    background: none repeat scroll 0 50% transparent;
    color: #CCCCCC;
    display: block;
    padding: 15px 5px;
    text-decoration: none;
    text-transform: uppercase;
}

.plugin_translation ul li .curid a, .plugin_translation ul li .curid a:visited {
  background: #2B85A2;
}

.plugin_translation ul li a.wikilink2 {
  color: #000000;
}
```

### Modification de user/screen.css pour la version mobile

```css
@media (max-device-width: 599px)
{

.plugin_translation ul li a, .plugin_translation ul li a:visited {
    padding: 10px 3px;
}

}
```
