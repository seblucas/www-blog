/*
Title: Ranger proprement des fichiers dans des répertoires
Description: 
Author: Sébastien Lucas
Date: 2011/08/21
Robots: noindex,nofollow
Language: fr
Tags: debian,perl
*/
# Ranger proprement des fichiers dans des répertoires

Dernièrement un ami m'a donné des photos (un bon paquet de photos : 2325). Le problème est qu'elles étaient toutes dans un seul et même répertoire sans organisation en répertoire. Par contre elles étaient toutes nommées de la même manière : `<Date au format ISO>`-`<Numéro>`. Comme mon objectif était de les trier et de les organiser, j'ai décidé dans un premier de les regrouper par paquet du même jour pour me faciliter le travail. Et encore une fois vive perl :

```perl
#!/usr/bin/perl

use strict;
use File::Copy;

opendir (REP, ".") or die ("Directory not found\n");
my @v_filelist = readdir REP;
closedir REP;

print "Debut\n";

foreach my $v_file ( @v_filelist )
{
  if ( $v_file =~ /^(.*?)-/ )
  {
    my $v_date = $1;
    $v_date =~ s/\.$//is;
    #print "$v_file -> $v_date \n";
    if (! ( -d $v_date ))
    {
      mkdir ($v_date);
    }
    move ($v_file, "$v_date/$v_file");
  }
}

print "Fin\n";
```








