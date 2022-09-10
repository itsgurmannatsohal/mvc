#! /bin/bash

	composer install
	composer dump-autoload
	echo 'Rewrite config file'
	echo 'DB_HOST:'
	read DB_HOST
	echo 'DB_PORT:'
	read DB_PORT 
	echo 'DB_NAME:'
	read DB_NAME 
	echo 'DB_USERNAME:'
	read DB_USERNAME
	echo 'DB_PASSWORD:'
	read -s DB_PASSWORD

	MYSQL_PWD=$DB_PASSWORD mysql -u $DB_USERNAME -e "CREATE DATABASE $DB_NAME;"
        
    MYSQL_PWD=$DB_PASSWORD mysql -u $DB_USERNAME "$DB_NAME"<./schema/schema.sql

	touch config/config.php
	echo '<?php'>config/config.php
    echo '$DB_HOST = "'$DB_HOST'";' >> config/config.php
    echo '$DB_PORT = "'$DB_PORT'";' >> config/config.php
    echo '$DB_NAME = "'$DB_NAME'";' >> config/config.php
    echo '$DB_USERNAME = "'$DB_USERNAME'";' >> config/config.php
    echo '$DB_PASSWORD = "'$DB_PASSWORD'";' >> config/config.php
	echo '?>'>>config/config.php

	cd public
	php -S localhost:8080