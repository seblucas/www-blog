---
title: "How to clone all the partitions of a disk"
date: 2011-02-07
tags: [debian,tips]
slug: mdadm-clone-partition
disqus_identifier: /en/tips/mdadm-clone-partition
aliases: [/en/tips/mdadm-clone-partition]
---
# How to clone all the partitions of a disk

If you want to create the same partitions as an existing disk and if those disks are exactly the same, then you can use the following command :

```
sfdisk -d /dev/hda | sfdisk /dev/hdb
```


