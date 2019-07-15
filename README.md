# php-redirect-server

## Description
This PHP redirect server can answer all requests with configured redirect types from a database.
It is supports multiple redirect modules, the following modules are already in this project:

- HTTP 301 (permanent redirect)
- HTTP 302 (temporary redirect)
- Frame Redirect (opens target in a frame)
- Proxy Redirect BETA (tries to proxy the request to the target)
  
It was written 2011 by Stephan Schwarz (@stearz)

## Usage
Place the content of the project into the root of a PHP enabled webserver.

Create a database, table and a user on a MySQL compatible server:

    CREATE DATABASE php-redirect-server;
    
    CREATE TABLE redirects (
       id INT UNSIGNED NOT NULL AUTO_INCREMENT,
       type VARCHAR(20) NOT NULL,
       name VARCHAR(255) NOT NULL,
       target VARCHAR(255) NOT NULL,
       active_from DATETIME NULL,
       active_until DATETIME NULL,
       primary key (id)
    );

    GRANT ALL PRIVILEGES ON php-redirect-server.* TO 'php-redirect-server'@'localhost' IDENTIFIED BY 'php-redirect-server';
    FLUSH PRIVILEGES;

Configure the database connection in config.inc.php:

    <?php
    $DB_HOST='localhost';
    $DB_NAME='php-redirect-server';
    $DB_TABL='redirects';
    $DB_USER='php-redirect-server';
    $DB_PASS='php-redirect-server';
    ?> 

## Requirements
The project currently only supports the use of MySQL database servers but enabling it to use other SQL servers should be easy.
