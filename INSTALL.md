# Installing Book Library


1) Get the sources:
```sh
git clone https://github.com/8kto/libraryTask.git
```

2) Change directory to the root of application and install all dependencies (you will be asked for database configuration throughout installation):
```sh
cd libraryTask
composer install
```
3) If any troubles with database parameters occured you can tweak it in ``app/config/parameters.yml``
4) Run ``install/symfony_post_install.sh `` to set file and directories permissions.
5) Import tables structure and test data from ``install/structure-demo-data.sql``.
6) Run ``php app/console cache:clear`` for removing old cache if any. Also it checks if installation is valid.
7) Configure your webserver to display web application in browser. Check ``install/library.local.conf`` for Apache virtual host config.
Another option is to use web server provided by Symfony, which in turn uses the built-in web server provided by PHP.
Execute this command:
```sh
php app/console server:run
``` 
Now you can access app via the http://localhost:8000/ 

Also you can access admin dashboard on URL ``/admin/``.
Credentials are:
```txt
Login: admin
Password: admin
```
 