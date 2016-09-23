# I2NSF_Client

INSTALLATION & SETTINGS GUIDE

  - install php and mysql
  - create Database as "I2NSF_DB" and Table as "Policies".
  - Insert all six php files into /var/www/html.
  - change permission or capability if necessary.

How TO USE

  - open your browser and type http://[web server's ip address]/index.php
  - type in the provided username and password
  - select either Policy settings or Logs
  - in Policy settings page, fill in all required information then press submit
  - if you wish to view the Policies tables' information type in the following command:
    curl -i -X GET http://[web server's ip address]/qfc.php/api/Policies
