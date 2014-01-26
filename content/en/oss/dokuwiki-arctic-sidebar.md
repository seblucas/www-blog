/*
Title: More sidebars with Arctic template (dokuwiki)
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: dokuwiki
*/
# More sidebars with Arctic template (dokuwiki)

## Backlinks
I simply used the method described here : http://www.dokuwiki.org/template:arctic#backlinks
## Bookmark

You have to create a the following file in this location lib/tpl/arctic/sidebars/bookmark/sidebar.php :
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
You will have bookmar images for delicious, digg, facebook, twitter and google. ~~My next aim is to integrate this cleanly (without any duplication) and with some configuration~~ (Done 05/22/2011).

For now I use free icons I got from : http://nouveller.deviantart.com/art/Social-Media-Bookmark-Icon-125995730

