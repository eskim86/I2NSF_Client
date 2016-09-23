# I2NSF_Client

INSTALLATION & SETTINGS GUIDE

  - Install php and mysql
  - Create Database as "I2NSF_DB" and Table as "Policies".
  - Insert all six php files into /var/www/html.
  - change permission or capability if necessary.

How TO USE
  - Open your browser and type "http://[web server's ip address]/mysql_CDB.php" to create Database "I2NSF_DB".
  - Open another browser and type "http://[web server's ip address]/mysql_CT.php" to create the table "Policies".
  - close all tabs and start a new browser and type http://[web server's ip address]/index.php to access the Web UI.
  - Type in the provided username and password
  - Select either Policy settings or Logs
  - In Policy settings page, fill in all required information then press submit
  - If you wish to view the Policies tables' information type in the following command:
     
    "curl -i -X GET http://[web server's ip address]/qfc.php/api/Policies"
