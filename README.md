PrettyBoot
==========

PrettyBoot stresser source





How to install
==========

PrettyBoot Booter Source



SETUP

Before being able to run the script you’ll have to put some of your information in some files.
This covers:
Database information (MySQL)
Host
Database
Username
Password
PayPal information
Page title
Logo
Admin’s mail address
Timezone
Making yourself admin


DATABASE INFORMATION

File location: /application/config/database.php

When opened go to:
Line: 70 to 77
array Connections -> mysql
host : to your DB host
database : database name
username : username of database account
password : password of database account

Installing the .SQL file
Go to your PHPMyAdmin page, create a new database with the same name as you used in the database.php file. When created go to that database’s import page and import the .SQL file that is included with the PrettyBoot HUB package.

Now register yourself and make yourself admin by editing your group to 3.



Now you can set all the other settings in your Admin panel -> core application settings.
Direct location to this: yourdomain.com/admin/settings


TIMEZONE
TO BE SURE THE BOOTER WORKS SET YOUR TIMEZONE EQUAL TO THE TIMEZONE OF YOUR DATABASE OTHERWISE SOME FUNCTIONS WILL NOT WORK

File location: /application/config/application.php
Line: 138
Default: Europe/Amsterdam
Don’t know the name of your timezone?
http://php.net/manual/en/timezones.php



