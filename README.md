# BirdVector
An implimentation of Bird BGP Daemon, Pathvector and BGPQ4 on the pfSense Environment.

## What is it?
This pfSense package allows you to fully control pathvector and bird2 via the WebUI on your pfSense installations.

## Installtion
You will need to install the dependacies. If you're running pfSense 2.6 (FreeBSD-12) make sure to replace the below URLs with `FreeBSD:12:amd64`

```
pkg install libssh
pkg install pfSense-pkg-Cron
pkg add https://pkg.freebsd.org/FreeBSD:14:amd64/latest/All/bgpq4-1.11.pkg
pkg add https://pkg.freebsd.org/FreeBSD:14:amd64/latest/All/bird2-2.13.1.pkg
```

Download and install the latest version of the the BirdVector Package
```
echo "IGNORE_OSVERSION=yes" >> /usr/local/etc/pkg.conf

# For pfSense 2.7
pkg add https://github.com/zappiehost/pfSense-pkg-birdvector/releases/latest/download/pfSense-pkg-BirdVector.pkg

# For pfSense 2.6
pkg add https://github.com/zappiehost/pfSense-pkg-birdvector/releases/latest/download/pfSense-pkg-BirdVector-2.6.pkg
```

## Uninstall
To remove and uninstall the package:
```
pkg delete pfSense-pkg-BirdVector
```
