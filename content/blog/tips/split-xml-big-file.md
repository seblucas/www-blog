---
title: "How to split a big XML file without running out of RAM"
date: 2011-02-07
tags: [debian,tips]
slug: split-xml-big-file
disqus_identifier: /en/tips/split-xml-big-file
aliases: [/en/tips/split-xml-big-file]
---
# How to split a big XML file without running out of RAM

```
aptitude install xml-twig-tools
xml_split -s 5Mb MyBigXmlFile.xml
```

More informations : http://search.cpan.org/~mirod/XML-Twig-3.35/tools/xml_split/xml_split





