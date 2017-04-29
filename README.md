# phaba-database-manager

Database-Manager of Phaba is a library for managing databases used by your PHP project.
Thank to this library you can:
 - select, insert, update and delete database rows
 - execute SQL queries
 
## Pre-requirements

- PHP ^7.1
- Composer

## Get started

### Install

Install phaba-database-manager library through Composer

`your/project/root/path$ composer require phaba/database-manager`

### Usage



## Development

For developing new features of phaba-database-manager you have to install dependencies through composer.

`path/project/root$ composer install`

### Coding

PSR-2 PHP codification standard is used for writing phaba-database-manager source code.
 
## Testing

### Pre-requirements

- Create database for testing with corresponding tables.
Necessary tables for testing can to be known through dataset files (tests/app/data/*.yml files)
- Specify database connection data, from **configuration parameters** file, is necessary.
- This library is testing against real database using DBUnit, so **pdo** & **pdo_mysql** PHP extensions have to be installed.

## Contributors

- Jesús Hernando Sancha <jesushs80@gmail.com> (developer)