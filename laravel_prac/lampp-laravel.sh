#!/bin/sh
if [ "$1" != ""  ]; then
	project=$1
	path='/opt/lampp/htdocs'
	cd $path
	sudo chown -R www-data:www-data $path/$project
	cd $path/$project
	sudo usermod -a -G www-data princeluo
	cd 
	sudo find $path/$project -type f -exec chmod 664 {} \;
	sudo find $path/$project -type d -exec chmod 755 {} \;
	sudo chgrp -R www-data $path/$project/storage $path/$project/bootstrap/cache
	sudo chmod -R ug+rwx $path/$project/storage $path/$project/bootstrap/cache
	echo "The laravel project" $1 "has been loaded successfully on lampp!"
	exit 0
else
	echo 'Please input the name of the project......'
	exit 1
fi
