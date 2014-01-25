/*
Title: How to split a big XML file without running out of RAM
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
# How to split a big XML file without running out of RAM

```
aptitude install xml-twig-tools
xml_split -s 5Mb MyBigXmlFile.xml
```
More informations : http://search.cpan.org/~mirod/XML-Twig-3.35/tools/xml_split/xml_split





