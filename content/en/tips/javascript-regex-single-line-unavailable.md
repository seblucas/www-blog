/*
Title: The single line regex modifier is not available for Javascript
Description: 
Author: Sébastien Lucas
Date: 2011/11/10
Robots: noindex,nofollow
Language: en
Tags: javascript
*/
# The single line regex modifier is not available for Javascript

To prevent it replace your . by [\s\S] :

```
start(.*?)end

become

start([\s\S]*?)end
```

I had trouble with this syntax :

```javascript
var myregExp = new RegExp ("start([\s\S]*?)end", "g");
```
Instead I used that way without trouble : 

```javascript
var myregExp = /start([\s\S]*?)end/g;
```

Source : http://fire-studios.com/blog/2008/overview-of-javascript-regex
