# Clean Docker with PHP
Docker with PHP 7.4 fpm, Nginx, Composer, PhpUnit and postgresDB

## Starting app
docker-compose up -d
or
docker-compose up --build --force-recreate -d

## Main page - localhost
http://localhost:8000/

## Php info
http://localhost:8000/php_info.php

## Xdebug info
http://localhost:8000/xdebug_info.php

## Running tests
docker-compose run php vendor/bin/phpunit

## Namespaces
change namespace "Example" in composer.json line 7 for your project name

## Connecting to MySql
1. User: admin
2. Passwd: Admin456
3. Port 5432
4. DB: ratedb

## Using PhpUnit in PhpStorm
1. PhpUnit By Remote Interpreter
2. Provide full docker path to autoloader.php /opt/project/vendor/autoload.php

## Problems and solusions
1. database issues: "Access denied for user 'root'@'localhost' (using password: YES)"
   Solusion: 
            Warning: this will permanently delete the contents in your db_data volume, wiping out any previous database you had there.

            docker-compose down -v
            docker-compose up -d

## How to know the ip of you db in docker
1. docker inspect name_of_your_db | grep IPAddress

### by Lorenz Knight