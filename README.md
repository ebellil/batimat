M1 project batimat with Symfony 4
=================================

## Windows environement
install Visual Studio Code
install wamp server
install composer
add bin php file on environement path


## Linux environement
sudo apt-get install php7-gd
sudo-apt get install php7.2-intl
sudo apt-get install php7.2-xsl
sudo apt-get install php-soap
sudo apt install mysql-server


## Getting Started
Clone this project using the following commands:


```
git clone git@github.com:ebellil/batimat.git
cd batimat
```

or if you use https
```
https://github.com/ebellil/batimat.git
cd batimat
```

## Setup the project

If you've just downloaded the code, congratulations!

To get it working, install the project dependencies:

```
composer install
```

add materialize_layout.html.twig file on vendor/symfony/twig-bridge/Ressources/views/Form

```
cp dependances/materialize_layout.html.twig vendor/symfony/twig-bridge/Ressources/views/Form/
```

add materialize_pagination.html.twig file on vendor/knplabs/knp-paginator-bundle/Resources/views/Pagination/

```
cp dependances/materialize_pagination.html.twig vendor/knplabs/knp-paginator-bundle/Resources/views/Pagination/*
```
## Setup the Database

Open `.env` and make sure the `DATABASE_URL` setting is
correct for your system.

Then, create the database and the schema!

```
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

If you get an error that the database exists, that should
be ok. But if you have problems, completely drop the
database (`doctrine:database:drop --force`) and try again.

## Start the built-in web server

You can use Apache, but the built-in web server works
great:

```
php bin/console server:run

```

or

```
php -S 127.0.0.1:8000 -t public

```
Now check out the site at `http://localhost:8000`

