/*
Title: Ajout de sidebar au template Arctic (dokuwiki)
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: dokuwiki
*/
# Ajout de sidebar au template Arctic (dokuwiki)

## Backlinks
J'ai bêtement utilisé la méthode expliquée ici : http://www.dokuwiki.org/template:arctic#backlinks

## Bookmark

Créer le fichier sidebar.php suivant dans le répertoire lib/tpl/arctic/sidebars/bookmark/sidebar.php :

```php
Bookmark
<?php

$bookmarks = array(
    'del.icio.us' => array('link' => 'http://del.icio.us/post?title=%title%&amp;url=%link%', 'image' => 'delicious.png'),
    'Digg'        => array('link' => 'http://digg.com/submit?phase=2&amp;title=%title%&amp;url=%link%', 'image' => 'digg.png'),
    'Facebook'    => array('link' => 'http://www.facebook.com/sharer.php?u=%link%&amp;t=%title%', 'image' => 'facebook.png'),
    'Twitter'     => array('link' => 'http://twitter.com/home?status=%title%:%link%', 'image' => 'twitter.png'),
    'Google'      => array('link' => 'http://www.google.com/bookmarks/mark?op=add&amp;title=%title%&amp;bkmk=%link%', 'image' => 'google.png'),
    'Google Buzz' => array('link' => 'http://www.google.com/buzz/post?url=%link%&amp;message=%title%', 'image' => 'buzz.png'),
    'Stumbleupon' => array('link' => 'http://www.stumbleupon.com/submit?url=%link%&amp;title=%title%', 'image' => 'stumble.png')
  );

$title = rawurlencode(p_get_metadata($ID, "title")." [".strip_tags($conf['title'])."]");
$link = rawurlencode(wl($ID,'',true));
$before = array("%title%", "%link%");
$after = array($title, $link);

foreach ($bookmarks as $key => $value)
{
  $url = str_replace ($before, $after, $value["link"]);
  $image = DOKU_TPL."images/".$value["image"];
  $text = "Bookmark to ".$key;
?>
  <a href="<?php echo $url?>" target="_blank" rel="external nofollow"><img src="<?php echo $image?>" width="16" height="16" alt="<?php echo $text?>" title="<?php echo $text?>" /></a>
<?php
}
?>
```
Cela crée des images d'ajout de bookmark pour delicious, digg, facebook, twitter, google, etc. ~~Mon prochain objectif est de l'intégrer plus proprement (sans duplication de code) et avec la possibilité de choisir ses icônes~~ (Fait le 22/05/2011).

Pour l'instant j'utilise des icônes (libres) récupérées ici : http://nouveller.deviantart.com/art/Social-Media-Bookmark-Icon-125995730

