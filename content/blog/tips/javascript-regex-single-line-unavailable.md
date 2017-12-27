---
title: "The single line regex modifier is not available for Javascript"
date: 2011-11-10
tags: [javascript]
slug: javascript-regex-single-line-unavailable
aliases: [/en/tips/javascript-regex-single-line-unavailable]
---
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
