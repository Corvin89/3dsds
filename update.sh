#!sh
git stash
git pull origin master
mysql -uroot -e "drop database denis;"
mysql -uroot -e "create database denis;"
mysql -uroot denis < backup/database.sql
mysql -uroot -e "UPDATE wp_options SET option_value = 'http://denis.dev/' WHERE option_name = 'home' OR option_name = 'siteurl';" denis
git stash pop

