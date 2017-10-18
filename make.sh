#!/bin/bash

cd web

if ! [ -e ".htaccess.$1" ] || [ -z $1 ] ; then
	echo Env $1 doesnt exists
	exit 1 
fi

mv .htaccess{,.off}
rename .$1 '' .htaccess.$1
ls -1 .htac*

cd -
php app/console cache:clear
php app/console assetic:dump --env=prod --no-debug

zip -r ~/tmp/library-$1-$(date +%Y-%m-%d-%H%M%S).zip . -x '*app/cache/*' -x '*app/logs/*' -x '*.git/*' -x '*nbproject*' -x '*.log' -x useful.sql -x make.sh -x README.md

cd web
mv .htaccess{,".$1"}
rename .off '' .htaccess.off
ls -1 .htac*
cd -

exit 0
