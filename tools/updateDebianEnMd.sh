#!/bin/sh
for x in *.md; do
  sed -i "s|^/\*$|---|g" $x
  sed -i "s|^\*/$|slug: ${x%.*}\naliases: [/en/debian/${x%.*}]\n---|g" $x
done
sed -i 's/^Title\: \(.*\)$/title: "\1"/g' *.md
sed -i 's|^Date: \([[:digit:]]\{4\}\)/\([[:digit:]]\{2\}\)/|date: \1-\2-|g' *.md
sed -i 's/^Tags\: \(.*\)$/tags: [\1]/g' *.md
sed -i '/^Description:/d' *.md
sed -i '/^Robots:/d' *.md
sed -i '/^Language:/d' *.md
sed -i '/^Author:/d' *.md
