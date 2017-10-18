# Installing Book Library


1) Get the sources:
```sh
git clone .. TODO
```

2) Change directory to the root of application and install all dependencies:
```sh
cd library
composer install
```
3) Configure database parameters in ``app/config/parameters.yml``
4) Run ``install/symfony_post_install.sh `` to set file and directories permissions.
5) Import tables structure and test data from ``install/structure-demo-data.sql``.
6) Configure your webserver to display web application in browser. Check ``install/library.local.conf`` for Apache virtual host config.
Another option is to use web server provided by Symfony, which in turn uses the built-in web server provided by PHP.
Execute this command:
```sh
php bin/console server:run
``` 
Now you can access app via the http://localhost:8000/ 

Also you can access admin dashboard on URL /admin/.
Credentials are:
```txt
Login: admin
Password: admin
```
 