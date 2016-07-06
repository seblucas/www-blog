/*
Title: Docker Cheatsheet
Description: 
Author: Sébastien Lucas
Date: 2016/03/22
Robots: noindex,nofollow
Language: en
Tags: rpi,bpi,debian
*/
# Docker Cheatsheet

```
# list all images
docker images

# remove an image
docker rmi <imageid>

# list all running containers
docker ps

# list all containers
docker ps -a

# remove all exited containers
docker rm $(docker ps -q -f status=exited)

# start a container with an interactive session and remove it when stopped
docker run -it --rm --name=mosquitto slucas/alpine-mosquitto /bin/sh

# start a container with a name
docker run -d -p 1883:1883 --name=mosquitto slucas/alpine-mosquitto

# start a container depending on another
docker run -d --link mosquitto:mosquitto --name=mqttwarn slucas/alpine-mqttwarn

# build an image from a local directory
docker build -t ouruser/ourproject:v2 .

```

Gestion des liens entre docker :
https://docs.docker.com/engine/userguide/networking/default_network/dockerlinks/

Reference Dockerfile :
https://docs.docker.com/engine/reference/builder/

Gestion des logs dans Docker :
https://gist.github.com/afolarin/a2ac14231d9079920864

Best practice Docker / Alpine
https://github.com/gliderlabs/docker-alpine/blob/master/docs/usage.md

Gestion de l'arrêt des services
https://www.ctl.io/developers/blog/post/gracefully-stopping-docker-containers/

Gestion de l'arret / demarrage avec systemd
https://goldmann.pl/blog/2014/07/30/running-docker-containers-as-systemd-services/
http://container-solutions.com/running-docker-containers-with-systemd/










