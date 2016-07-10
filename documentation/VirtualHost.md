Example config virtual host in xampp (windows)
==============================================

----------

Add domain in your hosts file
-----------------------------

- Go to **Windows/system32/drivers/etc/hosts**
- Add a line:

````code
127.0.0.1 your-domain.mydev.local
````

- Then go to **xampp installation folder/apache/config/extra/httpd-vhosts.conf**

````code
#your-domain.mydev.local
<VirtualHost *:80>
  ServerName your-domain.mydev.local
  DocumentRoot "**your-project-folder/public**"
  <Directory "**your-project-folder/public**">
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
````

- Example:
````code
#tedozicms.mydev.local
<VirtualHost *:80>
  ServerName tedozicms.mydev.local
  DocumentRoot "D:\Projects\repos\mine\tedozi-cms"
  <Directory "D:\Projects\repos\mine\tedozi-cms">
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
````

- After that, restart apache.

Well done! Now, you can access the project by go to **http://your-domain.mydev.local**