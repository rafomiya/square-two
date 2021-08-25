# square-two

[![pt-br](https://img.shields.io/badge/lang-pt--br-green.svg)](https://github.com/rafomiya/square-two/README.pt-br.md)



Just
Project of a virtual store, made with HTML, CSS and PHP. Deployed on [Heroku](www.heroku.com).
The current progress of the project can be seen [here](https://square-two.herokuapp.com/).


## Requirements:

- Composer package manager.
- A [Heroku account](https://signup.heroku.com/login).



<hr>

## Starting with Heroku:

​	Obtaining the Heroku CLI (in case you don't have it yet):

```bash
sudo snap install --classic heroku
```

​	Login in through the command line:

```bash
heroku login -i
```

​	Creating the app on the project root:

```bash
heroku create
```

<hr>

## Project requirements:

​	We need a `composer.json` file on the root of the application, declaring each dependency of our project on the `require` key. 
​	e.g.:

```JSON
{
    "require": {
        "monolog/monolog": "1.0.*@beta",
        "php": "^7.4.0"
    }
}
```

​	If the project doesn't have any dependencies, it will still need a `composer.json` file, containing only `{}`. That's how Heroku recognize which runtime to use.

​	After that, execute `composer update` on the command line, so the app can run locally. This command will also generate a `composer.lock` file, responsable for "locking" the dependencies.

> OBS: Commit the changes in each step of the development :)



<hr>

## `Procfile`:

​	The next step is to create a `Procfile` on the root directory of our project. This file will instruct Heroku on how to start the application. To do so, create the file and write the following:

​	```web: vendor/bin/heroku-php-apache2```

### Document root

​	The document root is the directory where the `.php` files are located. It is possible to change that on the `Procfile`, adding the path to the end of the line:

​	```web: vendor/bin/heroku-php-apache2 public/```

​	In this example, the document root is the `public` directory.

> OBS: Usually, the `vendor` directory contains sensitive data of our project. It must be always on the `.gitignore`, for security reasons :)



<hr>

## Environment variables

​	Sensitive data, such as passwords or tokens, must be kept in a safe way. Therefore, we use environment variables, that can't be seen on the source code, but can be accessed through special methods.

### `heroku config` command

​	Using Heroku, it is really easy to set the env vars through the command line:

```bash
heroku config:set VAR_NAME=VAR_VALUE
```

​	If we want to define `123` as `PASSWORD`:

```bash
heroku config:set PASSWORD=123
```

​	To verify them:

```bash
heroku config
```

> Warning! Don't give too generic names to your environment variables. They could be overrid by predefined Heroku varables.



<hr>

## Deploy

​	Now that we have all setup, we can make the deploy. But before we do that, verify if all files containing sensitive data are on the `.gitignore`. After that, run:

```bash
git add . # adding the files to commit
git commit -m "<commit_message>" # commiting
git push heroku main # deploying
```
