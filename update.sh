#!sh
git stash
git pull origin master
mysql -uroot -e "drop database 3dsds;"
mysql -uroot -e "create database 3dsds;"
mysql -uroot 3dsds < backup/database.sql
mysql -uroot -e "UPDATE wp_options SET option_value = 'http://3dsds.dev/' WHERE option_name = 'home' OR option_name = 'siteurl';" 3dsds
git stash pop

