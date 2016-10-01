# I2NSF_Client

INSTALLATION & SETTINGS GUIDE

  - Install php and mysql
  - Create Database as "I2NSF_DB" and Table as "Policies".
  - Insert all six php files into /var/www/html.
  - Insert server.py file into /home/(usrname)
  - change permission or capability if necessary.

How TO USE
  - open your terminal and local your server.py file.
  - open the server.py file so that your server side can listen for any incomming packets.
  - Open your browser and type "http://[web server's ip address]/mysql_CDB.php" to create Database "I2NSF_DB".
  - Open another browser and type "http://[web server's ip address]/mysql_CT.php" to create the table "Policies".
  - close all tabs and start a new browser and type http://[web server's ip address]/index.php to access the Web UI.
  - Type in the provided username and password
  - Select either Policy settings or Logs
  - In Policy settings page, fill in all required information then press submit
  - You will be able to see the response from the terminal.  

