/*
Title: Transformation Wikidot > Dokuwiki
Description: 
Author: Sébastien Lucas
Date: 2010/09/26
Robots: noindex,nofollow
Language: fr
Tags: dokuwiki,perl
*/
# Transformation Wikidot > Dokuwiki

J'ai transféré mon ex blog/wiki de wikidot (http://slucas.wikidot.com) à dokuwiki (http://www.slucas.fr). Par fainéantise j'ai donc créé un script Perl (d'un laideur rare) pour me faciliter le travail.

```perl
#!/usr/bin/perl

use strict;

opendir (REP, ".") or die ("Directory not found\n");
my @v_filelist = readdir REP;
closedir REP;
    
foreach my $v_file ( sort {lc $a cmp lc $b} (@v_filelist))
{
    TransformeCreate ($v_file) if ( $v_file =~ /\.txt$/ && $v_file !~ /^doku/ );
}

sub TransformeCreate ($)
{
    my ($fichier) = @_;
    
    my $fichierSortie = "doku_".$fichier;
       
    open INPUT, "$fichier";
    open OUTPUT, ">$fichierSortie";
    
    my @toutesLignes = <INPUT>;
    close INPUT;
    
    while (my $ligne = shift (@toutesLignes))
    {
        $ligne =~ s/\r\n//igs;
        $ligne =~ s/\n//igs;
        next if ( $ligne =~ /^\[\[include include/ );
        $ligne =~ s/^\+ (.*)$/===== $1 =====/igs;
        $ligne =~ s/^\+\+ (.*)$/==== $1 ====/igs;
        $ligne =~ s/^\+\+\  + (.*)$/=== $1 ===/igs;
        $ligne =~ s/\[http(.*?) (.*?)\]/\[\[http$1\|$2\]\]/igs;
        $ligne =~ s/\[wikipedia\:(.*?)\]/\[\[wp>$1\]\]/igs;
        $ligne =~ s/\[\[code\]\]/<code>/igs;
        $ligne =~ s/\[\[\/code\]\]/<\/code>/igs;
        $ligne =~ s/\[\[footnote\]\]/((/igs;
        $ligne =~ s/\[\[\/footnote\]\]/))/igs;
        $ligne =~ s/^\*/  */igs;
        print OUTPUT "$ligne\n"; 
    }
    
    close OUTPUT;
}
```
Il gère :
* Les liens externes
* Les notes de bas de page
* Les liens vers wikipedia
* Les titres
* Les listes non ordonnées

