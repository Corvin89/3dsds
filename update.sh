#!sh
#git stash
#git pull origin master
mysql -uadmin -padmin -e "drop database 3dsds;"
mysql -uadmin -padmin -e "create database 3dsds;"
mysql -uadmin -padmin 3dsds < backup/database.sql
mysql -uadmin -padmin -e "UPDATE wp_options SET option_value = 'http://3dsds.dev/' WHERE option_name = 'home' OR option_name = 'siteurl';" 3dsds
#git stash pop

