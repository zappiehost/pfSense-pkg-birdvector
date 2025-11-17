# BirdVector
An implimentation of Bird BGP Daemon, Pathvector and BGPQ4 on the pfSense Environment.

## What is it?
This pfSense package allows you to fully control pathvector and bird2 via the WebUI on your pfSense installations.

## Installtion
You will need to install the dependacies. (Below are for pfSense 2.8.X)

```
pkg install libssh
pkg install pfSense-pkg-Cron
pkg add https://pkg.freebsd.org/FreeBSD:15:amd64/latest/All/bgpq4-1.12.pkg
pkg add https://pkg.freebsd.org/FreeBSD:15:amd64/latest/All/bird2-2.17.2_1.pkg
```

Download and install the latest version of the the BirdVector Package
```
echo "IGNORE_OSVERSION=yes" >> /usr/local/etc/pkg.conf

pkg add https://github.com/zappiehost/pfSense-pkg-birdvector/releases/latest/download/pfSense-pkg-BirdVector.pkg
```

## Uninstall
To remove and uninstall the package:
```
pkg delete pfSense-pkg-BirdVector
```
