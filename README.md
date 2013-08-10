PrettyBoot
==========

PrettyBoot stresser source
Scroll down for install instructions.

##Features
PrettyBoot is a solid stresser source with plenty amount of features, due to it also being built upon Laravel it is easy to customise it to your likings.

A list containing most of the features:
* full-fledged user system, easy to manage
* News system, supporting BBCode
* Full PayPal integration, fill in your PayPal e-mail and you're ready to go!
* Advanced API server support, any server with any parameters possible!
* Advanced stresser page
    + Notes per user
    + Attack history per user
    + Many resolvers
        + Cloudflare
        + Skype
        + Geo location
        + Hostname to IPv4
    + Down or not checker
    + Realtime statistics
    + IP logger with customisable redirecting
    + Start attacks with a single click, no page reload required!
    + Stop button for API's that have this integrated
    + Any attack method possible!
* Blacklisting of IP's and Skype's, you can even sell blacklisting!
* Customise the stresser on the back-end as Admin
* Manage your sales and see your profits
* User-friendly support system
* Sleak design that is also easy to customise
* Built with AJAX technology to enhance user experience
* Built upon one of the best PHP frameworks, Laravel 3.2

### And best of all, it is now free for anyone!













##How to install

Clone the files in the source directory to wherever you want, the included .htaccess will make sure every request will be directed into the /public folder.


Before being able to run the script you’ll have to put some of your information in some files.
This covers:

* Database information (MySQL)
* Making yourself admin
* PayPal information
* Page title
* Logo
* Admin’s mail address
* Timezone



###DATABASE INFORMATION

File location: /application/config/database.php

Line: 70 to 77  
array Connections -> mysql  
host : to your DB host  
database : database name  
username : username of database account  
password : password of database account  


Installing the .SQL file
Go to your PHPMyAdmin page, create a new database with the same name as you used in the database.php file. When created go to that database’s import page and import the .SQL file that is included with the PrettyBoot HUB package.

Now register yourself as a normal user and make yourself admin by editing your group to 3.



Now you can set all the other settings in your Admin panel -> core application settings.  
Direct location to this: yourdomain.com/admin/settings


TIMEZONE
TO BE SURE THE STRESSER WORKS SET YOUR TIMEZONE EQUAL TO THE TIMEZONE OF YOUR DATABASE OTHERWISE SOME FUNCTIONS WILL NOT WORK

File location: /application/config/application.php  
Line: 138  
Default: Europe/Amsterdam  
Don’t know the name of your timezone?  
http://php.net/manual/en/timezones.php  



