/*
Title: Mobile Arctic template for Dokuwiki
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: android,dokuwiki
*/
# Mobile Arctic template for Dokuwiki

## Why ?
The template used on this website is [Arctic](http://www.dokuwiki.org/template:arctic) and I like it on a normal desktop browser. But it's far less usable on a mobile device (iphone, android, bada, blackberry, Symbian, Windows Phone or any other tablet) for the following reasons :
*	The right sidebar is not useful with a low width device.
*	Margin and padding should be reduced (or removed) to fit more text.
*	Some (and maybe all) mobile browser emulate the width of a normal screen, so you have to zoom and scroll horizontally to read the text.

## Existing solutions

To my knowledge, Dokuwiki don't allow each wiki user to have a template (with a cookie for example). I've seen some plugins or some modifications of dokuwiki sources to have multitemplate (see [here](http://www.dokuwiki.org/plugin:multitemplate_styleman) or [there](http://www.dokuwiki.org/template:multitemplate)) but those topic are too old. Moreover I read (I don't remember where) that multitemplate can cause problem with cache (to be confirmed).

Another solution is to have specific pages for mobiles (or even another dokuwiki site with the same data but a mobile template). I really don't like having to duplicate data, so I didn't go further with this solution (it also have the drawback to make the indexation of page harder). 

Next I followed this [thread](http://forum.dokuwiki.org/thread/5270) of the Dokuwiki forum where I learned a few things to understand better what could be done : 
*	$INFO['ismobile'] or clientismobile() allow to detect mobile devices. But all mobile devices are detected without any distinction between new smartphones (with a real browser) and older ones (wap).
*	Modifying template.php allow to have two templates for desktop and mobile.

In the end, I don't like any of these choices.

## CSS to the rescue

The solution I liked better was to add a mobile specific CSS which will be loaded after the other CSS and override some class. All mobile devices will have more work to do but it's, in my opinion easier.

The aim of the mobile CSS is to :
*	Reduce all margins and paddings.
*	Remove all float (right or left). There will be only one collumn with sidebar in the bottom.
*	Maximize the width of the div.

In the tests I made, the cache seems to work fine.

## The code

### The CSS file
```css
body {
  margin: 0.1em;
}

div#wrapper {
  width: 98%;
  padding: 0.1em;
}

div.dokuwiki div.right_sidebar, div.dokuwiki div.left_sidebar {
  float: none;
  width: 99%;
}

div.dokuwiki div.right_page, div.dokuwiki div.left_page {
  padding: 0;
  width: 99% !important;
}

div.dokuwiki div.toc {
  float: none;
  width: 99%;
  margin: 0.1em;
}
```
As stated before the goal is just have as much space as possible for the text.

### The modification on main.php

That's just 3 lines to add just before `</head>` :
```html
    <meta name="HandheldFriendly" content="true" />
    <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no" />
    <link rel="stylesheet" media="only screen and (max-device-width: 599px)" type="text/css" href="<?php echo DOKU_TPL?>arctic_mobile.css" />
```

It's also possible to add those lines to the file meta.html.

## The full diff

TODO


