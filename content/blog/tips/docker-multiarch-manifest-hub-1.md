---
title: "How to push a multi-architecture Docker image to Docker Hub - 1"
date: 2018-01-14
tags: [docker]
slug: docker-multiarch-manifest-hub-1
disqus_identifier: /blog/tips/docker-multiarch-manifest-hub-1
series: ["Multi-Architecture Docker image"]
---
# How to push a multi-architecture Docker image to Docker Hub - x86_64

For the last 6 months I read a lot about multi-architecture docker images. I first read [this one from IBM](https://developer.ibm.com/linuxonpower/2017/07/27/create-multi-architecture-docker-image/) and was still a little puzzled. I then read [this one by @stefscherer](https://jugsaxony.org/wp-content/uploads/2017/11/20171109_JUG_Saxony_Multi-arch_Images.pdf) which was easier to read and gave some ideas.

## My Goal

I use a lot of images for my home automation and some website I host at home. All those images are hosted on [2 Banana Pis](http://linux-sunxi.org/LeMaker_Banana_Pi) so Arm32V7. Those images are now build on one of my Banana Pi from this [repository](https://github.com/seblucas/docker-images). I've made one big repository because most of my images are fully based on alpine, I only use apk to install others packages.

I also have a [Pine64](http://linux-sunxi.org/Pine64) lying around so Arm64v8. It will maybe replace / complement my Banana Pi someday.

My goal is to provide images from ARM32v7, ARM64v8 and x86_64.

## Baby steps - x86_64 first

### Basic images

I have no server available to build any x86_64 images (beside my work laptop, I'm all ARM at home). I first thought to use a VPS / Public cloud resource and ended trying to use [automatic builds provided by docker hub](https://docs.docker.com/docker-hub/builds/).

The configuration was easy for simple images, I ended up using it with tags only :

[![Python2](/blog/docker-multi-arch-python2.png)](/blog/docker-multi-arch-python2.png)

In my case the Dockerfile Location is inside a directory. I also take care to use a prefix for the tag of my image.

You just have to push a tag to Github and the new image should be pushed to the Hub automatically. It might take some time though !

### x86_64 - dependencies

In my case the image `alpine-python3-cron` is using `alpine-python3` as its base image. So I have to ensure that they are build in order. It seems to be handled with Repository Links, see the image below.

[![Python3](/blog/docker-multi-arch-python3.png)](/blog/docker-multi-arch-python3.png)

I also added another tag to make sure the dependency can be found.

### Conclusion

Now each time I push a new tag to my `docker-images` repository, new images are created on Docker Hub with this tag : `amd64-{NAME OF THE GITHUB TAG}`.

Every image is created within the hour which is not that bad.

## Next steps

Two more architectures and the manfiest to go !