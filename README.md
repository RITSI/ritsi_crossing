**DISCLAIMER:** There are pending code improvements and corrections, as pending deployment documentation.

To deploy and test:
1. Clone the project in your server
2. Move the folder to the location where Nginx server will be listening
3. Copy "nginx-site" file to the folder "sites-available" in your Nginx folder
4. Create a synlink with $ln -sF &fileSitesAVailable &nameOfTheFile (ex: $ln -sF /etx/nginx/sites-available/ritsicrossing.ritsi.es ritsicrossing.ritsi.es)
5. Create a database with name "ritsi_crossing"
6. Import "demo.sql" into the database
7. Create the users required on the database and update it on "services/db_auth.json"
8. Create a ".htpasswd" in the "management" folder of the website with the command $sudo htpasswd -c &route/.htpasswd &username (ex. $sudo htpasswd -c /var/www/ritsi_crossing/management/.htpasswd admin)
9. Enjoy it!

Note: Remember that if you change any name or configuration, you have to ensure that you update it in the files needed.
