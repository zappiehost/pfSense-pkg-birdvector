# $FreeBSD$

PORTNAME=	pfSense-pkg-BirdVector
PORTVERSION=	1.0
PORTREVISION=	1
CATEGORIES=	net
MASTER_SITES=	# empty
DISTFILES=	# empty
EXTRACT_ONLY=	# empty

MAINTAINER=	admin@zappiehost.com
COMMENT=	pfSense package BirdVector

LICENSE=	APACHE20

NO_BUILD=	yes
NO_MTREE=	yes

SUB_FILES=	pkg-install pkg-deinstall
SUB_LIST=	PORTNAME=${PORTNAME}


RUN_DEPENDS=	bird2>=2:net/bird2 \
		bgpq4:net/bgpq4

CONFLICTS=	pfSense-pkg-OpenBGPD-[0-9]* \
		pfSense-pkg-Quagga_OSPF-[0-9]* \
		pfSense-pkg-frr-[0-9]*

do-extract:
	${MKDIR} ${WRKSRC}

do-install:
	${MKDIR} ${STAGEDIR}${PREFIX}/pkg
	${MKDIR} ${STAGEDIR}/etc/inc/priv
	${MKDIR} ${STAGEDIR}${PREFIX}/www/packages/birdvector
	${MKDIR} ${STAGEDIR}${PREFIX}/bin
	${MKDIR} ${STAGEDIR}${DATADIR}
	${INSTALL_DATA} -m 0644 ${FILESDIR}${PREFIX}/pkg/birdvector.xml \
		${STAGEDIR}${PREFIX}/pkg
	${INSTALL_DATA} ${FILESDIR}${PREFIX}/pkg/birdvector.xml \
		${STAGEDIR}${PREFIX}/pkg
	${INSTALL_DATA} ${FILESDIR}${PREFIX}/pkg/birdvector.inc \
		${STAGEDIR}${PREFIX}/pkg
	${INSTALL_DATA} ${FILESDIR}/etc/inc/priv/birdvector.priv.inc \
		${STAGEDIR}/etc/inc/priv
	${INSTALL_DATA} ${FILESDIR}${PREFIX}/www/packages/birdvector/birdvector.php \
		${STAGEDIR}${PREFIX}/www/packages/birdvector
	${INSTALL_DATA} ${FILESDIR}${PREFIX}/www/packages/birdvector/birdvector_config.php \
		 ${STAGEDIR}${PREFIX}/www/packages/birdvector
	${INSTALL_DATA} ${FILESDIR}${PREFIX}/www/packages/birdvector/birdvector_about.php \
		 ${STAGEDIR}${PREFIX}/www/packages/birdvector
	${INSTALL_DATA} ${FILESDIR}${PREFIX}/www/packages/birdvector/birdvector_shell.php \
		 ${STAGEDIR}${PREFIX}/www/packages/birdvector
	${INSTALL_DATA} ${FILESDIR}${PREFIX}/www/packages/birdvector/birdvector_shell_ajax.php \
		${STAGEDIR}${PREFIX}/www/packages/birdvector
	${INSTALL_DATA} ${FILESDIR}${PREFIX}/www/packages/birdvector/index.php \
		${STAGEDIR}${PREFIX}/www/packages/birdvector
	${INSTALL_DATA} -m 0755 ${FILESDIR}${PREFIX}/bin/pathvector \
		${STAGEDIR}${PREFIX}/bin
	${INSTALL_DATA} ${FILESDIR}${DATADIR}/info.xml \
		${STAGEDIR}${DATADIR}
	@${REINPLACE_CMD} -i '' -e "s|%%PKGVERSION%%|${PKGVERSION}|" \
		${STAGEDIR}${PREFIX}/pkg/birdvector.xml \
		${STAGEDIR}${DATADIR}/info.xml

.include <bsd.port.mk>
